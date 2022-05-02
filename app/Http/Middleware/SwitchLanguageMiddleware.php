<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SwitchLanguageMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
	 * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
	 */
	public function handle(Request $request, Closure $next)
	{
		if (session()->has('applocale') && array_key_exists(session('applocale'), config('languages'))) {
			App::setLocale(session('applocale'));
		} else {
			App::setLocale(config('app.fallback_locale'));
		}
		return $next($request);
	}
}
