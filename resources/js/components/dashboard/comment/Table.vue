<template>
   
    <table id="comment-table" class="table table-borderless w-100">
        <thead>
            <tr>
                <th class="d-none"></th>
            </tr>
        </thead>
    </table>

</template>

<script>
    
    import 'plugins/datatables'
    
    export default {
        data() {
            return {
                table: null,
                filters: {
                    status: '*',
                },
                orders: {
                    created_at: 'DESC'
                },
                columns: [
                    { data: 'comment', orderable: false }
                ]
            }
        },
        mounted() {

            var vm = this

            vm.table = $('#comment-table').DataTable({
                // order: [4],
                dom: 'trip',
                responsive: true,
                pageLength: 100,
                ajax: {
                    url: vm.route('dashboard.blog.comment.index'),
                    data: function(d) {
                        d.status = vm.filters.status
                        d.created_at = vm.orders.created_at
                    },
                },
                columns: vm.columns
            })

            $(document).on('click', '.moderate-comment', function(event){
                event.preventDefault()
                
                axios.patch(this.href)
                .then(function(response){
                    
                    vm.$actions.setAlert({
                        type: response.data.type,
                        body: response.data.message
                    })

                    vm.table.ajax.reload()

                })
                .catch(function(error){
                    
                    vm.$actions.setAlert({
                        type: 'danger',
                        body: error.response.data.message
                    })
                })
            })

            vm.$root.$on('order-datatable', function(event){
                if(event.target == vm.$el.id) {
                    vm.orders[event.type] = event.data
                    vm.table.ajax.reload()
                }
            })

            vm.$root.$on('filter-datatable', function(event){
                if(event.target == vm.$el.id) {
                    vm.filters[event.type] = event.data
                    vm.table.ajax.reload()
                }
            })

            vm.$root.$on('search-datatable', function(event){
                if(event.target == vm.$el.id) {
                    vm.table.search(event.data).draw();
                }
            })

            vm.$root.$on('reload-datatable', function(event){
                if(event.target == vm.$el.id) {
                    vm.table.ajax.reload()
                }
            })

        }
    }
</script>