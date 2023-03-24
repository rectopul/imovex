<template>
	<header>
		<div id="parallax" class=""></div>
		<div class="container-xxl">
			<div class="row justify-content-center align-items-center">
				<div class="col-12 p-5 text-center p-lg-0 px-lg-3 text-lg-start col-lg-6">
					<p id="about-title" class="fw-medium lh-1 my-auto fs-45">
						{{ title }}
					</p>
				</div>
				<div class="d-none d-lg-block col-lg-6">
					<img :src="cover"  alt="..." loading="lazy" class="overflow-hidden">
				</div>
			</div>

			


		</div>

		<div class="about-description bg-gray-2 py-5">
			<div class="container-xxl">
				<p class="m-0 fs-14 text-center text-md-start" v-html="description"></p>
			</div>
		</div>
	</header>
</template>

<script>
	export default {
		props: {
			title: String,
			cover: String,
			description: String
		}
	}
</script>

<style scoped>
    p.fs-45 { line-height: 3.125rem !important; }

	p.fs-14 { line-height: 1.9rem; }

	/* img { height: 35rem; } */

	@media (max-width: 575.98px) { 
		#about-title { font-size: 1.8rem; line-height: 2.5rem !important; }
	}

	@media (max-width: 991.98px) {

		#about-title { color: var(--bs-dark); }
	}

	/* .about-title { margin-left: 85px !important; } */

	.about-description { 
		padding-top: 99px !important;
		padding-bottom: 99px !important;
		border: none !important;
	 }
</style>