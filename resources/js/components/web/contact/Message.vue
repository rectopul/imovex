<template>
    <div class="col-md-12 mb-3 mb-lg-0 text-center text-lg-start col-lg-5 fs-14 lh-29">
        <p class="m-0 text-info fw-bold fs-25">{{ phone }}</p>
        <p class="m-0 mb-4">{{ message }}</p>

        <p class="m-0 fw-bold">{{ email }}</p>
        <p class="m-0 mb-4">Respostas em até um dia útil</p>

        <p class="m-0 fw-bold">{{ workEmail }}</p>
        <p class="m-0">Quer trabalhar conosco</p>
    </div>
</template>

<script>
    export default {
        props: {
            phone: String,
            email: String,
            workEmail: String,
            message: String
        }
    }
</script>