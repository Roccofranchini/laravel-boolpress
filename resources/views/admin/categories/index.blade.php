@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-between my-4">
            <h1>My Categories</h1>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary my-2">Aggiungi</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Colore</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <th>{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td class="text-right">
                            <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}"
                                class="delete-form d-inline-block" data-post="{{ $category->name }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger ms-2">Delete</button>
                            </form>
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                class="btn btn-success mx-2">Modifica</a>
                            <a href="{{ route('admin.categories.show', $category->id) }}"
                                class="btn btn-primary">Mostra</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Non ci sono categorie da visualizzare</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    @section('scripts')
        <script>
            const deleteFormElements = document.querySelectorAll(".delete-form");
            deleteFormElements.forEach(form => {
                form.addEventListener("submit", function(e) {
                    const title = form.getAttribute("data-post");
                    e.preventDefault(); //impedisco che parte il form e che riaggiorna diretto la pagina
                    const confirm = window.confirm(
                        `Sei sicuro di voler eliminare ${title} ?`
                    );
                    if (confirm) this.submit();
                });
            });
        </script>
    @endsection
@endsection
