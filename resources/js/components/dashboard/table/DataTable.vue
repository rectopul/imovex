<template>

    <table class="table w-100" :class="{'table-borderless': borderless, 'table-sm': small}">
        <thead>
            <tr>
                <th v-for="(column, index) in columns" :key="index" class="d-none"></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

</template>

<script>
    import 'plugins/datatables'

    export default {
        
        props: {
            columns: Array,
            url: String,
            headers: Array,
            borderless: {
                type: Boolean,
                default: true
            },
            small: {
                type: Boolean,
                default: true
            }
        },

        data() {
            return {
                tables: {},
                params: {}
            }
        },

        mounted() {
            let vm = this
            
            vm.tables[vm.$el.id] = $('#'+vm.$el.id).DataTable({
                dom: 'trip',
                ajax: {
                    url: vm.url,
                    data: function(d) {
                        Object.assign(d, vm.params)
                    }
                },
                columns: vm.columns,
                // pageLength: vm.$parent.pageLength ?? 10
                pageLength: 100
            })

            vm.$root.$on('reload-datatable', function(event){
                vm.tables[event.target].ajax.reload()
            })

            vm.$root.$on('search-datatable', function(event){
                vm.tables[event.target].search(event.data).draw()
            })

            vm.$root.$on('order-datatable', function(event){
                vm.params = {}
                vm.params[event.type] = event.data
                vm.tables[event.target].ajax.reload()
            })

            $(document).on('click', 'table tbody tr', function(event){
                
                let tagName = $(event.target).prop('tagName').toLowerCase()
                
                if($(this).data('url')) {

                    if(tagName != 'svg' && tagName != 'button' && tagName != 'path' && tagName != 'a') {
                        location.href = $(this).data('url')
                    }
                    
                }
            })    
        }
    }
</script>