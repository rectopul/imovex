<template>

    <section :class="{'bg-gray-2': bg}">
        
        <div class="container-xxl position-relative">
            

            <property-tools :total-records="totalRecords"></property-tools>

            <property-filter-button v-if="filters"></property-filter-button>
            <property-filter-modal 
                v-if="filters" 
                :filters="filters"
            >
            </property-filter-modal>

            <div class="property-card-row-load row row-cols-1 row-cols-md-3 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 g-0">
                <div class="col" v-for="property in properties" :key="property.id">
                    <property-card :property="property"></property-card>
                </div>
                <div v-if="properties.length" v-observe-visibility="loadMore"></div>
            </div>
            

            <div v-if="isLoading" id="load-more" class="row">
                <div class="col text-center">

                    <span class="fs-15 border border-gray-3 rounded-3 px-3 py-2">
                        CARREGANDO MAIS PRODUTOS
                    </span>

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
            records: Number,
        },

        data() {

            return {
                properties: new Array(this.records).fill(new Object),
                page: 1,
                lastPage: 1,
                totalRecords: '',
                isLoading: false,
                filters: {}
            }

        },

        methods: {

            async fetchProperties() {

                this.isLoading = true

                let properties = await axios.get(this.url, { params: { page: this.page } })

                this.properties = this.properties.filter(property => !(property && Object.keys(property).length === 0))
                
                this.properties.push(...properties.data.data)

                this.lastPage = properties.data.last_page

                this.totalRecords = properties.data.total

                this.isLoading = false

                this.filters = properties.data.filters

                this.$root.$emit('load-filter')

            },

            loadMore(isVisible) {
                

                if(!isVisible) { return }

                if(this.page >= this.lastPage) { return }

                if(this.isLoading) { return }

                this.page++

                this.properties.push(...new Array(this.records).fill(new Object))

                this.fetchProperties()
                

            }

        },

        mounted() {
            
            this.fetchProperties()

        }
    }
</script>

<style scoped>
    section {
        padding-top: 2.6rem;
        padding-bottom: 2.6rem;
    }

    #load-more {
        margin-top: 8.9rem;
        margin-bottom: 5.6rem;
    }

    .row {
        --bs-gutter-y: 1.538vw;
        --bs-gutter-x: 1.538vw;
    }

</style>