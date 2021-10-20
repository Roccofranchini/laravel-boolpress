@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->content }}</p>
        <address>{{ $post->getFormattedDate('created_at') }}</address>
        <div class="text-center"><a href="{{ URL::previous() }}" class="btn btn-primary">Indietro</a></div>
    </div>
@endsection
