<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
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
        if (isset($request->segments()[0]) && in_array($request->segments()[0], config('app.available_locales'))) {
            $locale = $request->segment(1);
            App::setLocale($locale);
            URL::defaults(['locale' => $locale]);
        } else {
            App::setLocale(App::getLocale());
            URL::defaults(['locale' => App::getLocale()]);

            $url = App::getLocale() . '/';
            // Redirect to the same URL with the new locale added to the segments. 302 is a temporary redirect. 301 is a permanent redirect. 307 is a temporary redirect with the same method (GET, POST, etc.) as the original request. 308 is a permanent redirect with the same method as the original request. 303 is a temporary redirect with a GET method.
            return Redirect::to($url, 302);
        }

        return $next($request);
    }
}
