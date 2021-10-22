@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>New Post</h1>
    @section('aggiungi-modifica', 'aggiungi')
    @include('includes.admin.posts.form')
</div>
@endsection
