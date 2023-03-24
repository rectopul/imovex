<template>
    <span  id="filter" class="fs-14 fw-bold py-2 px-3 position-absolute bg-white text-center justify-content-center align-items-center text-info border border-gray-3 fw-bold rounded-4" 
        :style="{top: scrollPosition + 'px'}"
        data-bs-toggle="modal" 
        data-bs-target="#filter-options">
        FILTRAR
    </span>
</template>

<style scoped>
    #filter {
        margin-top: 40vw;
		transform: rotate(-90deg);
		cursor: pointer;
		right: -1.2rem;
		z-index: 2;
        transition:all 0.1s linear;
	}

    /* SM */
    @media (min-width: 576px) and (max-width: 767.98px) { 
        #filter { margin-top: 20vw; }
    }

    /* MD */
    @media (min-width: 768px) and (max-width: 991.98px) { 
        #filter { margin-top: 10vw; }
    }

    /* LG */
    @media (min-width: 992px) and (max-width: 1199.98px) { 
        #filter { margin-top: 8vw; }
    }

    /* XL */
    @media (min-width: 1200px) and (max-width: 1399.98px) {
        #filter { margin-top: 7.1vw; }
    }

    /* XXL */
    @media (min-width: 1400px) {
        #filter { margin-top: 5.5vw; }
    }

</style>

<script>
    export default {
        data() {
            return {
                scrollPosition: 10
            }
        },
        methods: {
			updateScroll() {
                this.scrollPosition = window.scrollY
		    },
		},
		mounted() {
			window.addEventListener('scroll', this.updateScroll);
		}
    }
</script>