<template>

    <ValidationObserver ref="form" v-slot="{ handleSubmit }">
        
        <div v-if="submitedPost" class="card small text-success border-0 mb-3 p-2 rounded-lg">
            <div class="card-body border-success border border-5 border-end-0 border-top-0 border-bottom-0 p-2 d-flex justify-content-between">
                <div>
                    <i class="fa fa-check-circle"></i>
                    Post {{ submitedPost.title }} Criado!
                    <p v-if="submitedPost.publish" class="m-0 text-muted">Você pode visualizar o post <a @click="closeAlert" :href="route('web.blog.post.show', submitedPost)" target="_blank">aqui</a></p>
                    <p v-else class="m-0 text-muted">Para visualizar um post você precisa publicá-lo antes</p>
                </div>
                <span @click="closeAlert">
                    <i class="fa fa-times text-muted"></i>
                </span>
            </div>
        </div>
        
        <form @submit.prevent="handleSubmit(savePost)">
            <div class="row">
                <div class="col">
                    
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="publish">Data de publicação</label>
                                        <datepicker
                                            input-class="bg-white"
                                            :language="datepicker.language"
                                            format="dd/MM/yyyy"
                                            :bootstrap-styling="true"
                                            v-model="post.publish"
                                            :clear-button="true"
                                        ></datepicker>
                                    </div>
                                </div>
                            </div>

                            <ValidationProvider vid="post-cover" name="imagem de capa" rules="image" class="form-group" v-slot="{ validate, errors }">
                                <label for="post-cover">Capa</label>

                                <img v-if="coverPreview" @click="selectImage" :src="coverPreview" class="img-fluid w-100">
                                
                                <div v-else @click="selectImage" class="bg-light py-5 text-center cover-placeholder border rounded">
                                    <i :class="[errors.length > 0 ? 'text-danger' : 'text-muted', 'far fa-fw fa-image fa-5x']"></i>
                                </div>
                                <p class="small text-muted">*Tamanho recomendado 540x360px</p>

                                <input ref="fileInput" type="file" accept="image/*" class="d-none" @change="validate">
                                <span class="text-danger small d-block">{{ errors[0] }}</span>
                            </ValidationProvider>
                            <div class="mb-4"></div>

                            <ValidationProvider vid="post-title" name="título" rules="required" class="form-group" v-slot="{ errors }" mode="eager">
                                <label for="post-title">Título</label>
                                <input v-model="post.title" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}">
                                <span class="invalid-feedback">{{ errors[0] }}</span>
                            </ValidationProvider>
                            <div class="mb-4"></div>

                            <ValidationProvider vid="post-description" name="descrição" rules="max:100" class="form-group" v-slot="{ errors }" mode="eager">
                                <div class="row">
                                    <div class="col">
                                        <label for="post-description">Descrição</label>
                                    </div>
                                    <div class="col">
                                        <p class="m-0 small text-muted text-end">{{ descriptionChars }} caracteres restantes</p>
                                    </div>
                                </div>
                                <textarea @keyup="countDescriptionChars" v-model="post.description" class="form-control no-resize" :class="{'is-invalid': errors.length > 0}"></textarea>
                                <span class="invalid-feedback">{{ errors[0] }}</span>
                            </ValidationProvider>
                            <div class="mb-4"></div>

                            <ValidationProvider vid="post-body" name="conteúdo" rules="required" class="form-group" v-slot="{ errors }" mode="eager">
                                <div :class="{'has-error': errors.length > 0}">
                                    <label for="post-body">Conteúdo</label>
                                    <textarea ref="postBody" v-model="post.body" class="form-control summernote"></textarea>
                                    <span class="text-danger">{{ errors[0] }}</span>
                                </div>
                            </ValidationProvider>
                            <div class="mb-4"></div>

                            <div class="form-group">
                                <label for="categories" class="d-block">Categorias</label>
                                <div class="row">
                                    <div class="col-md-4" v-for="category in categories" :key="category.id">
                                        <input v-model="post.categories" type="checkbox" class="form-check-input" :value="category.id"> {{ category.name }}
                                    </div>
                                </div>

                                <span @click="showNewCategory" class="px-0 btn btn-link fs-7">
                                    <i class="fa fa-fw fa-plus-square"></i>
                                    Nova categoria
                                </span>

                                <div class="row" v-show="newCategory.show">
                                    <div class="col-md-4">
                                        <input v-model="newCategory.name" @input="validateNewCategory" @blur="validateNewCategory" type="text" class="form-control form-control-sm mt-2" :class="{'is-invalid': newCategory.error}">
                                        <span v-show="newCategory.error" class="invalid-feedback">{{ newCategory.error }}</span>
                                        <span @click="addCategory" class="btn btn-sm btn-primary w-100 mt-2">Adicionar categoria</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-fw fa-save"></i>
                                    {{ edit ? 'Atualizar Post' : 'Criar Post' }}
                                </button>
                            </div>
                            
                        </div>
                    </div>
                    

                </div>

            </div>
        </form>

    </ValidationObserver>

</template>

<script>
    import Datepicker from 'vuejs-datepicker/dist/vuejs-datepicker.esm.js'
    import { ptBR } from 'vuejs-datepicker/dist/locale'
    import { ValidationObserver, ValidationProvider, extend } from 'vee-validate'
    import { required, image, max } from 'vee-validate/dist/rules'
    import 'plugins/summernote'
    import { pleaseWait } from 'please-wait'
    import 'please-wait/build/please-wait.css'

    extend('required', required)
    extend('image', image)
    extend('max', max)

    export default {
        components: { ValidationObserver, ValidationProvider, Datepicker },
        props: {
            edit: Object
        },
        data() {
            return {
                post: {
                    id: '',
                    cover: '',
                    title: '',
                    description: null,
                    body: '',
                    publish: null,
                    categories: []
                },
                categories: [],
                coverPreview: '',
                submitedPost: null,
                descriptionChars: 100,
                newCategory: {
                    show: false,
                    name: '',
                    error: ''
                },
                datepicker: {
                    language: ptBR,
                    date: new Date(),
                }
            }
        },
        methods: {
            selectImage() {
                this.$refs.fileInput.click()
            },
            closeAlert() {
                this.submitedPost = null
            },
            countDescriptionChars() {
                this.descriptionChars = 100 - this.post.description.length

                if(this.descriptionChars <= 0) {
                    this.$refs.form.setErrors({'post-description': 'O campo descrição não deve ter mais que 100 caracteres'})
                }
            },
            showNewCategory() {
                this.newCategory.name = ''
                this.newCategory.show = !this.newCategory.show
                this.newCategory.error = ''
            },
            validateNewCategory() {
                if(this.newCategory.name == '') {
                    this.newCategory.error = 'O campo categoria é obrigatório'
                } else {
                    this.newCategory.error = ''
                }
            },
            addCategory() {
                var vm = this
                
                if(vm.newCategory.name == '') {
                    vm.newCategory.error = 'O campo categoria é obrigatório'
                } else {
                    axios.post(vm.route('dashboard.blog.post.category.store'), {
                        name: vm.newCategory.name
                    })
                    .then(function(response){
                        vm.fetchCategories()
                    })

                    vm.newCategory.name = ''
                    vm.newCategory.show = false
                }
            },

            clearForm() {
                let vm = this

                vm.$refs.form.reset()
                    vm.post.cover = vm.post.title = vm.post.description = vm.post.body = vm.post.post_category_id = vm.post.cover = ''
                    vm.coverPreview = ''
                    vm.post.publish = ''
                    vm.descriptionChars = 100
                    vm.post.categories = []
                    $('.summernote').summernote('code', '')
            },

            savePost() {

                var vm = this
                var formData = new FormData()

                for(var key in vm.post) {
                    console.log(key, vm.post[key])
                    let data = (key === 'publish' && vm.post[key] !== null) ?
                        vm.$root.formatDate(vm.post[key]) : 
                        vm.post[key]

                    formData.append(key, data)
                }

                if(typeof formData.get('cover') == 'string') {
                    if(formData.get('cover').includes('img/blog')) {
                        formData.delete('cover')
                    }
                }

                if(formData.get('description') == 'null') {
                    formData.delete('description')
                }
                
                if(vm.edit) formData.append('_method', 'put')
                
                axios({
                    method: 'post',
                    url: vm.edit ? vm.route('dashboard.blog.post.update', vm.post) : vm.route('dashboard.blog.post.store'),
                    data: formData
                })
                .then(function(response){
                    
                    if(vm.edit) {
                        
                        location.reload()

                    } else {

                        location.href = response.data.redirect

                    }

                    
                })
                .catch(function(error){
                    // console.log(error.response)
                })
            },
            fetchCategories(){
                var vm = this

                axios.get(vm.route('dashboard.blog.post.category.index'))
                .then(function(response){
                    vm.categories = response.data
                })
                .catch(function(error){
                    // console.log(error)
                })
            }
        },
        mounted() {
            
            var vm = this

            vm.fetchCategories()
            // console.log(pleaseWait())
            // pleaseWait({
            //     backgroundColor: '#f46d3b',
            //     el: 'main',
            //     loadingHtml: "<p class='loading-message'>A good day to you fine user!</p>"
            // });

            vm.$refs.fileInput.addEventListener('change', function(){
                
                var input = this.files[0]

                if (input) {

                    if(input.type.split('/')[1] === 'png' || input.type.split('/')[1] === 'jpeg') {
                        var reader = new FileReader()

                        reader.onload = function (e) {
                            vm.coverPreview = e.target.result    
                        }

                        reader.readAsDataURL(input)

                        vm.post.cover = input

                    } else {
                        vm.$refs.form.setErrors({'post-cover': 'O campo imagem de capa deve ser uma imagem'})
                    }

                    
                }

            })

            
           
            $('.summernote').summernote({
                lang: 'pt-BR',
                height: 'auto',
                minHeight: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline']],
                    
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                ],
                callbacks: {
                    onChange: function(contents) {

                        vm.post.body = contents
                    }
                }
            })

            $('button[aria-label="Imagem"]').click(function(){
                $('.note-modal-backdrop').hide()
                $('.note-modal').removeClass('open')
                $('.note-image-input').click()
            })

            if(vm.edit) {
                vm.post = vm.edit

                if(vm.edit.description == 'null') vm.edit.description = ''
                
                vm.post.categories = _.map(vm.edit.categories, function(category){
                    return category.pivot.category_id
                })
                
                if(vm.post.description) {
                    vm.descriptionChars -= vm.post.description.length
                }
                

                $('.summernote').summernote('code', vm.post.body)

                if(vm.post.cover) vm.coverPreview = vm.post.cover

                if(vm.post.publish) {
                    let splitDate = vm.post.publish.split('/')

                    vm.post.publish = new Date(splitDate[2], splitDate[1] - 1, splitDate[0])    
                }
            

            }

        }
    }
</script>

<style scoped>

    #categories-list { height: 150px; overflow-y: scroll; }

</style>

<style>
    .has-error .note-editor { border: 1px solid #dc3545; }
    .has-error .note-toolbar { background: #dc3545; }
    .has-error .note-statusbar { background: #dc3545 !important; }
</style>