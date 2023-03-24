<template>
    
    <div id="remove-modal" class="modal fade" tabindex="-1" aria-labelledby="removeModal" aria-hidden="true">
        <div class="modal-dialog modal-md">
            
            <div class="modal-content">
                <div class="modal-body text-center">
                    <slot></slot>
                </div>
                <div class="modal-footer border-0">
                    <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    <button @click="remove" data-bs-dismiss="modal" class="btn btn-danger btn-sm ">Remover</button>
                </div>
            </div>
            
        </div>
    </div>

</template>

<script>
    export default {
        props: {
            redirect: String,
        },
        data() {
            return {
                url: ''
            }
        },
        methods: {
            remove() {
                
                var vm = this

                axios({
                    url: vm.url,
                    method: 'delete'
                })
                .then(function(response){
                    
                    if(response.data.redirect || vm.redirect) {
                        location.href = response.data.redirect ?? vm.redirect
                    }

                    if(response.data.reloadDatatable) {
                        vm.$root.$emit('reload-datatable', {
                            target: response.data.reloadDatatable
                        })
                    }

                    vm.$actions.setAlert({
                        type: 'success',
                        body: response.data.message
                    })

                })
                .catch(function(error){
                    vm.$actions.setAlert({
                        type: 'danger',
                        body: error.response.data.message
                    })
                })
            }
        },
        mounted() {

            var vm = this

            vm.$el.addEventListener('show.bs.modal', function(event){
                vm.url = event.relatedTarget.href
            })
        }   
    }
</script>