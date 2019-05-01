<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $activities = Activity::orderBy('created_at', 'desc')->get();

        return view('activity-logs')
            ->with('data', $activities)
            ->with('page_name', 'Activity logs');
    }
}
