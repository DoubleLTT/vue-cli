<template>
	<div>
		<ul>
			<router-link to="/About">About</router-link>
			<router-link to="/About">page1</router-link>
			<router-link to="/About">page2</router-link>
		</ul>
		
		<router-view></router-view>
	</div>
</template>
<script>
export default {
	name : 'Home'
}
</script>