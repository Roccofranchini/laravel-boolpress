@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-between">
            <h1>Modify</h1>
            <div class="d-flex align-items-end">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Indietro</a>
            </div>
        </div>
    @section('aggiungi-modifica', 'modifica')
    @include('includes.admin.categories.form')
</div>
@endsection
