<template>

    <table id="user-table" class="table table-hover w-100">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Cadastro</th>
                <th width="1%"></th>
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
                columns: [
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'created_at', searchable: false, orderable: false },
                    { data: 'actions', searchable: false, orderable: false }
                ]
            }
        },
        mounted() {
            let vm = this

            vm.table = $('#user-table').DataTable({
                ajax: vm.route('dashboard.user.index'),
                pageLength: 100,
                columns: vm.columns
            })

            vm.$root.$on('reload-datatable', function(event){
                if(event.target == vm.$el.id) {
                    vm.table.ajax.reload()
                }
            })

        }
    }
</script>

<style>
    #user-table tbody tr { cursor: pointer; }
</style>