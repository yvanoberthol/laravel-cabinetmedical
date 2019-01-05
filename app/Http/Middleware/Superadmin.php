<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Superadmin
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
        $user = User::find(Auth::id());
        $roles = array();

        if (is_array($user['roles']) || is_object($user['roles'])){
            foreach ($user['roles'] as $role){
                array_push($roles,$role->name);
            }
        }

        if (!in_array('superadmin',$roles)){
            return redirect()->route('medecins.index');
        }
        return $next($request);
    }
}
