<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request){

        $users = User::with('organization')
            ->paginate(25);

        return view('users.index', ['users' => $users]);
    }
}
