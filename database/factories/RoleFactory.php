<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Role::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
    ];
});

$factory->define(App\Models\Permission::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'display_name' => $faker->name,
        'description' => $faker->text,
    ];
});
