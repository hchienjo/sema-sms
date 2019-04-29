<?php

namespace App\Http\Controllers;

use App\Organization;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class OrganizationsController extends Controller
{
    public function __contruct(){
        return $this->middleware('auth');
    }
    
    public function index(Request $request){
        $orgs = Organization::simplePaginate(15);
        return view('organization.index', [
            'orgs' => $orgs
        ]);
    }

    public function add(Request $request){
        return view('organization.add');
    }

    public function save(Request $request){
        $request->validate([
            'name' => 'required|string|min:3|max:25',
            'type' => 'required|integer|min:1|max:9',
        ]);

        $org = new Organization();
        $org->companyName = $request->name;
        $org->createdAt = Carbon::now()->toDateTimeString();
        $org->type = $request->type;
        $org->status = 1; //active for now
        $org->save();

        return redirect()->back()->with([
            'success' => true,
            'message' => "Organization created",
            'processed' => true,
        ]);
    }

    public function topup(Request $request){
        $orgs = Organization::orderBy('companyName')
            ->get();
        return view('organization.topup', [
            'orgs' => $orgs,
        ]);
    }

    public function save_topup(Request $request){
        $request->validate([
            'amount' => 'required|integer',
            'description' => 'required|string',
            'organizationID' => 'required|integer'
        ]);

        $key = 'units.' . $request->organizationID;
        $new = Redis::incrbyfloat($key, $request->amount);

        $identifier = bin2hex(openssl_random_pseudo_bytes(8));

        $description = sprintf("User %s topup organization %d: new value %d", Auth::user()->name, $request->organizationID, $new);
        $id = DB::table('transactions')->insertGetId(
            [
                'organizationID' => $request->organizationID,
                'value' => $request->amount,
                'identifier' => $identifier,
                'description' => $description,
                'createdAt' => Carbon::now()->toDateTimeString(),
            ]
        );

        return redirect()->back()->with([
            'success' => true,
            'processed' => true,
            'message' => $description,
        ]);
    }
}
