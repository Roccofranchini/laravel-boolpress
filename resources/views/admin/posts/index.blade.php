@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-between my-4">
            <h1>My Posts</h1>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary my-2">Aggiungi</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Pubblicato il</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->title, 50 }}</td>
                        <td>{{ $post->getFormattedDate('created_at') }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.posts.destroy', $post->id) }}"
                                class="delete-form d-inline-block" data-post="{{ $post->title }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger ms-2">Delete</button>
                            </form>
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-success mx-2">Modifica</a>
                            <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-primary">Mostra</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Non ci sono post da visualizzare</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <footer class="d-flex justify-content-center">
            {{ $posts->links() }}
        </footer>
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
