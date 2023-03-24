<template>
    <div class="row px-2">
        <div class="col">
            <div class="btn-group">

                <table-dropdown v-model="order" :items="orders" @input="orderByCreatedAt">
                </table-dropdown>

                <table-dropdown class="ms-2" v-model="status" :items="statuses" @input="filterByStatus">
                </table-dropdown>

            </div>
        </div>

        <div class="col-4 text-end">
            <input @input="searchComments" v-model="search" type="search" class="form-control" placeholder="Pesquise pelo post ou usuário">
        </div>

    </div>
</template>

<script>

    export default {
        data() {
            return {
                order: '',
                orders: [
                    { label: 'Mais recentes', value: 'DESC' },
                    { label: 'Mais antigos', value: 'ASC' }
                ],
                search: '',
                status: '',
                statuses: [
                    { label: 'Todos', value: '*' },
                    { label: 'Aprovados', value: 'AP' },
                    // { label: 'Spam', value: 'SP' },
                    { label: 'Bloqueados', value: 'BL' },
                    { label: 'Sem moderação', value: 'SM' }
                ]
                
            }
        },
        methods: {
            orderByCreatedAt() {
                let vm = this

                vm.$root.$emit('order-datatable', {
                    target: 'comment-table',
                    type: 'created_at',
                    data: vm.order
                })
            },

            filterByStatus() {
                let vm = this

                vm.$root.$emit('filter-datatable', {
                    target: 'comment-table',
                    type: 'status',
                    data: vm.status
                })
            },

            searchComments() {
                let vm = this

                vm.$root.$emit('search-datatable', {
                    target: 'comment-table',
                    data: vm.search
                })
            }
        }
    }
</script>