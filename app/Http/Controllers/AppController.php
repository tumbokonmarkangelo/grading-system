<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Subject;
use App\Classes;
use App\Activity;

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
            $user = Auth::user();
            $activity['user_id'] = $user->id;
            $activity['log'] = $user->name . ' login to system.';
            $activity = Activity::create($activity);
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
            ->with('page_name', 'Welcome!');
    }

    public function users_management(Request $request)
    {
        $user = Auth::user();
        $admins = User::where('id', '!=', $user->id)->where('type', 'admin')->orderBy('first_name', 'asc')->get();
        $teachers = User::where('type', 'teacher')->orderBy('first_name', 'asc')->get();
        $students = User::where('type', 'student')->orderBy('first_name', 'asc')->get();

        return view('users-management')
            ->with('page_name', 'Users Management')
            ->with('admins', $admins)
            ->with('teachers', $teachers)
            ->with('students', $students);
    }

    public function subjects_management(Request $request)
    {
        $data = Subject::orderBy('code', 'asc')->get();
        return view('subjects-management')
            ->with('page_name', 'Subjects Management')
            ->with('data', $data);
    }

    public function classes_management(Request $request)
    {
        $user = Auth::user();
        $data = new Classes;
        if ($user->type == 'teacher') {
            $data = $data->whereHas('subjects', function ($query) use ($user) {
                $query->where('teacher_id', $user->id);
            });
            $data = $data->where('status', 'active');
        }
        $data = $data->orderBy('code', 'asc')->get();
        
        return view('classes-management')
            ->with('page_name', 'Classes Management')
            ->with('data', $data);
    }


}
