<template>
	<div class="content">
		<!-- <NavBar></NavBar> -->
		<div class="box">
			<div class="page" id="page1">
				<Carousel></Carousel>
				<!-- <img src="../../assets/slider_1_2.jpg"> -->
			</div>
			<div class="page">page2</div>
			<div class="page">page3</div>
			<div class="page">page4</div>
		</div>			
	</div>
</template>

<script>
import NavBar from "@/views/navbar/navbar"
import Carousel from "./component/Carousel"

export default {
	name : 'Home',
	components: {NavBar,Carousel},
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
