<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get('locale', 'vi');

        if (! in_array($locale, ['vi', 'en'], true)) {
            $locale = 'vi';
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
