<template>
	<div>
		<p v-on:click="swt=!swt">登录/注册</p>
		<div class="login" v-if="swt">
			<p>登录界面</p>
			<p>name:<input type="text" name="user"></p>
			<p>password:<input type="text" name="password"></p>
			<router-link to="/Home"><button>登录</button></router-link>
		</div>
		<div class="register" v-else="!swt">
			<p>注册界面</p>
			<p>name:<input type="text" name="user"></p>
			<p>password:<input type="text" name="password"></p>
			<router-link to="/Home"><button>注册</button></router-link>
		</div>
	</div>
</template>

<script>
	export default {
		name : 'Login',
		data () {
			return {
				swt:true
			}
		}
	}
</script>