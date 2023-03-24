<template>
    <div id="faq-highlight">
    
        <div id="faq-most-wanted" class="row">
            <div class="col">
                <p class="fs-13">
                    <span class="fw-semi-bold">O termo mais buscado do mês de: </span> <a :href="link" class="text-info text-decoration-none">{{ month }}</a>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-12">
                <h2 class="fs-22 fw-light lh-16">{{ faq.title }}</h2>
                <p class="fs-15 fw-light lh-16">{{ faq.description }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            faq: Object
        },

        data() {
            return {
                today: new Date()
            }
        },

        computed: {
            month() {
                let month = this.today.toLocaleString('default', { month: 'long' })

                return month.charAt(0).toUpperCase() + month.slice(1)
            },

            link() {
                return this.route('web.faq.show', [this.faq.title.charAt(0).toLowerCase(), this.faq.title.toLowerCase()])
            }
        }
    }
</script>

<style scoped>
    #faq-most-wanted {
        margin-top: 2.688rem;
        margin-bottom: 1.688rem;
    }
</style>