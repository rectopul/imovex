<template>
	<div class="card">
	    <div class="card-body">
	        <h4><i :class="`fa fw fa-${icon}`"></i> {{ label }}</h4>
			<div v-if="isLoading">
				<i class="fa fa-fw fa-spinner fa-spin"></i>
			</div>
			<p v-else class="h5 fw-normal">{{ counter }}</p>
	    </div>
	</div>
</template>

<script>
	export default {
		props: {
			icon: String,
			label: String,
			url: String
		},

		data() {
			return {
				counter: '',
				isLoading: true
			}
		},

		async mounted() {
			let vm = this

			await axios.get(vm.url, {
				params: {
					begin: vm.$store.dashboardInterval.begin,
					end: vm.$store.dashboardInterval.end
				}
			})
			.then(function(response){
				vm.counter = response.data
				vm.isLoading = false
			})
			.catch(function(error){
				console.log(error.response.data)
			})

			
		}
	}
</script>