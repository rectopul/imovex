<template>
    <section>

        <div class="container-xxl">

            <div v-if="!isLoading" class="property-card-row row row-cols-1 row-cols-md-3 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 gx-2 gy-5">
                <div class="col" v-for="property in properties" :key="property.id">
                    <property-card :property="property" :simple="simple"></property-card>
                </div>
            </div>

            <property-card-list-skeleton v-if="isLoading" :cards="records"></property-card-list-skeleton>

            <div v-if="properties.length > 0 && !isLoading" class="mt-5">
                <div class="row">
                    <div class="col text-center">
                        <nav>
                            <ul class="pagination fs-15 justify-content-center">
                                <li v-for="(link, index) in links" :key="index" class="page-item">
                                    <a :href="route('web.bookmark.index', {pagina: link.label})" class="page-link mx-1 rounded-4 px-3" :class="link.active ? 'bg-white text-dark' : 'bg-info text-white'" v-html="link.label"></a>
                                </li>
                            </ul>
                        </nav>
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
            simple: Boolean,
            records: Number,
        },

        data() {
            return {
                properties: new Array(this.records).fill(new Object()),
                isLoading: false,
                links: [],
                page: 1
            }
        },

        methods: {
            async fetchProperties() {
                const vm = this

                vm.isLoading = true

                const urlParams = new URLSearchParams(window.location.search)
                vm.page = urlParams.get('pagina')

                await axios
                .get(vm.url, {
                    params: {
                        pagina: vm.page
                    }
                })
                .then(function (response) {
                
                    vm.properties = response.data.data

                    vm.links = response.data.links
                    vm.links.shift()
                    vm.links.pop()

                    vm.isLoading = false;
                })
                .catch(function (error) {
                    console.log(error.response.data)
                })
            },

        },

        async created() {
            const vm = this
            if(vm.records > 0) await vm.fetchProperties()
        },

        mounted() {

            const vm = this

            vm.$root.$on('bookmark-removed', function(id){
                vm.properties = vm.properties.filter(function(property){
                    return property.id != id
                })
            })

        }

    }
</script>

<style scoped>
    section {
        padding-top: 2.6rem;
        padding-bottom: 2.6rem;
    }

    .btn-outline-primary {
        padding: 1.5rem !important;
    }

    .btn-outline-primary:hover {
        color: #fff;
        font-weight: bold;
    }
</style>