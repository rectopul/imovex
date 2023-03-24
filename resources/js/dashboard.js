import 'startbootstrap-sb-admin/src/js/scripts'

import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue'
import { Ziggy } from './plugins/ziggy'

window._ = require('lodash')
window.bootstrap = require('bootstrap')

window.axios = require('axios')
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

window.Vue = require('vue').default;

Vue.use(ZiggyVue, Ziggy)

const store = Vue.observable({
    alert: {},
})

const actions = {

    setAlert(args = {}) {
        store.alert = {
            type: args.type,
            body: args.body
        }
    },

    clearAlert() {
        store.alert = {}
    },

    setDashboardInterval(begin, end) {
        store.dashboardInterval = {
            begin: begin,
            end: end
        }
    }
}

Vue.prototype.$store = store
Vue.prototype.$actions = actions

// const files = require.context('./components/dashboard/', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('login-form', require('./components/dashboard/auth/LoginForm.vue').default)

Vue.component('navbar', require('./components/dashboard/base/Navbar.vue').default)
Vue.component('sidebar', require('./components/dashboard/base/Sidebar.vue').default)
Vue.component('bottom', require('./components/dashboard/base/Bottom.vue').default)

Vue.component('data-table', require('./components/dashboard/table/DataTable.vue').default)
Vue.component('table-dropdown', require('./components/dashboard/table/Dropdown.vue').default)
Vue.component('table-dropdown-checkbox', require('./components/dashboard/table/DropdownCheckbox.vue').default)

Vue.component('interval-selector', require('./components/dashboard/dashboard/IntervalSelector.vue').default)
Vue.component('counter-widget', require('./components/dashboard/dashboard/CounterWidget.vue').default)

Vue.component('alert', require('./components/dashboard/notification/Alert.vue').default)
Vue.component('remove-modal', require('./components/dashboard/notification/RemoveModal.vue').default)

Vue.component('property-table', require('./components/dashboard/property/Table.vue').default)

Vue.component('post-form', require('./components/dashboard/post/Form.vue').default)
Vue.component('post-table', require('./components/dashboard/post/Table.vue').default)
Vue.component('post-table-toolbar', require('./components/dashboard/post/TableToolbar.vue').default)

Vue.component('contact-table', require('./components/dashboard/contact/Table.vue').default)
Vue.component('contact-table-toolbar', require('./components/dashboard/contact/TableToolbar.vue').default)

Vue.component('comment-table', require('./components/dashboard/comment/Table.vue').default)
Vue.component('comment-table-toolbar', require('./components/dashboard/comment/TableToolbar.vue').default)

Vue.component('category-form', require('./components/dashboard/category/Form.vue').default)
Vue.component('category-table', require('./components/dashboard/category/Table.vue').default)
Vue.component('category-table-toolbar', require('./components/dashboard/category/TableToolbar.vue').default)

Vue.component('faq-form', require('./components/dashboard/faq/Form.vue').default)
Vue.component('faq-table', require('./components/dashboard/faq/Table.vue').default)
Vue.component('faq-table-tools', require('./components/dashboard/faq/TableTools.vue').default)

Vue.component('home-form', require('./components/dashboard/configuration/HomeForm.vue').default)
Vue.component('social-form', require('./components/dashboard/configuration/SocialForm.vue').default)
Vue.component('about-form', require('./components/dashboard/configuration/AboutForm.vue').default)
Vue.component('contact-form', require('./components/dashboard/configuration/ContactForm.vue').default)
Vue.component('company-form', require('./components/dashboard/configuration/CompanyForm.vue').default)
Vue.component('logo-form', require('./components/dashboard/configuration/LogoForm.vue').default)

Vue.component('user-table', require('./components/dashboard/user/UserTable.vue').default)
Vue.component('user-form', require('./components/dashboard/user/UserForm.vue').default)

Vue.component('privacy-form', require('./components/dashboard/privacy/Form.vue').default)


const app = new Vue({
    el: '#app',
    methods: {
        formatDate(date) {
            
            let tempDay = date.getDate().toString()
            let tempMonth = (date.getMonth()+1).toString()

            let day = (tempDay.length == 1) ? '0'+tempDay : tempDay
            let month = (tempMonth.length == 1) ? '0'+tempMonth : tempMonth
            let year = date.getFullYear()

            return day+"/"+month+"/"+year
        },
        clearFormErrors() {

            $('.form-control').on('click', function() {
                $(this).removeClass('is-invalid')
                $(this).next('.invalid-feedback').remove()
            })
            
        }

    },
    mounted() {

        this.clearFormErrors()

    }
})