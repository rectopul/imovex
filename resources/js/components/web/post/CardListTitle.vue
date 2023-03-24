<template>
    <div id="card-list-title" class="row mb-4">
        <div class="col text-center">
            <h1 class="post-card-list-title">{{ title }}</h1>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            title: String
        }   
    }
</script>

<style scoped>
    #card-list-title { padding-top: 2.6rem; }
</style>