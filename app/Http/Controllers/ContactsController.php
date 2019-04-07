<?php

namespace App\Http\Controllers;

use App\Contact;
use App\ContactGroup;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ContactsController extends Controller
{
    public function __contruct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('contacts.index');
    }

    public function add(){
        $contactGroups = DB::table('contactGroups')
            ->select('name', 'contactGroupID')
            ->where('organizationID', '=', Auth::user()->company_id)
            ->orderBy('name')
            ->get();
        return view('dashboard.contacts', [
            'contactGroups' => $contactGroups
        ]);
    }

    public function groups(Request $request){
        $user = Auth::user();
        $contactGroups = DB::select('SELECT *, (SELECT COUNT(*) FROM contacts c WHERE c.contactGroupID = g.contactGroupID) AS nContacts FROM contactGroups g WHERE organizationID = ? ORDER BY name', 
            [
                $user->company_id
            ]);
        return view('contacts.groups', ['contactGroups' => $contactGroups]);
    }

    public function group_contacts(Request $request, $contactGroupID){
        $user = Auth::user();
        $contactGroup = ContactGroup::where('contactGroupID', '=', $contactGroupID)
            ->where('organizationID', '=', $user->company_id)
            ->firstOrFail();

        $contacts = Contact::where('contactGroupID', '=', $contactGroupID)
            ->simplePaginate(15);

        return view('contacts.group_contacts', [
            'contacts' => $contacts,
            'contactGroup' => $contactGroup,
        ]);
    }

    public function upload(Request $request){
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $uploadingToExistingGroup = false;
        $contactGroupID = 0;
        if (empty($request->contactGroupName)){
            $request->validate([
                'contactGroupID' => 'required|integer|exists:contactGroups'
            ]);
            $uploadingToExistingGroup = true;
            $contactGroupID = $request->contactGroupID;
        }
        else {
            $request->validate([
                'contactGroupName' => 'sometimes|min:4|max:55|unique:contactGroups,name',
            ]);
        }

        $userID = Auth::user()->id;
        $companyID = Auth::user()->company_id;
        $identifier = hash('crc32b', $userID . Carbon::now());

        $path = Storage::putFileAs('csvs', $request->file('file'),
            $identifier . ".csv" );

        if (!$uploadingToExistingGroup){
            $contactGroupID = DB::table('contactGroups')->insertGetId(
                [
                    'organizationID' => $companyID,
                    'name' => $request->contactGroupName,
                    'createdAt' => Carbon::now()->toDateTimeString(),
                    'status' => 1,
                ]
            );
        }

        $data = [
            'contactGroupID' => '' . $contactGroupID,
            'contactGroupName' => $request->contactGroupName,
            'identifier' => '' . $identifier,
            'organizationID' => '' . $companyID,
            'path' => env('CONTACTS_UPLOAD_PATH') . $path,
        ];

        $jsonedData = json_encode($data);

        $success = $this->enqueue_upload($jsonedData);
        $message = $success ? "Your file is being processed." : "Sorry, could not process your file. Try again later.";

        if ($success){
            DB::insert("insert into `jobs` SET identifier = ?, name = 'file upload', userID = ?, type = 1, createdAt = NOW()",
            [
                $identifier, $userID
            ]);
        }


        return redirect()->back()->with([
            'message' => $message,
            'success' => $success,
            'processed' => true,
            ]
        );
    }

    private function enqueue_upload($data){
        $ch = curl_init(env('GOBLIN_SERVER_URL') . '/contacts/');
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
