@extends('layouts.main')

@section('title', 'PUSH URL SHORTENER')

@section(
    'description',
    'A Personal, Self-hosted URL Shortener for people craving control over their tools'
    )

@section('content')
<h1>Push URL Shortener</h1>

<p>
   This is a paragraph of text. There are many like it but this one is mine.
</p>

<form action="/url/create" method="post" id="shorten" class="box-bordered">
    @csrf
    <h2>Shorten</h2>
    <div>
        <label for="url-long">Long URL</label>
        <input id="url-long"
            name="url_long"
            class="wide"
            type="url"
            placeholder="http://example.com/really/long/url"
            required />
    </div>
    <div>
        <label for="url-alias">Alias</label>
        <input id="url-alias"
            name="url_alias"
            class="countable"
            aria-describedby="url-alias-counter"
            type="text"
            maxlength="16" />
        <p class="counter screen-only" aria-hidden="true">Enter up to 16 characters</p>
        <p class="counter sr-only" id="url-alias-counter">Enter up to 16 characters</p>
    </div>
    <div>
        <label for="url-title">Title</label>
        <input id="url-title"
            name="url_title"
            class="wide countable"
            aria-describedby="url-title-counter"
            placeholder="Title for the Link"
            type="text"
            maxlength="70" />
        <p class="counter screen-only" aria-hidden="true">Enter up to 70 characters</p>
        <p class="counter sr-only" id="url-title-counter">Enter up to 70 characters</p>
    </div>
    <div>
        <label for="url-description">Description</label>
        <textarea id="url-description"
            name="url_description"
            aria-describedby="url-description-counter"
            placeholder="Description of the link"
            maxlength="170"
            class="wide countable"></textarea>
        <p class="counter screen-only" aria-hidden="true">Enter up to 170 characters</p>
        <p class="counter sr-only" id="url-description-counter">Enter up to 170 characters</p>
    </div>
    <div class="buttons">
        <input type="submit" id="submit-button">
    </div>
</form>

<div class="box-bordered">
    <h2>Newest URLs</h2>
    <ul>
    @foreach ($newestUrls as $newestUrl)
        <li>
        <a href="{{url("/", $newestUrl->id)}}" target="_blank">{{ $newestUrl->title }}</a>
        (<a href="{{url("/url", $newestUrl->id)}}">View</a>)
        </li>
    @endforeach
    </ul>
</div>
@endsection

