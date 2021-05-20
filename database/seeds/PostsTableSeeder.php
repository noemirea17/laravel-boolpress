<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;
use Illuminate\Support\Str; //serve ad importare lo slug

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 10; $i++) {
            $new_post = new Post();

            $new_post->title = $faker->sentence(3);
            $new_post->text = $faker->paragraph();
            $new_post->author = $faker->name();

            $slug = Str::slug($new_post->title, '-');

            //verifico che lo slag non esista già nel database
            $slug_base = $slug;

            $post_presente = Post::where('slug', $slug)->first(); //select * from posts where slug = $slug
            $contatore = 1;
           
            while($post_presente) {
                $slug = $slug_base . '-' . $contatore;
                $contatore++;
                $post_presente = Post::where('slug', $slug)->first();
            }

            $new_post->slug = $slug;
            $new_post->user_id = 1;
            $new_post->save();

        }
    }
}
