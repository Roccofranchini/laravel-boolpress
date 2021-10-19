@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My Posts</h1>
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
                        <td><a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-primary">Mostra</a></td>
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
@endsection
