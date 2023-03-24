<template>
	<div class="dropdown bg-white">
	  <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
	    {{ selected.label }}
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
	    <li v-for="(item, index) in getItems" :key="index">
	    	<a @click.prevent="handleInput(item)" class="dropdown-item" href="#">
	    		{{ item.label }}
	    	</a>
	    </li>
	  </ul>
	</div>
</template>

<script>
	export default {
		props: {
			items: Array
		},
		data() {
			return {
				selected: this.items[0]
			}
		},
		methods: {
			handleInput(item) {
				this.selected = item
				this.$emit('input', this.selected.value)
			}
		},
		computed: {
			getItems() {
				let vm = this

				return _.filter(vm.items, function(item){ return item.label != vm.selected.label })
			}
		}
	}
</script>