<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\UrlStr;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

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

        $url = new Url();

        $url->long_url = $request->url_long;
        $url->title = $request->url_title ?? '';
        $url->description = $request->url_description ?? '';
        $url->alias = $request->url_alias ?? '';

        $url->save();

        return redirect('/');
    }

    /**
     * Show the profile for a given user.
     */
    public function show(string $id): View
    {
        return view('url', [
            'url' => Url::find($id),
        ]);
    }

    public function cleanForm(Request $request): View {
        $cleanUrl = '';
        return view('url-clean', [
            'clean_url' => $cleanUrl,
        ]);
    }

    public function clean(Request $request): View {
        $urlLongData = parse_url($request->url_long);
        $urlString = new UrlStr();

        // @todo
        $cleanUrl = $urlString->fromParseUrl($urlLongData);

        return view('url-clean', [
            'clean_url' => $cleanUrl,
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
