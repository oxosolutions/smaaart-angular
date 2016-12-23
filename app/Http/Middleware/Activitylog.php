<?php

namespace App\Http\Middleware;

use Closure;
use Activity;
class Activitylog
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
            $current_url = $request->route()->getUri(); 
           Activity::log($current_url);

        return $next($request);
    }
}
