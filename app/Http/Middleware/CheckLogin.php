<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        $adminuser = $request->session()->get('adminuser');
        //dd($adminuser);
        if(!$adminuser){
          $adminuser = $request->cookie('adminuser');
            if($adminuser){
            session(['adminuser'=>$adminuser]);
            $request->session()->save();
            // dump(session('adminuser'));
        }else{
             return redirect('/login');
        }
        return $next($request);
        }
    }
}
