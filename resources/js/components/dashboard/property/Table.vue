<template>

    <table id="property-table" class="table table-hover w-100">
        <thead>
            <tr>
            	<th>ID</th>
                <th>Descrição</th>
                <th>Função</th>
                <th class="no-wrap">Cidade</th>
                <th>Bairro</th>
                <th>CEP</th>
                <th>Situação</th>
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
                    { data: 'id' },
                    { data: 'descricao' },
                    { data: 'funcao' },
                    { data: 'cidade', className: 'no-wrap' },
                    { data: 'bairro' },
                    { data: 'cep', className: 'no-wrap' },
                    { data: 'situacao' },
                ]
            }
        },
        mounted() {
            let vm = this

            vm.table = $('#property-table').DataTable({
                ajax: vm.route('dashboard.property.index'),
                columns: vm.columns,
                order: [[0, 'desc']],
                pageLength: 100
            })

            vm.$root.$on('reload-datatable', function(event){
                if(event.target == vm.$el.id) {
                    vm.table.ajax.reload()
                }
            })

            $(document).on('click', '#property-table tbody tr', function(event){
                location.href = $(this).data('url')
            }) 

        }
    }
</script>

<style>
	#property-table tbody tr { cursor: pointer; }
</style>