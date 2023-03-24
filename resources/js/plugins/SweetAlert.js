import Swal from 'sweetalert2'

const SweetAlert = {

    toast(options = {}) {

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            customClass: {
                popup: `bg-${options.type} p-0 small`,
                title: 'text-white',
            },
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
          
        Toast.fire({
            title: options.message,
        })

    }

}

export default SweetAlert