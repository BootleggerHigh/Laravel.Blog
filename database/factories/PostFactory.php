<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->realText(40,5);
    $short_title = Str::length($title) > 30 ? mb_substr($title, 0, 30) . '...' : $title;
    $created = $faker->dateTimeBetween('-30 days','-1 days');
    $descr = $faker->realText(100,5);
    return [
        'title' => $title,
        'short_title' => $short_title,
        'author_id'=>rand(1,4),
        'descr'=>$descr,
        'created_at'=>$created,
        'updated_at'=>$created,
    ];

});
