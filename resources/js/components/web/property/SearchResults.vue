<template>
    <div class="row my-5">
        <div class="col">
            <h1 v-if="properties.length">Imóveis</h1>

            <div class="property-card-row-load row row-cols-1 row-cols-md-3 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 g-0">
                <div class="col" v-for="property in properties" :key="property.id">
                    <property-card :property="property"></property-card>
                </div>
            </div>

            <property-card-list-skeleton v-if="isLoading" :cards="records"></property-card-list-skeleton>

        </div>
    </div>
</template>

<script>
    export default {
        
        props: {
            url: String,
            records: Number
        },
        
        data() {

            return {
                properties: [],
                isLoading: false,
            }

        },
        methods: {
            async fetchProperties() {
                
                this.isLoading = true

                const response = await axios.get(this.url+'&records='+this.records)

                this.properties = response.data

                this.isLoading = false

                this.$root.removeSkeletonAnimationClasses('[class^="property-card-"]:empty, [class^="property-card-"].empty')

                if(this.properties.length == 0) {
                    this.$root.$emit('no-results-properties')
                }

            }
        },

        mounted() {
            this.fetchProperties()
        }
    }
</script>

<style scoped>
    .row {
        --bs-gutter-y: 1.538vw;
        --bs-gutter-x: 1.538vw;
    }
</style>