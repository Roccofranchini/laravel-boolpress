@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h3 class="card-header">{{ $post->title }}</h3>
            <div class="card-body">
                <h5 class="card-title">
                    <address>Categoria: @if ($post->category)
                            {{ $post->category->name }}
                        @else
                            Nessuna categoria
                        @endif
                    </address>
                </h5>
                <p class="card-text">{{ $post->content }}</p>
                <a href="{{ URL::previous() }}" class="btn btn-primary ml-5">Indietro</a>
            </div>
        </div>
    </div>
@endsection
