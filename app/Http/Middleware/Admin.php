<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user()->role_id == Role::ADMIN){
            return $next($request);
        }
        return redirect('home')->with('error','Permission Denied!!! You do not have administrative access.');
        return $next($request);
    }
}
