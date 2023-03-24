<template>
    
    <div class="container-xxl mt-4">
		
		<div class="row">
			
			<div class="col-lg-8">
				
				<property-details :property="property"/>

			</div>

			<div class="col-lg-4">

				<property-details-card :property="property"></property-details-card>

			</div>
		</div>
	</div>

</template>

<style scoped>
    .container-xxl {
        margin-bottom: 6.8rem;
    }
</style>

<script>
    import PropertyDetails from './Details.vue'
    import PropertyDetailsCard from './DetailsCard'

    export default {
        props: {
            property: Object
        },
        components: { PropertyDetails, PropertyDetailsCard }
    }
</script>