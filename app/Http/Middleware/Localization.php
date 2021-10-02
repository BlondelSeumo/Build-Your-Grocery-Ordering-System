<?php

namespace App\Http\Middleware;

use Closure;
use App\CompanySetting;
use App\Language;

class Localization
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
        if (session()->has('locale')) {
            \App::setLocale(session()->get('locale'));
        } else {
            $default = CompanySetting::first()->language;
            $language = Language::where('name',$default)->first();
            \App::setLocale($default);
            session()->put('locale', $default);
            session()->put('direction', $language->direction);
        }
        return $next($request);
    }
}
