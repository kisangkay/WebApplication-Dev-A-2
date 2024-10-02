<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class check_user_role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $user_role): Response
    {
        if (auth::check() && auth()->user()->user_role === $user_role) {//if user logged in and has the matching role
//            @dd($user_role);
            return $next($request);
        }

        return redirect()->route('courses')->with('feedback', 'RESTRICTED ACCESS');//otherwise go homepage and see error
    }
}
