<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Http\Request;

class SetLocaleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->input('locale') ?? app()->getLocale();

        App::setLocale($locale);
        return $next($request);
    }
}
