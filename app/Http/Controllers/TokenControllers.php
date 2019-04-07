<?php

namespace App\Http\Controllers;

use App\ApiToken;
use App\Organization;
use Illuminate\Http\Request;

class TokenControllers extends Controller
{
    public function index(Request $request){
        $tokens = ApiToken::with('organization')->orderBy('createdAt', 'DESC')
            ->paginate(10);

        return view('token.index', [
            'tokens' => $tokens,
        ]);
    }

    public function add(Request $request){
        $orgs = Organization::orderBy('companyName')
            ->get();
        return view('token.add', [
            'orgs' => $orgs
        ]);
    }

    public function save(Request $request){
        $token = bin2hex(openssl_random_pseudo_bytes(16));
        $tok = new ApiToken();
        $tok->key = $token;
        $tok->organizationID = $request->organizationID;
        $tok->save();

        return redirect()->route('tokens.index')->with([
            'message' => "Generated token $token",
        ]);
    }
}
