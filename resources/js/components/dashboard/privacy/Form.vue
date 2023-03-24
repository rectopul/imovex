<template>
    <form @submit.prevent="save" :action="route('dashboard.privacy.store')" method="POST">

        <div class="form-group">
            <textarea name="privacy_term" cols="30" rows="10" class="form-control summernote"></textarea>
        </div>

        <div class="form-group text-end">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>


    </form>
</template>

<script>

    import Editor from '@/plugins/Editor'
    import Form from '@/services/Form'

    export default {

        props: {
            privacy: String
        },

        data() {
            return {
                editor: null
            }
        },

        methods: {
        
            save() {
                Form.post(this.$el)
            }
        
        },
        mounted() {
            this.editor = Editor.summernote()

            this.editor.summernote('code', this.privacy)

        }
    }
</script>