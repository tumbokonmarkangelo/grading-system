<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            if ($user->type == 'admin') {
                return redirect()->route('UsersManagement');
            } else if ($user->type == 'teacher') {
                return redirect()->route('GradesManagement');
            } else if ($user->type == 'student') {
                return redirect()->route('ViewGrade');
            } else if ($user->type == 'assistant') {
                return redirect()->route('ViewClassRecords');
            } else {
                return redirect()->route('User');
            }
        }

        return $next($request);
    }
}
