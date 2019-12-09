<template>
	<div class="login">
    <Menu mode="horizontal" theme="light" :active-name="active_name" @on-select="chooseItem">
      <MenuItem name="login">
        <Icon type="ios-paper" />
        登录
      </MenuItem>
      <MenuItem name="register">
        <Icon type="ios-people" />
        注册
      </MenuItem>
    </Menu>
    <div v-if="swt" class="form-style">
      <Form ref="formLogin" :model="formLogin" :rules="ruleLogin">
        <!--<FormItem prop="user">-->
          <!--<Input type="text" v-model="formLogin.user" placeholder="用户名">-->
            <!--<Icon type="ios-person-outline" slot="prepend"></Icon>-->
          <!--</Input>-->
        <!--</FormItem>-->
        <FormItem prop="password">
          <Input type="password" v-model="formLogin.password" placeholder="密码">
            <Icon type="ios-lock-outline" slot="prepend"></Icon>
          </Input>
        </FormItem>
        <FormItem>
          <Button type="primary" @click="userLogin('formLogin')">登录</Button>
        </FormItem>
      </Form>
    </div>
    <div v-if="!swt" class="form-style">
      <Form>
        <FormItem label="邮箱" prop="mail">
          <Input placeholder="Enter your e-mail"></Input>
        </FormItem>
        <FormItem label="用户名" prop="name">
          <Input placeholder="Enter your name"></Input>
        </FormItem>
        <FormItem label="密码" prop="pwd">
          <Input placeholder="Enter your password"></Input>
        </FormItem>
        <FormItem>
          <Button type="primary" @click="userRegister('formRegister')">注册</Button>
        </FormItem>
      </Form>
    </div>
	</div>
</template>

<script>
import {register,login} from "../../service/api";

export default {
		name : 'Login',
		data () {
			return {
        formLogin: {
          user: '',
          password: '',
        },
        ruleLogin: {
          user: [
            { required: true, message: '请输入用户名', trigger: 'blur' }
          ],
          password: [
            {  required: true, message: '请输入密码', trigger: 'blur' }
          ],
        },
        formRegister: {
          name: '',
          pwd: '',
          mail: '',
        },
        ruleRegister: {

        },
				swt:true,
        active_name:'login',
			}
		},
    methods :{
		  initial(){
		    this.active_name="login";
		    this.swt=true;
      },
      chooseItem(name){
        switch (name) {
          case 'login':
            this.active_name="login";
            this.swt=true;
            break;
          case 'register':
            this.active_name="register";
            this.swt=false;
            break;
        }
      },
      userRegister (name){
        register(this.username,this.password).then(response=>{
          let res=response.data;
          if(res.valid){
            alert("注册成功！");
            this.$router.push({path:'/'})
          }else{

          }
        })
      },
      userLogin (name){
        this.$refs[name].validate((valid) => {
          if (valid) {
            login(this.formLogin.user,this.formLogin.password).then( response =>{
              let res=response.data;
              if(res.valid){
                this.$Message.success(res.msg);
                this.$store.commit("loginState",this.formLogin.user);
                this.$emit("closeModal");
                if(this.formLogin.user==="admin"){
                  this.$router.push({path:'/Manager'})
                }
              }else {
                this.$Message.error(res.msg);
              }
            })
          } else {
            this.$Message.error('请输入用户名和密码');
          }
        })
      }
    }
			  
	}
</script>
<style scoped lang="less">
  .login{
    margin-top: 10px;
    text-align: center;
  }
  .login .ivu-menu-horizontal .ivu-menu-item{
    width:50%;
  }
  .form-style{
    padding:50px 50px 10px 50px;
  .ivu-btn-primary{
    width:100%;
  }
  }
</style>
