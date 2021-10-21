@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card title">
                <h1 class="ml-3">{{ $post->title }}</h1>
            </div>
            <div class="card-body">
                <p>{{ $post->content }}</p>
                <address>Pubblicato il: {{ $post->getFormattedDate('created_at') }}</address>
                <address>Categoria: @if ($post->category)
                        {{ $post->category->name }}
                    @else
                        Nessuna categoria
                    @endif
                </address>
                <div class="text-center"><a href="{{ URL::previous() }}" class="btn btn-primary">Indietro</a></div>
            </div>
        </div>
    </div>
@endsection
