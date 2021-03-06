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
                    <th scope="col">Categoria</th>
                    <th scope="col">Tag</th>
                    <th scope="col">Pubblicato il</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>
                            @if ($post->category)
                                <span
                                    class="badge badge-pill badge-{{ $category->color ?? 'light' }} px-3">{{ $post->category->name }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @forelse ($post->tags as $tag)
                                <span class="badge badge-pill"
                                    style="background-color: {{ $tag->color }}">{{ $tag->name }}</span>
                            @empty

                            @endforelse
                        </td>
                        <td>
                            {{ $post->created_at }}
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-success">Modifica</a>
                            <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-primary mx-2">Mostra</a>
                            <form method="POST" action="{{ route('admin.posts.destroy', $post->id) }}"
                                class="delete-form d-inline-block" data-post="{{ $post->title }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger ms-2">Delete</button>
                            </form>
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
        <section id="posts_by-categories">
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-4 mb-3">
                        <div class="card h-100" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $category->name }}</h5>
                                <ul class="card-text pl-0">
                                    @forelse ($category->posts as $post)
                                        <li class="list-unstyled">
                                            <a class="text-decoration-none"
                                                href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a>
                                        </li>
                                    @empty
                                        <li class="list-unstyled">Nessun post in questa categoria.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
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
