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

	/** @test */
	public function admin_can_filter_users_by_category()
	{
		$this->withoutExceptionHandling();
		
		$categoryOne = factory('App\Category')->create();
		$categoryTwo = factory('App\Category')->create();
		$userInCategoryOne = factory('App\User')->create(['category_id' => $categoryOne->id]);
		$userNotInCategoryOne = factory('App\User')->create(['category_id' => $categoryTwo->id]);

		$this->get('/categories/' . $categoryOne->id)
			->assertSee($userInCategoryOne->name)
			->assertDontSee($userNotInCategoryOne->name);
	}

	/** @test */
	public function admin_can_view_a_user_in_edit_mode()
	{

		$this->withoutExceptionHandling();

		// Given i am an admin 
			// Auth goes here!

		// When i hit the show single user endpoint 
		$user = factory('App\User')->create();

		$this->get('/users/' . $user->id . '/edit')

		// Then i should see that user info
			->assertSee($user->name)
			->assertSee($user->lastname)
			->assertSee($user->idNumber)
			->assertSee($user->birthdate->toDateString())
			->assertSee($user->category->name);
	}

	/** @test */
	public function admin_can_edit_users()
	{
		$user = factory('App\User')->create();

		$user->update([
			'name' 			=> 'Jhon', 
			'lastname'	=> 'Doe', 
			'email' 		=> 'jhondoetestproject@gmail.com',
			'phone' 		=> '555555', 
			'address' 	=> 'calle siempre viva', 
			'birthdate' => $user->birthdate
		]);

		$this->get('/users/' . $user->id)
			->assertSee($user->name)
			->assertSee($user->lastname)
			->assertSee($user->idNumber)
			->assertSee($user->birthdate->toFormattedDateString())
			->assertSee($user->category->name);
	} 
}
