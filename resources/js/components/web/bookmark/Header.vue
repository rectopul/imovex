<template>
    <div class="container-xxl">
        <div class="row">
            <div class="col text-center">
                
                <svg class="mb-3" xmlns="http://www.w3.org/2000/svg" width="44" height="40.886" viewBox="0 0 44 40.886">
                    <path id="Path_360" data-name="Path 360" d="M40.4,20.74a12.023,12.023,0,0,0-17.622,0L22,21.559l-.777-.821a12.031,12.031,0,0,0-17-.625q-.324.3-.625.625a13.494,13.494,0,0,0,0,18.348L20.862,57.292a1.573,1.573,0,0,0,2.223.06q.031-.029.06-.06L40.4,39.086A13.492,13.492,0,0,0,40.4,20.74ZM38.126,36.921h0L22,53.925l-16.123-17a10.311,10.311,0,0,1,0-14.019A8.888,8.888,0,0,1,18.439,22.4q.263.242.505.505l1.917,2.022a1.62,1.62,0,0,0,2.283,0L25.062,22.9A8.888,8.888,0,0,1,37.621,22.4q.263.242.505.505A10.217,10.217,0,0,1,38.126,36.921Z" transform="translate(0 -16.896)" fill="#cd1875"/>
                </svg>

                <h1>Seus imóveis favoritos</h1>
                <p class="fs-15 fw-light">{{ text }}</p>
                <!-- <div v-if="currentTotal > 0">
                    <block-icon></block-icon>
                    <list-icon></list-icon>
                </div> -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props: {
            total: String
        },

        data() {
            return {
                currentTotal: this.total
            }
        },

        computed: {
            text() {
                if(this.currentTotal == 0) return 'Você ainda não salvou produtos'
                if(this.currentTotal == 1) return `Você salvou ${this.currentTotal} produto`
                if(this.currentTotal > 1) return `Você salvou ${this.currentTotal} produtos`
            }
        },

        mounted() {

            const vm = this

            vm.$root.$on('bookmark-removed', function(id){
                vm.currentTotal--
            })

        }
    }
</script>