<template>
	<div class="content">
		<NavBar></NavBar>
		<div class="page">
			<div class="" style="padding: 40px;">
    			<Tabs :animated="false" type="card">
			      <TabPane label="景点" icon="md-home"><Places></Places></TabPane>
			      <TabPane label="美食" icon="ios-ice-cream"><Foods></Foods></TabPane>
            <TabPane label="行程" icon="md-paw"><Routes></Routes></TabPane>
    			</Tabs>
  			</div>
		</div>
		<!--<div class="page">-->
				<!--<Carousel></Carousel>-->
		<!--</div>-->
	</div>
</template>

<script>
import NavBar from "./../navbar/navbar"
import Places from "./component/Places"
import Foods from "./component/Foods"
import Routes from "./component/Routes"

import Advice from "./component/Advice"
import Carousel from "./component/Carousel"

export default {
	name : 'Home',
	data () {
		return {
		}
	},
	components: {NavBar,Carousel,Places,Foods,Routes,Advice},
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
}
.page{
  width: 100%;
  height: 100%;
  overflow:hidden;
}
</style>
