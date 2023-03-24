<template>
	<ValidationObserver ref="form" v-slot="{ handleSubmit }">
		
		<form @submit.prevent="handleSubmit(updateAbout)" enctype="multipart/form-data">

			<ValidationProvider vid="about-cover" name="imagem de capa" rules="image" class="form-group" v-slot="{ validate, errors }">
                <label for="about-cover">Imagem de Capa</label>

                <img v-if="about.coverPreview" @click="selectImage" :src="about.coverPreview" class="d-block" height="200">
                
                <div v-else @click="selectImage" class="bg-light py-5 text-center cover-placeholder border rounded">
                    <i :class="[errors.length > 0 ? 'text-danger' : 'text-muted', 'far fa-fw fa-image fa-5x']"></i>
                </div>

                <input ref="fileInput" type="file" accept="image/*" class="d-none" @change="validate">
                <span class="text-danger small d-block">{{ errors[0] }}</span>
            </ValidationProvider>

			<div class="row mt-3">
				<div class="col">
					<ValidationProvider vid="about-title" name="título" rules="required" v-slot="{ errors }" mode="eager">
						<div class="form-group mb-3">
							<label>Título</label>
							<input v-model="about.title" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}">
							<span class="invalid-feedback">{{ errors[0] }}</span>
						</div>
					</ValidationProvider>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<ValidationProvider vid="about-description" name="descrição" rules="required" v-slot="{ errors }" mode="eager">
						<div class="form-group mb-3">
							<label>Descrição</label>
							<textarea v-model="about.description" rows="8" class="form-control" :class="{'is-invalid': errors.length > 0}"></textarea>
							<span class="invalid-feedback">{{ errors[0] }}</span>
						</div>
					</ValidationProvider>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<ValidationProvider vid="post-body" name="conteúdo" rules="required" class="form-group" v-slot="{ errors }" mode="eager">
						<div :class="{'has-error': errors.length > 0}">
							<div class="form-group mb-3">
								<label>Conteúdo</label>
								<textarea ref="aboutContent" v-model="about.content" type="text" class="form-control summernote"></textarea>
								<span class="text-danger">{{ errors[0] }}</span>
							</div>
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
	import 'plugins/summernote'
	import { ValidationObserver, ValidationProvider, extend } from 'vee-validate'
    import { required } from 'vee-validate/dist/rules'

    extend('required', required)

	export default {
		components: { ValidationObserver, ValidationProvider },
		props: {
			title: String,
			description: String,
			content: String,
			cover: String
		},
		data() {
			return {
				about: {
					title: '',
					description: '',
					content: '',
					cover: '',
					coverPreview: ''
				}
			}
		},
		methods: {
			
			selectImage() {
                this.$refs.fileInput.click()
            },

			updateAbout() {
				let vm = this

				let formData = new FormData()

				formData.append('about[cover]', vm.about.cover)
				formData.append('about[title]', vm.about.title)
				formData.append('about[description]', vm.about.description)
				formData.append('about[content]', vm.about.content)

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
			},

			initSummernote() {
				let vm = this

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
	                        vm.about.content = contents
	                    }
	                }
	            })
			}
		},
		mounted() {
			let vm = this

			this.initSummernote()


			vm.$refs.fileInput.addEventListener('change', function(){
			    
			    var input = this.files[0]

			    if (input) {

			        if(input.type.split('/')[1] === 'png' || input.type.split('/')[1] === 'jpeg') {
			            var reader = new FileReader()

			            reader.onload = function (e) {
			                vm.about.coverPreview = e.target.result    
			            }

			            reader.readAsDataURL(input)
						
			            vm.about.cover = input

			        } else {
			            vm.$refs.form.setErrors({'about-cover': 'O campo imagem de capa deve ser uma imagem'})
			        }

			        
			    }

			})


			this.about.coverPreview = this.cover
			this.about.title = this.title
			this.about.description = this.description
			this.about.content = this.content
			$('.summernote').summernote('code', this.content)
		}
	}
</script>

<style scoped>
	img {
		cursor: pointer;
	}
</style>

<style>
    .has-error .note-editor { border: 1px solid #dc3545; }
    .has-error .note-toolbar { background: #dc3545; }
    .has-error .note-statusbar { background: #dc3545 !important; }
</style>