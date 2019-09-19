<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        factory(App\Models\Post::class, 30)->create();
        factory(App\Models\Tag::class, 10)->create();
        $this->call(PostTagSeeder::class);
    }
}
