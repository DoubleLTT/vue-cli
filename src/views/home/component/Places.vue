<template>
	<div>
		    <div class="title">
				<h1>Our Most Popular Packges</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br>labore et dolore magna aliqua. Ut enim ad minim veniam</p>
			</div>
			<ul class="row">
				<li class="col-md-4"  v-for="(item,index) in palce_json">
					<div class="thumbnail">
						<div class="imgBox"><img v-bind:src="item.url" alt="缩略图"></div>
						<div class="caption">
							<h3>{{item.name}} – All Stunning Places</h3>
							<p>4 Days, 5 Nights Start From <span class="price">{{item.price}}</span></p>
							<p>
								<button class="btn btn-success" @click="choose(index)">Book Now</button>
								<span class="glyphicon glyphicon-star"></span>
								<span class="glyphicon glyphicon-star"></span>
								<span class="glyphicon glyphicon-star"></span>
								<span class="glyphicon glyphicon-star"></span>
							</p>
						</div>
					</div>
				</li>
			</ul>
	</div>
</template>
<script>
	export default{
		data (){
			return{

			}
		}
	}
</script>