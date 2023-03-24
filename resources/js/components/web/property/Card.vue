<template>
	
	<a :href="property.id ? route('web.product.show', property.id) : '#'" :class="[property.viewed ? 'bg-gray-1' : '', 'card property-card h-100 border border-gray-3']">
	
		<span 
			v-if="property.desconto" 
			class="property-card-discount position-absolute text-primary fw-bold m-2 px-2 py-1 bg-white fs-13 rounded end-0">
			-{{property.desconto}}%
		</span>

		<div class="property-card-cover">
			<img v-if="property.cover" :src="property.cover" @error="setAltImg" class="card-img-top" alt="..." referrerpolicy="no-referrer">
		</div>

		<div class="card-body pt-2 pb-4 px-3">

			<div class="row" v-if="!simple">
				<div class="col">
					<span class="property-card-id badge bg-white fs-11 fw-medium text-dark border border-gray-8 me-1 mb-1">{{ property.ir }}</span>
					<span class="property-card-type badge bg-white fs-11 fw-medium text-dark border border-gray-8 me-1 mb-1">{{ property.tipo }}</span>
					<span class="property-card-situation badge bg-white fs-11 fw-medium text-dark border border-gray-8 me-1 mb-1">{{ property.situacao }}</span>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<p class="property-card-description m-0 text-info fs-13 fw-medium">{{ property.descricao }}{{ property.funcao ? ' | '+property.funcao : '' }}</p>
				</div>
			</div>

			<div class="d-flex justify-content-between">
				<div class="property-card-data">
					<p class="property-card-location m-0 fs-13 fw-bold">{{ location }}</p>
					<p class="property-card-address m-0 fs-15 fw-light">{{ property.short_address }}</p>
					<p class="property-card-info m-0 fs-12 fw-light" :class="{'empty': !property.id}" v-html="info"></p>
				</div>
				<div v-if="!simple" class="d-flex flex-column property-card-icons">
					<div class="property-card-bookmark-icon">
						<i v-if="isLoadingBookmark" class="fa fa-spinner fa-spin fa-2x text-gray-6"></i>
						<heart-icon 
							v-if="property.id && !isLoadingBookmark"
							:fill="[property.bookmarked ? '#cd1875' : 'none']"
							color="#cd1875"
							@click.native.prevent="bookmark"  
						></heart-icon>
					</div>
					<div class="property-card-share-icon">
						<share-icon v-if="property.id"></share-icon>
					</div>
				</div>
			</div>

			<div v-if="simple" class="d-flex justify-content-between align-items-center">
				<p class="m-0 fs-18 fw-bold text-primary">{{ property.price }}</p>
				<div class="property-card-bookmark-icon">
					<i v-if="isLoadingBookmark" class="fa fa-spinner fa-spin fa-2x text-gray-6"></i>
					<heart-icon 
						v-if="property.id && !isLoadingBookmark"
						:fill="[property.bookmarked ? '#cd1875' : 'none']"
						color="#cd1875"
						@click.native.prevent="bookmark" 
						class="my-2" 
					></heart-icon>
				</div>
			</div>

			<div v-if="!simple" class="row">
				<div class="col">
					<p class="property-card-price-label m-0 fs-12 fw-light">{{ property.price ? 'A PARTIR DE' : null }}</p>
					<p class="property-card-price m-0 fs-18 fw-bold text-primary">{{ property.price }}</p>
					<div class="property-card-evaluation" :class="{'empty': !property.id}">
						<p v-if="property.has_evaluation" class="m-0 fs-12 fw-medium text-gray-5 mb-2">Avaliação: {{property.avaliacao}}</p>
					</div>
					
					
					<div class="property-card-squares my-2">
						
						<span v-if="property.data_leilao_praca_1 && !property.data_leilao_praca_2" 
							class="text-info border border-info rounded px-2 fs-12 fw-medium p-1"
							:class="{'border-0 text-danger fw-bold px-0': property.data_leilao_praca_1_passed}"
						>
							<span v-if="property.data_leilao_praca_1_passed"><i class="fa fa-fw fa-exclamation-circle"></i> Leilão Encerrado</span>
							<span v-else>1ª Praça - {{ property.valor_lance_inicial_praca_1 }}</span>
						</span>

						<span v-if="property.valor_lance_inicial_praca_2" 
							class="text-info border border-info rounded px-2 fs-12 fw-medium p-1"
							:class="{'border-0 text-danger fw-bold px-0': property.data_leilao_praca_2_passed}"
						>
							<span v-if="property.data_leilao_praca_2_passed"><i class="fa fa-fw fa-exclamation-circle"></i> Leilão Encerrado</span>
							<span v-else>2ª Praça - {{ property.valor_lance_inicial_praca_2 }}</span>
						</span>

					</div>

					<p class="property-card-square-dates fs-11 py-2">
						<span v-if="property.data_leilao_praca_1"><span class="fw-bold">1ª P:</span> <span :class="{'text-decoration-line-through':property.data_leilao_praca_1_passed}">{{ property.data_leilao_praca_1 }}</span></span>
						<span v-if="property.data_leilao_praca_2"><span class="fw-bold"> - 2ª P:</span> <span :class="{'text-decoration-line-through':property.data_leilao_praca_2_passed}">{{ property.data_leilao_praca_2 }}</span></span>
					</p>
				</div>
			</div>

		</div>

		<span v-if="property.viewed" class="position-absolute top-100 start-50 translate-middle bg-gray-3 text-gray-6 border-0 py-1 px-2 rounded fs-11 fw-bold">
			<check-icon/>
			VISTO
		</span>
		
	</a>

</template>

<script>

	export default {
		
		data() {
			return {
				isLoadingBookmark: false
			}
		},
		props: {
			property: Object,
			simple: Boolean
		},
		methods: {
			navigate() {
				location.href = this.route('web.product.show', this.property.id)
			},
			bookmark() {
				const vm = this

				if(!vm.isLoadingBookmark) {
					if(!vm.property.bookmarked) {

						vm.isLoadingBookmark = true

						axios
						.post(vm.route('web.bookmark.store'), {
							'property_id': vm.property.id
						})
						.then(function(response){
							vm.property.bookmarked = true
							vm.isLoadingBookmark = false

							vm.$root.showToast('success', 'O imovél foi adicionado aos favoritos')


						})
						.catch(function(error){
							console.log(error.response.data)
						})
					} else {

						vm.isLoadingBookmark = true

						axios
						.delete(vm.route('web.bookmark.destroy', vm.property.id))
						.then(function(response){
							console.log(response)
							vm.property.bookmarked = false
							vm.isLoadingBookmark = false

							vm.$root.showToast('danger', 'O imovél foi removido dos favoritos')

							vm.$root.$emit('bookmark-removed', vm.property.id)
						})
						.catch(function(error){
							console.log(error.response.data)
						})
					}
				}

			},
			setAltImg(event) { 
    			event.target.src = this.property.default_cover 
			} 
		},

		computed: {
			location() {

				let district = this.property.bairro
				let city = this.property.cidade

				if(district) district = district.trim()
				if(city) city = city.trim()

				if(district && city) return `${district}, ${city}`
				if(district && !city) return district
				if(!district && city) return city
			},

			info() {
				let info = []
				let area = this.property.area_total
				let bedrooms = this.property.dormitorios
				let parking = this.property.garagem

				if(area) info.push(`<span class="fw-bold">${area}m²</span>`)
				
				if(bedrooms) {
					if(bedrooms > 1) {
						info.push(`${bedrooms} quartos`)
					} else {
						info.push(`${bedrooms} quarto`)
					}
				}

				if(parking) {
					if(parking > 1) {
						info.push(`${parking} vagas`)
					} else {
						info.push(`${parking} vaga`)
					}
				}
				
				return info.join(' - ')
				
			}
		}
	}
</script>

<style scoped>
	
	a {
		text-decoration: none;
		color: inherit;
	}

	.property-card-data {
		margin-right: 2.188vw;
	}

	.property-card {
		border-bottom-left-radius: 0.75rem;
		border-bottom-right-radius: 0.75rem;
		cursor: pointer;
	}

	.property-card-price-label {
		margin-top: 0.521vw;
	}

	.property-card-share-icon {
		margin-top: 0.625vw;
	}

	.card-img-top {
		height: 11rem;
		object-fit: cover;
	}

	li {
		padding-left: 0.938rem;
		padding-right: 0.938rem;
	}

	p { margin: 0; }

	@media (min-width: 992px) and (max-width: 1199.98px) { 

		
	}

	.badge {
		font-size: 0.5rem;
	}
</style>