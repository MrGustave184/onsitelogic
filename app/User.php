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
}
