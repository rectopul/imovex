<template>
	<div class="swiper-container">
	  
	  <div class="swiper-wrapper">
	    
	    <div v-for="(image, index) in images.filter(n => n)" :key="index" class="swiper-slide">
	    	<img :src="image">
	    </div>
	    
	  </div>

	</div>

</template>

<script>
	import Swiper from 'swiper'
	import SwiperCore, { Navigation, Pagination } from 'swiper/core'
	import 'swiper/swiper-bundle.css'

	export default {
	
		props: {
			images: []
		},

		computed: {
			imagesCount() {
				return this.images.filter(n => n).length
			}
		},
		mounted() {
			
			let vm = this
			SwiperCore.use([Navigation, Pagination])

			const swiper = new Swiper('.swiper-container', {
				loop: false,
				spaceBetween: 0,
				breakpoints: {
		          	640: {
		            	slidesPerView: vm.imagesCount < 1 ? vm.imagesCount : 1,
		            	spaceBetween: 0,
		          	},
		          	768: {
			            slidesPerView: vm.imagesCount < 2 ? vm.imagesCount : 2,
		            	spaceBetween: 0,
		          	},
		          	1024: {
		            	slidesPerView: vm.imagesCount < 3 ? vm.imagesCount : 3,
		            	spaceBetween: 0,
		          	},
		         },
				autoplay: {
          			delay: 2500,
          			disableOnInteraction: false,
        		}
			})
		}
	}
</script>

<style scoped>
	.swiper-slide {
		height: 26rem;
	}

	img {
		object-fit: fill;
		height: 100%;
		width: 100%;
	}
</style>