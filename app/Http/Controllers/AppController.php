<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AppController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('login')
                ->with('page_name', 'Login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        } else {
            return redirect()->intended('/')->with('authenticate_message', 'Please check login credentials.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->intended('/');
    }

    public function index(Request $request)
    {
        return view('home')
            ->with('page_name', 'Home');
    }

    public function users_management(Request $request)
    {
        $user = Auth::user();
        $admins = User::where('id', '!=', $user->id)->where('type', 'admin')->get();
        $teachers = User::where('type', 'teacher')->get();
        $students = User::where('type', 'student')->get();

        return view('users-management')
            ->with('page_name', 'Users Management')
            ->with('admins', $admins)
            ->with('teachers', $teachers)
            ->with('students', $students);
    }


}
