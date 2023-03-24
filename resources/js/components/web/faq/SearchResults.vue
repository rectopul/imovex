<template>
    
    <div class="row my-5">
        <div class="col">
            <h1 v-if="faqs.length" class="mb-3">Dicionário</h1>
            <div class="row">
                <div v-for="(faq, index) in faqs" :key="`faq-${index}`" class="col-lg-2 mb-4">
                    <h2 class="text-primary fw-bold">{{ index }}</h2>
                    <p v-for="item in faq" :key="item.id" class="my-2">
                        <a :href="route('web.faq.show', [item.title.charAt(0).toLowerCase(), item.slug])" class="text-decoration-none">{{ item.title }}</a>
                    </p>
                </div>
            </div>
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
                faqs: [],
            }
        },

        methods: {
            async fetchFaqs() {

                const response = await axios.get(this.url+'&records='+this.records)
                
                this.faqs = response.data

                if(this.faqs.length == 0) {
                    this.$root.$emit('no-results-faqs')
                }

            }
        },

        mounted() {

            this.fetchFaqs()


        }
    }
</script>