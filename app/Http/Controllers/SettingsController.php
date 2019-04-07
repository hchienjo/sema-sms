<?php

namespace App\Http\Controllers;

use App\User;
use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(Request $request){

        $users = User::with('organization')
            ->paginate(25);

        return view('users.index', ['users' => $users]);
    }

    public function passwords(Request $request){
        $settings = Setting::sdpPasswords()->get();
        return view('dashboard.passwords', [
            'settings' => $settings
        ]);
    }
}
