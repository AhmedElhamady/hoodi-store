<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $defultLang = 'en';
        $locale = $request->header('Accept-Language') ?? $defultLang;
        if (!in_array($locale, ['en', 'ar'])) {
            $locale = 'en';
        }
        app()->setLocale($locale);
        return $next($request);
    }
}