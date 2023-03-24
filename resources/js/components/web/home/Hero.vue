<template>
	<header>
		
		<div class="container-xxl text-center">
			
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 mx-auto">
					<h1>{{ title }}</h1>
					<h2 class="fw-light">{{ subTitle }}</h2>
				</div>
			</div>
			
			<form @submit.prevent="searchProperties">
				
				<div class="row">
					<div class="col-md-8 col-sm-10 mx-auto">
						<input 
							id="search-input"
							v-model="search"
							type="text" 
							class="form-control" 
							placeholder="Busque o imóvel, cidade ou bairro que deseja"
							required
						>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-10 mx-auto d-grid">
						<button class="btn btn-primary">
							Explorar!
						</button>
					</div>
				</div>

			</form>

			<div class="row">
				<div class="col">
					<a class="link" :href="route('web.contact.create')">
						Quer anunciar o seu imóvel aqui?
					</a>
				</div>
			</div>

		</div>
		

	</header>
</template>

<script>

	import { Dropdown } from 'bootstrap'

	export default {
		
		props: {
			title: String,
			subTitle: String,
			url: String
		},

		data() {
			return {
				search: ''
			}
		},

		methods: {
			searchProperties() {
				
				let url = this.url

				if(this.search) {
					url += `?busca=${this.search}`	
				}

				
				location.href = url
				
			}
		},

		mounted() {
			
		}
	}
</script>

<style scoped>
	
	header {
		min-height: 32.448vw;
		padding-top: 9.063rem;
		padding-bottom: 6.5rem;
		/* min-height: 100vh;
		padding-top: 9.063rem;
		padding-bottom:  6.5rem; */
	}

	h1 {
		font-weight: bold;
		font-size: 25px;
	}

	.form-control {
		font-size: 0.938rem;
		font-weight: medium;
		border-radius: 0.313rem;
		height: 4.75rem;
		margin-top:  4.125rem;
		margin-bottom:  2.75rem;
		line-height: 1.563rem;
	}

	.btn-primary {
		font-size: 1rem;
		font-weight: bold;
		height: 4rem;
		border-radius: 0.313rem;
	}

	.btn-primary:hover {
		color: #fff;
	}

	.link {
		display:  block;
		margin-top: 2.75rem;
	}
</style>