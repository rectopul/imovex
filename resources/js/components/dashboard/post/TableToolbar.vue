<template>
    <div class="px-2">
        <div class="row">
            <div class="col-md-8">
                
                <div class="btn-group justify-content-between">
                    
                    <table-dropdown v-model="order" :items="orders" @input="ordering">
                    </table-dropdown>

                    <table-dropdown class="mx-2" v-model="status" :items="statuses" @input="filterByStatus">
                    </table-dropdown>
                    
                    <table-dropdown-checkbox v-if="categories.length > 0" v-model="selectedCategories" :items="categories" label="Categorias" @input="filterByCategories">
                    </table-dropdown-checkbox>

                    <table-dropdown-checkbox class="ms-2" v-if="users.length > 0" v-model="selectedUsers" :items="users" label="Autores" @input="filterByUsers">
                    </table-dropdown-checkbox>

                </div>

            </div>
            <div class="col-md-4 text-end">
                <input type="search" class="form-control" v-model="search" @input="searchPosts" placeholder="Pesquise os posts pelo título">
            </div>
            
        </div>
        <div class="row mt-2" v-show="selectedCategories.length > 0">
            <div class="col">
                <span class="badge bg-secondary text-white">
                    Categorias selecionadas: {{ getSelectedCategories().join(', ') }}
                    <span @click="clearSelectedCategories"><i class="fa fa-fw fa-times ms-2"></i></span>
                </span>
            </div>
        </div>
        <div class="row mt-2" v-show="selectedUsers.length > 0">
            <div class="col">
                <span class="badge bg-secondary text-white">
                    Autores selecionados: {{ getSelectedUsers().join(', ') }}
                    <span @click="clearSelectedUsers"><i class="fa fa-fw fa-times ms-2"></i></span>
                </span>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                
                status: '',
                statuses: [
                    { label: 'Todos', value: '*' },
                    { label: 'Exibidos na Home', value: 'home' },
                    { label: 'Publicados', value: 'published' },
                    { label: 'Agendados', value: 'scheduled' },
                    { label: 'Não publicados', value: 'unpublished' }
                ],
                
                order: '',
                orders: [
                    { label: 'Mais recentes', value: 'newest' },
                    { label: 'Mais antigos', value: 'oldest' },
                    { label: 'Últimos atualizados', value: 'updated_at' },
                    { label: 'A-Z', value: 'alpha' }
                ],
                
                categories: [],
                selectedCategories: [],

                users: [],
                selectedUsers: [],

                search: ''
            }
        },
        methods: {
            getSelectedCategories(){

                var vm = this
                
                return _.map(_.filter(vm.categories, function(category){
                    return _.includes(vm.selectedCategories, category.value)
                }), 'label')

            },

            getSelectedUsers(){

                var vm = this
                
                return _.map(_.filter(vm.users, function(user){
                    return _.includes(vm.selectedUsers, user.value)
                }), 'label')

            },
            
            clearSelectedCategories() {

                let vm = this

                vm.selectedCategories = []
                vm.$root.$emit('clear-dropdown')

                vm.$root.$emit('filter-datatable', {
                    target: 'post-table',
                    type: 'categories',
                    data: vm.selectedCategories
                })

            },

            clearSelectedUsers() {

                let vm = this

                vm.selectedUsers = []
                vm.$root.$emit('clear-dropdown')

                vm.$root.$emit('filter-datatable', {
                    target: 'post-table',
                    type: 'users',
                    data: vm.selectedUsers
                })

            },

            fetchCategories() {
                let vm = this

                axios.get(vm.route('dashboard.blog.post.category.index'))
                .then(function(response){
                    vm.categories = _.map(response.data, function(category){
                        
                        return {
                            value: category.id,
                            label: category.name
                        }
                    })
                })
            },

            fetchUsers() {
                let vm = this

                axios.get(vm.route('dashboard.blog.post.user.index'))
                .then(function(response){
                    vm.users = _.map(response.data, function(user){
                        
                        return {
                            value: user.id,
                            label: user.name
                        }
                    })
                })
            },

            filterByStatus() {
                let vm = this
                
                vm.$root.$emit('filter-datatable', {
                    target: 'post-table',
                    type: 'status',
                    data: vm.status
                })
            },

            filterByCategories() {
                let vm = this

                vm.$root.$emit('filter-datatable', {
                    target: 'post-table',
                    type: 'categories',
                    data: vm.selectedCategories
                })
            },

            filterByUsers() {
                let vm = this

                vm.$root.$emit('filter-datatable', {
                    target: 'post-table',
                    type: 'users',
                    data: vm.selectedUsers
                })
            },

            orderByCreatedAt() {
                let vm = this

                vm.$root.$emit('order-datatable', {
                    target: 'post-table',
                    type: 'created_at',
                    data: vm.order
                })
            },

            ordering() {
                let vm = this

                vm.$root.$emit('order-datatable', {
                    target: 'post-table',
                    data: vm.order
                })
            },

            searchPosts() {
                let vm = this

                vm.$root.$emit('search-datatable', {
                    target: 'post-table',
                    data: vm.search
                })
            }
            
        },
        mounted() {
            this.fetchCategories()
            this.fetchUsers()
        }
    }
</script>

<style scoped>
    .fa-times { cursor: pointer; }
</style>