<template>
    <div class="col-lg-7">
        <div class="card bg-gray-2 border-0">
            <ValidationObserver ref="form" v-slot="{ handleSubmit }">
                <form @submit.prevent="handleSubmit(sendMessage)">
                    
                    <div class="row g-3 mb-3">

                        <ValidationProvider class="form-group col-md-6" vid="name" name="nome" rules="required" v-slot="{ errors }" mode="eager">
                            <input v-model="contact.name" type="text" class="form-control fs-15 fw-medium border-gray-3" placeholder="Nome" :class="{'is-invalid': errors.length > 0}">
                            <span class="invalid-feedback">{{ errors[0] }}</span>
                        </ValidationProvider>
                        
                        <ValidationProvider class="form-group col-md-6" vid="email" name="e-mail" rules="required|email" v-slot="{ errors }" mode="eager">
                            <input v-model="contact.email" type="text" class="form-control fs-15 fw-medium border-gray-3" placeholder="E-mail" :class="{'is-invalid': errors.length > 0}">
                            <span class="invalid-feedback">{{ errors[0] }}</span>
                        </ValidationProvider>

                    </div>

                    <div class="row g-3 mb-3">

                        <ValidationProvider ref="contactPhone" class="form-group col-md-6" vid="phone" name="telefone" rules="required|phone" v-slot="{ errors }" mode="eager">
                            <the-mask @blur.native="setPhoneError" v-model="contact.phone" :mask="['(##) #### - ####', '(##) ##### - ####']" :masked="true" type="text" class="form-control fs-15 fw-medium border-gray-3" placeholder="Telefone" :class="{'is-invalid': errors.length > 0}"/>
                            <span class="invalid-feedback">{{ errors[0] }}</span>
                        </ValidationProvider>
                        
                        <ValidationProvider class="form-group col-md-6" vid="subject" name="assunto" rules="required" v-slot="{ errors }" mode="eager">
                            <input v-model="contact.subject" type="text" class="form-control fs-15 fw-medium border-gray-3" placeholder="Assunto" :class="{'is-invalid': errors.length > 0}">
                            <span class="invalid-feedback">{{ errors[0] }}</span>
                        </ValidationProvider>

                    </div>

                    <div class="row g-3">
                        <ValidationProvider class="form-group col" vid="message" name="mensagem" rules="required" v-slot="{ errors }" mode="eager">
                            <textarea v-model="contact.message" class="form-control fs-15 fw-medium border-gray-3" placeholder="Mensagem" :class="{'is-invalid': errors.length > 0}"></textarea>
                            <span class="invalid-feedback">{{ errors[0] }}</span>
                        </ValidationProvider>
                    </div>

                    <div id="btn-row" class="row g-3 mb-3">
                        <div class="col text-center">
                            <button class="btn btn-primary fs-16 fw-bold">
                                Enviar mensagem
                            </button>
                        </div>
                    </div>

                </form>
            </ValidationObserver>
        </div>
    </div>
</template>


<script>
    import {TheMask} from 'vue-the-mask'
    import { ValidationObserver, ValidationProvider, extend, localize } from 'vee-validate'
    import { required, email } from 'vee-validate/dist/rules';
    import br from 'vee-validate/dist/locale/pt_BR.json'

    extend('required', required)
    extend('email', email)

    extend('phone', {
        message(field) {
            return 'O campo ' + field + ' deve ser um telefone válido'
        },
        validate(value) {
            
            value = value.trim()
                .replace('(', '')
                .replace(')', '')
                .replace('-', '')
                .replace(' ', '')
                .replace('  ', '')
            
            return {
                required: true,
                valid: /[0-9]{10}/.test(value) || /[0-9]{11}/.test(value)
                
            }

        },
        computesRequired: true
        
    })
    
    localize('en', br)

    export default {
        components: { ValidationObserver, ValidationProvider, TheMask },
        props: {
            url: String,
        },
        data() {
            return {
                contact: {
                    name: '',
                    email: '',
                    phone: '',
                    subject: '',
                    message: ''
                }
            }
        },
        methods: {
            setPhoneError() {
                this.$refs.contactPhone.validate(this.contact.phone)
            },
            sendMessage() {

                var vm = this

                axios.post(vm.url, vm.contact)
                .then(function(response){

                    let name = vm.contact.name

                    vm.$refs.form.reset()

                    Object.keys(vm.contact).forEach(index => vm.contact[index] = '')

                    vm.$root.showToast('success', `Obrigado, ${name}! Agradecemos sua mensagem!`)
                })
                .catch(function(error){
                    vm.$refs.form.setErrors(error.response.data.errors)
                })
            }
        }
    }
</script>

<style scoped>
	.form-control {
		height: 2.375rem;
		border-radius: 0.313rem;
	}

	textarea.form-control {
		height: 5.625rem;
		resize: none;
	}

	.form-control::placeholder {
		color: var(--bs-gray-5);
	}

    .form-control.is-invalid { border-color: #dc3545 !important; }

    .invalid-feedback { font-size: 0.7rem; font-weight: bold; }

	#btn-row {
		margin-top: 2.063rem;
	}

	.btn {
		height: 3.125rem;
		padding-left: 5rem;
		padding-right: 5rem;
	}

    .btn:hover {
        color: #fff;
    }

	.card {
		border-radius: 0.75rem;
		padding-left: 2.438rem;
		padding-right: 2.438rem;
		padding-top: 4.188rem;
		padding-bottom: 1.938rem;
	}

    @media (max-width: 575.98px) { 
        .card { padding: 1rem; }

        .btn { padding-left: 2rem; padding-right: 2rem; }
    }
</style>