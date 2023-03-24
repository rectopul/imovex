<template>
	<section id="about">
		<div class="container-xxl fs-14">
			<!-- <div class="row">
				<div class="col">
					{{ description }}
				</div>
			</div> -->

			<div class="row ">
				<div class="about-content col-12" v-html="content">
					
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	export default {
		props: {
			description: String,
			content: String
		}
	}
</script>

<style scoped>
	p { line-height: 1.9rem; }
	
	section { padding-top: 4.125rem; }

	.about-content {
		font-size: 14px !important;
	 }
</style>

<style>
	img.note-float-left:not([style*="width: 100%"]) { padding-right: 1rem !important; }
	img.note-float-right:not([style*="width: 100%"]) { padding-left: 1rem !important; }

	@media (max-width: 991.98px) { 
		img.note-float-left:not([style*="width: 100%"]) { padding: 1rem !important; width: 100% !important; }
		img.note-float-right:not([style*="width: 100%"]) { padding: 1rem !important; width: 100% !important; }
	}

</style>