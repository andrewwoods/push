@extends('layouts.main')

@section('title', 'Clean a Url')

@section(
    'description',
    'Remove known tracking parameters from the query string'
    )

@section('content')

@if ($clean_url)
    <div class="message-success">
        <h3>Your Cleaned Link</h3>
        <pre>{{ $clean_url }}</pre>
        <a href="{{ $clean_url }}">Open your link</a>
    </div>
@endif

<form action="/url/clean" method="post" id="shortenForm" class="box-bordered">
    @csrf
    <h2>Clean a URL</h2>
    @if ($errors->any())
        <div class="message-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form">
        <h3>Clean a Link</h3>
        <label for="url-long">Long URL</label>
        <input id="url-long"
            name="url_long"
            class="wide"
            type="url"
            placeholder="http://example.com/really/long/url?p1=value1&p2=value2"
            />
    </div>
    <div class="buttons">
        <input type="submit" class="button-submit" id="submit-button" value="Clean Url">
    </div>
</form>
@endsection

