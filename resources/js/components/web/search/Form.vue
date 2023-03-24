<template>
    <div>
        <div v-if="!hasPosts && !hasFaqs && !hasProperties" class="my-4">
            <p>Nenhum resultado encontrado, tente uma nova busca</p>

            <form :action="route('web.search.index')">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <input type="text" name="q" class="form-control bg-white" required>
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-primary">
                                Buscar
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</template>

<script>
    export default {
        
        data() {

            return {

                hasPosts: true,
                hasFaqs: true,
                hasProperties: true,

            }

        },

        mounted() {
                
            this.$root.$on('no-results-posts', () => {
                this.hasPosts = false
            })

            this.$root.$on('no-results-faqs', () => {
                this.hasFaqs = false
            })

            this.$root.$on('no-results-properties', () => {
                this.hasProperties = false
            })
    
        }

    }
</script>