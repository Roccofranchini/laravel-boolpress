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
 @if ($category->exists)
     <form class="" method='POST' action="{{ route('admin.categories.update', $category->id) }}">
         @method('PATCH')
     @else
         <form class="row" method='POST' action="{{ route('admin.categories.store') }}">
 @endif
 @csrf
 <div class="mb-3 col-6 px-4">
     <label for="name" class="form-label">Name</label>
     <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
         value="{{ old('name', $category->name) }}" placeholder="">
     <div class="invalid-feedback">Inserire il nome della categoria</div>
 </div>

 <div class="mb-3 col-6 px-4">
     <label for="color" class="form-label">Color</label>
     <select name="color" class="form-control" id="color">
         <option>Nessuna categoria</option>
         <option @if (old('color', $category->color) && old('color', $category->color) == $category->color) selected

             @endif value="success">Verde</option>
         <option @if (old('color', $category->color) && old('color', $category->color) == $category->color) selected

             @endif value="danger">Rosso</option>
         <option @if (old('color', $category->color) && old('color', $category->color) == $category->color) selected

             @endif value="primary">Blue</option>
         <option @if (old('color', $category->color) && old('color', $category->color) == $category->color) selected

             @endif value="warning">Giallo</option>
         <option @if (old('color', $category->color) && old('color', $category->color) == $category->color) selected

             @endif value="secondary">Grigio</option>
     </select>
 </div>

 <div class="col-12 text-center my-4">
     <button type="submit" class="btn btn-dark">@yield('aggiungi-modifica')</button>
 </div>

 </form>
