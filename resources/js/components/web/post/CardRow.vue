<template>

    <div class="d-flex flex-wrap align-items-stretch gap-custom">
        <post-card v-for="(post, index) in posts" :key="post.id" :post="post" :image="image(index)"></post-card>
    </div>

</template>

<script>
    export default {
        props: {
            posts: Array
        },
        data() {
            return {
                fullPosts: [1, 4, 9, 12, 17, 20, 25, 28]
            }
        },
        methods: {

            image(index) {

                return this.fullPosts.includes(index)
                
            },

        }
    }
</script>

<style scoped>
    
    .gap-custom {
        gap: 20px;
    }

</style>