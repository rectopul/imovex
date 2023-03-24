<template>
    <div class="row px-2">
        <div class="col">
            <div class="btn-group">

                <table-dropdown v-model="order" :items="orders" @input="ordering">
                </table-dropdown>

                <!-- <table-dropdown class="ms-2" v-model="status" :items="statuses" @input="filterByStatus">
                </table-dropdown> -->

            </div>
        </div>

        <div class="col-4 text-end">
            <input @input="searchFaqs" v-model="search" type="search" class="form-control" placeholder="Pesquisar">
        </div>

    </div>
</template>

<script>

    export default {
        data() {
            return {
                order: '',
                orders: [
                    { label: 'Mais recentes', value: 'created_at' },
                    { label: 'Mais antigos', value: 'old' },
                    { label: 'Últimos atualizados', value: 'updated_at' },
                    { label: 'A-Z', value: 'alpha' },
                ],
                search: '',
                status: '',
                statuses: [
                    { label: 'Todos', value: '*' },
                    { label: 'Aprovados', value: 'AP' },
                    { label: 'Spam', value: 'SP' },
                    { label: 'Bloqueados', value: 'BL' },
                    { label: 'Sem moderação', value: 'SM' }
                ]
                
            }
        },
        methods: {

            ordering() {

                let vm = this

                vm.$root.$emit('order-datatable', {
                    target: 'faq-table',
                    type: vm.order,
                    data: vm.order
                })

            },

            orderByCreatedAt() {
                let vm = this

                vm.$root.$emit('order-datatable', {
                    target: 'faq-table',
                    type: 'created_at',
                    data: vm.order
                })
            },

            filterByStatus() {
                let vm = this

                vm.$root.$emit('filter-datatable', {
                    target: 'faq-table',
                    type: 'status',
                    data: vm.status
                })
            },

            searchFaqs() {
                let vm = this

                vm.$root.$emit('search-datatable', {
                    target: 'faq-table',
                    data: vm.search
                })
            }
        }
    }
</script>