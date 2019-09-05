<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
		// dates in the $dates array will be coverted into carbon instances
		protected $dates = ['birthdate'];

		protected $guarded = [];

		public function category()
		{
			return $this->belongsTo(Category::class);
		}

		public function path()
		{
			return \URL::to('/users') . '/' . $this->id;
		}

		public function updateStatus()
		{
			$status = $this->status == 'live' ? 'non live' : 'live';

			return $this->update(['status' => $status]);
		}

		static public function buildQuery() 
		{
			$query = \DB::table('users')
				->join('categories', 'users.category_id', '=', 'categories.id')
				->select('users.name', 'users.lastname', 'users.email', 'users.status', 'users.id', 'categories.name as category');

			return $query;
		}

		static public function getUsers() 
		{
			return User::select('name', 'lastname', 'email', 'status', 'id', 'category_id')
					->latest()
					->paginate(15);
		}
}