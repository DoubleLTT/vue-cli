<template>
	<div id="myCarousel" class="carousel slide">
			<ol class="carousel-indicators">
				<!-- <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li> -->
				<li v-for="n in len" data-target="#myCarousel" :data-slide-to="n-1" :class="(n==0)?active:'' "></li>
			</ol>
			<div class="carousel-inner">
				<div :class="list.classes"  v-for="list in carousel_img">
					<div class="content" v-html="list.content">						
					</div>
					<img :src="list.url" :alt="list.alt">
				</div>
			</div>
			<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
</template>
<script>
	export default{

		data () {
			return {
				carousel_img:[
				{
          			classes:"item active",
					url:require("./slider_1_1.jpg"),
					alt:"First slide" ,
					content:"<h3>Open Your Eyes To Pictual1</h3><h1>The Hidden World</h1><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do tempor incididunt ut labore et dolore magna aliqua.</p>"
				},
				{
          			classes:"item",
					url:require("./slider_1_2.jpg"),
					alt:"Second slide",
					content:"<h3>Open Your Eyes To Pictual2</h3><h1>The Hidden World</h1><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do tempor incididunt ut labore et dolore magna aliqua.</p>"
				}
				],
				len:0,
			}
		},
    mounted (){
      $(document).ready(function(){
        // 停止轮播
        $("#myCarousel").carousel('pause');
      })
      this.len=this.carousel_img.length;
    },
		methods:{

		}
	}
</script>
<style scoped>
  .content{
  	text-align:center;
  	top:20%;
    overflow: hidden;
    position: absolute;
    /*top: 25%;*/
    /*left: 40%;*/
    animation:myText 2s;
   animation-timing-function:ease-out;
  }
  @keyframes myText
  {
    from{height:0px;}
    to  {height:193px;}
  }
  .carousel-inner{
    width: 100%;
    height: 100%;
  }
</style>
