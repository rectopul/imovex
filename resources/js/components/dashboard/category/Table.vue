<template>

    <!-- <div class="card">
        <div class="card-body">
            <category-table-controls/>
            <data-table id="category-table" :columns="columns" :url="url"/>

            <remove-modal id="remove-modal">
                <p class="m-0">Deseja realmente remover a Categoria?</p>
                <small class="text-muted">* Todos os posts relacionados serão removidos</small>
            </remove-modal>

        </div>
    </div> -->

    <data-table id="category-table" :columns="columns" :url="url"/>

</template>

<script>
    export default {
        data() {
            return {
                url: this.route('dashboard.blog.category.index'),
                columns: [
                    { data: 'category'}
                ]
            }
        }
    }
</script>