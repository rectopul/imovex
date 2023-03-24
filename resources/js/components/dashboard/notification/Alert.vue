<template>
    <div v-if="$store.alert.body" :class="`alert bg-white border-${$store.alert.type} border border-4 border-end-0 border-top-0 border-bottom-0 alert-dismissible fade show small shadow-sm`" role="alert">
        <p class="m-0" v-html="$store.alert.body"></p>
        <button @click="$actions.clearAlert" type="button" class="btn-close"></button>
    </div>
</template>

<script>
    export default {
        props: {
            flash: Object
        },
        mounted() {
            if(this.flash) {
                this.$actions.setAlert(this.flash)
            }
        }
    }
</script>