<template>
	<div>
		<div class="row">
			<div class="col">
				<h1 class="fs-45 lh-50 text-info fw-bold">{{ post.title }}</h1>
				<p class="fs-18 fw-light lh-22">{{ post.description }}</p>
			</div>
		</div>
		
		<div class="row justify-content-center align-items-center mb-4">
			<div class="col-12 col-sm-6 col-lg-4">
				<div class="row">
					<div class="col-auto col-md-6">
						<span class="text-primary fs-28 fw-medium lh-50">{{ post.publish }}</span>
					</div>
					<div class="col-auto col-md-6 text-center my-auto">
						<a v-for="(category, index) in post.categories" :key="category.id" class="text-info fs-13 fw-bold text-decoration-none" :href="route('web.blog.index', {categoria: category.name})">
							{{ category.name }}{{ index != post.categories.length -1 ? ', ' : '' }}
						</a>
					</div>
				</div>
			</div>

			<div class="col-12 col-sm-6 col-lg-4 text-start text-sm-end text-lg-center my-auto">
				<span id="total-comments" class="fs-13 text-gray-5 fw-normal" @click="scrollToComments">
					<speech-icon></speech-icon>
					{{ totalComments }} comentários
				</span>
			</div>

			<div class="col-12 col-md-12 col-lg-4 text-end">
		 		<div class="addthis_inline_share_toolbox_vn4d"></div>
			</div>
		</div>

		<div v-if="post.cover" class="row">
			<div class="col">
				<img :src="post.cover" alt="" class="img-fluid w-100">
			</div>
		</div>
		
		<div id="post-text" class="row">
			<div v-html="post.body" class="col fs-15 fw-light lh-22"></div>
		</div>
		
		<post-comments :post="post"></post-comments>

	</div>
</template>

<script>

	export default {
		
		data() {
			return {
				totalComments: 0
			}
		},
		props: {
			post: Object
		},
		methods: {
			setTotalComments(total) {
				this.totalComments =  total
			},
			getCategories() {
				return this.post.categories.map(category => category.name).join(', ')
			},
			scrollToComments() {
				$('html, body').animate({
					scrollTop: $('#post-comments').offset().top - 100
				}, 500);
			}
		},
		mounted() {

			var vm = this
			
			vm.totalComments = vm.post.approved_comments.length

			this.$on('addcomment', function(total){
				vm.setTotalComments(total)
			})
		}
	}
</script>

<style scoped>
    #post-text {
        margin-top: 2.75rem;
        margin-bottom: 2.188rem;
    }

	#total-comments { cursor: pointer; }
</style>