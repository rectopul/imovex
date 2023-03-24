import SweetAlert from '@/plugins/SweetAlert'

const Form = {

    setFormErrors(form, errors) {
        
        for (const key in errors) {

            const error = errors[key]
            const input = $(form).find(`[name="${key}"]`)

            if (input.hasClass("summernote")) {
                
                const noteEditor = input.siblings(".note-editor")
                
                noteEditor.addClass('is-invalid')
                noteEditor.addClass('border-danger')
                noteEditor.find(".note-toolbar").addClass('bg-danger')
                noteEditor.find(".note-resizebar").addClass('bg-danger')
                noteEditor.after(`<div class="invalid-feedback">${error}</div>`)

            } else {

                input.addClass('is-invalid')
                input.after(`<div class="invalid-feedback">${error}</div>`)

            }
        }

    },

    removeFormErrors(form) {

        $(form).find('.is-invalid').removeClass('is-invalid')
        $(form).find('.border-danger').removeClass('border-danger')
        $(form).find('.bg-danger').removeClass('bg-danger')
        $(form).find('.invalid-feedback').remove()
    
    },

    setLoadingState(form) {

        $(form).find('.form-control').addClass('bg-light')

        const submitButton = $(form).find('[type="submit"]')
        const buttonText = submitButton.html()

        submitButton.html('<i class="la la-fw la-spinner la-spin"></i>')

    },

    post(form, options = {}) {

        Form.removeFormErrors(form)

        $(form).find('.form-control').addClass('bg-light')
        const submitButton = $(form).find('[type="submit"]')
        const buttonText = submitButton.html()

        submitButton.html('<i class="fa fa-fw fa-spinner fa-spin"></i>')

        axios.post(form.action, new FormData(form))
            .then(response => {

                console.log(response)

                if (response.data.redirect) {
                    
                    window.location.href = response.data.redirect
                    
                } else {

                    $(form).find('.form-control').removeClass('bg-light')
                    submitButton.html(buttonText)

                    if (response.data.toast) {

                        SweetAlert.toast(response.data.toast)

                    }

                }

            })
            .catch(error => {
                console.log(error.response.data)

                $(form).find('.form-control').removeClass('bg-light')
                submitButton.html(buttonText)

                if (error.response.status === 422) {
                    
                    const errors = error.response.data.errors;

                    Form.setFormErrors(form, errors);

                }
            });

    }

}

export default Form