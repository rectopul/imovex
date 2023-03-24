<template>
    <div class="modal fade" tabindex="-1" id="filter-options">
        <div class="modal-dialog">
            <div class="modal-content modal-sm border-0 rounded-5">
                
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item border-0">
                            <span class="fs-13 fw-semi-bold">Filtre sua busca</span>
                            <span v-if="queryParams" @click="clearFilters" class="fs-11 text-primary text-decoration-none" role="button">LIMPAR FILTROS</span>
                        </li>

                        <li class="list-group-item border-0">
                            <p class="m-0 text-info fs-13">Localização</p>
                            <div v-if="!filters.cities">
                                <i class="fa fa-spinner fa-spin text-gray text-gray-6"></i>
                            </div>
                            <div v-else>
                                <autocomplete 
                                    class="form-control fs-11 fw-light border-gray-3 rounded-5 px-1" 
                                    placeholder="Busque a cidade" 
                                    :search="filterCities"
                                    @submit="searchByCity"
                                    :default-value="queryParams.cidade"
                                >
                                </autocomplete>
                            </div>
                        </li>
                        
                        
                        <li class="list-group-item fs-13 fw-normal bg-gray-2 border-0">
                            <p class="m-0 mb-1 text-info">Tipo do imóvel</p>
                            <ul>
                                <div v-if="!filters.descriptions">
                                    <i class="fa fa-spinner fa-spin text-gray text-gray-6"></i>
                                </div>
                                <li v-for="(description, index) in filters.descriptions" :key="index">
                                    <a href="#" @click.prevent="setQueryParam('tipo', description)" class="text-decoration-none text-dark">{{ description }}</a>
                                </li>
                            </ul>
                        </li>

                        <li class="list-group-item fs-13 border-0">
                            <p class="m-0 text-info">Faixa de preço</p>
                            <!-- <div v-if="!filters.descriptions">
                                <i class="fa fa-spinner fa-spin text-gray text-gray-6"></i>
                            </div> -->
                            <div class="row">
                                <div class="col">
                                    <label>Mínimo</label>
                                    <input id="min-price" type="text" class="form-control fs-11 fw-light border-gray-3 rounded-5">
                                </div>
                                <div class="col">
                                    <label>Máximo</label>
                                    <input id="max-price" type="text" class="form-control fs-11 fw-light border-gray-3 rounded-5">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item fs-13 bg-gray-2 border-0">
                            <p class="m-0 mb-1 text-info">Número de quartos</p>
                            <ul>
                                <div v-if="!filters.bedrooms">
                                    <i class="fa fa-spinner fa-spin text-gray text-gray-6"></i>
                                </div>
                                <li v-for="(bedroom, index) in filters.bedrooms" :key="index">
                                    <a v-if="bedroom <= 5 && bedroom > 0" href="#" 
                                        @click.prevent="setQueryParam('quartos', bedroom)" 
                                        class="text-decoration-none text-dark"
                                    >
                                        {{ bedroom }}{{ bedroom == 5 ? '+' : '' }}
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
                
            </div>
        </div>
    </div>
</template>

<script>

    import Autocomplete from '@trevoreyre/autocomplete-vue'
    require('inputmask/dist/jquery.inputmask')

    export default {

        props: {
            filters: Object,
            selectedFilters: Object
        },

        data() {
            return {

                min: '',
                max: '',

                translate: {
                    city: 'cidade',
                    type: 'tipo',
                    minPrice: 'minimo',
                    maxPrice: 'maximo',
                    bedrooms: 'quartos'
                },

                queryParams: {
                    cidade: ''
                }
            }
        },

        methods: {

            doFilter() {

                const vm = this

                location.href = vm.route('web.catalog.index', this.queryParams)

            },

            filterBedrooms() {



            },

            filterCities(input) {

                const vm = this

                if (input.length < 1) { return [] }

                return Object.values(vm.filters.cities).filter(city => {
                    return city.toLowerCase()
                    .startsWith(input.toLowerCase())
                })
            },

            searchByCity(selected) {

                const vm = this
                
                this.queryParams.cidade = selected

                if(Object.values(this.filters.cities).includes(this.queryParams.cidade)) {
                    this.doFilter()
                }
            },

            searchByValue() {

                this.queryParams.min = $('#min-price').val()
                this.queryParams.max = $('#max-price').val()

                this.doFilter()
                
            },

            setQueryParam(key, value) {
                this.queryParams[key] = value
                
                this.doFilter()
            },

            clearFilters() {

                this.queryParams = {}

                const urlSearchParams = new URLSearchParams(window.location.search)

                if(urlSearchParams.has('busca')) {
                    this.queryParams.busca = urlSearchParams.get('busca')
                }

                this.doFilter()

            }

        },

        mounted() {
            const vm = this
            const urlSearchParams = new URLSearchParams(window.location.search)
            
            vm.queryParams = Object.fromEntries(urlSearchParams.entries())

            $('#min-price, #max-price').inputmask('decimal', {
                radixPoint:",",
                groupSeparator: ".",
                autoGroup: true,
                digits: 2,
                digitsOptional: false,
                // placeholder: '0',
                rightAlign: false,
                prefix: 'R$ ',
                onBeforeMask: function (value, opts) {
                    return value;
                }
            })

            $('#min-price, #max-price').on('blur', function(){
                let value = $(this).inputmask('unmaskedvalue').replace(',', '.')

                if(value) {
                    vm.setQueryParam($(this).prop('id').split('-')[0], value)
                }
                 
                vm.doFilter()
                
            })

            if(this.queryParams.min) {
                $('#min-price').inputmask('setvalue', vm.queryParams.min.replace('.', ','));
            }

            if(this.queryParams.max) {
                $('#max-price').inputmask('setvalue', vm.queryParams.max.replace('.', ','));
            }


        }

    }

</script>

<style scoped>
    .modal-dialog {
        position: absolute;
        top: 8rem;
        right: 4px;
    }

	
	#filter-options ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
	}

	#filter-options .card {
		border-radius: 0.5rem;
	}

	body.modal-open {
		overflow: scroll !important;
	}
</style>

<style>
    .autocomplete-input, .autocomplete-input:focus, .autocomplete-input:focus-visible {
        width: 100%;
        outline: none !important;
        border: none;
    }

    .autocomplete-result-list {
        background: #fff;
        width: 100%;
        margin-top: 0.5rem;
    }

    .autocomplete-result {
        list-style: none;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        padding-left: 0;
        cursor: pointer;
        width: 100%;
    }
</style>