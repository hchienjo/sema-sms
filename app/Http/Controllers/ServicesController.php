<?php

namespace App\Http\Controllers;

use App\Service;
use App\Subscriber;
use App\Organization;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Propaganistas\LaravelPhone\PhoneNumber;

class ServicesController extends Controller
{
    public function index(Request $request, $type = 'bulk'){
        $services = Service::withCount('subscribers')->where('type', '=', 2)
            ->orderBy('serviceName')->simplePaginate(10);
        return view('services.index', [
                'services' => $services
            ]
        );
    }

    public function bulk(Request $request){
        $services = Service::where('type', '=', 1)
            ->orderBy('serviceName')->simplePaginate(10);
        return view('services.bulk', [
                'services' => $services
            ]
        );
    }

    public function summary(Request $request, $productID, $serviceName){
        $n = Subscriber::where('productID', '=', $productID)
            ->where('status', '=', 1)->count();
        return view('services.summary', [
            'N' => $n,
            'serviceName' => $serviceName,
            'productID' => $productID,
        ]);
    }

    public function add(Request $request){
        return view('services.add');
    }

    public function register(Request $request){
        $orgs = Organization::orderBy('companyName')->get();
        return view('services.register',[
            'orgs' => $orgs,
        ]);
    }

    public function save_bulk(Request $request){
        $request->validate([
            'serviceID' => 'required|integer',
            'productID' => 'required|string',
            'spid' => 'required|integer',
            'shortCode' => 'required|integer',
            'serviceName' => 'required|string',
            'organizationID' => 'required|integer'
        ]);

        $processed = false;
        $success = false;
        $message = "Sucessfully added service";

        $service = new Service();
        $service->serviceID = $request->serviceID;
        $service->productID = $request->productID;
        $service->shortCode = $request->shortCode;
        $service->organizationID = $request->organizationID;
        $service->spid = $request->spid;
        $service->serviceName = $request->serviceName;
        $service->type = 1; // bulk product
        $service->createdAt = Carbon::now()->toDateTimeString();
        try {
            $service->save();
            $success = true;
        }
        catch(\Illuminate\Database\QueryException $ex){
            $message = "Could not save. Error: " . $ex->getMessage();
        }
        return redirect()->back()->with([
            'message' => $message,
            'processed' => $processed,
            'success' => $success,
        ]);

        return $request;
    }

    public function save(Request $request){
        $validData = $request->validate([
            'serviceID' => 'required|integer',
            'productID' => 'required|string',
            'spid' => 'required|integer',
            'shortCode' => 'required|integer',
            'serviceName' => 'required|string',
        ]);

        $processed = false;
        $success = false;
        $message = "Sucessfully added service";

        $service = new Service();
        $service->serviceID = $request->serviceID;
        $service->productID = $request->productID;
        $service->shortCode = $request->shortCode;
        $service->organizationID = Auth::user()->company_id;
        $service->spid = $request->spid;
        $service->serviceName = $request->serviceName;
        $service->type = 2; // subscribable product
        $service->createdAt = Carbon::now()->toDateTimeString();
        try {
            $service->save();
            $success = true;
        }
        catch(\Illuminate\Database\QueryException $ex){
            $message = "Could not save. Error: " . $ex->getMessage();
        }
        return redirect()->back()->with([
            'message' => $message,
            'processed' => $processed,
            'success' => $success,
        ]);
    }

    public function subscribers(Request $request, $productID, $serviceName){
        $subscribers = Subscriber::where('productID', '=', $productID)
            ->where('status', '=', 1)
            ->orderBy('createdAt', 'DESC')
            ->simplePaginate(15);
        return view('services.subscribers', [
            'productID' => $productID,
            'serviceName' => $serviceName,
            'subscribers' => $subscribers,
        ]);
    }

    public function upload(Request $request, $productID, $serviceName){
        return view('services.manual', [
            'productID' => $productID,
            'serviceName' => $serviceName,
        ]);
    }

    public function enqueue(Request $request, $productID, $serviceName){
        $service = Service::where('productID', '=', $productID)->first();
        if(empty($service)){
            abort(404);
        }

        $request->validate([
            'keyword' => 'required|string:min:1|max:10',
            'file' => 'required|mimes:csv,txt',
        ]);

        $userID = Auth::user()->id;
        $companyID = Auth::user()->company_id;
        $identifier = hash('crc32b', $userID . Carbon::now());

        $path = Storage::putFileAs('csvs', $request->file('file'),
            $identifier . ".csv" );

        $name = "$serviceName manual subscribe";

        $data = [
            'productID' => $productID,
            'serviceID' => '' . $service->serviceID,
            'identifier' => $identifier,
            'keyword' => $request->keyword,
            'path' => env('CONTACTS_UPLOAD_PATH') . $path,
        ];

        $jsonedData = json_encode($data);
        $success = $this->enqueue_upload($jsonedData, "/manualSubs/");
        $message = $success ? "Your file is being processed." : "Sorry, could not process your file. Try again later.";

        if ($success){
            DB::insert("insert into `jobs` SET identifier = ?, name = ?, userID = ?, type = 2, createdAt = NOW()",
            [
                $identifier, $name, $userID
            ]);
        }

        return redirect()->back()->with([
            'message' => $message,
            'success' => $success,
            'processed' => true,
            ]
        );
    }

    public function schedule(Request $request, $productID){
        $service = Service::where('productID', '=', $productID)->first();
        return view('services.schedule', [
            'service' => $service
            ]);
    }

    public function enqueue_bulk_blast(Request $request){
        Session::put('bulk', true);
        Session::forget("express");
        $request->validate([
            'serviceID' => 'required|string',
            'contactGroupID' => 'required|integer',
            'message' => 'required|string|min:5',
            'date' => 'required|string',
            'time' => 'required|string',
        ]);

        $service = Service::where('serviceID', '=', $request->serviceID)
            ->where('type', '=', 1)
            ->firstOrFail();

        $sendTime = $this->parseTime($request->date . ' ' . $request->time);
        $identifier = bin2hex(openssl_random_pseudo_bytes(8));
        $name = substr($request->message, 0, 80) . '...';
        $type = 2;

        $data = [
            'organizationID' => '' . Auth::user()->company_id,
            'contactGroupID' => '' . $request->contactGroupID,
            'spid' => '' . $service->spid,
            'serviceID' => '' . $service->serviceID,
            'productID' => '' . $service->productID,
            'senderName' => '' . $service->shortCode,
            'internalIdentifier' => $identifier,
            'message' => $request->message,
            'sendAt' => $sendTime->setTimeZone('UTC')->toDateTimeString(),
        ];

        $jsonedData = json_encode($data);
        $res = $this->enqueue_content($jsonedData, '/bulk/');
        $message = $res["success"] ? "Your request is being processed." : "Sorry, could not process your request. Try again later.";

        if ($res["success"]){
            DB::insert("insert into `jobs` SET identifier = ?, name = ?, userID = ?, type = 1, createdAt = NOW(), deletedAt = ?",
            [
                $identifier, $name, Auth::user()->id, $sendTime->toDateTimeString()
            ]);
        }

        return redirect()->back()->with([
            'message' => $message,
            'success' => $res["success"],
            'processed' => true,
            ]
        );

    }

    public function enqueue_custom_blast(Request $request){
        Session::put('custom', true);
        Session::forget("express");
        Session::forget("bulk");
        $request->validate([
            'serviceID' => 'required|string',
            'message' => 'required|string|min:5',
            'date' => 'required|string',
            'time' => 'required|string',
            'file' => 'required|mimes:csv,txt',
        ]);

        $service = Service::where('serviceID', '=', $request->serviceID)
            ->where('type', '=', 1)
            ->firstOrFail();

        $sendTime = $this->parseTime($request->date . ' ' . $request->time);
        $identifier = bin2hex(openssl_random_pseudo_bytes(8));
        $name = substr($request->message, 0, 80) . '...';
        $type = 2;

        $path = Storage::putFileAs('csvs', $request->file('file'),
            $identifier . ".csv" );

        $data = [
            'organizationID' => '' . Auth::user()->company_id,
            'contactGroupID' => '' . $request->contactGroupID,
            'spid' => '' . $service->spid,
            'serviceID' => '' . $service->serviceID,
            'productID' => '' . $service->productID,
            'senderName' => '' . $service->shortCode,
            'internalIdentifier' => $identifier,
            'message' => $request->message,
            'sendAt' => $sendTime->setTimeZone('UTC')->toDateTimeString(),
            'path' => env('CONTACTS_UPLOAD_PATH') . $path,
        ];

        $jsonedData = json_encode($data);
        $res = $this->enqueue_content($jsonedData, '/customBulk/');
        $message = $res["success"] ? "Your request is being processed." : "Sorry, could not process your request. Try again later.";

        if ($res["success"]){
            DB::insert("insert into `jobs` SET identifier = ?, name = ?, userID = ?, type = 9, createdAt = NOW(), deletedAt = ?",
            [
                $identifier, $name, Auth::user()->id, $sendTime->toDateTimeString()
            ]);
        }

        return redirect()->back()->with([
            'message' => $message,
            'success' => $res["success"],
            'processed' => true,
            ]
        );

    }

    public function enqueue_express(Request $request){
        Session::put('express', true);
        Session::forget("bulk");
        $request->validate([
            'serviceID' => 'required|string',
            'msisdns' => 'required|string',
            'message' => 'required|string|min:5',
        ]);

        $service = Service::where('serviceID', '=', $request->serviceID)
            ->where('type', '=', 1)
            ->firstOrFail();

        $msisdns = $this->parseMsisdns($request->msisdns);
        $identifier = bin2hex(openssl_random_pseudo_bytes(8));
        $name = substr($request->message, 0, 80) . '...';
        $type = 2;
        $sendTime = Carbon::now()->setTimeZone('UTC')->toDateTimeString();

        $data = [
            'organizationID' => '' . Auth::user()->company_id,
            'spid' => '' . $service->spid,
            'serviceID' => '' . $service->serviceID,
            'productID' => '' . $service->productID,
            'senderName' => '' . $service->shortCode,
            'internalIdentifier' => $identifier,
            'message' => $request->message,
            'msisdns' => $msisdns,
            'sendAt' => $sendTime,
        ];

        $jsonedData = json_encode($data);
        $res = $this->enqueue_content($jsonedData, '/express/');
        $message = $res["success"] ? "Your request is being processed." : "Sorry, could not process your request. Try again later.";

        if ($res["success"]){
            DB::insert("insert into `jobs` SET identifier = ?, name = ?, userID = ?, type = ?, createdAt = NOW(), deletedAt = ?",
            [
                $identifier, $name, Auth::user()->id, $type, $sendTime
            ]);
        }

        return redirect()->back()->with([
            'message' => $message,
            'success' => $res["success"],
            'processed' => true,
            'express' => true,
            ]
        );
    }

    public function enqueue_blast(Request $request, $productID){
        $service = Service::where('productID', '=', $productID)->first();
        if(empty($service)){
            abort(404);
        }
        $request->validate([
            'message' => 'required|string|min:5|max:200',
            'date' => 'required|string',
            'time' => 'required|string',
        ]);

        $deadline = $this->parseTime($request->date . ' ' . $request->time);
        $identifier = bin2hex(openssl_random_pseudo_bytes(8));
        $name = $service->serviceName . " @ " . $deadline->toDateTimeString();
        $type = 3;
        $description = $name;

        $data = [
            'spid' => '' . $service->spid,
            'serviceID' => '' . $service->serviceID,
            'productID' => '' . $service->productID,
            'senderName' => '' . $service->shortCode,
            'internalIdentifier' => $identifier,
            'message' => $request->message,
            'sendAt' => $deadline->setTimeZone('UTC')->toDateTimeString(),
        ];

        $jsonedData = json_encode($data);
        $res = $this->enqueue_content($jsonedData);
        $message = $res["success"] ? "Your request is being processed." : "Sorry, could not process your request. Try again later." . $res["code"];

        if ($res["success"]){
            DB::insert("insert into `jobs` SET identifier = ?, name = ?, userID = ?, type = 3, createdAt = NOW(), deletedAt = ?",
            [
                $identifier, $name, Auth::user()->id, $deadline->toDateTimeString()
            ]);
        }

        return redirect()->back()->with([
            'message' => $message,
            'success' => $res["success"],
            'processed' => true,
            ]
        );
    }

    private function parseTime($in) {
        $error = \Illuminate\Validation\ValidationException::withMessages([
            'date' => ['invalid date/time'],
        ]);

        try {
            $c = Carbon::createFromFormat('Y-m-d H:i', $in, 'Africa/Nairobi');
            $d = Carbon::now()->setTimeZone('UTC');
            if ($c < $d) {
                throw $error;
            }
            return $c;
        }
        catch(Exception $ex){
            throw $error;
        }
    }

    private function parseMsisdns($in) {
        $error = \Illuminate\Validation\ValidationException::withMessages([
            'msisdns' => ['invalid phone number(s)'],
        ]);

        $extracted = preg_split('/[\s+,]+/', $in);

        $out = [];

        try {
            $len = count($extracted);
            if ($len == 0){
                throw $error;
            }
            for ($x=0;$x < $len; $x++){
                $a = phone($extracted[$x], 'KE');
                if (!$a->isOfType('mobile')) {
                    throw $error;
                }
                array_push($out, $a->formatForMobileDialingInCountry('KE'));
            }
            return $out;
        }
        catch (\libphonenumber\NumberParseException $ew){
            throw $error;
        }
        catch(Exception $ex){
            throw $error;
        }
    }

    private function enqueue_content($data, $endpoint = '/content/'){
        $ch = curl_init(env('GOBLIN_SERVER_URL') . $endpoint);
        curl_setopt_array($ch, [
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Length: ' . strlen($data),
            ],
        ]);
        $res = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $response = [
            'success' => false,
            'code' => 0
        ];
        $response["success"] = $httpcode == 200;
        $response["code"] = $httpcode;
        return $response;
    }

    private function enqueue_upload($data, $path = "/subscribers"){
        $response = [
            'success' => false,
            'code' => 0
        ];
        $ch = curl_init(env('GOBLIN_SERVER_URL') . $path);
        curl_setopt_array($ch, [
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Length: ' . strlen($data),
            ],
        ]);
        $res = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        return $httpcode == 200;
    }
}
