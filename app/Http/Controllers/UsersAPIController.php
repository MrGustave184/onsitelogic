<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersAPIController extends Controller
{
		// Filters array
		protected $filters = ['CheckedIn', 'notChekedIn'];

		// Fetch all users
		public function users(Request $request)
		{
			$users = \DB::table('users')
				->join('categories', 'users.category_id', '=', 'categories.id')
				->select('users.name', 'users.lastname', 'users.email', 'users.status', 'users.id', 'categories.name as category');

			$filter = request('filter');

			if($filter) {
				$users = $this->$filter($users);
			}
			
			return $users->orderBy('users.created_at', 'desc')->paginate(15);
		}

		public function updateStatus (User $user)
		{
			$status = $user->status == 'asistente' ? 'inasistente' : 'asistente';

			$user->update(['status' => $status]);

			return $user->status;
		}

		private function checkedIn($builder) {
			return $builder->where('users.status', 'asistente');
		}

		private function notCheckedIn($builder) {
			return $builder->where('users.status', 'inasistente');
		}
}
