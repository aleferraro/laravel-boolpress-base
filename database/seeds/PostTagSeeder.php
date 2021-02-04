<?php

use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

use Illuminate\Support\Facades\DB;

use App\Post;
use App\Tag;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $posts = Post::all();
        $tags = Tag::all();

        foreach ($posts as $post) {
            
            for ($i = 0; $i <= $faker->numberBetween(1, 10); $i++) { 
                DB::table('post_tag')->insert([
                    'post_id' => $post->id,
                    'tag_id' => $faker->numberBetween(1, $tags->count())
                ]);
            }
        }

    }
}
