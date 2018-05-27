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
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name'      => $faker->name,
        'email'     => $faker->unique()->safeEmail,
        'password'  => bcrypt('secret'),
        'active'    => true,
        'confirmed' => true,
        'locale'    => app()->getLocale(),
        'timezone'  => config('app.timezone'),
    ];
});

$factory->define(App\Models\Meta::class, function (Faker\Generator $faker) {
    return [
        'title' => [
            'en' => $faker->sentence,
            'fr' => $faker->sentence,
            'es' => $faker->sentence,
            'ar' => $faker->sentence,
        ],
        'description' => [
            'en' => $faker->sentences(3, true),
            'fr' => $faker->sentences(3, true),
            'es' => $faker->sentences(3, true),
            'ar' => $faker->sentences(3, true),
        ],
    ];
});

$factory->define(Spatie\Tags\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => [
            'en' => $faker->unique()->word,
            'fr' => $faker->unique()->word,
            'es' => $faker->unique()->word,
            'ar' => $faker->unique()->word,
        ],
    ];
});

$factory->define(App\Models\Post::class, function (Faker\Generator $faker) {
    $publishedDate = null;
    $unPublishedDate = null;

    if ($faker->boolean) {
        $publishedDate = $faker->dateTimeBetween('-2 days', '+2 days');
        $unPublishedDate = $faker->dateTimeBetween($publishedDate, '+2 days');
    }

    return [
        'title' => [
            'en' => $faker->sentence,
            'fr' => $faker->sentence,
            'es' => $faker->sentence,
            'ar' => $faker->sentence,
        ],
        'summary' => [
            'en' => $faker->sentences(3, true),
            'fr' => $faker->sentences(3, true),
            'es' => $faker->sentences(3, true),
            'ar' => $faker->sentences(3, true),
        ],
        'status'         => $faker->numberBetween(0, 2),
        'promoted'       => $faker->boolean(10),
        'pinned'         => $faker->boolean(5),
        'published_at'   => $publishedDate,
        'unpublished_at' => $unPublishedDate,
    ];
});
