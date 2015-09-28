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

$factory->define(TeachersAsTutors\User::class, function ($faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->email,
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'is_enabled'     => true,
    ];
});

$factory->defineAs(TeachersAsTutors\User::class, 'admin', function ($faker) use ($factory) {
    $user = $factory->raw(TeachersAsTutors\User::class);

    return array_merge($user, ['permission_id' => 1]);
});

$factory->defineAs(TeachersAsTutors\User::class, 'tutor', function ($faker) use ($factory) {
    $user = $factory->raw(TeachersAsTutors\User::class);

    return array_merge($user, ['permission_id' => 2]);
});

$factory->defineAs(TeachersAsTutors\User::class, 'parent', function ($faker) use ($factory) {
    $user = $factory->raw(TeachersAsTutors\User::class);

    return array_merge($user, ['permission_id' => 3]);
});

$factory->define(TeachersAsTutors\Page::class, function ($faker) {
    return [
        'hero_text'  => $faker->text(700),
        'content'    => $faker->text(1000),
        'is_enabled' => true,
    ];
});

$factory->defineAs(TeachersAsTutors\Page::class, 'blog-post', function ($faker) use ($factory) {
    $page = $factory->raw(TeachersAsTutors\Page::class);

    $name = $faker->text(30);

    return array_merge($page,
        [
            'parent_id' => 5,
            'name'      => $name,
            'uri'       => 'blog/' . \Carbon\Carbon::now()->format('Y-m-d') . '/' . str_slug($name),
        ]);
});

$factory->define(TeachersAsTutors\Resource::class, function ($faker) {
    return [
        'desc'              => $faker->sentence,
        'original_filename' => str_slug($faker->text(50)) . '.' . $faker->fileExtension,
        'filename'          => str_slug($faker->text(50)) . '.' . $faker->fileExtension,
        'size'              => $faker->randomNumber(),
        'extension'         => $faker->fileExtension,
        'mime_type'         => $faker->mimeType,
        'is_enabled'        => true,
    ];
});

$factory->define(TeachersAsTutors\Report::class, function ($faker) {
    return [
        'parent_id'  => 1,
        'name'       => $faker->text(50),
        'slug'       => str_slug($faker->text(50)),
        'report'     => $faker->text(1000),
        'is_enabled' => true,
    ];
});

$factory->define(TeachersAsTutors\Lesson::class, function ($faker) {
    return [
        'tutor_id'    => 1,
        'parent_id'   => 10,
        'started_at'  => $faker->date,
        'ended_at'    => $faker->date,
        'hourly_rate' => $faker->randomFloat(2),
    ];
});