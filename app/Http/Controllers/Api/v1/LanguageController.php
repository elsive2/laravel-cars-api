<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
	/**
	 * Handle the incoming request.
	 *
	 * @param  string  $lang
	 * @return \Illuminate\Http\Response
	 */
	public function __invoke(string $lang)
	{
		if (array_key_exists($lang, config('languages'))) {
			session(['applocale' => $lang]);
		}
		return back();
	}
}
