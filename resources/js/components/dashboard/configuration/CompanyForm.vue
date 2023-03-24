<template>
	<ValidationObserver ref="form" v-slot="{ handleSubmit }">
		<form @submit.prevent="handleSubmit(updateCompany)">

			<div class="row">
				<div class="col-md-4">
					<ValidationProvider vid="company-cnpj" name="cnpj" rules="required" v-slot="{ errors }" mode="eager">
						<div class="form-group mb-3">
							<label>CNPJ</label>
							<the-mask :mask="'##.###.###/####-##'" v-model="company.cnpj" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}"/>
							<span class="invalid-feedback">{{ errors[0] }}</span>
						</div>
					</ValidationProvider>		
				</div>
			</div>

			
			<div class="row">
				<div class="col-md-6">
					<ValidationProvider vid="company-name" name="nome" rules="required" v-slot="{ errors }" mode="eager">
						<div class="form-group mb-3">
							<label>Nome</label>
							<input v-model="company.name" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}">
							<span class="invalid-feedback">{{ errors[0] }}</span>
						</div>
					</ValidationProvider>		
				</div>
			</div>

			<div class="row">
				<div class="col-md-8">
					<ValidationProvider vid="company-address" name="endereço" rules="required" v-slot="{ errors }" mode="eager">
						<div class="form-group mb-3">
							<label>Endereço</label>
							<input v-model="company.address" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}">
							<span class="invalid-feedback">{{ errors[0] }}</span>
						</div>
					</ValidationProvider>		
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<ValidationProvider vid="company-site" name="site" rules="required" v-slot="{ errors }" mode="eager">
						<div class="form-group mb-3">
							<label>Site</label>
							<input v-model="company.site" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}">
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
    import { required } from 'vee-validate/dist/rules'
    import { TheMask } from 'vue-the-mask'

    extend('required', required)

	export default {
		components: { ValidationObserver, ValidationProvider, TheMask },
		props: {
			name: String,
			site: String,
			cnpj: String,
			address: String
		},
		data() {
			return {
				company: {
					name: '',
					site: '',
					cnpj: '',
					address: ''
				}
			}
		},
		methods: {
			updateCompany() {
				let vm = this

				axios.post(vm.route('dashboard.configuration.update'),{
					company: vm.company
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
			this.company.name = this.name
			this.company.site = this.site
			this.company.cnpj = this.cnpj
			this.company.address = this.address
		}
	}
</script>