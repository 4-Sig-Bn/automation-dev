<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function index()
    {
        // $users = User::all();
        $users = User::with('roles')->get();

        $loggedInUser = auth()->user(); // Get the currently authenticated user

        // Get session data
        $loginTime = Session::get('login_time');
        $isLoggedIn = Session::get('is_logged_in');

        return view('config.user.index', compact('users', 'loggedInUser', 'loginTime', 'isLoggedIn'));
    }
}
