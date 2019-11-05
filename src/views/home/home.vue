<template>
	<div class="content">
		 <NavBar></NavBar>
			<!--<div class="page">-->
				<!--<Carousel></Carousel>-->
			<!--</div>-->
			<!--<div class="page">-->
				<!--<Places></Places>-->
			<!--</div>-->
      <!--<div class="page">-->
        <!--<Advice></Advice>-->
      <!--</div>-->
			<!--<div class="page">page4</div>		-->
	</div>
</template>

<script>
import NavBar from "./../navbar/navbar"
import Carousel from "./component/Carousel"
import Places from "./component/Places"
import Advice from "./component/Advice"

export default {
	name : 'Home',
	data () {
		return {
		}
	},
	components: {NavBar,Carousel,Places,Advice},
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
  margin-bottom: 50px;
}
.page img{
    width: 100%;
    height:auto;
}
</style>
