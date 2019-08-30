<template>
<div>
	<!-- <form action="">
		<table class="table">
			<tbody>
				<tr>
					<td class="bg-dark text-white" style="width: 16%">Name</td>
					<td><input type="text">{{ $user->name }}</td>
				</tr>
				<tr>
					<td class="bg-dark text-white">Lastname</td>
					<td>{{ $user->lastname }}</td>
				</tr>
				<tr>
					<td class="bg-dark text-white">ID Number</td>
					<td>{{ $user->idNumber }}</td>
				</tr>
				<tr>
					<td class="bg-dark text-white">Email</td>
					<td>{{ $user->email }}</td>
				</tr>
				<tr>
					<td class="bg-dark text-white">Birthdate</td>
					<td>{{ $user->birthdate->toFormattedDateString() }}</td>
				</tr>
				<tr>
					<td class="bg-dark text-white">Phone</td>
					<td>{{ $user->phone }}</td>
				</tr>
				<tr>
					<td class="bg-dark text-white">Address</td>
					<td>{{ $user->address }}</td>
				</tr>
				<tr>
					<td class="bg-dark text-white">Category</td>
					<td>{{ $user->category->name }}</td>
				</tr>
				<tr>
					<td class="bg-dark text-white">Status</td>
					<td>{{ $user->status }}</td>
				</tr>
			</tbody>
		</table>
	</form> -->
	</div>
</template>


<script>
	export default {
		data: function () {
			return {
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
			console.log('Edit component mounted...');

			this.fetchSingleUser();
		},

		methods: {
			fetchSingleUser: function () {
				axios.get('api/users/')
					.then((response) => {
						console.log('fetching all users...');
					})
					.catch((error) => {
						console.log(error);
					})
					
					return;
			}
		}
	}

</script>

<style>
	.active-field {
		border: 1px solid #DDD;
		animation: pulseBorder .75s alternate infinite;
	}
</style>
