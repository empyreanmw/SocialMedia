<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'display_name' => $faker->name,
        'name' => str_replace(" ", "", $faker->name),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'avatar_path' => 'avatars/avatar.png',
        'data' => ['about' => 'About me', 'location' => getUserLocation()->location]
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    $user_id =  factory('App\User')->create()->id;
  
    return [
       'body' => $faker->paragraph. " #test",
       'user_id' => $user_id
    ];
});

$factory->define(App\Replies::class, function (Faker\Generator $faker) {
    
        return [
            'replied_id' => function () {
                return factory('App\Post')->create()->id;
            },
            'replied_type' => 'App\Post',
           'body' => $faker->paragraph,
           'user_id' => function () {
               return factory('App\User')->create()->id;
           }
        ];
    });