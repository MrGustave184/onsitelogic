<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Participante;
use Faker\Generator as Faker;
use App\Categoria;

$factory->define(Participante::class, function (Faker $faker) {
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
