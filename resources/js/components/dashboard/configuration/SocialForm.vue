<template>
	<ValidationObserver ref="form" v-slot="{ handleSubmit }">
		<form @submit.prevent="handleSubmit(updateSocial)">
			<div class="row">
				<div class="col-md-4">
					<ValidationProvider vid="links-facebook" name="facebook" rules="" v-slot="{ errors }" mode="eager">
						<div class="form-group mb-3">
							<div class="input-group">
								<span class="input-group-text bg-white" :class="{'border-danger text-danger': errors.length > 0}">
									<i class="fab fa-fw fa-facebook"></i>
								</span>
								<input v-model="links.facebook" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}">
								<span class="invalid-feedback">{{ errors[0] }}</span>
							</div>
						</div>
					</ValidationProvider>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<ValidationProvider vid="links-instagram" name="instagram" rules="" v-slot="{ errors }" mode="eager">
						<div class="form-group mb-3">
							<div class="input-group">
								<span class="input-group-text bg-white" :class="{'border-danger text-danger': errors.length > 0}">
									<i class="fab fa-fw fa-instagram"></i>
								</span>
								<input v-model="links.instagram" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}">
								<span class="invalid-feedback">{{ errors[0] }}</span>
							</div>
						</div>
					</ValidationProvider>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<ValidationProvider vid="links-youtube" name="youtube" rules="" v-slot="{ errors }" mode="eager">
						<div class="form-group mb-3">
							<div class="input-group">
								<span class="input-group-text bg-white" :class="{'border-danger text-danger': errors.length > 0}">
									<i class="fab fa-fw fa-youtube"></i>
								</span>
								<input v-model="links.youtube" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}">
								<span class="invalid-feedback">{{ errors[0] }}</span>
							</div>
						</div>
					</ValidationProvider>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-4">
					<div class="form-group mb-3">
						<ValidationProvider vid="links-whatsapp" name="whatsapp" rules="" v-slot="{ errors }" mode="eager">
						<div class="form-group mb-3">
							<div class="input-group">
								<span class="input-group-text bg-white" :class="{'border-danger text-danger': errors.length > 0}">
									<i class="fab fa-fw fa-whatsapp"></i>
								</span>
								<input v-mask="'(##) #####-####'" v-model="links.whatsapp" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}"/>
								<span class="invalid-feedback">{{ errors[0] }}</span>
							</div>
						</div>
					</ValidationProvider>
					</div>
				</div>
			</div>

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
    import {TheMask} from 'vue-the-mask'

    extend('required', required)

	export default {
		components: { ValidationObserver, ValidationProvider, TheMask },
		props: {
			facebook: String,
			instagram: String,
			youtube: String,
			whatsapp: String
		},
		data() {
			return {
				links: {
					facebook: '',
					instagram: '',
					youtube: '',
					whatsapp: ''
				}
			}
		},
		methods: {
			updateSocial() {
				let vm = this

				axios.post(vm.route('dashboard.configuration.update'),{
					social: vm.links
				})
				.then(function(response){
					vm.$actions.setAlert({
	                    type: 'success',
	                    body: response.data.message
	                })
				})
				.catch(function(error){
					vm.$refs.form.setErrors(error.response.data.errors)
				})
			}
		},
		mounted() {
			this.links.facebook = this.facebook
			this.links.instagram = this.instagram
			this.links.youtube = this.youtube
			this.links.whatsapp = this.whatsapp
		}
	}
</script>