<template>
	<div id="post-comments" class="mb-4">
		<div class="row mb-4">
			<div class="col">
				<h2 class="fs-25 fw-medium">Comentários</h2>	
			</div>
		</div>

		<div v-for="comment in comments" :key="comment.id" class="row mb-3">
			<div class="col-auto">
				<img :src="'img/user.png'" alt="..." class="img-fluid">
			</div>
			<div class="col fs-15 fw-medium">
				<p class="text-info m-0">{{ comment.name }}</p>
				<p class="fw-light lh-22">{{ comment.body }}</p>
			</div>
		</div>
		
		<ValidationObserver ref="newCommentForm" v-slot="{ handleSubmit }">
			<form @submit.prevent="handleSubmit(comment)">
				<div class="row mb-3">
					<div class="col-auto">
						<img :src="'img/user.png'" alt="..." class="img-fluid">
					</div>
					<div class="col fs-15 fw-medium">
						
						<ValidationProvider vid="commentName" name="nome" rules="required" v-slot="{ errors }" slim mode="eager">
							<div class="form-group mb-3">
								<input v-model="newComment.name" type="text" class="form-control fw-light lh-22" placeholder="Nome" :class="{'is-invalid': errors.length > 0}">
								<span class="invalid-feedback">{{ errors[0] }}</span>
							</div>
						</ValidationProvider>

						<ValidationProvider vid="comment" name="comentário" rules="required" v-slot="{ errors }" slim mode="eager">
							<div class="grow-wrap">
								<textarea 
									v-model="newComment.body" 
									class="form-control fw-light lh-22" 
									placeholder="Escreva o seu comentário" 
									onInput="this.parentNode.dataset.replicatedValue = this.value"
									:class="{'is-invalid': errors.length > 0}"
								></textarea>
								<span class="invalid-feedback">{{ errors[0] }}</span>
							</div>
						</ValidationProvider>
						
					</div>
				</div>

				<div id="comment-btn-row" class="row">
					<div class="col">
						<button class="btn btn-primary fs-16 fw-bold py-2 px-5">
							Deixe seu comentário
						</button>
					</div>
				</div>

			</form>
		</ValidationObserver>
		
	</div>
</template>

<script>
	import { ValidationObserver, ValidationProvider, extend, localize } from 'vee-validate'
    import { required } from 'vee-validate/dist/rules';
    import br from 'vee-validate/dist/locale/pt_BR.json'

    extend('required', required)
    
    localize('en', br)

	export default {
		components: { ValidationObserver, ValidationProvider },
		props: { post: Object },
		data() {
			return {
				newComment: {
					name: '',
					body: ''
				},
				comments: []
			}
		},
		methods: {
			comment() {

				var vm = this

				axios.post(vm.route('web.comment.store'),{
                    name: vm.newComment.name,
					body: vm.newComment.body,
                    post_id: vm.post.id
                })
                .then(function(response){
                    
					vm.$refs.newCommentForm.reset()

					vm.newComment.name = ''
					vm.newComment.body = ''

					vm.$root.showToast('primary', 'Seu comentário foi enviado e está aguardando aprovação.')
                })
                .catch(function(error){
                    console.log(error.response)
                })

			},
		},
		mounted() {
			this.comments = this.post.approved_comments
		}
	}
</script>

<style scoped>
    #comment-btn-row {
        margin-top: 2.875rem;
    }

    .btn {
        height: 3.125rem;
        border-radius: 0.313rem;
    }

	.grow-wrap { display: grid; }
	
	.grow-wrap::after {
		content: attr(data-replicated-value) " ";
		white-space: pre-wrap;
		visibility: hidden;
	}

	.grow-wrap > textarea {
		resize: none;
		overflow: hidden;
	}

	.grow-wrap > textarea,
	.grow-wrap::after { grid-area: 1 / 1 / 2 / 2; }

</style>