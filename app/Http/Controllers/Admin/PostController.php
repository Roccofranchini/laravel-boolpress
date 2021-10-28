<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $categories = Category::all();
        $tags = Tag::all();
        $posts = Post::paginate(10); 
        return view('admin.posts.index', compact('posts', 'categories', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //creiamo un'istanza vuota per gestire il doppio form per creare/modificare gli elementi
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();

        // Per creare una nuova entità restituiamo una view create con l'apposito form
        return view('admin.posts.create', compact('post', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDAZIONE
        $request->validate([
            'title' => 'required|string|unique:posts|max:50',
            'content' => 'required|string',
            'price' => 'string',
            'category-id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            //se selezioniamo una delle categorie del db metterà l'id di questa, altrimenti sarà null
        ],
            //messagi degli errori
        [
            'required' =>"You must fill the :attribute field",
            'title.unique' => "Il titolo '$request->title' è già stato usato"
        ]);

        //raccogliamo utti i dati dellla request
        $data = $request->all();
        //creiamo una nuova istanza
        $post = new Post();
        //la rempiamo con i dati ricevuti
        $post->fill($data);
        //creiamo lo slug
        $post->slug = Str::slug($post->title, '-');
        //per salvare l'img con storage
        $img_path = Storage::put('public', $data['image']);
        $post->image = $img_path;
        //salviamo
        $post->save();
        
        //OPPURE
        //$post = Post::create($data);
        
        //se ho dei tags, creo la relazione
        if (array_key_exists('tags', $data)) $post->tags()->attach($data['tags']);
        

        //restituiamo la view della nuova entità creata
        return redirect()->route('admin.posts.show', $post-> id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        //recupero l'id del post da editare
        $tagIds = $post->tags->pluck('id')->toarray();
        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'tagIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // VALIDAZIONE
        $request->validate([
            'title' => ['required', 'string', Rule::unique('posts')->ignore($post->id), 'min:3'],
            'content' => 'required|string',
            'price' => 'string',
            'category-id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
            //se selezioniamo una delle categorie del db metterà l'id di questa, altrimenti sarà null
        ],
            //messagi degli errori
        [
            'required' =>"You must fill the :attribute field",
            'title.unique' => "Il titolo '$request->title' è già stato usato"
        ]);

        $data = $request->all();
        $post->fill($data);
        
    
       
        dd($data['image']);
            # code...
        $img_path = Storage::put('public', $data['image']);
        $post->image = $img_path;

        if(!array_key_exists('tags', $data)) $post->tags()->detach();
        else $post->tags()->sync($data['tags']);

        $post->save();
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('delete', $post->title);
    }
}
