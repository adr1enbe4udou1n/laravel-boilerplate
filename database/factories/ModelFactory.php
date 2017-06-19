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
use App\Models\User;

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'),
        'active' => true,
        'confirmed' => true,
        'locale' => app()->getLocale(),
        'timezone' => config('app.timezone'),
    ];
});

$factory->define(App\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        'locale' => app()->getLocale(),
        'name' => $faker->word,
    ];
});

$factory->define(App\Models\Post::class, function (Faker\Generator $faker) {
    $count = User::count();

    return [
        'user_id' => $faker->numberBetween(1, $count - 1),
        'en' => [
            'title' => $faker->sentence,
            'summary' => $faker->sentences(3, true),
            'body' => '<p>' . implode('</p><p>', $faker->paragraphs) . '</p>',
        ],
        'fr' => [
            'title' => $faker->sentence,
            'summary' => $faker->sentences(3, true),
            'body' => '<p>' . implode('</p><p>', $faker->paragraphs) . '</p>',
        ],
        'status' => $faker->numberBetween(0, 2),
        'promoted' => $faker->boolean,
        'pinned' => $faker->boolean,
        'published_at' => $faker->dateTimeBetween('-2 days', '+2 days')
    ];
});
