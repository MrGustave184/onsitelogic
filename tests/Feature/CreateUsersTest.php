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
		// $this->withoutExceptionHandling();
			// Given we are the admin
				// authentication goes here!

			// When we register a new user with the necessary information
			$user = factory('App\User')->make();
			// dd($user->toArray());

			$this->post('/users', $user->toArray());
			
			// We should see the new user in the main view
			$this->get('/users')
				->assertSee($user->name)
				->assertSee($user->lastname)
				->assertSee($user->category->name);
	}
}
