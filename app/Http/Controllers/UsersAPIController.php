<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;

class UsersAPIController extends Controller
{
		// Filters array
		protected $filters = ['checkedIn', 'notCheckedIn'];

		// Fetch all users
		public function users(Request $request)
		{
			$users = \DB::table('users')
				->join('categories', 'users.category_id', '=', 'categories.id')
				->select('users.name', 'users.lastname', 'users.email', 'users.status', 'users.id', 'categories.name as category');

			$filter = $request->filter;
			$category = $request->category;

			if($filter && in_array($filter, $this->filters)) {
				$users = $this->$filter($users);
			}

			if($category && $this->categoryExists($category)) {
				$users = $this->byCategory($users, $category);
			}
			
			return $users->orderBy('users.created_at', 'desc')->paginate(15);
		}

			/**
			*	Return single user
			*/
			public function show(User $user)
			{
				return $user;
			}

		public function destroy(User $user)
		{
			$user->delete();

			return 'User Deleted...';
		}

		public function categories()
		{
			$categories = Category::all();

			return $categories;
		}

		public function updateStatus (User $user)
		{
			$status = $user->status == 'asistente' ? 'inasistente' : 'asistente';

			$user->update(['status' => $status]);

			return $user->status;
		}

		public function search(Request $request)
		{
			$keywords = $request->keywords;

			$query = \DB::table('users')
				->join('categories', 'users.category_id', '=', 'categories.id')
				->select('users.name', 'users.lastname', 'users.email', 'users.status', 'users.id', 'categories.name as category');

			$users = $query
				->where('users.name', 'like', '%'.$keywords.'%')
				->orWhere('users.lastname', 'like', '%'.$keywords.'%')
				->orWhere('users.email', 'like', '%'.$keywords.'%')
				->orWhere('users.idNumber', 'like', '%'.$keywords.'%');

			return $users->orderBy('users.created_at', 'desc')->paginate(15);
		}

		/**
		* Filters
		*/
		private function checkedIn($builder) {
			return $builder->where('users.status', 'asistente');
		}

		private function notCheckedIn($builder) {
			return $builder->where('users.status', 'inasistente');
		}

		private function byCategory($builder, $category) {
			return $builder->where('users.category_id', $category);
		}

		private function categoryExists($id) {
			return Category::where('id', $id)->exists();
		}
}
