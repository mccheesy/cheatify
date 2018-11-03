<?php

use Faker\Generator as Faker;

$factory->define(App\Cheat::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(6, true),
        'description' => $faker->paragraph(6, true),
        'code' => $faker->bothify('????????'),
        'creator_id' => function () {
            $creator = factory(App\User::class)->create();
            return $creator->id;
        },
    ];
});
