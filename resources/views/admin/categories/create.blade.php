@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>New Category</h1>
    @section('aggiungi-modifica', 'aggiungi')
    @include('includes.admin.categories.form')
</div>
@endsection
