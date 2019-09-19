<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    return [
        //
        'title'=> $faker->catchPhrase(),
        'content' => "<p>".$faker->paragraph()."</p>",
        'user_id' => 1,
        'last_user_id' => 1,
        'publish' => 1,
    ];
});
