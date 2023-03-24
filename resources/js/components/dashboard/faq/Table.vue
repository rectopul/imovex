<template>

    <data-table 
        id="faq-table"
        :columns="columns"
    />

</template>

<script>

    export default {
        data() {
            return {
                url: this.route('dashboard.faq.index'),
                columns: [
                    { data: 'faq' }
                ],
            }
        },
        mounted() {

            let vm = this

            this.$root.$emit('order-datatable', {
                target: 'faq-table',
                type: 'created_at',
                data: 'created_at'
            })
            

        }
    }
</script>