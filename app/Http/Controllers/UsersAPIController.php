<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Category;

class UsersAPIController extends Controller
{
		// Available filters
		protected $filters = ['live', 'nonLive'];

		/**
		* Fetch all users
		*/
		public function users(Request $request)
		{
			// Build basic query
			$users = User::buildQuery();

			// Validate/sanitize and apply filters if any
			$filter 	= $request->filter 		? filter_var($request->filter, FILTER_SANITIZE_STRIPPED) : '';
			$category = $request->category 	? filter_var($request->category, FILTER_VALIDATE_INT) : '';
			$keywords = $request->keywords 	? filter_var($request->keywords, FILTER_SANITIZE_STRIPPED) : '';

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

			return 'User deleted...';
		}

		public function categories()
		{
			$categories = Category::all();

			return $categories;
		}

		public function updateStatus (User $user)
		{
			$user->updateStatus();

			return $user->status;
		}

		/**
		* Filters
		*/
		private function live($builder) {
			return $builder->where('users.status', 'live');
		}

		private function nonLive($builder) {
			return $builder->where('users.status', 'non live');
		}

		private function byCategory($builder, $category) {
			return $builder->where('users.category_id', $category);
		}

		private function applyKeywords($builder, $keywords) {
			$builder->where('users.name', 'like', '%'.$keywords.'%')
				->orWhere('users.lastname', 'like', '%'.$keywords.'%')
				->orWhere('users.email', 'like', '%'.$keywords.'%')
				->orWhere('users.idNumber', 'like', '%'.$keywords.'%');
			
			return $builder;
		}

		/**
		* Helpers
		*/

		private function categoryExists($id) {
			return Category::where('id', $id)->exists();
		}
}
