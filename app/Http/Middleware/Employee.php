<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
Use Auth;


class Employee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $employee = Auth::user();
            // dd($employee->role_id);
            if ($employee->role_id == 2) {
               
                return $next($request);
            }
                abort(403);
            
        }
    }
}
