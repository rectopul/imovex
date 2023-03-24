<template>
    <ValidationObserver ref="form" v-slot="{ handleSubmit }">
        <form @submit.prevent="handleSubmit(submitCategory)">

            <ValidationProvider vid="name" name="nome" rules="required" v-slot="{ errors }" slim mode="eager">
                <div class="form-group mb-3">
                    <label for="name">Nome</label>
                    <input v-model="category.name" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}">
                    <span class="invalid-feedback small">{{ errors[0] }}</span>
                </div>
            </ValidationProvider>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">{{ buttonText }}</button>
            </div>
        </form>
    </ValidationObserver>
</template>

<script>
    import { ValidationObserver, ValidationProvider, extend, localize } from 'vee-validate'
    import { required } from 'vee-validate/dist/rules';
    import br from 'vee-validate/dist/locale/pt_BR.json'

    extend('required', required)
    
    localize('en', br)

    export default {
        components: { ValidationObserver, ValidationProvider },
        props: {
            edit: Object
        },
        data() {
            return {
                category: {
                    name: ''
                },

                buttonText: 'Criar Categoria',
                submitRoute: '',
                submitMethod: 'post'

            }
        },
        methods: {
            submitCategory() {

                var self = this

                axios({
                    url: self.submitRoute,
                    method: self.submitMethod,
                    data: self.category
                })
                .then(function(response){
                    
                    location.href = response.data.redirect
                    
                })
                .catch(function(error){
                    console.log(error.response)
                    self.$refs.form.setErrors(error.response.data.errors)
                })
            }
        },

        mounted() {
            let vm = this

            if(vm.edit) {

                vm.category = vm.edit

                vm.submitRoute = vm.route('dashboard.blog.category.update', vm.category.id)
                vm.submitMethod = 'put'
                vm.buttonText = 'Atualizar Categoria'
            } else {
                vm.submitRoute = vm.route('dashboard.blog.category.store')    
            }

            
        }
    }
</script>