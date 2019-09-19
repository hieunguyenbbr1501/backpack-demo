<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Post;
use App\Models\Tag;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();

        
        $post = Post::pluck('id')->all();
        $tagIds = Tag::pluck('id')->all();

        for($i=1; $i <= 30; $i++) {

            DB::table('post_tag')->insert([
                'post_id' => $faker->randomElement($post),
                'tag_id' => $faker->randomElement($tagIds)
            ]);


        }
    }
}
