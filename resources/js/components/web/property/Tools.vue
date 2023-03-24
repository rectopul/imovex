<template>
    <div id="tools" class="row my-4">
            
        <div class="col-12 col-md-6 col-lg-7 col-xl-8 text-center mb-3 mb-md-0">
            <span v-if="totalRecords" class="fs-15 fw-light">
                Encontramos {{ totalRecords }} imóveis para sua busca
            </span>
        </div>

        <div class="col-12 col-md-6 col-lg-5 col-xl-4">
            <div class="row gap-0">

                <div class="col-12 col-sm-4 col-md-3 col-lg-3 order-last order-sm-first text-center text-sm-start mt-2 mt-sm-0">
                    <!-- <span @click="setOption('th')">
                        <block-icon
                            :color="[(activeOption === 'th') ? '#273B92' : '#b5b5b5']" 
                            class="me-2 d-none"></block-icon>
                    </span>
                    <span @click="setOption('list')">
                        <list-icon 
                            :color="[(activeOption === 'list') ? '#273B92' : '#b5b5b5']"
                            class="d-none"
                        >
                        </list-icon>
                    </span> -->
                </div>
                <form class="col-12 col-sm-8 col-md-9 col-lg-9 d-flex flex-xl-row">
                    
                    <span class="fs-15 fw-light me-1 d-block d-xl-inline text-nowrap">Classificar por </span>
                    <select v-model="sort" name="classificacao" class="form-control fs-11 fw-light text-gray-5 border-gray-3">
                        <option value="mais-buscados">Mais buscados</option>
                        <option value="maior-preco">Maior preço</option>
                        <option value="menor-preco">Menor preço</option>
                        <option value="maior-desconto">Maior desconto</option>
                        <option value="menor-desconto">Menor desconto</option>
                        <option value="mais-recente">Mais recente</option>
                        <option value="judicial">Judicial</option>
                        <option value="extrajudicial">Extrajudicial</option>
                        <option value="ocupado">Ocupado</option>
                        <option value="desocupado">Desocupado</option>
                    </select>
                    
                </form>

            </div>

            
        </div>
    </div>
</template>

<script>

    export default {
        
        props: {
            totalRecords: ''
        },

        data() {
            return {
                activeOption: "th",
                orderBy: '',
                sort: 'mais-buscados',
                queryString: ''
            }
        },

        methods: {
            setOption(option) {
                this.activeOption = option;
            }
        },

        mounted() {
            const self = this;

            $('[name="classificacao"]').on('change', function() {
                let url = new URL(window.location.href);
                let params = new URLSearchParams(url.search);

                params.set('classificacao', self.sort);

                url.search = params.toString();

                window.location.href = url.toString();
            });

            const urlParams = new URLSearchParams(window.location.search);
            this.sort = urlParams.get('classificacao');
            this.queryString = location;

            

        }
    }
</script>

<style scoped>
    svg {
        cursor: pointer;
    }
</style>


