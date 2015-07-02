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
        'name'           => '',
        'uri'            => '',
        'hero_image_uri' => '',
        'hero_text'      => $faker->text(700),
        'content'        => $faker->text(1000),
        'is_enabled'     => true,
    ];
});