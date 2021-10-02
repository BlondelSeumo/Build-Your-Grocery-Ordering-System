<?php

namespace App\Http\Middleware;

use Closure;
use App\Setting;
use App\Location;

class DefaultLocation
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
        if(Setting::where('id',1)->first()->location != null) {
            if (!session()->exists('location_id') && !session()->exists('location_name')) {
                $default_loc = Location::find(Setting::where('id',1)->first()->location);
                if(!$default_loc->status){
                    session()->put('location_id', $default_loc->id);
                    session()->put('location_name', $default_loc->name);
                }
            }
        }
        return $next($request);
    }
}
