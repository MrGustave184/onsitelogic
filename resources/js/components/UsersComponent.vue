<template>
	<div>


		<!-- Filters -->
		<div class="row filters">
			<h5 class="filter-title">Filters: </h5>
			<a class="btn btn-secondary btn-sm filter-button text-white" @click="clearFilter()">Clear</a>
			<a class="btn btn-sm btn-secondary filter-button text-white" :class="{'btn-info':filter == 'checkedIn'}" @click="filterUsers('checkedIn')" >Checked in</a>
			<a class="btn btn-sm btn-secondary filter-button text-white" :class="{'btn-info':filter == 'notCheckedIn'}"  @click="filterUsers('notCheckedIn')" >Not Checked in</a>
		</div>
		<div class="row filters">
			<h5 class="filter-title">Categories: </h5>
			<a class="btn btn-secondary btn-sm filter-button text-white" @click="clearCategory" >Clear</a>
			<div v-for="category in categories" v-bind:key="category.id">
				<a class="btn btn-sm btn-secondary filter-button text-white" :class="{'btn-info':filterCategory == category.id}" @click="singleCategory(category.id)">{{ category.name}}</a>
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
						<td>{{ user.name }}</td>
						<td>{{ user.lastname }}</td>
						<td>{{ user.email }}</td>
						<td>{{ user.category }}</td>
						<td>
							<img v-show="user.status == 'asistente'" class="mb-2" src="images/check.png" alt="" width="24" height="24">
							<img v-show="user.status == 'inasistente'" class="mb-2" src="images/uncheck.png" alt="" width="24" height="24">
							{{ user.status }}
							</td>

						<!-- Actions -->
						<td class="row">
							<div class="actionButton">
								<a v-show="user.status == 'inasistente'" class="btn btn-success btn-sm text-white" @click="checkUser(user)" >Check in</a>
								<a v-show="user.status == 'asistente'" class="btn btn-secondary btn-sm text-white" @click="checkUser(user)">Uncheck</a>
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
				// Filtersarray goes here!!!!

				// The filter property will hold the current filter
				filter: '',
				filterCategory: '',
				categories: [],
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
		},

		methods: {
			/**
			 * Fetch all users
			 */
			fetchUsers: function (page = 1) {
				let requestRoute = 'api/users?page=' + page;
				
				if(this.filter) requestRoute += '&filter=' + this.filter;
				if(this.filterCategory) requestRoute += '&category=' + this.filterCategory;

				axios.get(requestRoute)
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
			 * Filter users
			 */
			filterUsers: function (filter) {
				this.filter = filter;

				this.fetchUsers();
			},

			/**
			 * Update user status
			 */
			checkUser: function (user) {
				// If user is already checked in, ask for comfirmation before uncheck it
				if(user.status == 'asistente' && (! confirm("Do you really want to uncheck this user?"))) {
					return;
				}
				
				user.status = user.status == 'asistente' ? 'inasistente' : 'asistente';

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

			// fetchCategories
			fetchCategories: function () {
				axios.get('api/categories')
					.then((response) => {
						console.log(response);
						this.categories = response.data;
					}).catch((error) => {
						console.log(error);
					});
			},

			singleCategory: function (category) {
				this.filterCategory = category;
				this.fetchUsers();
			},

			clearFilter: function () {
				this.filter = '';
				this.fetchUsers();
			},

			clearCategory: function () {
				this.filterCategory = '';
				this.fetchUsers();
			}
		},

		// computed: {
		// 	categories: () => {
		// 		 axios.get('api/categories')
		// 			.then((response) => {
		// 				this.categories = response.data;
		// 			}).catch((error) => {
		// 				console.log(error);
		// 			});
		// 	}
		// }
	}
</script>

<style>
	.title {
		margin-bottom: 40px;
	}

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