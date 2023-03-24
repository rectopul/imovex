<template>
    <div class="row my-5">
            <div class="col">
                <h1 v-if="hasPosts" class="mb-3">Blog</h1>
                <post-card-list 
                    :url="url" 
                    :records="records"
                ></post-card-list>

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
                hasPosts: false,
            }
        },

        mounted() {

            this.$root.$on('fetch-posts', (posts) => {
                this.hasPosts = posts.length > 0
            })

        }
    }
</script>