<template>
            
    <data-table 
        id="contact-table" 
        :columns="columns" 
        :url="url" 
        :small="false" 
        :borderless="false"
    >
    </data-table>

</template>

<script>
    export default {
        data() {
            return {
                url: this.route('dashboard.contact.index'),
                columns: [
                    { data: 'name' },
                    { data: 'subject' },
                    { data: 'created_at' },
                    { data: 'actions' }
                ]
            }
        },

        mounted() {

            let vm = this

            $(document).on('click', '.mark-read', function(event) {
                event.preventDefault()

                var action = this.href
                
                axios({
                    method: 'put',
                    url: action
                })
                .then(function(response) {
                    console.log(response)
                    vm.$actions.setAlert({
                        type: response.data.type,
                        body: response.data.body
                    })

                    vm.$root.$emit('reload-datatable', {
                        target: 'contact-table'
                    })

                    // vm.table.ajax.reload(null, false)

                })
                .catch(function(error){
                    console.log(error)
                    vm.$actions.setAlert({
                        type: 'danger',
                        body: `Não foi possível realizar a operação!`
                    })

                })

            })
        }
    }
</script>

<style>
    .dropdown-toggle, .btn { box-shadow: none !important; }

    #contact-table tbody tr { cursor: pointer; }

    #contact-table tbody tr td:nth-child(2) {
        max-width: 45vw;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    

</style>