<template>
    <section :class="{'bg-gray-2': bg}">
        
        <div class="container-xxl position-relative">


            <div v-if="title && !isLoading && properties" class="row mb-4">
                <div class="col text-center">
                    <h1>{{ title }}</h1>
                </div>
            </div>

            
            <div v-if="!isLoading" class="property-card-row row row-cols-1 row-cols-md-3 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5">
                <div class="col mb-3" v-for="property in properties" :key="property.id">
                    <property-card :property="property" :simple="simple"></property-card>
                </div>
            </div>

            <property-card-list-skeleton v-if="isLoading" :cards="records"></property-card-list-skeleton>
            

            <div v-if="catalog && !isLoading" class="row mt-4">
                <div class="col-sm-10 col-md-6 col-lg-5 col-xl-4 col-xxl-3 mx-auto">
                    <div class="d-grid">
                        <a href="catalogo" class="btn btn-outline-primary fs-14 fw-medium rounded-3">
                            Encontrar imóvel ideal para mim
                        </a>
                    </div>
                </div>
            </div>
            

        </div>


    </section>
</template>

<script>
    export default {
        props: {
            url: String,
            bg: Boolean,
            title: String,
            simple: Boolean,
            records: Number,
            catalog: Boolean
        },

        data() {
            return {
                properties: new Array(this.records).fill(new Object),
                isLoading: false,
            }
        },

        methods: {

            async fetchProperties() {

                const vm = this

                vm.isLoading = true

                await axios.get(vm.url)
                .then(function(response){
                    
                    vm.properties = response.data

                    vm.isLoading = false
                    
                })
                .catch(function(error){
                    console.log(error.response.data)
                })
            }
            
        },

        async created() {
            const vm = this

            await vm.fetchProperties()
            
        }
    }
</script>

<style scoped>
    section {
        padding-top: 2.6rem;
        padding-bottom: 2.6rem;
    }
    
    .property-card-row {
        --bs-gutter-x: 1.042vw;
        margin-bottom: 16px !important;
    }

    .btn-outline-primary {
        padding: 1.5rem !important;
    }

    .btn-outline-primary:hover {
        color: #fff;
        font-weight: bold;
    }
</style>