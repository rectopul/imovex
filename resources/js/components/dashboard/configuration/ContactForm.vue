<template>
	<ValidationObserver ref="form" v-slot="{ handleSubmit }">
		<form @submit.prevent="handleSubmit(updateContact)">

			<div class="row">
				<div class="col">
					<ValidationProvider vid="contact-title" name="título" rules="required" v-slot="{ errors }" mode="eager">
						<div class="form-group mb-3">
							<label>Título</label>
							<input v-model="contact.title" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}">
							<span class="invalid-feedback">{{ errors[0] }}</span>
						</div>
					</ValidationProvider>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<ValidationProvider vid="contact-message" name="mensagem" rules="required" v-slot="{ errors }" mode="eager">
						<div class="form-group mb-3">
							<label>Mensagem</label>
							<input v-model="contact.message" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}">
							<span class="invalid-feedback">{{ errors[0] }}</span>
						</div>
					</ValidationProvider>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<ValidationProvider vid="contact-email" name="email para contato" rules="required|email" v-slot="{ errors }" mode="eager">
						<div class="form-group mb-3">
							<label>E-mail para contato</label>
							<input v-model="contact.email" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}">
							<span class="invalid-feedback">{{ errors[0] }}</span>
						</div>
					</ValidationProvider>
				</div>
				<div class="col">
					<ValidationProvider vid="contact-work-email" name="email para vagas" rules="required|email" v-slot="{ errors }" mode="eager">
						<div class="form-group mb-3">
							<label>E-mail para vagas</label>
							<input v-model="contact.work_email" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}">
							<span class="invalid-feedback">{{ errors[0] }}</span>
						</div>
					</ValidationProvider>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<ValidationProvider vid="contact-phone" name="telefone" rules="required" v-slot="{ errors }" mode="eager">
						<div class="form-group mb-3">
							<label>Telefone</label>
							<input v-mask="'(##) #####-####'" v-model="contact.phone" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}"/>
							<span class="invalid-feedback">{{ errors[0] }}</span>
						</div>
					</ValidationProvider>
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
    import { required, email } from 'vee-validate/dist/rules'
    import { TheMask } from 'vue-the-mask'

    extend('required', required)
    extend('email', email)

	export default {
		components: { ValidationObserver, ValidationProvider, TheMask },
		props: {
			title: String,
			email: String,
			workEmail: String,
			phone: String,
			message: String
		},
		data() {
			return {
				contact: {
					title: '',
				    email: '',
				    work_email: '',
				    phone: '',
					message: ''
				}
			}
		},
		methods: {
			updateContact() {
				let vm = this

				axios.post(vm.route('dashboard.configuration.update'),{
					contact: vm.contact
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
			this.contact.title = this.title
			this.contact.email = this.email
			this.contact.work_email = this.workEmail
			this.contact.phone = this.phone
			this.contact.message = this.message
		}
	}
</script>