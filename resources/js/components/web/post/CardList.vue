<template>

    <section>
        <post-card-list-title 
            v-if="title && posts.length"
            :title="title"
        />

        <post-card-row-container 
            v-if="container"
            :posts="posts" 
        />

        <post-card-row
            v-else
            :posts="posts" 
        />

        <post-card-row-skeleton v-if="isLoading" :cards="records"></post-card-row-skeleton>

    </section>

</template>

<script>

    export default {
        
        props: {
            url: String,
            title: String,
            container: Boolean,
            records: Number
        },

        data() {
            return {
                isLoading: true,
                posts: []
            }
        },

        methods: {

            async fetchPosts() {

                const url = this.records ? this.url + '?records=' + this.records : this.url

                let posts = await axios.get(url)

                this.posts = posts.data

                this.$root.$emit('fetch-posts', this.posts)

                this.isLoading = false

                if(this.posts.length == 0) {
                    this.$root.$emit('no-results-posts')
                }

            }

        },

        mounted() {

            this.fetchPosts()
            
        }

    }
</script>

<style scoped>
    section {
        padding-bottom: 2.6rem;
    }
</style>

