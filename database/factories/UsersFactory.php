<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use App\Category;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'lastname' => $faker->lastname,
        'status' => $faker->randomElement(['live', 'non live']),
        'email' => $faker->unique()->safeEmail,
				'birthdate' => $faker->date(),
				'phone' => $faker->phoneNumber,
				'address' => $faker->address,
				'idNumber' => $faker->randomElement(['V-', 'E-']) . $faker->randomNumber(8),
				'remember_token' => Str::random(10),
				'category_id' => function() {
					// Find a random category in the DB
					$randomCategory = Category::inRandomOrder()->first();

					// If random ucategory was found, return his id, else create a new category and return his id 
					return $randomCategory ? $randomCategory->id : factory('App\Category')->create()->id;
				},
				'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
				'is_admin' => 0
		];
});
