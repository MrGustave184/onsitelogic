<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
		// // Instruct route model binding for the Channel model to not fetch the model by his id but
		// // by his slug instead
		// public function getRouteKeyName()
		// {
		// 	return 'name'; // Add a slug instead?
		// }

		public function users()
		{
			return $this->hasMany(User::class);
		}
}
