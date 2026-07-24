<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Language;

class SetLocaleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('locale')) {
            app()->setLocale(session('locale'));
        } else {
            $defaultLang = Language::where('is_default', true)->first();
            if ($defaultLang) {
                app()->setLocale($defaultLang->code);
            }
        }

        return $next($request);
    }
}
