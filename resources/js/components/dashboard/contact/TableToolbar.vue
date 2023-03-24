<template>
    <div class="row mb-3">
        <div class="col-md-8">
            <div class="btn-group justify-content-between">
                <table-dropdown v-model="order" :items="orders" @input="doOrder"/>
            </div>
        </div>
        <div class="col-md-4">
            <input type="search" class="form-control" v-model="search" @input="doSearch" placeholder="Pesquise pelo contato ou assunto">
        </div>
    </div>   
</template>

<script>
    export default {

        data() {
            return {
                search: '',
                
                order: 'DESC',
                orders: [
                    { label: 'Mais recentes', value: 'DESC' },
                    { label: 'Mais antigos', value: 'ASC' },
                ],
            }
        },

        methods: {

            doSearch() {
                let vm = this

                vm.$root.$emit('search-datatable', {
                    target: 'contact-table',
                    data: vm.search
                })
            },

            doOrder() {
                let vm = this
    
                vm.$root.$emit('order-datatable', {
                    target: 'contact-table',
                    type: 'created_at',
                    data: vm.order
                })
            }
        },
        mounted() {
            let vm = this
            $(document).ready(function(){
                vm.order = 'DESC'
            
                vm.doOrder()
            })
            
        }
    }
</script>
