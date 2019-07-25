<template>
	<div class="container">
		<NavBar></NavBar>

		<div class="content">
			<router-view></router-view>
		</div>		
	</div>
</template>

<script>
import NavBar from "@/views/navbar/navbar"

export default {
	name : 'Home',
	components: {NavBar},
}
</script>

<style>
*{
	margin:0;
	padding:0;
}
.container{
	width:100%;
	height:100%;
}
.content{
	position:absolute;
	left:200px;
	top:50px;
	width:calc(100% - 200px);
	height:calc(100% - 50px);
	background-color:rgb(245,245,245);
}
</style>