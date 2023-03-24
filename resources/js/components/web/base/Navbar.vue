<template>
	<nav :class="[(scrollPosition > 80) ? 'bg-white navbar-light scrolled' : 'bg-info navbar-dark', 'navbar navbar-expand-lg sticky-top']">
	    <div class="container-xxl">
	        
	        <a class="navbar-brand" :href="route('web.home.index')">
	        	<img v-if="logo" :src="logo" alt="Logo Imovel Explorer">
	        </a>

	        <button @click="close" class="navbar-toggler" type="button">
	            <span class="navbar-toggler-icon"></span>
	        </button>
	        <div class="collapse flex-column navbar-collapse" id="navbar-content">

	            <ul class="navbar-nav ms-auto justify-content-center align-items-center mb-2 mb-lg-0">
	                
					<li class="nav-item" id="search-form">
						<form :action="route('web.search.index')">
							<div class="input-group">
								<input type="text" name="q" class="form-control border-end-0 fs-15 border-gray-3" placeholder="Busque aqui" required>
								<button class="input-group-text bg-white border-gray-3 border-start-0">
									<i class="fa fa-fw fa-search text-primary"></i>
								</button>
							</div>
						</form>
	                </li>

					<li class="nav-item main-nav">
	                    <a class="nav-link text-nowrap" :href="route('web.monthly_properties.index')">Imóveis do Mês</a>
	                </li>
	                <li class="nav-item main-nav">
	                    <a class="nav-link" :href="route('web.blog.index')">Conhecimento</a>
	                </li>
	                <li class="nav-item main-nav">
	                    <a class="nav-link" :href="route('web.faq.index')">Imovelpedia</a>
	                </li>
	                <li class="nav-item main-nav">
	                    <a class="nav-link" :href="route('web.contact.create')">Vender</a>
	                </li>
	                <li class="nav-item main-nav">
	                    <a class="nav-link" :href="route('web.catalog.index')">Comprar</a>
	                </li>
	                <li class="nav-item main-nav">
	                    <a class="nav-link text-nowrap" :href="route('web.about.index')">Sobre Nós</a>
	                </li>

	                <li id="nav-item-icons" class="nav-item d-flex flex-row me-0">
	                    <a class="nav-link text-nowrap" :href="route('web.bookmark.index')">
	                    	<heart-icon :color="iconsColor"></heart-icon>
	                    </a>
						<a class="nav-link text-nowrap" :href="route('web.contact.create')">
	                    	<comment-icon :color="iconsColor"></comment-icon>
	                    </a>
	                </li>

	            </ul>

				<ul id="search-form-lg" class="navbar-nav flex-row ms-auto d-none">
					<li class="nav-item">
						<form :action="route('web.search.index')">
							<div class="input-group input-group-sm">
								<input name="q" type="text" class="form-control border-end-0 fs-15 border-gray-3" placeholder="Busque aqui" required>
								<button class="input-group-text bg-white border-gray-3 border-start-0">
									<i class="fa fa-fw fa-search text-primary"></i>
								</button>
							</div>
						</form>
	                </li>
            	</ul>
				
				
	        </div>

	    </div>

	</nav>
</template>

<script>

	import { Collapse } from 'bootstrap'
	
	export default {
		
		props: {
			primaryLogo: String,
			secondaryLogo: String
		},
		data() {
			return {
				logo: '',
				scrollPosition: null,
				iconsColor: '#fff',
				showSearchInput: false,
				search: ''
			}
		},
		methods: {
			updateScroll() {
		       let navbar = document.getElementsByTagName('nav')[0]

		       this.scrollPosition = window.scrollY

		       if(this.scrollPosition > navbar.offsetHeight) {
		       		this.logo = this.secondaryLogo
		       		this.iconsColor = '#4A4A4A'
					this.showSearchInput = true
		       } else {
		       		this.logo = this.primaryLogo
		       		this.iconsColor = '#fff'
					this.showSearchInput = false
		       }
		    },
			changeBackground() {
				this.scrollPosition = window.scrollY
			},
			close() {

				const collapse = new bootstrap.Collapse('#navbar-content')

				collapse.toggle()

			}

		},
		mounted() {
			this.logo = this.primaryLogo
			window.addEventListener('scroll', this.updateScroll);
		}
	}
</script>

<style scoped>

	.navbar {
		min-height: 4.167vw;
		padding-top: 0.521vw !important;
		padding-bottom: 0.521vw !important;
	}

	.form-control {
		height: 3.063rem;
	}

	.navbar-brand > img {
		height: 3.688rem;
	}

	.navbar.scrolled img {
		width: 8.688rem;
		height: 3.438rem;
	}

	.navbar.scrolled {
	  transition: background-color 200ms linear;
	}

	.nav-item {
		margin-right: 0;
	}

	.nav-link {
		text-transform: uppercase;
		font-weight: bold;
		font-size:  15px;
		color: #fff !important;
	}

	.navbar.scrolled .nav-link {
		color: var(--bs-dark) !important;
		font-weight: bold;
	}

	#nav-item-icons {
		margin-left: 4.531vw;
	}

	.main-nav .nav-link {
		padding-left: 0.5385vw;
		padding-right: 0.5385vw;
	}

	@media (max-width: 991.98px) {
		.navbar-collapse { background-color: var(--bs-info); }

		#nav-item-icons { 
			padding-left: 0.5rem;
			padding-right: 0.5rem;
			margin-left: 0;
			margin-bottom: 8px;
		}

		#nav-item-icons a:nth-child(1) { margin-right: 0.25rem; }

		#nav-item-icons a:nth-child(2) { margin-left: 0.25rem; }

		#search-form { 
			display: block; 
			order: 13 !important; 
		}

		.scrolled .navbar-collapse { background: #fff; }
	}

	@media (min-width: 992px) { 
		#search-form { display: none; }
	}

	@media (min-width: 992px) and (max-width: 1199.98px) { 
		.nav-link { font-size: 0.8rem; }

		.scrolled { height: auto; }

		.scrolled #search-form-lg { display: block !important; }
	}

	@media (min-width: 1200px) {
		.scrolled #search-form { display: block; }
	}

</style>