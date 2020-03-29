<?php

namespace App\Http\Middleware;

use Closure;

class CheckPost
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
        if($request->id !== \Auth::user()->id)
        {
            return redirect()->route('post.index')->with("destroy","<strong>Ты пытался :)</strong>");
        }
        return $next($request);
    }
}
