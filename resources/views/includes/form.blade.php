 {{-- FORM CREATE, con i name = alle colonne del nostro DB, con metodo Post e una volta inserito @csrf per il token di
Laravel, specificato "submit" come type del nostro button e indicando nell'action del Form la route comics.store del controller che "salverà questi dati" --}}
 @if ($errors->any())
     <div class="alert alert-danger my-4">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
 @endif
 @if ($post->exists)
     <form class="" method='POST' action="{{ route('admin.posts.update', $post->id) }}">
         @method('PATCH')
     @else
         <form class="row" method='POST' action="{{ route('admin.posts.store') }}">
 @endif
 @csrf
 <div class="mb-3 col-6 px-4">
     <label for="title" class="form-label">Title</label>
     <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
         value="{{ old('title', $post->title) }}" placeholder="">
     <div class="invalid-feedback">Inserire il titolo del Post</div>
 </div>
 <div class="mb-3 col-6 px-4">
     <label for="iamge" class="form-label">Image</label>
     <input type="text" class="form-control" id="iamge" name="iamge" value="{{ old('iamge', $post->image) }}"
         placeholder="">
 </div>
 <div class="mb-3 col-8 offset-2 px-4">
     <label for="content" class="form-label">Descrizione</label>
     <textarea class="form-control @error('title') is-invalid @enderror" id="content" name="content"
         rows="3">{{ old('content', $post->content) }}</textarea>
     <div class="invalid-feedback">Inserire la descrizione del Post</div>
 </div>
 <div class="col-12 d-flex justify-content-between">
     <button type="submit" class="btn btn-dark text-center d-block">@yield('aggiungi-modifica')</button>
     <a href="{{ URL::previous() }}" class="btn btn-primary">Indietro</a>
 </div>
 </form>