<template>

	<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
		<g id="Group_491" data-name="Group 491" transform="translate(-1435 -25)">
			<g id="Ellipse_6" data-name="Ellipse 6" transform="translate(1435 25)" fill="none" :stroke="color" stroke-width="1.6">
				<circle cx="15" cy="15" r="14.2" fill="none"/>
			</g>
			<path id="Path_323" data-name="Path 323" d="M18.364,18.643a5.465,5.465,0,0,0-8.01,0L10,19.016l-.353-.373a5.469,5.469,0,0,0-7.729-.284q-.147.137-.284.284a6.134,6.134,0,0,0,0,8.34l7.847,8.275a.715.715,0,0,0,1.01.027l.027-.027,7.844-8.275A6.133,6.133,0,0,0,18.364,18.643ZM17.33,26h0L10,33.727,2.673,26a4.687,4.687,0,0,1,0-6.372,4.04,4.04,0,0,1,5.709-.23q.119.11.23.23l.871.919a.736.736,0,0,0,1.038,0l.871-.919A4.04,4.04,0,0,1,17.1,19.4q.119.11.23.23A4.644,4.644,0,0,1,17.33,26Z" transform="translate(1440 15.104)" :fill="color"/>
			<path id="Path_361" data-name="Path 361" d="M1621-1585.3l-1.376-1.719-1.719-.793-1.982-.309-1.146.838-1.1.749-1.014,1.234-.353,1.807v2.027l1.058,1.851,7.634,7.536,2.15-2.247,2.247-2.292,2.556-2.115,1.675-2.732.441-2.027-.793-2.071-1.322-1.454-1.675-.793h-1.763l-1.366.793-1.014.881Z" transform="translate(-171 1621)" :fill="fill"/>
		</g>
	</svg>


</template>


<style scoped>

</style>

<script>
	export default {
		props: {
			color: {
				type: String,
				default: '#fff'
			},
			fill: {
				default: 'none'
			}
		},
		computed: {
			checkMarked() {
				alert('ok')
			}
		}
	}
</script>