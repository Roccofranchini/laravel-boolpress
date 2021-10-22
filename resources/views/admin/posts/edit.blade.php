@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modify</h1>
    @section('aggiungi-modifica', 'modifica')
    @include('includes.admin.posts.form')
</div>
@endsection
