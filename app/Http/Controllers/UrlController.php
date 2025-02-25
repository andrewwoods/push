<?php

namespace App\Http\Controllers;

use App\Models\Url;
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
        $url = new Url();

        $url->long_url = $request->url_long;
        $url->title = $request->url_title;
        $url->description = $request->url_description;
        $url->alias = $request->url_alias;

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
