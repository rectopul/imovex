<template>
	<ValidationObserver ref="form" v-slot="{ handleSubmit }">
		<form @submit.prevent="handleSubmit(saveUser)">
			
			<div class="row">
				<div class="col-md-6">
					<ValidationProvider vid="name" name="nome" rules="required" class="form-group" v-slot="{ errors }" mode="eager">
						<div class="form-group">
							<label>Nome</label>
							<input v-model="newUser.name" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}">
							<span class="invalid-feedback">{{ errors[0] }}</span>
						</div>
					</ValidationProvider>
				</div>
				<div class="col-md-6">
					<ValidationProvider  vid="email" name="email" rules="required|email" class="form-group" v-slot="{ errors }" mode="eager">
						<div class="form-group">
							<label>Email</label>
							<input v-model="newUser.email" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}">
							<span class="invalid-feedback">{{ errors[0] }}</span>
						</div>
					</ValidationProvider>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<ValidationProvider vid="password" name="senha" :rules="{'required': !user}" class="form-group" v-slot="{ errors }" mode="eager">
						<div class="form-group">
							<label>{{ user ? 'Nova Senha' : 'Senha' }}</label>
							<input v-model="newUser.password" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}">
							<span class="invalid-feedback">{{ errors[0] }}</span>
						</div>
					</ValidationProvider>
				</div>
			</div>

			<div class="form-group text-end">
				<button class="btn btn-primary">{{ buttonText }}</button>
			</div>

		</form>
	</ValidationObserver>
</template>

<script>
	import { ValidationObserver, ValidationProvider, extend } from 'vee-validate'
    import { required, email } from 'vee-validate/dist/rules'

    extend('required', required)
    extend('email', email)

	export default {
		components: { ValidationObserver, ValidationProvider },
		
		props: {
			user: Object
		},

		data() {
			return {
				newUser: {
					name: '',
					email: '',
					password: ''
				},

				submitRoute: '',
				submitMethod: 'post',
				buttonText: 'Criar Usuário'
			}
		},

		methods: {
			saveUser() {
				var vm = this

                axios({
                    url: vm.submitRoute,
                    method: vm.submitMethod,
                    data: vm.newUser
                })
                .then(function(response){
                    
                    location.href = vm.route('dashboard.user.index')
                    
                })
                .catch(function(error){
                    vm.$refs.form.setErrors(error.response.data.errors)
                })
			}
		},

		mounted() {
			let vm = this

            if(vm.user) {

                vm.newUser = vm.user

                vm.submitRoute = vm.route('dashboard.user.update', vm.user.id)
                vm.submitMethod = 'put'
                vm.buttonText = 'Atualizar Usuário'
            } else {
                vm.submitRoute = vm.route('dashboard.user.store')    
            }
		}
	}
</script>