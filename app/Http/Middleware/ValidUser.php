<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Get the currently authenticated user
         $user = Auth::user();

         // Check if the user is an instance of the User model
        if ($user instanceof User) {
            // Eager load roles
            $user->load('roles'); 

            // Check if the user has the 'admin' role
            if ($user->roles->contains('roleName', 'admin')) {
                return $next($request);  // Proceed to the next middleware or route
            }
        }
         // Redirect to the welcome page if not an admin
         return redirect()->route('welcome');
    }
}
