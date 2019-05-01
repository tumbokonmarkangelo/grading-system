<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Subject;
use App\Classes;
use App\Activity;
use App\YearLevel;

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

    public function search(Request $request)
    {
        $keyword = $request->only('keyword')['keyword'];
        $users = User::where('username', 'like', $keyword.'%')->orWhere('first_name', 'like', $keyword.'%')->orWhere('middle_name', 'like', $keyword.'%')->orWhere('last_name', 'like', $keyword.'%')->orderBy('first_name', 'asc')->get();
        $students = $users->where('type', 'student');
        $teachers = $users->where('type', 'teacher');
        $subjects = Subject::where('code', 'like', $keyword.'%')->orWhere('name', 'like', $keyword.'%')->orWhere('description', 'like', $keyword.'%')->orderBy('name', 'asc')->get();

        return view('search')
            ->with('page_name', 'Search result')
            ->with('students', $students)
            ->with('teachers', $teachers)
            ->with('subjects', $subjects);
    }

    public function users_management(Request $request)
    {
        $user = Auth::user();
        $admins = User::where('id', '!=', $user->id)->where('type', 'admin')->orderBy('first_name', 'asc')->get();
        $teachers = User::where('type', 'teacher')->orderBy('first_name', 'asc')->get();
        $students = User::where('type', 'student')->orderBy('first_name', 'asc')->get();
        $assistants = User::where('type', 'assistant')->orderBy('first_name', 'asc')->get();
        $year_levels = YearLevel::get();

        return view('users-management')
            ->with('page_name', 'Users Management')
            ->with('year_levels', $year_levels)
            ->with('admins', $admins)
            ->with('teachers', $teachers)
            ->with('students', $students)
            ->with('assistants', $assistants);
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
