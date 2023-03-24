<template>
    <svg xmlns="http://www.w3.org/2000/svg" width="26.433" height="26.432" viewBox="0 0 26.433 26.432">
        <g id="_3096630" data-name="3096630" transform="translate(0 -0.014)">
        <path id="Path_336" data-name="Path 336" d="M.826,296.013h19a.826.826,0,0,1,.826.826V298.9a.826.826,0,0,1-.826.826h-19A.826.826,0,0,1,0,298.9v-2.065A.826.826,0,0,1,.826,296.013Z" transform="translate(0 -280.718)" :fill="setFill"/>
        <path id="Path_337" data-name="Path 337" d="M49.193.84c0,3.723.008,3.458-.014,3.458a.826.826,0,0,1-.812.671H38.042a2.482,2.482,0,0,0-2.336,1.652h.233a6.233,6.233,0,0,1,6.233,6.233v.53a.258.258,0,0,1-.258.258H24.258A.258.258,0,0,1,24,13.385v-.53a6.233,6.233,0,0,1,6.233-6.233h.421A7.445,7.445,0,0,1,38.042.014H48.367a.826.826,0,0,1,.826.826Z" transform="translate(-22.761)" :fill="setFill"/>
        <path id="Path_338" data-name="Path 338" d="M184.826,384.013a.826.826,0,0,0-.826.826v1.187a.826.826,0,0,0,1.652,0v-1.187A.826.826,0,0,0,184.826,384.013Z" transform="translate(-174.501 -364.175)" :fill="setFill"/>
        <path id="Path_339" data-name="Path 339" d="M280.826,384.013a.826.826,0,0,0-.826.826v1.187a.826.826,0,0,0,1.652,0v-1.187A.826.826,0,0,0,280.826,384.013Z" transform="translate(-265.545 -364.175)" :fill="setFill"/>
        <path id="Path_340" data-name="Path 340" d="M232.826,457.013a.826.826,0,0,0-.826.826v1.187a.826.826,0,1,0,1.652,0v-1.187A.826.826,0,0,0,232.826,457.013Z" transform="translate(-220.023 -433.407)" :fill="setFill"/>
        <path id="Path_341" data-name="Path 341" d="M336.826,457.013a.826.826,0,0,0-.826.826v1.187a.826.826,0,1,0,1.652,0v-1.187A.826.826,0,0,0,336.826,457.013Z" transform="translate(-318.654 -433.407)" :fill="setFill"/>
        <path id="Path_342" data-name="Path 342" d="M88.826,384.013a.826.826,0,0,0-.826.826v1.187a.826.826,0,0,0,1.652,0v-1.187A.826.826,0,0,0,88.826,384.013Z" transform="translate(-83.457 -364.175)" :fill="setFill"/>
        <path id="Path_343" data-name="Path 343" d="M136.826,457.013a.826.826,0,0,0-.826.826v1.187a.826.826,0,1,0,1.652,0v-1.187A.826.826,0,0,0,136.826,457.013Z" transform="translate(-128.979 -433.407)" :fill="setFill"/>
        <path id="Path_344" data-name="Path 344" d="M40.826,457.013a.826.826,0,0,0-.826.826v1.187a.826.826,0,1,0,1.652,0v-1.187A.826.826,0,0,0,40.826,457.013Z" transform="translate(-37.935 -433.407)" :fill="setFill"/>
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