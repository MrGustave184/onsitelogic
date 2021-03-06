<template>
	<div>
		<!-- Filters -->
		<div class="row filters form-inline">
		<a class="btn btn-secondary filter-button text-white" @click="clearFilters('search')">Clear</a>
			<a class="btn btn-secondary filter-button text-white" :class="{'btn-info':keywords}">Search</a>
			<input v-model.lazy="keywords" v-debounce="500" class="form-control" type="text" placeholder="Keyword or ID" aria-label="Search">
		</div>
		<div class="row filters">
			<h5 class="filter-title">Filters: </h5>
			<a class="btn btn-secondary btn-sm filter-button text-white" @click="clearFilters('filter')">Clear</a>
			<a class="btn btn-sm btn-secondary filter-button text-white" :class="{'btn-info':filter.status == 'live'}" @click="filterUsers('filter', 'live')" >Live</a>
			<a class="btn btn-sm btn-secondary filter-button text-white" :class="{'btn-info':filter.status == 'nonLive'}"  @click="filterUsers('filter', 'nonLive')" >Non Live</a>
		</div>
		<div class="row filters">
			<h5 class="filter-title">Categories: </h5>
			<a class="btn btn-secondary btn-sm filter-button text-white" @click="clearFilters('category')" >Clear</a>
			<div v-for="category in categories" v-bind:key="category.id">
				<a class="btn btn-sm btn-secondary filter-button text-white" :class="{'btn-info':filter.category == category.id}" @click="filterUsers('category', category.id)">{{ category.name}}</a>
			</div>
		</div>

		<!-- Display Users -->
		<table class="table table-hover" id="participantes">
			<thead class="thead-dark" id="mytable">
				<tr>
					<th scope="col">Name</th>
					<th scope="col">Last Name</th>
					<th scope="col">Email</th>
					<th scope="col">Category</th>
					<th scope="col">Status</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody v-for="user in list.data" v-bind:key="user.id">
				<tr>
					<td><a v-bind:href="'/users/' + user.id">{{ user.name }}</a></td>
					<td>{{ user.lastname }}</td>
					<td>{{ user.email }}</td>
					<td>{{ user.category }}</td>
					<td>
						<img v-show="user.status == 'live'" class="mb-2" src="images/check.png" alt="" width="24" height="24">
						<img v-show="user.status == 'non live'" class="mb-2" src="images/uncheck.png" alt="" width="24" height="24">
						{{ user.status }}
						</td>

					<!-- Actions -->
					<td class="row">
						<div class="actionButton">
							<a v-show="user.status == 'non live'" class="btn btn-success btn-sm text-white" @click="checkUser(user)" >Check in</a>
							<a v-show="user.status == 'live'" class="btn btn-secondary btn-sm text-white" @click="checkUser(user)">Uncheck</a>
						</div>
						<div class="actionButton">
							<a v-bind:href="'/users/' + user.id + '/edit'" class="btn btn-info btn-sm text-white">Edit</a>
						</div>
						<div class="actionButton">
							<form action="">
								<a class="btn btn-danger btn-sm text-white" @click="deleteUser(user)">X</a>
							</form>
						</div>
					</td>
				</tr>
			</tbody>

			<pagination :data="list" @pagination-change-page="fetchUsers"></pagination>
		</table>
	</div>
</template>

<script>
	export default {
		data: function() {
			return {
				list: {},
				categories: [],
				filter: {
					status: '',
					category: '',
				},
				keywords: null,
				user: {
					id: '',
					name: '',
					lastname: '',
					email: '',
					category: '',
					status: ''
				}
			}
		},

		mounted: function () {
			console.log('Users component mounted...');
			this.fetchUsers();
			this.fetchCategories();
			console.log(this.keywords);
		},

		methods: {
			search: function(page = 1) {
				this.filter.status = null;
				this.filter.category= null;

				axios.get('api/users?page=' + page, { 
					params: { 
						keywords: this.keywords
					} })
					.then((response) => {
						this.list = response.data;
					})
					.catch(error => console.log(error));

				return;
			},

			/**
			 * Fetch all users
			 */
			fetchUsers: function (page = 1) {
				let requestRoute = 'api/users?page=' + page;
				
				if(this.filter.status) requestRoute += '&filter=' + this.filter.status;
				if(this.filter.category) requestRoute += '&category=' + this.filter.category;

				axios.get(requestRoute, {
						params: {
							keywords: this.keywords
						}})
					.then((response) => {
						console.log('fetching all users...');
						this.list = response.data;
					})
					.catch((error) => {
						console.log(error);
					})
					
					return;
			},

			/**
			 * Update user status
			 */
			checkUser: function (user) {
				// If user is already checked in, ask for comfirmation before uncheck it
				if(user.status == 'live' && (! confirm("Do you really want to uncheck this user?"))) {
					return;
				}
				
				user.status = user.status == 'live' ? 'non live' : 'live';

				axios.post('api/users/' + user.id + '/check')
					.then((response) => {
						console.log(response.data)
					}).catch((error) => {
						console.log(error);
					});

				return;
			},

			/**
			 * Delete User
			 */
			deleteUser: function(user) {
				if(! confirm("Do you really want to delete this user?")) return;

				axios.delete('api/users/' + user.id)
					.then((response) => {
						console.log(response);
						this.fetchUsers();
					}).catch((error) => {
						console.log(error);
					});

				return;
			},

			/**
			 * Fetch Categories
			 */
			fetchCategories: function () {
				axios.get('api/categories')
					.then((response) => {
						this.categories = response.data;
					}).catch((error) => {
						console.log(error);
					});
			},

			filterUsers: function (type, filter) {
				this.keywords = null;

				if(type == 'filter') this.filter.status = filter; 
				if(type == 'category') this.filter.category = filter; 

				this.fetchUsers();
			},

			clearFilters: function (item) {
				// I can use a variable variable here!
				if(item == 'filter') 		this.filter.status = null;
				if(item == 'category') 	this.filter.category = null;
				if(item == 'search') 		this.keywords = null;

				this.fetchUsers();
			},
		},

		watch: {
			keywords(after, before) {
					this.search();
			}
		}
	}
</script>

<style>
	.actionButton {
		margin-left: 5px;
		cursor: pointer;
	}

	.filters {
		margin: 20px 10px;
	}

	.filter-title {
		min-width: 100px;
	} 

	.filter-button {
		margin: 0 2px 0px 2px;
	}

	.debug {
		border: 1px solid black
	}
</style>