<template>

	<div class="row">
		<div class="col-md-4">
			
		</div>
		<div class="col-md-4">
			<label class="d-block text-start">Inicio</label>
			<datepicker
				input-class="bg-white"
				:language="language"
				format="dd/MM/yyyy"
				:bootstrap-styling="true"
				v-model="firstDay"
				:disabled-dates="disabledDates.firstDay"
				@input="setDisabledDates"
			>
			</datepicker>
			
		</div>
		<div class="col-md-4">
			<label class="d-block text-start">Término</label>
			<datepicker
			input-class="bg-white"
				:language="language"
				format="dd/MM/yyyy"
				:bootstrap-styling="true"
				v-model="lastDay"
				:disabled-dates="disabledDates.lastDay"
				@input="setDisabledDates"
			></datepicker>
		</div>
	</div>

</template>

<script>
	import Datepicker from 'vuejs-datepicker/dist/vuejs-datepicker.esm.js'
	import { ptBR } from 'vuejs-datepicker/dist/locale'

	export default {
		
		components: { Datepicker },
		
		data() {
			return {
				language: ptBR,
				date: new Date(),
				firstDay: '',
				lastDay: '',
				disabledDates: {
					firstDay: {},
					lastDay: {}
				}
			}
		},

		methods: {
			setPeriod() {
				this.firstDay = new Date(this.date.getFullYear(), this.date.getMonth(), 1)
				this.lastDay = new Date(this.date.getFullYear(), this.date.getMonth() + 1, 0)
			},

			setDisabledDates() {

				this.disabledDates.firstDay = {
					from: this.lastDay
				}

				this.disabledDates.lastDay = {
					to: this.firstDay
				}
			}
		},

		beforeMount() {
			
		},

		mounted() {
			
			let vm = this

			vm.setPeriod()
			vm.setDisabledDates()

			vm.$actions.setDashboardInterval(vm.firstDay, vm.lastDay)
			
		},
	}
</script>

<style>
	/* .vdp-datepicker__calendar { right: 0; } */
</style>