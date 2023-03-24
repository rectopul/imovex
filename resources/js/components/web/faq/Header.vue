<template>
    <div class="row">
        <div class="col">
            <h1 class="">Imovelpedia</h1>
            <p v-if="!onlyHeader" class="fs-18 fw-light lh-22">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vitae ante odio. Donec placerat lectus mi. Mauris tempor justo eget est dignissim.</p>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            onlyHeader: Boolean
        }
    }
</script>

<style scoped>
    h1 {
        font-size: 45px;
    }

    p {
        margin-bottom: 2.500vw;
    }
</style>