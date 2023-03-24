<template>
    
    <div class="sticky-lg-top mt-n5 mt-4 mt-lg-0">
        
        <div class="card px-4 pt-4 pb-3 bg-gray-2 border-0 rounded-3">
            <p class="m-0 fs-25 text-primary fw-bold">{{ property.price }}</p>
            <p v-if="property.valor_lance_inicial_praca_1 && property.valor_lance_inicial_praca_2" class="text-info fw-bold fs-14">
                1ª Praça: {{ property.valor_lance_inicial_praca_1 }} / 2º Praça: {{ property.valor_lance_inicial_praca_2 }}
            </p>
            <p class="m-0 fs-13">Valor do imovél - pode ser parcelado</p>

            <p v-if="property.valor_lance_incremento" class="fs-13 fw-bold">
                Incremento do Leilão: {{ property.valor_lance_incremento }}
            </p>

            <p v-if="property.leilao_encerrado" class="text-danger fw-bold fs-13">
                <i class="fa fa-fw fa-exclamation-circle"></i> Leilão Encerrado
            </p>

            <!-- <div class="row fs-14 mt-2">
                <div class="col">
                    <span>Condomino</span>
                </div>
                <div class="col-auto">
                    <span class="">R$ 450,00</span>
                </div>
            </div>

            <div class="row fs-14 my-1">
                <div class="col">
                    <span>IPTU</span>
                </div>
                <div class="col-auto">
                    <span class="">10x de R$ 450,00</span>
                </div>
            </div> -->

            <div class="d-grid mt-3">
                <button class="btn btn-primary btn-block text-white fw-bold">
                    Agendar visita
                </button>
            </div>
        </div>

        <div v-if="property.latitute && property.longitude" class="row my-4">
            <div class="col-12 col-sm-6 col-lg-12">
                <gmap-map
                    :center="position"
                    :zoom="15"
                    map-type-id="roadmap"
                    style="height: 300px"
                >
                    <gmap-marker ref="mapView" :position="position" />
                </gmap-map>
            </div>
            <div class="col-12 col-sm-6 mt-3 mt-sm-0 mt-lg-3 col-lg-12">
                <gmap-street-view-panorama class="pano" :position="position"
                    :pov="position" :zoom="1">
                </gmap-street-view-panorama>
                
            </div>
        </div>
        

    </div>

</template>

<script>
    export default {
        props: {
            property: Object
        },

        computed: {
            position() {
                return {lat: Number(this.property.latitute), lng: Number(this.property.longitude)}
            }
        }
    }
</script>

<style scoped>
    .sticky-top {
        margin-top: -3.5rem !important;
        top: 80px;
    }

    .sticky-lg-top {
        margin-top: -4rem !important;
        top: 80px;
    }

    #map {
        height: 300px;
    }

    .pano {
        width: 100%;
        height: 300px;
    }
</style>