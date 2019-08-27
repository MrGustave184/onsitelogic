<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
				// $this->call(UsersTableSeeder::class);
				factory('App\Category', 5)->create();
				factory('App\User', 20)->create();
    }
}
