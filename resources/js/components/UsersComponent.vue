<template>
	<div>
		<div class="text-center title">
			<h1>Users</h1>
		</div>
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
							<td>{{ user.status }}</td>

							<!-- Actions -->
							<td class="row">
								<div class="actionButton">
									<form action="">
										<button class="btn btn-success btn-sm">Check in</button>
									</form>
								</div>
								<div class="actionButton">
									<form action="">
										<button class="btn btn-info btn-sm">Edit</button>
									</form>
								</div>
								<div class="actionButton">
									<form action="">
										<button class="btn btn-danger btn-sm">X</button>
									</form>
								</div>
							</td>
						</tr>
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
						console.log(response.data);
						this.list = response.data;
					})
					.catch((error) => {
						console.log(error);
					})
					
					return;
			}
		},
	}
</script>

<style>
	.title {
		margin-bottom: 40px;
	}

	.actionButton {
		margin-left: 5px;
	}
</style>