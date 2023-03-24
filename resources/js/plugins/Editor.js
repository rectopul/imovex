import './summernote'

const Editor = {

    summernote(selector = '.summernote', options = {}) {

        return $(selector).summernote({
            lang: 'pt-BR',
            height: 'auto',
            minHeight: 300,
            callbacks: {
                onInit: function() {
                    $(".note-editable").on('click', function (e) {

                        $(this).parents('form').find('.is-invalid').removeClass('is-invalid')
                        $(this).parents('form').find('.border-danger').removeClass('border-danger')
                        $(this).parents('form').find('.bg-danger').removeClass('bg-danger')
                        $(this).parents('form').find('.invalid-feedback').remove()

                    });
                }
            }
        })

    }

}

export default Editor