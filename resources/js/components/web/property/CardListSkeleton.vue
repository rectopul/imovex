<template>
    <div class="property-card-row-load row row-cols-1 row-cols-md-3 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 g-0 mt-3">
        <div class="col" v-for="(card, index) in cards" :key="index">
            

            <div class="card property-card .empty h-100 border border-gray-3">
	
                <span class="property-card-discount position-absolute m-2 px-2 py-1 rounded end-0"></span>

                <div class="property-card-cover"></div>

                <div class="card-body pt-2 pb-4 px-3">

                    <div class="row" v-if="!simple">
                        <div class="col">
                            <span class="property-card-id badge border border-gray-8 me-1 mb-1"></span>
                            <span class="property-card-type badge border border-gray-8 me-1 mb-1"></span>
                            <span class="property-card-situation badge border border-gray-8 me-1 mb-1"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <p class="property-card-description m-0"></p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="property-card-data">
                            <p class="property-card-location m-0"></p>
                            <p class="property-card-address m-0"></p>
                            <p class="property-card-info m-0"></p>
                        </div>
                        <div v-if="!simple" class="d-flex flex-column property-card-icons">
                            <div class="property-card-bookmark-icon"></div>
                            <div class="property-card-share-icon"></div>
                        </div>
                    </div>

                    <div v-if="simple" class="d-flex justify-content-between align-items-center">
                        <p class="m-0"></p>
                        <div class="property-card-bookmark-icon"></div>
                    </div>

                    <div v-if="!simple" class="row">
                        <div class="col">
                            <p class="property-card-price-label m-0"></p>
                            <p class="property-card-price m-0"></p>
                            <div class="property-card-evaluation empty"></div>
                            
                            <div class="property-card-squares empty"></div>

                            <p class="property-card-square-dates empty"></p>
                        </div>
                    </div>

                </div>

                <span class="position-absolute top-100 start-50 translate-middle bg-gray-3 border-0 py-1 px-2 rounded"></span>
                
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        
        props: {
            cards: Number,
            simple: {
                type: Boolean,
                default: false
            }
        },

        mounted() {
        	this.$root.addSkeletonAnimationClasses('[class^="property-card-"]:empty, [class^="property-card-"].empty')
        }

    }
</script>

<style scoped>

	.row {
        --bs-gutter-y: 1.538vw;
        --bs-gutter-x: 1.538vw;
    }

	.property-card-data {
		margin-right: 2.188vw;
	}

	.property-card {
		border-bottom-left-radius: 0.75rem;
		border-bottom-right-radius: 0.75rem;
		cursor: pointer;
	}

	.property-card-price-label {
		margin-top: 0.521vw;
	}

	.property-card-share-icon {
		margin-top: 0.625vw;
	}

	.card-img-top {
		height: 11rem;
		object-fit: cover;
	}

	li {
		padding-left: 0.938rem;
		padding-right: 0.938rem;
	}

	p { margin: 0; }

	[class^="property-card-"]:empty,
	.property-card-info.empty,
	.property-card-evaluation.empty,
	.property-card-squares.empty,
	.property-card-square-dates.empty {
		background: var(--bs-gray-3) !important;
		border-radius: 4px;
	}

	.property-card-cover:empty {
		height: 11rem;
	}
	
	.property-card-id:empty,
	.property-card-situation:empty,
	.property-card-type:empty {
		display: inline-block !important;
		height: 20px !important;
		width: 60px !important;
		border: none !important;
	}

	.property-card-description:empty {
		height: 16px;
		width: 12%;
	}

	.property-card-address:empty,
	.property-card-location:empty {
		height: 20px;
		width: 114px !important;
		margin-top: 4px !important;
	}

	.property-card-info.empty {
		height: 15px;
		width: 134px !important;
		margin-top: 4px !important;
	}

	.property-card-bookmark-icon:empty,
	.property-card-share-icon:empty {
		height: 30px;
		width: 30px !important;
	}

	.property-card-price-label:empty {
		height: 15px;
		width: 58px !important;
	}

	.property-card-price:empty {
		height: 24px;
		width: 94px !important;
		margin-top: 4px !important;
	}

	.property-card-evaluation.empty {
		height: 15px;
		width: 104px !important;
		margin-top: 4px !important;
	}

	.property-card-squares.empty {
		height: 20px;
		width: 132px !important;
		margin-top: 4px !important;
	}

	.property-card-square-dates.empty {
		height: 15px;
		width: 168px !important;
		margin-top: 4px !important;
	}

</style>