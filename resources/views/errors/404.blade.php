@extends('layouts.main')

@section('title', 'An Error Occurred | Push, the Personal URL Shortener')

@section(
    'description',
    'A Personal, Self-hosted URL Shortener for people craving control over their tools'
    )

@section('content')
<h2>An Error Occurred</h2>
<p>{{ $exception->getMessage() }}</p>
@endsection
