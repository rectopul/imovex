<template>
	<a :href="route('web.blog.post.show', post)" class="card bg-gray-2 border-0 rounded-2">
		<div class="row g-0">
			<div class="col-md">
				<img :src="post.cover" alt="..." class="img-fluid">
			</div>
			<div class="col-md">
				<div class="card-body">
					<h5 class="post-title">
						{{ post.title }}
					</h5>
	        		<p class="post-body card-text fs-13 lh-16" v-html="post.description"></p>
	        		<p class="post-published text-info fs-28 lh-50 fw-medium">{{ post.publish }}</p>
				</div>
			</div>
		</div>
	   
	</a>
</template>

<script>
	export default {
		props: {
			post: Object
		}
	}
</script>

<style scoped>
	img {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

	.post-title {
		font-size: 30px;
		font-weight: bold;
		color: #273B92;
		margin-bottom: 1.979vw;
	}

	.post-published {
		margin-top: 1.979vw;
	}

	.card {
		border-radius: 0.25rem;
        margin-bottom: 1.625rem;
        text-decoration: none;
        color:  inherit;
	}

	.card-body {
		padding: 0;
		padding-left: 2.396vw;
		padding-right: 1.979vw;
		padding-top: 3.177vw;
		padding-block: 4.375vw;
	}
</style>