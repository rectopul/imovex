<template>

    <table id="post-table" class="table table-borderless w-100">
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
        
        props: {
            categories: Array
        },

        data() {
            return {
                table: null,
                filters: {
                    categories: [],
                    users: [],
                    status: '*',
                },
                orders: {
                    created_at: 'ASC'
                },
                sort: 'newest'
            }
        },

        mounted() {
            var vm = this

            vm.table = $('#post-table').DataTable({
                dom: 'trip',
                responsive: true,
                pageLength: 100,
                ajax: {
                    url: vm.route('dashboard.blog.post.index'),
                    data: function(d) {
                        d.query = vm.search
                        d.categories = vm.filters.categories
                        d.users = vm.filters.users
                        d.status = vm.filters.status
                        d.sort = vm.sort
                    }
                },
                columns: [
                    { data: 'post', searchable: false, orderable: false }
                ]
            })

            $(document).on('click', '.publish-post', function(event) {
                event.preventDefault()

                var action = this.href
                
                axios({
                    method: 'patch',
                    url: action
                })
                .then(function(response) {
                    
                    vm.$actions.setAlert({
                        type: response.data.type,
                        body: response.data.body
                    })

                    vm.table.ajax.reload(null, false)

                })
                .catch(function(error){
                    console.log(error.response.data)
                    vm.$actions.setAlert({
                        type: 'danger',
                        body: `Não foi possível realizar a operação!`
                    })

                })

            })

            $(document).on('click', '.home-post', function(event) {
                event.preventDefault()

                var action = this.href
                
                axios({
                    method: 'put',
                    url: action
                })
                .then(function(response) {
                    
                    vm.$actions.setAlert({
                        type: response.data.type,
                        body: response.data.body
                    })

                    vm.table.ajax.reload(null, false)

                })
                .catch(function(error){
                    
                    vm.$actions.setAlert({
                        type: 'danger',
                        body: `Não foi possível realizar a operação!`
                    })

                })

            })

            vm.$root.$on('filter-datatable', function(event){
                if(event.target == vm.$el.id) {
                    vm.filters[event.type] = event.data
                    vm.table.ajax.reload()
                }
            })

            vm.$root.$on('order-datatable', function(event){
                if(event.target == vm.$el.id) {
                    vm.sort = event.data
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