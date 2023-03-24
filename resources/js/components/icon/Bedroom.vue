<template>
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="27.357" viewBox="0 0 32 27.357">
        <g id="_3159474" data-name="3159474" transform="translate(0 -37.141)">
        <path id="XMLID_891_" d="M119.763,131.9a.283.283,0,0,0-.283.283v1.8h5.913v-1.8a.283.283,0,0,0-.283-.283Z" transform="translate(-112.013 -88.835)" :fill="setFill"/>
        <path id="XMLID_890_" d="M298.188,131.9a.283.283,0,0,0-.283.283v1.8h5.913v-1.8a.283.283,0,0,0-.283-.283h-5.348Z" transform="translate(-279.286 -88.835)" :fill="setFill"/>
        <path id="XMLID_889_" d="M53.692,45.126v-1.78a2.179,2.179,0,0,1,2.177-2.177h5.348a2.179,2.179,0,0,1,2.177,2.177v1.78h1.451v-1.78A2.179,2.179,0,0,1,67.02,41.17h5.348a2.179,2.179,0,0,1,2.177,2.177v1.78h1.507a4.3,4.3,0,0,1,.859.086V39.4a2.263,2.263,0,0,0-2.263-2.263H53.589A2.263,2.263,0,0,0,51.326,39.4v5.808a4.306,4.306,0,0,1,.859-.086Z" transform="translate(-48.118)" :fill="setFill"/>
        <path id="XMLID_888_" d="M30.827,258.811H1.173A1.173,1.173,0,0,0,0,259.984v7.69a1.173,1.173,0,0,0,1.173,1.173H30.827A1.173,1.173,0,0,0,32,267.675v-7.69A1.173,1.173,0,0,0,30.827,258.811Z" transform="translate(0 -207.816)" :fill="setFill"/>
        <path id="XMLID_887_" d="M53.159,195.206H29.292a2.407,2.407,0,0,0-2.385,2.082H55.544a2.407,2.407,0,0,0-2.385-2.082Z" transform="translate(-25.225 -148.186)" :fill="setFill"/>
        <path id="XMLID_886_" d="M18.762,449.7v.626a.947.947,0,0,0,1.894,0V449.7H18.762Z" transform="translate(-17.589 -386.775)" :fill="setFill"/>
        <path id="XMLID_885_" d="M462.938,449.7v.626a.947.947,0,1,0,1.894,0V449.7h-1.894Z" transform="translate(-434.004 -386.774)" :fill="setFill"/>
        </g>
    </svg>
</template>

<script>
    export default {
        props: {
            active: Boolean
        },

        data() {
            return {
                fill: ''
            }
        },

        computed: {
            setFill() {
                return this.active ? '#273b92' : '#e8e8e8'
            }
        }
    }
</script>