<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;


$factory->define(App\Models\Post::class, function (Faker $faker) {
    $disk = config('backpack.base.root_disk_name'); // use Backpack's root disk; or your own
        $destination_path = 'public/uploads/posts/thumbnails';
    $image = \Image::make($faker->imageUrl(300,300))->encode('jpg', 90);
            // 1. Generate a filename.
            $filename = time().rand(10,99).'.jpg';

            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            // 3. Save the public path to the database
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);

    return [
        //
        'title'=> $faker->catchPhrase(),
        'thumbnail' => $public_destination_path.'/'.$filename,
        'content' => $faker->realText(10000,4),
        'user_id' => 1,
        'last_user_id' => 1,
        'publish' => 1,
    ];
});
