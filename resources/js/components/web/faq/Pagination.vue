<template>
    <div id="faq-pagination">
        <div id="faq-items" class="row">
            <div class="col">

                <nav>
                    <ul class="pagination bg-gray-2 justify-content-center flex-wrap">

                        <li 
                            v-for="(pageItem, index) in pageItens" 
                            :key="index" 
                            class="page-item my-auto rounded"
                            :class="{'active': pageItem.active}"
                            @click="setActivePageItem(pageItem.label)"
                        >

                            <span class="page-link fs-18 lh-22 fw-light">{{ pageItem.label }}</span>

                        </li>
                        
                    </ul>
                </nav>
                
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h1 class="fs-45 lh-50 fw-medium text-primary">{{ activePageItem }}</h1>
            </div>
        </div>

        <div v-if="activePageItem" class="row">
            <div v-for="(block, index) in faqBlocks" :key="index" class="col-6 col-sm-4 col-md-3 col-xl-2 mb-4">
                <ul class="list-group list-group-flush fs-14 lh-30 fw-light">
                    <li v-for="item in block" :key="item.id">
                        <a :class="{'active': faqItem && (item.id == faqItem.id) }" :href="route('web.faq.show', [activePageItem.toLowerCase(), item.slug])">
                            {{ item.title }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
	
	export default {
		props: {
			faqItem: Object,
			faqIndex: String,
			url: String
		},
		data() {
			return {
				faqBlocks: [],
				pageItens: [
					{ label: '#', active: false },
					{ label: 'A', active: false },
					{ label: 'B', active: false },
					{ label: 'C', active: false },
					{ label: 'D', active: false },
					{ label: 'E', active: false },
					{ label: 'F', active: false },
					{ label: 'G', active: false },
					{ label: 'H', active: false },
					{ label: 'I', active: false },
					{ label: 'J', active: false },
					{ label: 'K', active: false },
					{ label: 'L', active: false },
					{ label: 'M', active: false },
					{ label: 'N', active: false },
					{ label: 'O', active: false },
					{ label: 'P', active: false },
					{ label: 'Q', active: false },
					{ label: 'R', active: false },
					{ label: 'S', active: false },
					{ label: 'T', active: false },
					{ label: 'U', active: false },
					{ label: 'V', active: false },
					{ label: 'W', active: false },
					{ label: 'X', active: false },
					{ label: 'Y', active: false },
					{ label: 'Z', active: false },
				],
				activePageItem: ''
			}
		},
		mounted() {

			if(this.faqIndex) {
				
				this.setActivePageItem(this.faqIndex.toUpperCase())

			} else if(this.faqItem) {
				
				this.setActivePageItem(this.faqItem.title.charAt(0).toUpperCase())
				
			}
		},
		methods: {
			setActivePageItem(label) {
				
				var vm = this

				this.pageItens = this.pageItens.map((pageItem) => {
					if(pageItem.label === label) {
					 	this.activePageItem = label

						axios.get(vm.url,{
							params: {
								letra: label.toLowerCase()
							}
						})
						.then(function(response){
							vm.faqBlocks = _.chunk(response.data, 6)
						})
						.catch(function(error){
							console.log(error.response)
						})
						 
					 	return { ...pageItem, active: true }
					} else {
						return { ...pageItem, active: false }
					}
				})
			}
		}
	}

</script>

<style scoped>
	#faq-pagination {
		margin-top: 2.5rem;
	}

	.page-link {
		background: var(--bs-gray-2);
		border: none;
		color: inherit;
		cursor: pointer;
	}

	.page-item.active .page-link, .page-link:hover {
		background: initial;
		color: var(--bs-primary);
		font-weight: 600 !important;
	}

	.pagination {
		padding-left: 4rem;
		padding-right: 4rem;
		border-radius: 0.75rem;
	}

	li {
		list-style-type: none;
		margin-bottom: 0.5rem;
	}

	li > a {
		text-decoration: none;
		color: inherit;
	}

	li > a:hover, li >a.active {
		color: var(--bs-info);
		font-weight: 600;
	}

	@media (max-width: 767.98px) { 
		.pagination {
			padding-left: 2rem;
			padding-right: 2rem;
		}
	}
</style>