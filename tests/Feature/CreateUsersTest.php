<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUsersTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function admin_can_register_users()
	{
		$this->withoutExceptionHandling();
			// Given we are the admin
				// authentication goes here!

			// When we register a new user with the necessary information
			$user = factory('App\User')->make();

			$this->post('/users', $user->toArray());

			// Then the db must have the new record
			// I can't user assertSee because the view is beign rendered with vue
			// There is a way to test it better? IMPORTANT!
			$this->assertDatabaseHas('users', [
				'idNumber'	=> $user->idNumber,
				'email' 		=> $user->email,
			]);
	}
}
