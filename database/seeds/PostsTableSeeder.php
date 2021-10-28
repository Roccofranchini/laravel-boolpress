<?php
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Support\Arr;

// as è un alias, dopo la riga 6 ci permette di chiamare questa classe solo con "Faker"
use Faker\Generator as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)

    {   
        //vogliamo gli id delle categorie, quindi del modello Category seleziona solo la colonna ID, poi usiamo pluck per ricevere direttamente l'ID, ma dato che abbiamo comunque una collection che contiene gli Id utiliziamo toArray che ci restituisce solo l'array di id 

        $categories_id = Category::select('id')->pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++ ) {
            //per ogni giro istanziamo un nuovo post, lo riempiamo e lo salviamo
            $post = new Post(); 

                //usiamo l'helper arr  e la sua funzione random per assegnare ogni giro del ciclo un category id diverso
                $post->category_id = Arr::random($categories_id);
                $post->title = $faker->text(50);
                $post->content = $faker->paragraphs(2, true);
                $post->slug = Str::slug($post->title, '-');

            $post->save();
        }
    }
}
