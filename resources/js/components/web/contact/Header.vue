<template>
    <div class="row">
        <div class="col">
            <h1 class="text-center text-lg-start fs-45 lh-50">{{ title }}</h1>
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
    .row {
        margin-top: 2.6rem;
        margin-bottom: 3.563rem;
    }
</style>