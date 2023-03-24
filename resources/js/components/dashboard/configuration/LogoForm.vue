<template>
	<ValidationObserver ref="form" v-slot="{ handleSubmit }">
		<form @submit.prevent="handleSubmit(updateLogo)">

			<div class="row">
				<div class="col-md-4">
					<ValidationProvider vid="logo-primary" name="logo primário" rules="required|ext:png,svg,jpg,jpeg" class="form-group" v-slot="{ validate, errors }">
						<label class="d-block">Primário</label>

						<img v-if="logo.primaryPreview" @click="selectPrimary" :src="logo.primaryPreview" class="img-fluid bg-dark">

						<div v-else @click="selectPrimary" class="bg-light py-5 text-center cover-placeholder border rounded">
							<i :class="[errors.length > 0 ? 'text-danger' : 'text-muted', 'far fa-fw fa-image fa-5x']"></i>
						</div>

						<input ref="primaryFileInput" type="file" accept="image/*" class="d-none" @change="validate">
						<span class="text-danger small d-block">{{ errors[0] }}</span>
					</ValidationProvider>
				</div>

				<div class="col-md-4">
					<ValidationProvider vid="logo-secondary" name="logo secundário" rules="required|ext:png,svg,jpg,jpeg" class="form-group" v-slot="{ validate, errors }">
						<label class="d-block">Secundário <span class="small text-muted">Utilizado no rodapé</span></label>

						<img v-if="logo.secondaryPreview" @click="selectSecondary" :src="logo.secondaryPreview" class="img-fluid bg-dark">

						<div v-else @click="selectSecondary" class="bg-light py-5 text-center cover-placeholder border rounded">
							<i :class="[errors.length > 0 ? 'text-danger' : 'text-muted', 'far fa-fw fa-image fa-5x']"></i>
						</div>

						<input ref="secondaryFileInput" type="file" accept="image/*" class="d-none" @change="validate">
						<span class="text-danger small d-block">{{ errors[0] }}</span>
					</ValidationProvider>
				</div>
				
			</div>


			<div class="form-group mt-3">
				<button class="btn btn-primary">
					Salvar Informações
				</button>
			</div>

		</form>
	</ValidationObserver>
</template>

<script>
	import { ValidationObserver, ValidationProvider, extend } from 'vee-validate'
    import { required, ext } from 'vee-validate/dist/rules'

    extend('required', required)
    extend('ext', ext)

	export default {
		components: { ValidationObserver, ValidationProvider },
		props: {
			primary: String,
			secondary: String
		},
		data() {
			return {
				logo: {
					primary: '',
					secondary: '',
					primaryPreview: '',
					secondaryPreview: ''
				}
			}
		},
		methods: {
			selectPrimary() {
				this.$refs.primaryFileInput.click()
			},

			selectSecondary() {
				this.$refs.secondaryFileInput.click()
			},

			updateLogo() {
				let vm = this

				let formData = new FormData()

				formData.append('logo[primary]', vm.logo.primary)
				formData.append('logo[secondary]', vm.logo.secondary)

				axios.post(vm.route('dashboard.configuration.update'), formData)
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
			let vm = this

			vm.logo.primaryPreview = vm.primary
			vm.logo.secondaryPreview = vm.secondary

			vm.$refs.primaryFileInput.addEventListener('change', function(){
			    
			    var input = this.files[0]

			    if (input) {

			        if(input.type.split('/')[1] === 'png' || input.type.split('/')[1] === 'jpeg' || input.type.split('/')[1] === 'svg+xml') {
			            var reader = new FileReader()

			            reader.onload = function (e) {
			                vm.logo.primaryPreview = e.target.result    
			            }

			            reader.readAsDataURL(input)

			            vm.logo.primary = input

			        } else {
			            vm.$refs.form.setErrors({'logo-primary': 'O campo logo deve ser uma imagem'})
			        }

			        
			    }

			})

			vm.$refs.secondaryFileInput.addEventListener('change', function(){
			    
			    var input = this.files[0]

			    if (input) {

			        if(input.type.split('/')[1] === 'png' || input.type.split('/')[1] === 'jpeg' || input.type.split('/')[1] === 'svg+xml') {
			            var reader = new FileReader()

			            reader.onload = function (e) {
			                vm.logo.secondaryPreview = e.target.result    
			            }

			            reader.readAsDataURL(input)

			            vm.logo.secondary = input

			        } else {
			            vm.$refs.form.setErrors({'logo-secondary': 'O campo logo deve ser uma imagem'})
			        }

			        
			    }

			})
		}
	}
</script>

<style scoped>
	img {
		cursor: pointer;
	}
</style>