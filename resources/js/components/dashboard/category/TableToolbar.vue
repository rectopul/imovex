<template>
    <div class="px-1">

        <div class="row">
            <div class="col-md-8">
                <div class="btn-group justify-content-between">
                    <table-dropdown v-model="order" :items="orders" @input="doOrder"/>
                </div>
            </div>
            <div class="col-md-4">
                <input type="search" class="form-control" v-model="search" @input="doSearch" placeholder="Pesquise pelo nome da categoria">
            </div>
        </div>
    </div>    
</template>

<script>
    export default {

        data() {
            return {
                search: '',
                
                order: '',
                orders: [
                    { label: 'Mais visualizados', value: 'views|DESC' },
                    { label: 'Menos visualizados', value: 'views|ASC' },
                    { label: 'Mais posts', value: 'posts|DESC' },
                    { label: 'Menos posts', value: 'posts|ASC' },
                ],
            }
        },

        methods: {

            doSearch() {
                let vm = this

                vm.$root.$emit('search-datatable', {
                    target: 'category-table',
                    data: vm.search
                })
            },

            doOrder() {
                let vm = this
                let type = vm.order.split('|')[0]
                let order = vm.order.split('|')[1]

                vm.$root.$emit('order-datatable', {
                    target: 'category-table',
                    type: type,
                    data: order
                })
            }
        }
    }
</script>
