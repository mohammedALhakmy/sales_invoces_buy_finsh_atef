<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
           /* if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            } */
            if (Auth::guard($guard)->check()) {

            // write code for redierct both for admin or front in case login
                if ($request ->is('admin') || $request->is('admin/*')){

                // redirect of back end
                return redirect(RouteServiceProvider::Admin);
                }else{

                // redecrct with the front end in case is front end
//                return redirect(RouteServiceProvider::HOME);
                return redirect(RouteServiceProvider::Admin);
                }
            }

        }

        return $next($request);
    }
}
