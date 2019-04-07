<?php

namespace App\Http\Controllers;

use App\ContactGroup;
use App\CustomOutbox;
use App\Job;
use App\Outbox;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function billing(Request $request){
        $user = Auth::user();
        $transactions = [];
        if($user->user_group == 1){
            $transactions = DB::table('transactions')
                ->orderBy('createdAt', 'DESC')
                ->simplePaginate(30);
        }
        else{
            $transactions = DB::table('transactions')
                ->where('organizationID', '=', $user->company_id)
                ->orderBy('createdAt', 'DESC')
                ->simplePaginate(30);
        }
        return view('dashboard.billing', [
            'transactions' => $transactions,
            'user_group' => $user->user_group,
        ]);
    }

    public function bulk_outbox(Request $request){
        $products = Service::where('type', '=', 1)
            ->where('organizationID', '=', Auth::user()->company_id)
            ->pluck('productID');
        $outboxes = Outbox::whereIn('productID', $products)
            ->orderBy('createdAt', 'DESC')
            ->simplePaginate(50);
        return view('dashboard.bulk', [
            'outboxes' => $outboxes,
        ]);
    }

    public function config(Request $request){
        return view('dashboard.config');
    }
 
    public function express_outbox(Request $request){
        return view('dashboard.express');
    }

    public function api_outbox(Request $request){
        return view('dashboard.api');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = DB::table('contactGroups')
            ->select('name', 'contactGroupID')
            ->where('type', '=', 1)
            ->where('organizationID', '=', Auth::user()->company_id)
            ->orderBy('name')
            ->get();

        $senders = DB::table('services')
            ->select('serviceName', 'serviceID')
            ->where('type', '=', 1)
            ->where('organizationID', '=', Auth::user()->company_id)
            ->orderBy("friendlyName")
            ->get();
            
        return view('dashboard.home', [
            'groups' => $groups,
            'senders' => $senders,
        ]);
    }

    public function job_results(Request $request, $jobid){
        $job = Job::findOrFail($jobid);
        $outboxes = Outbox::where('internalIdentifier', '=', $job->identifier)
            ->orderBy('deliveryStatus')
            ->simplePaginate(15);
        return view('dashboard.outbox', [
            'job' => $job,
            'outboxes' => $outboxes
        ]);
    }

    public function job_summary(Request $request, $jobid){
        $summary = DB::select('SELECT deliveryStatus, COUNT(*) AS N FROM outbox WHERE internalIdentifier = ? GROUP BY deliveryStatus', [$jobid]);
        return view('dashboard.summary', [
            'jobid' => $jobid,
            'summary' => $summary,
        ]);
    }
    
    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }

    public function scheduled(Request $request){
        $jobs = Job::orderBy('deletedAt', 'DESC')
            ->whereRaw('userID IN (SELECT id FROM users WHERE company_id = ?)', [Auth::user()->company_id])
            ->whereIn('type', [1,2,3])
            ->simplePaginate(15);
        return view('dashboard.scheduled',[
            'jobs' => $jobs,
        ]);
    }

    public function scheduled_custom(Request $request){
        $jobs = Job::orderBy('deletedAt', 'DESC')
            ->whereRaw('userID IN (SELECT id FROM users WHERE company_id = ?)', [Auth::user()->company_id])
            ->whereIn('type', [9])
            ->simplePaginate(15);
        return view('dashboard.scheduled_custom',[
            'jobs' => $jobs,
        ]);
    }

    public function custom_approve(Request $request, $jobid){
        $job = Job::where('identifier', '=', $jobid)
            ->where('status', '=', 1)
            ->firstOrFail();
        $data = [
            "identifier" => $job->identifier,
            "sendAt" => $job->deletedAt->setTimeZone('UTC')->toDateTimeString(),
            'organizationID' => '' . Auth::user()->company_id,
        ];
        
        $success = $this->enqueue_upload(json_encode($data), "/approvedCustomBulk/");
        $message = $success ? "Approval Successful": "Unable to approve. Please try later.";
        if ($success){
            $job->status = 2;
            $job->save();
        }

        return redirect()->back()->with([
            'message' => $message,
            'processed' => $success,
            'success' => $success,
            'custom' => 'true',
        ]);
    }

    public function scheduled_outbox(Request $request, $jobid){
        $job = Job::findOrFail($jobid);
        $outboxes = CustomOutbox::where('internalIdentifier', '=', $job->identifier)
            ->orderBy('createdAt', 'DESC')
            ->simplePaginate(30);
        return view('dashboard.custom_outbox', [
            'job' => $job,
            'outboxes' => $outboxes
        ]);
    }

    public function subscribe_results(Request $request){
        $jobs = Job::orderBy('createdAt', 'DESC')
            ->whereRaw('CHAR_LENGTH(identifier) < 9')
            ->whereRaw('userID IN (SELECT id FROM users WHERE company_id = ?)', [Auth::user()->company_id])
            ->simplePaginate(15);
        return view('dashboard.scheduled',[
            'jobs' => $jobs,
        ]);
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
