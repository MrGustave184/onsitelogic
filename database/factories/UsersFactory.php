<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use App\Category;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'lastname' => $faker->name,
        'status' => $faker->randomElement(['asistente', 'inasistente']),
        'email' => $faker->unique()->safeEmail,
				'birthdate' => $faker->date(),
				'phone' => $faker->phoneNumber,
				'address' => $faker->address,
				'idNumber' => $faker->randomNumber(8),
				'remember_token' => Str::random(10),
				'category_id' => function() {
					return Category::inRandomOrder()->first()->id;
				}
		];
});
