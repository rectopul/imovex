<template>
    <div class="py-5 text-center">
        <p class="lead">Nenhum imóvel encontrado</p>
        <p>Tente uma nova busca</p>
        <form @submit="isLoading = true">
            <div class="row">
                <div class="col-lg-5 mx-auto">
                    <div class="form-group mb-4">
                        <input type="text" name="busca" class="form-control form-control-lg" required :class="{'bg-light': isLoading}">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <button class="btn btn-primary">
                    <i v-if="isLoading" class="fa fa-fw fa-spinner fa-spin"></i>
                    Buscar Imóveis
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {

            return {
                isLoading: false
            }

        }
    }
</script>

<style scoped>
    .form-control {
		font-size: 0.938rem;
		font-weight: medium;
		border-radius: 0.313rem;
		line-height: 1.563rem;
	}
</style>