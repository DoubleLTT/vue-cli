<template>
	<div>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
		            <span class="sr-only">切换导航</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		        </button>
		        <div class="collapse navbar-collapse"  id="navbar-collapse">
					<ul class="nav navbar-nav  navbar-right">
						<li><a href='#'>tab1</a></li>
						<li><a href='#'>tab2</a></li>
						<li><router-link to="/Login">登录|注册</router-link></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
</template>

<script>
	export default {
		name:"NavBar"
	}
</script>

<style scoped>
	.navbar{
		border:none;
	}
</style>
