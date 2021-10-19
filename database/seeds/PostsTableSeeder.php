<?php
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
        for ($i = 0; $i < 50; $i++ ) {
            //per ogni giro istanziamo un nuovo post, lo riempiamo e lo salviamo
            $post = new Post(); 

                $post->title = $faker->text(50);
                $post->content = $faker->paragraphs(2, true);
                $post->image = $faker->imageUrl(250, 250);
                $post->slug = Str::slug($post->title, '-');

            $post->save();
        }
    }
}
