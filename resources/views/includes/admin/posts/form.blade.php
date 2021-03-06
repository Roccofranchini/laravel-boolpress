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
     <form class="" method='POST' enctype="multipart/form-data"
         action="{{ route('admin.posts.update', $post->id) }}">
         @method('PATCH')
     @else
         <form class="row" method='POST' enctype="multipart/form-data"
             action="{{ route('admin.posts.store') }}">
 @endif
 @csrf
 <div class="mb-3 col-6 px-4">
     <label for="title" class="form-label">Title</label>
     <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
         value="{{ old('title', $post->title) }}" placeholder="">
     <div class="invalid-feedback">Inserire il titolo del Post</div>
 </div>


 <div class="mb-3 px-4">
     <label for="image" class="form-label">Image</label>
     <input type="file" class="form-control-file" id="image" name="image">
 </div>
 <div class="mb-3 col-8  px-4">
     <label for="content" class="form-label">Descrizione</label>
     <textarea class="form-control @error('title') is-invalid @enderror" id="content" name="content"
         rows="3">{{ old('content', $post->content) }}</textarea>
     <div class="invalid-feedback">Inserire la descrizione del Post</div>
 </div>
 <div class="mb-3 col-4 px-4">
     <label for="category_id">Categoria</label>
     <select class="form-control" id="category_id" name="category_id">
         <option>nessuna categoria</option>
         @foreach ($categories as $category)
             <option @if (old('category_id', $post->category_id) == $category->id)
                 selected
                 @endif value="{{ $category->id }}">{{ $category->name }}</option>
         @endforeach
     </select>

 </div>

 <div class="mb-3 px-4">
     <fieldset>
         <h5>Tags</h5>
         @foreach ($tags as $tag)
             <div class="form-check form-check-inline">
                 <input class="form-check-input" type="checkbox" id="{{ $loop->iteration }}" {{-- controlla innanzititto se c'è una vecchia richiesta (old) con 'tags', in quel caso cerca l'Id lì, altrimenti cerca nel tagIds (che sono i valori checckati gia salvati nel database ) alrtimenti metti un array vuoto --}}
                     value="{{ $tag->id }}" name="tags[]" @if (in_array($tag->id, old('tags', $tagIds ?? [])))
                 checked
         @endif>
         {{-- mettiamo tag[] in modo tale che ci restitusca un array con i valori "checckati" --}}
         <label class="form-check-label" for="{{ $loop->iteration }}">{{ $tag->name }}</label>
 </div>
 @endforeach
 </fieldset>
 </div>


 <div class="col-12 text-center my-4">
     <button type="submit" class="btn btn-dark">@yield('aggiungi-modifica')</button>
 </div>
 </form>
