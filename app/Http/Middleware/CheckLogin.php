<?php

namespace App\Http\Middleware;

use Closure;
use Request;

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
        if(session('foo')){
            return $next($request);
        }
        else{
            // return view('setfoo')->with('message', 'aaaaaa');
            return redirect('setfoo')->with('message','You must set foo to continue' );
        }

        
    }
}