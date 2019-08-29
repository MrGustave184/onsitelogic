<template>
	<div>
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
					<transition name="slide-fade">
						<tr>
							<td><a v-bind:href="'/users/' + user.id">{{ user.name }}</a></td>
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
									<a class="btn btn-info btn-sm text-white">Edit</a>
								</div>
								<div class="actionButton">
									<form action="">
										<a class="btn btn-danger btn-sm text-white" @click="deleteUser(user)">X</a>
									</form>
								</div>
							</td>
						</tr>
					</transition>
				</tbody>

				<pagination :data="list" @pagination-change-page="fetchUsers"></pagination>
			</table>
	</div>
	<!-- Pagination -->
</template>

<script>
	export default {
		data: function() {
			return {
				list: {},

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
		},

		methods: {
			// Fetch all users
			fetchUsers: function (page = 1) {
				axios.get('api/users?page=' + page)
					.then((response) => {
						console.log('fetching all users...');
						this.list = response.data;
					})
					.catch((error) => {
						console.log(error);
					})
					
					return;
			},

			// Check in a user
			checkUser: function (user) {
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

			// Delete user
			deleteUser: function(user) {
				if(! confirm("Do you really want to delete this user?")) return;

				axios.delete('api/users/' + user.id)
					.then((response) => {
						console.log('User deleted...');
						this.fetchUsers();
					}).catch((error) => {
						console.log(error);
					});

				return;
			},

		},
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
</style>