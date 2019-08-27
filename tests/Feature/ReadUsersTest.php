<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadUsersTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function admin_can_view_single_user()
	{
		// Given i am an admin 
			// Auth goes here!

		// When i hit the show single user endpoint 
		$user = factory('App\User')->create();

		$this->get('/users/' . $user->id)

		// Then i should see that user info
			->assertSee($user->name)
			->assertSee($user->lastname)
			->assertSee($user->idNumber)
			->assertSee($user->birthdate->toFormattedDateString())
			->assertSee($user->category->name);
	}
}
