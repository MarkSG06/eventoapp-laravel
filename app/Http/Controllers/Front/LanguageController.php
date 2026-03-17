<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\LanguageRequest;
use App\Models\MySQL\Sitemap;

class LanguageController extends Controller
{
	public function __construct(Sitemap $sitemap)
	{
	}

	public function changeLanguage(LanguageRequest $request)
	{
		$language = $request->language;
		$path = $request->path;
		$sitemap = Sitemap::where('path', $path)->first();
		\Debugbar::info('sitemap: ' . $sitemap, 'path: ' . $path, 'language: ' . $language);
		$routeName = $sitemap->route_name;
		$languagePath = $sitemap->language;

		$routeName = str_replace($languagePath, $language, $routeName);

		$redirect = Sitemap::where('route_name', $routeName)->first();

		return response()->json([
			'success' => true,
			'path' => $redirect->path
		]);
	}
}