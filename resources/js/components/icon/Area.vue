<template>
    <svg xmlns="http://www.w3.org/2000/svg" width="28.848" height="28.848" viewBox="0 0 28.848 28.848">
        <path id="_76858" data-name="76858" d="M28.4,6.894,21.957.45a1.537,1.537,0,0,0-2.173,0l-.527.526L21.9,3.619a.76.76,0,1,1-1.075,1.075L18.183,2.051,16.391,3.843l1.21,1.21a.76.76,0,1,1-1.075,1.075l-1.21-1.21L13.524,6.71l1.21,1.21a.76.76,0,1,1-1.075,1.075l-1.21-1.21L10.657,9.577,13.3,12.22A.76.76,0,1,1,12.225,13.3L9.582,10.652,7.79,12.444,9,13.654a.76.76,0,0,1-1.075,1.075l-1.21-1.21L4.923,15.311l1.21,1.21A.76.76,0,0,1,5.057,17.6l-1.21-1.21L2.056,18.178,4.7,20.822A.76.76,0,1,1,3.623,21.9L.98,19.254l-.526.526a1.536,1.536,0,0,0,0,2.173L6.9,28.4a1.537,1.537,0,0,0,2.173,0L28.4,9.067A1.537,1.537,0,0,0,28.4,6.894Z" transform="translate(-0.004 0)" :fill="setFill"/>
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