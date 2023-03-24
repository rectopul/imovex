<template>
    <div>
        
        <div class="row">
            <div class="col">
                <p class="fs-18 fw-medium text-info">
                    {{ property.descricao }}
                    <i class="fa fa-gavel fa-2x ms-4"></i>
                </p>
            </div>
        </div>

        <div class="row align-items-start">
            <div class="col-12 col-sm-10">
                <p class="fs-25 mb-1">{{ property.descricao_curta }}</p>
                <p class="fs-21 mb-1">{{ location }} <span class="fw-light">{{ property.endereco.split(',')[0] }}</span></p>
                <p class="fs-16 m-0">{{ property.area_total }}m² <!-- - R$ 7.790.00 --></p>
            </div>
            <div class="col-12 col-sm-2 text-end text-sm-center mt-1 mt-sm-0">
                <heart-icon 
                    :fill="[bookmarked ? '#cd1875' : 'none']"
                    :class="{'animate__animated animate__heartBeat': bookmarked}" 
                    color="#cd1875"
                    @click.native.stop="bookmark" 
                >
                </heart-icon>
            </div>
        </div>

        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-xl-5 fs-13 align-items-center property-info g-3">
            <div class="col">
                <bedroom-icon :active="property.dormitorios > 0"></bedroom-icon>
                <span class="ms-2 text-nowrap">{{ property.dormitorios ? property.dormitorios+' quartos' : 'sem quartos' }} </span>
            </div>
            <div v-if="property.area_total" class="col">
                <area-icon active></area-icon>
                <span class="ms-2 text-nowrap">{{ property.area_total }}m²</span>
            </div>
            <div class="col">
                <parking-icon :active="property.garagem > 0"></parking-icon>
                <span class="ms-2 text-nowrap">{{ property.garagem ? property.garagem+' vagas' : 'sem vagas' }} </span>
            </div>
            <div class="col">
                <bathroom-icon :active="property.banheiros > 0"></bathroom-icon>
                <span class="ms-2 text-nowrap">{{ property.banheiros ? property.banheiros+' banheiros' : 'sem banheiros' }} </span>
            </div>
            <div v-if="property.andar > 0" class="col">
                <building-icon active></building-icon>
                <span class="ms-2 text-nowrap">{{ property.andar }} andar</span>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="addthis_inline_share_toolbox_cfyn"></div>
            </div>
        </div>

        <div class="row property-description">
            <div class="col">
                <h2 class="text-info fs-25 mb-3">Descrição</h2>
                <p class="fs-14">{{ property.descricao_detalhada }}</p>
            </div>
        </div>

        <!-- <div class="row property-features">
            <div class="col">
                <h2 class="fs-25 text-info">Porque curtimos esse imovél</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-6 col-lg-6">
                <h3 class="fs-18 fw-light">Lazer e esporte</h3>
                <div class="row">
                    <div class="col-lg-6 fs-13">
                        <ul class="list-group">
                            <li v-for="(feature, index) in firstFeatures" :key="index" class="d-flex justify-content-start align-items-center">
                                    
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                    <g id="Rectangle_303" data-name="Rectangle 303" fill="#fff" stroke="#ccc" stroke-width="1">
                                        <rect width="15" height="15" stroke="none"/>
                                        <rect x="0.5" y="0.5" width="14" height="14" fill="none"/>
                                    </g>
                                </svg>
                                <span class="ms-1">{{ feature }}</span>
    
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 fs-13">
                        <ul class="list-group">
                            <li v-for="(feature, index) in lastFeatures" :key="index" class="d-flex justify-content-start align-items-center">
                                    
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                    <g id="Rectangle_303" data-name="Rectangle 303" fill="#fff" stroke="#ccc" stroke-width="1">
                                        <rect width="15" height="15" stroke="none"/>
                                        <rect x="0.5" y="0.5" width="14" height="14" fill="none"/>
                                    </g>
                                </svg>
                                <span class="ms-1 text-nowrap">{{ feature }}</span>
    
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-6 mt-3 mt-sm-0">
                <h3 class="fs-18 fw-light">Comodidade e serviços</h3>
                <div class="row">
                    <div class="col-lg-6 fs-13">
                        <ul class="list-group">
                            <li v-for="(feature, index) in firstFeatures" :key="index" class="d-flex justify-content-start align-items-center">
                                    
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                    <g id="Rectangle_303" data-name="Rectangle 303" fill="#fff" stroke="#ccc" stroke-width="1">
                                        <rect width="15" height="15" stroke="none"/>
                                        <rect x="0.5" y="0.5" width="14" height="14" fill="none"/>
                                    </g>
                                </svg>
                                <span class="ms-1 text-nowrap">{{ feature }}</span>
    
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 fs-13">
                        <ul class="list-group">
                            <li v-for="(feature, index) in lastFeatures" :key="index" class="d-flex justify-content-start align-items-center">
                                    
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                    <g id="Rectangle_303" data-name="Rectangle 303" fill="#fff" stroke="#ccc" stroke-width="1">
                                        <rect width="15" height="15" stroke="none"/>
                                        <rect x="0.5" y="0.5" width="14" height="14" fill="none"/>
                                    </g>
                                </svg>
                                <span class="ms-1">{{ feature }}</span>
    
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row property-data">
            <div class="col">
                <h2 class="fs-25 text-info">Porque curtimos esse imovél</h2>
                <ul class="list-group">
                    <li class="list-group-item px-0 border-0 pb-0">
                        <p class="data-title fs-15 fw-normal text-primary mb-2">Pé direito alto</p>
                        <p class="data-description mb-0 fs-11">
                            DIREITOS QUE O EXECUTADO POSSUI SOBRE O IMOVEL DA MATRÍCULA Nº 98.133 DO 1º CARTÓRIO DE REGISTRO DE IMÓVEIS DA COMARCA DE GUARULHOS/SP - IMÓVEL: Apartamento nº 202, localizado no 2º pavimento do Bloco 27, do empreendimento denominado Boulevard Residencial Club, situado na Estrada da Água Chata
                        </p>
                    </li>
                    <li class="list-group-item px-0 border-0 pb-0">
                        <p class="data-title fs-15 fw-normal text-primary mb-2">Ilumine-se</p>
                        <p class="data-description mb-0 fs-11">
                            DIREITOS QUE O EXECUTADO POSSUI SOBRE O IMOVEL DA MATRÍCULA Nº 98.133 DO 1º CARTÓRIO DE REGISTRO DE IMÓVEIS DA COMARCA DE GUARULHOS/SP - IMÓVEL: Apartamento nº 202, localizado no 2º pavimento do Bloco 27, do empreendimento denominado Boulevard Residencial Club, situado na Estrada da Água Chata
                        </p>
                    </li>
                </ul>
            </div>
        </div> -->

        <div class="row property-complaint">
            <div class="col fs-14">
                <p class="m-0 mb-3 fw-bold">Há algo errado com este anúncio?</p>
                <p class="m-0">Nos informe mais detalhes para ajudar</p>
                <a :href="route('web.contact.create')" class="text-primary">Denunciar Anúncio</a>
            </div>
        </div>
    </div>
</template>

<script>
    
    export default {
        
        props: {
            property: Object
        },
        data() {
            return {
				bookmarked: false,
                features: [
                    'Academia', 'Churraqueira', 'Cinema', 'Espaço Gourmet', 
                    'Jardim', 'Piscina', 'Playground', 'Quadra de Squash'
                ]
			}
        },
        methods: {
            bookmark(e) {
				this.bookmarked = !this.bookmarked
				console.log(e.target.closest('svg').classlist)
			}
        },
        computed: {
            firstFeatures() {
                return this.features.slice(0, 4)
            },
            lastFeatures() {
                return this.features.slice(4, 8)
            },
            location() {

				let district = this.property.bairro
				let city = this.property.cidade

				if(district) district = district.trim()
				if(city) city = city.trim()

				if(district && city) return `${district}, ${city}`
				if(district && !city) return district
				if(!district && city) return city
			},
        }
        
    }
</script>

<style scoped>
    .property-info {
        margin-top: 1.813rem;
        margin-bottom: 1.813rem;
    }

    .property-description {
        margin-top: 1.875rem;
    }

    .property-features {
        margin-top: 2.5rem;
        margin-bottom: 1.313rem;
    }

    .property-data {
        margin-top: 4.688rem;
    }

    .property-data h2 {
        margin-bottom: 1.313rem;
    }

    .property-data .list-group-item {
        margin-bottom: 1.313rem;
    }

    .data-description {
        line-height: 0.875rem;
    }

    .property-description p {
        line-height: 1.813rem;
    }

    .property-complaint {
        margin-top: 4.188rem;
    }

    .property-complaint p {
       line-height: 0.875rem;
    }
</style>