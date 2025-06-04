@extends('layouts.main')

@section('title', 'View a Short URL')

@section('description', 'Display all the details about a single URL record')

@section('content')
<!-- url.blade.php -->
<h1>View a URL</h1>

<div>
    <h2><a href="{{ url('url', $url->id) }}"> {{ $url->title }}</a></h2>
    <p><b>Alias:</b> {{ $url->alias }}</p>
    <p><b>Destination:</b> <code>{{ $url->long_url }}</code></p>
    <p>{{ $url->description }}</p>
</div>
@endsection
