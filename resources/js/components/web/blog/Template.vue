<template>
    <section id="blog-template">
    	<div class="container-xxl">
    		<div id="wrapper" class="d-flex justify-content-between">

		    	<div class="flex-2">	
                    <slot name="content"></slot>
		    	</div>

		    	<div class="flex-1">
		    		<slot name="sidebar"></slot>
		    	</div>

    		</div>
    	</div>
    	
    </section>
</template>

<style scoped>
    section#blog-template {
        padding-top: 3.625rem;
    }

	.flex-1 { width: 18.85%; }
	.flex-2 { width: 78.77%; }

	/* SM */
	@media (min-width: 576px) and (max-width: 767.98px) { 
		
	}

	/* MD */
	@media (max-width: 991.98px) { 
		#wrapper { display: block !important; }
		.flex-1 { width: 100%; }
		.flex-2 { width: 100%; }
	}

	/* LG */
	@media (min-width: 992px) and (max-width: 1199.98px) { 
		
	}

</style>