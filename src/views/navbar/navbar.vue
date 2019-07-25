<template>
	<div class="navbar">
		<ul class="top_navbar">
			<li>tab1</li>
			<li>tab2</li>
			<li>tab3</li>
			<li>tab4</li>
		</ul>
		<ul class="left_navbar">
			<li>tab1</li>
			<li>tab2</li>
			<li>tab3</li>
			<li>tab4</li>
			<li>tab5</li>
			<li>tab6</li>
			<li>tab7</li>
		</ul>
	</div>
</template>

<script>
	export default {
		name:"NavBar"
	}
</script>

<style scoped>
ul{
	list-style-type:none;
}

/*top navbar*/
.navbar{
	width:100%;
	height:100%;
}
.top_navbar{
	width:100%;
	height:50px;
	background-color:rgb(0,130,143); /*(139,164,194)*/
}
.top_navbar li{	
	float:right;
	padding-right:20px;
	line-height:50px;
}

/*left navbar*/
.left_navbar{
	position:absolute;
	width:200px;
	height:calc(100% - 50px);
	background-color:#fff;
}
.left_navbar li{
	padding-top:30px;
	padding-left:20px;
	color:rgb(112,112,112);
}
.left_navbar li:nth-child(1){
	padding-top:20px;
}
</style>