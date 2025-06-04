<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\UrlStr;
use App\UrlParser;
use Illuminate\Database\RecordNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use UrlParser as UrlParserUrlParser;
use stdClass;

class UrlController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function create(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'url_long' => 'required|url:http,https',
            'url_title' => 'required|max:70',
            'url_description' => 'max:170',
            'url_alias' => 'max:16',
        ]);

        $urlParser = new UrlParser($validated['url_long']);
        $urlLong = $urlParser->str();

        $url = new Url();
        $url->long_url = $urlLong ?? '';
        $url->title = $validated['url_title'] ?? '';
        $url->description = $validated['url_description'] ?? '';
        $url->alias = $validated['url_alias'] ?? '';

        $url->save();

        return redirect('/');
    }

    /**
     * Show the profile for a given user.
     */
    public function show(string $id): View
    {
        $url = new stdClass();
        $url->id = $id;
        $url->title = '';
        $url->long_url = '';
        $url->description = '';

        try {
            $url = Url::find($id);
            return view('url', [
                'url' => $url,
            ]);
        } catch (RecordNotFoundException $e) {
            abort(404);
        }
    }

    public function cleanForm(Request $request): View
    {
        $cleanUrl = '';
        return view('url-clean', [
            'clean_url' => $cleanUrl,
        ]);
    }

    public function clean(Request $request): View
    {
        $validated = $request->validate([
            'url_long' => 'required|url:http,https',
        ]);
        $query_string = parse_url($validated['url_long'], PHP_URL_QUERY);
        parse_str($query_string, $initial_params);

        $parser = new UrlParser($validated['url_long']);
        $cleanUrl = $parser->str();

        return view('url-clean', [
            'initial_url' => $validated['url_long'],
            'clean_url' => $cleanUrl,
            'params' => $initial_params,
            'debug' => env('APP_DEBUG'),
        ]);
    }

    /**
     * Redirect the short URL id to it's corresponding long url.
     *
     * @param int $id the numeric ID the represents the long URL
     */
    public function redirect(string $id): RedirectResponse
    {
        $url = Url::find($id);

        return redirect($url->long_url);
    }
}
