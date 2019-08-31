<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;

class UsersAPIController extends Controller
{
		// Available filters
		protected $filters = ['checkedIn', 'notCheckedIn'];

		/**
		* Fetch all users
		*/
		public function users(Request $request)
		{
			// Build basic query
			$users = $this->buildQuery();

			// Validate/sanitize and apply filters if any
			if($request->filter)		$filter 	= filter_var($request->filter, FILTER_SANITIZE_STRIPPED);
			if($request->category)	$category = filter_var($request->category, FILTER_VALIDATE_INT);
			if($request->keywords)	$keywords = filter_var($request->keywords, FILTER_SANITIZE_STRIPPED);

			if($filter && in_array($filter, $this->filters)) {
				$users = $this->$filter($users);
			}

			if($category && $this->categoryExists($category)) {
				$users = $this->byCategory($users, $category);
			}

			if($keywords) {
				$users = $this->applyKeywords($users, $keywords);
			}
			
			// Return results
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

			return response(200);
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

		private function applyKeywords($builder, $keywords) {
			$builder->where('users.name', 'like', '%'.$keywords.'%')
				->orWhere('users.lastname', 'like', '%'.$keywords.'%')
				->orWhere('users.email', 'like', '%'.$keywords.'%')
				->orWhere('users.idNumber', 'like', '%'.$keywords.'%');
			
				return $builder;
		}

		private function buildQuery() {
			$query = \DB::table('users')
				->join('categories', 'users.category_id', '=', 'categories.id')
				->select('users.name', 'users.lastname', 'users.email', 'users.status', 'users.id', 'categories.name as category');

			return $query;
		}
}
