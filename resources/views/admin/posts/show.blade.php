@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-lg">
            <h3 class="card-header">{{ $post->title }}</h3>
            <div class="card-body">
                <h5 class="card-title">
                    <address>Categoria: @if ($post->category)
                            <span
                                class="badge badge-pill badge-{{ $post->category->color }}">{{ $post->category->name }}</span>
                        @else
                            Nessuna categoria
                        @endif
                    </address>
                </h5>
                <p class="card-text">{{ $post->content }}</p>
                <div class="d-flex justify-content-between">
                    <a href="{{ URL::previous() }}" class="btn btn-primary">Indietro</a>
                    <div class="card-tags">
                        @if ($post->tags)
                            @foreach ($post->tags as $tag)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $tag->color }}">{{ $tag->name }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
