<template>
	<div class="dropdown bg-white">
	  	<button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
	    	{{ label }}
	  	</button>
	  	<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
	    	<li v-for="(item, index) in items" :key="index">
	    	
	    		<label class="dropdown-item">
	    			<input v-model="selectedItems" @change="handleInput" type="checkbox" class="form-input-check" :value="item.value"> {{ item.label }}
	    		</label>

	    	</li>
	  	</ul>
	</div>
</template>

<script>
	export default {
		props: {
			items: Array,
			label: String
		},
		data() {
			return {
				selectedItems: []
			}
		},
		methods: {
			handleInput() {
				this.$emit('input', this.selectedItems)
			}
		},
		mounted() {
			let vm = this
			
			vm.$root.$on('clear-dropdown', function(){
				vm.selectedItems = []
			})
		}
	}
</script>