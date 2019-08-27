<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Categoria;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'apellido' => $faker->name,
        'status' => $faker->randomElement(['asistente', 'inasistente']),
        'email' => $faker->unique()->safeEmail,
				'fechaNacimiento' => $faker->date(),
				'telefono' => $faker->phoneNumber,
				'direccion' => $faker->address,
				'cedula' => $faker->randomNumber(8),
				'remember_token' => Str::random(10),
				'categoria_id' => function() {
					return Categoria::inRandomOrder()->first()->id;
				}
    ];
});
