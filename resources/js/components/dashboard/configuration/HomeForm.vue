<template>
	<ValidationObserver ref="form" v-slot="{ handleSubmit }">
		<form @submit.prevent="handleSubmit(updateHome)">

			<ValidationProvider vid="home-title" name="título" rules="required" v-slot="{ errors }" mode="eager">
				<div class="form-group mb-3">
					<label>Titulo</label>
					<input v-model="home.title" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}">
					<span class="invalid-feedback">{{ errors[0] }}</span>
				</div>
			</ValidationProvider>
			
			<ValidationProvider vid="home-sub-title" name="sub título" rules="required" v-slot="{ errors }" mode="eager">
				<div class="form-group mb-3">
					<label>Sub Titulo</label>
					<input v-model="home.sub_title" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}">
					<span class="invalid-feedback">{{ errors[0] }}</span>
				</div>
			</ValidationProvider>

			<div class="form-group">
				<button class="btn btn-primary">
					Salvar Informações
				</button>
			</div>
		</form>
	</ValidationObserver>
</template>

<script>
	import { ValidationObserver, ValidationProvider, extend } from 'vee-validate'
    import { required } from 'vee-validate/dist/rules'

    extend('required', required)

	export default {
		components: { ValidationObserver, ValidationProvider },
		props: {
			title: String,
			subTitle: String
		},
		data() {
			return {
				home: {
					title: '',
					sub_title: ''
				}
			}
		},
		methods: {
			updateHome() {
				let vm = this

				axios.post(vm.route('dashboard.configuration.update'),{
					home: vm.home
				})
				.then(function(response){
					vm.$actions.setAlert({
                        type: 'success',
                        body: response.data.message
                    })
				})
				.catch(function(error){
					console.log(error.response)
					vm.$refs.form.setErrors(error.response.data.errors)
				})
			}
		},
		mounted() {
			this.home.title = this.title
			this.home.sub_title = this.subTitle
		}
	}
</script>