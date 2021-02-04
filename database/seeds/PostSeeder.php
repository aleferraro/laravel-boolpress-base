<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Post;
use App\PostInformation;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* factory(Post::class, 50)->create()->each(function($id){
            $id->save();
        }); */


        $faker = Faker\Factory::create();

        for($i = 0; $i < 100; $i++){
            $newPost = new Post();

            $newPost->title = $faker->sentence;
            $newPost->author = $faker->name;
            $newPost->category_id = $faker->numberBetween(1, 10);

            $newPost->save();

            $postId = $newPost->id;

            $newPostInformation = new PostInformation();

            $newPostInformation->description = $faker->paragraph;
            $newPostInformation->slug = Str::slug($newPost->title, '-');
            $newPostInformation->post_id = $postId;

            $newPostInformation->save();

        }
    }
}
