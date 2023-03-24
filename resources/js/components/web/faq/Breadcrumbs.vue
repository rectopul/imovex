<template>
    <div id="faq-breadcrumbs" class="row">
        
        <div class="col-12 col-sm-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb fs-14 fw-medium">
                    <li class="breadcrumb-item"><a href="faq">Dicionário</a></li>
                    <li class="breadcrumb-item">
                        <a :href="'faq/' + index.toLowerCase()">
                            {{ index.toUpperCase() }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ faqItem.title }}
                    </li>
                </ol>
            </nav>
        </div>

        <div class="col-12 col-sm-6 text-sm-end">
            <div class="addthis_inline_share_toolbox"></div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            faqItem: Object,
            shareLinks: String
        },
        computed: {
            index() {
                return this.faqItem.title.charAt(0)
            }
        }
    }
</script>

<style scoped>
    #faq-breadcrumbs {
        margin-top: 2.625rem;
        margin-bottom: 2.625rem;
    }

    a {
        text-decoration: none;
        color: inherit;
    }
</style>