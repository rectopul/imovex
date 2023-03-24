import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue'
import { Ziggy } from './plugins/ziggy'
import * as GmapVue from 'vue2-google-maps'
import Vue from 'vue'
import { Tooltip } from 'bootstrap/dist/js/bootstrap.esm.min.js'
import Swal from 'sweetalert2'
import VueObserveVisibility from 'vue-observe-visibility'
require('./bootstrap')

window.Vue = require('vue').default

Vue.use(ZiggyVue, Ziggy)
Vue.use(VueObserveVisibility)

Vue.use(GmapVue, {
    load: {
      key: '<INSIRA AQUI SUA CHAVE DE API DO GOOGLE MAPS>',
      libraries: 'places',
    },

    installComponents: true
  })

// Registra os componentes
// const files = require.context('./components/web/', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('navbar', require('./components/web/base/Navbar.vue').default)
Vue.component('bottom', require('./components/web/base/Bottom.vue').default)

Vue.component('home-hero', require('./components/web/home/Hero.vue').default)
Vue.component('home-vectors', require('./components/web/home/Vectors.vue').default)

Vue.component('property-card', require('./components/web/property/Card.vue').default)
Vue.component('property-card-list', require('./components/web/property/CardList.vue').default)
Vue.component('property-card-list-infinite', require('./components/web/property/CardListInfinite.vue').default)
Vue.component('property-card-list-skeleton', require('./components/web/property/CardListSkeleton.vue').default)
Vue.component('property-card-list-paginate', require('./components/web/property/CardListPaginate.vue').default)
Vue.component('property-city-autocomplete', require('./components/web/property/CityAutoComplete.vue').default)
Vue.component('property-details', require('./components/web/property/Details.vue').default)
Vue.component('property-details-card', require('./components/web/property/DetailsCard.vue').default)
Vue.component('property-details-template', require('./components/web/property/DetailsTemplate.vue').default)
Vue.component('property-filter-button', require('./components/web/property/FilterButton.vue').default)
Vue.component('property-filter-modal', require('./components/web/property/FilterModal.vue').default)
Vue.component('property-image-carousel', require('./components/web/property/ImageCarousel.vue').default)
Vue.component('property-tools', require('./components/web/property/Tools.vue').default)
Vue.component('property-new-search-form', require('./components/web/property/NewSearchForm.vue').default)
Vue.component('property-search-results', require('./components/web/property/SearchResults.vue').default)

Vue.component('post-card', require('./components/web/post/Card.vue').default)
Vue.component('post-card-row', require('./components/web/post/CardRow.vue').default)
Vue.component('post-card-row-skeleton', require('./components/web/post/CardRowSkeleton.vue').default)
Vue.component('post-card-row-container', require('./components/web/post/CardRowContainer.vue').default)
Vue.component('post-card-list-title', require('./components/web/post/CardListTitle.vue').default)
Vue.component('post-card-list', require('./components/web/post/CardList.vue').default)
Vue.component('post-comments', require('./components/web/post/Comments.vue').default)
Vue.component('post-details', require('./components/web/post/Details.vue').default)
Vue.component('post-search-results', require('./components/web/post/SearchResults.vue').default)

Vue.component('about-vectors', require('./components/web/about/Vectors.vue').default)
Vue.component('about-hero', require('./components/web/about/Hero.vue').default)
Vue.component('about-content', require('./components/web/about/Content.vue').default)

Vue.component('contact-form', require('./components/web/contact/Form.vue').default)
Vue.component('contact-header', require('./components/web/contact/Header.vue').default)
Vue.component('contact-message', require('./components/web/contact/Message.vue').default)
Vue.component('contact-template', require('./components/web/contact/Template.vue').default)

Vue.component('faq-breadcrumbs', require('./components/web/faq/Breadcrumbs.vue').default)
Vue.component('faq-description', require('./components/web/faq/Description.vue').default)
Vue.component('faq-header', require('./components/web/faq/Header.vue').default)
Vue.component('faq-highlight', require('./components/web/faq/Highlight.vue').default)
Vue.component('faq-pagination', require('./components/web/faq/Pagination.vue').default)
Vue.component('faq-template', require('./components/web/faq/Template.vue').default)
Vue.component('faq-search-results', require('./components/web/faq/SearchResults.vue').default)

Vue.component('blog-content', require('./components/web/blog/Content.vue').default)
Vue.component('blog-highlight', require('./components/web/blog/Highlight.vue').default)
Vue.component('blog-sidebar', require('./components/web/blog/Sidebar.vue').default)
Vue.component('blog-template', require('./components/web/blog/Template.vue').default)

Vue.component('bookmark-header', require('./components/web/bookmark/Header.vue').default)

//Icons
Vue.component('heart-icon', require('./components/icon/Heart.vue').default)
Vue.component('comment-icon', require('./components/icon/Comment.vue').default)
Vue.component('whatsapp-icon', require('./components/icon/Whatsapp.vue').default)
Vue.component('facebook-icon', require('./components/icon/Facebook.vue').default)
Vue.component('instagram-icon', require('./components/icon/Instagram.vue').default)
Vue.component('youtube-icon', require('./components/icon/Youtube.vue').default)
Vue.component('check-icon', require('./components/icon/Check.vue').default)
Vue.component('share-icon', require('./components/icon/Share.vue').default)
Vue.component('block-icon', require('./components/icon/Block.vue').default)
Vue.component('list-icon', require('./components/icon/List.vue').default)
Vue.component('speech-icon', require('./components/icon/Speech.vue').default)
Vue.component('bedroom-icon', require('./components/icon/Bedroom.vue').default)
Vue.component('parking-icon', require('./components/icon/Parking.vue').default)
Vue.component('area-icon', require('./components/icon/Area.vue').default)
Vue.component('bathroom-icon', require('./components/icon/Bathroom.vue').default)
Vue.component('building-icon', require('./components/icon/Building.vue').default)

Vue.component('skeleton-block', require('./components/web/skeleton/Block.vue').default)

Vue.component('search-form', require('./components/web/search/Form.vue').default)

// const icons = require.context('./components/icon/', true, /\.vue$/i)
// icons.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], icons(key).default))

const app = new Vue({
    el: '#app',
    mounted() {
      	Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      	.forEach(tooltipNode => new Tooltip(tooltipNode));

		if($('.note-video-clip').width() > $(window).width()) {
			$('.note-video-clip').css('width', '100%');
			$('.note-video-clip').css('padding-left', '1rem');
			$('.note-video-clip').css('padding-right', '1rem');
		}

		
    },
    methods: {
		addSkeletonAnimationClasses(selector) {
			$(selector).addClass('animate__animated animate__flash animate__infinite animate__slower')
		},

		removeSkeletonAnimationClasses(selector) {
			$(selector).removeClass('animate__animated animate__flash animate__infinite animate__slower').remove()
		},

    showToast(type, message) {
      const Toast = Swal.mixin({
        toast: true,
        position: 'bottom',
        showConfirmButton: false,
        timer: 5000,
        customClass: {
          popup: `bg-${type} p-0`,
          title: 'text-white '
        },
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      Toast.fire({
        title: message
      })
    }

	}
})