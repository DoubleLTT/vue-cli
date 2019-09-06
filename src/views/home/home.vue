<template>
	<div class="content">
		 <NavBar></NavBar>
			<div class="page">
				<Carousel></Carousel>
			</div>
			<div class="page">
				<Places></Places>
			</div>
			<div class="page">page3</div>
			<div class="page">page4</div>		
	</div>
</template>

<script>
import NavBar from "./../navbar/navbar"
import Carousel from "./component/Carousel"
import Places from "./component/Places"

export default {
	name : 'Home',
	data () {
		return {
			url: 'http://localhost:8081/myWeb/'
		}
	},
	components: {NavBar,Carousel,Places},
	mounted (){

	},
	methods: {

	}
}
</script>

<style>
*{
	margin:0;
	padding:0;
}
.content{
	width:100%;
	height:400%;
}
.page{
  width: 100%;
  height: 100%;
  overflow:hidden;
}
.page img{
    width: 100%;
    height:auto;
}
</style>
