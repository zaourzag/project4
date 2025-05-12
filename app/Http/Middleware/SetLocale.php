<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session::has('locale') && in_array(Session::get('locale'), array_keys(config('app.available_locales', ['en' => 'English'])))) {
            App::setLocale(Session::get('locale'));
        } else {
            // Optionally, set a default locale if no session is found or if the session locale is invalid
            App::setLocale(config('app.locale'));
        }

        return $next($request);
    }
}
