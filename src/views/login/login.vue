<template>
	<div>
		<p v-on:click="swt=!swt">登录/注册</p>
		<div class="login" v-if="swt">
			<p>登录界面</p>
			<p>name:<input type="text" name="user"></p>
			<p>password:<input type="text" name="password"></p>
			<button type="button" class="btn btn-primary" @click="login">登录</button>
		</div>
		<div class="register" v-else="!swt">
			<p>注册界面</p>
			<p>name:<input type="text" name="user" v-model="username"></p>
			<p>password:<input type="text" name="password" v-model="password"></p>
			<button type="button" class="btn btn-primary" @click="register">注册</button>
		</div>
    <p style="color: red;">{{ error_msg }}</p>
	</div>
</template>

<script>
	export default {
		name : 'Login',
		data () {
			return {
				swt:true,
        error_msg:'',
        url: 'http://localhost:8081/myWeb/',
        username:'',
        password:''
			}
		},
    methods :{
		  register (){
		    this.$http.post(this.url+'register.php',{name:this.username,password:this.password},{emulateJSON:true}).then( res => {
		      console.log(res);
		      if(res.ok){
		        alert("注册成功！");
		        this.$router.push({path:'/'})
          }else{
		        this.error_msg="注册失败"
          }
        })
      },
      login (){
        this.$http.post(this.url+'register.php',{name:this.username,password:this.password},{emulateJSON:true}).then( res => {
          console.log(res);
          if(res.ok){
            alert("登录成功！");
            this.$router.push({path:'/'})
          }else{
            this.error_msg="登录失败"
          }
        })
      }
    }
			  
	}
</script>
