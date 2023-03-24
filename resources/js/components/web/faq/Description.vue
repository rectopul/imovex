<template>
    <div>

        <div class="row align-items-center">
            <div class="col-md">
                <h1 class="text-info fs-45 lh-50 fw-medium">{{ faqItem.title }}</h1>
            </div>
            <div class="col-md-auto text-right">
                <div class="addthis_inline_share_toolbox"></div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <p class="fs-15 lh-22 fw-light">
                    {{ faqItem.description }}
                </p>	
            </div>
        </div>

        <div class="row">
            <div v-html="faqItem.body" id="faq-content" class="col fs-15 lg-22 fw-light"></div>
        </div>

    </div>
</template>

<script>
    export default {
        props: {
            faqItem: Object
        }   
    }
</script>

<style scoped>
    #faq-content {
        margin-top: 1.25rem;
    }
</style>