<template>
	<div>
    <div>
      <Menu mode="horizontal" theme="light" @on-select="chooseItem" :active-name="active_name">
        <span style="margin-left: 25px">欢迎您访问成都</span><span class="item">Chengdu</span>
        <MenuItem name="login" v-if="!isLogin" style="margin-right: 32px;">
          <Icon type="md-person" />
          <span>登录<Divider type="vertical" />注册</span>
        </MenuItem>
        <template v-else>
          <MenuItem name="logout">
            <Icon type="md-log-out"/>
            退出
          </MenuItem>
          <MenuItem name="user">
            <Dropdown @on-click="showQs">
              <span><Icon type="ios-contact" />
            用户：{{ this.username }}</span>
              <DropdownMenu slot="list">
                <DropdownItem name="0">修改密码</DropdownItem>
                <DropdownItem name="1">我的提问</DropdownItem>
              </DropdownMenu>
            </Dropdown>
          </MenuItem>
        </template>
        <MenuItem name="advise" to="/Advice">
          <span>问答</span>
        </MenuItem>
        <MenuItem name="route" to="/Route">
          <span>行程</span>
        </MenuItem>
        <MenuItem name="food" to="/Food">
          <span>美食</span>
        </MenuItem>
        <MenuItem name="place" to="/">
          <span>景点</span>
        </MenuItem>
      </Menu>
    </div>
    <Modal
      v-model="model"
      :footer-hide="true"
      :mask-closable="false"
      class-name="vertical-center-modal">
      <Login ref="log_reg" @closeModal="successLogin"></Login>
      <p slot="close" style="color:#777">关闭</p>
    </Modal>
    <Modal
      v-model="model1"
      title="修改密码"
      @on-ok="editPwd('formLogin')"
      :styles="{top: '30%'}">
      <div style="padding: 20px;">
        <Form ref="formLogin" :model="formLogin" :rules="ruleLogin">
          <FormItem prop="password">
            <Input type="password" v-model="formLogin.password" placeholder="新密码">
              <Icon type="ios-lock-outline" slot="prepend"></Icon>
            </Input>
          </FormItem>
          <FormItem prop="repassword">
            <Input type="password" v-model="formLogin.repassword" placeholder="确认密码">
              <Icon type="ios-lock-outline" slot="prepend"></Icon>
            </Input>
          </FormItem>
        </Form>
      </div>
    </Modal>
	</div>
</template>

<script>
  import Login from "../login/login"
  import {editPwd} from "../../service/api";
	export default {
		name:"NavBar",
    components:{Login},
    data(){
		  return{
		    isLogin: false,
        model:false,
        model1:false,
        active_name:'place',
        username:'',
        formLogin: {
          password: '',
          repassword: '',
        },
        ruleLogin: {
          password: [
            {  required: true, message: '请输入新密码', trigger: 'blur' }
          ],
          repassword: [
            {  required: true, message: '请确认新密码', trigger: 'blur' }
          ],
        },
      }
    },
    mounted(){
		  this.isLogin=sessionStorage.getItem("isLogin") || false;
      if(this.isLogin){
        this.active_name='user';
        this.username=sessionStorage.getItem("username")
      }
    },
    methods:{
      chooseItem(name){
        switch (name) {
          case 'login':
            this.model=true;
            this.$refs.log_reg.initial();
            break;
          case 'logout':
            this.isLogin=false;
            if(this.username==="admin"){
              this.$router.push('/')
            }
            sessionStorage.clear();
            break;
          case 'user':
            break;
        }
      },
      successLogin(){
        this.model=false;
        this.isLogin=true;
        this.username=sessionStorage.getItem('username') || '';
        this.active_name='user'
      },
      showQs(name){
        if(name ==='0'){
          this.formLogin.user = this.username;
          this.model1=true
        }else{
          this.$router.push({name:'Advice',path:'/Advice',query:{id:this.username}});
          this.$store.commit("getQuestions",{page:1,search:'',name:this.username});
        }
      },
      editPwd(name){
        this.$refs[name].validate((valid) => {
          if (valid) {
            if(this.formLogin.password === this.formLogin.repassword){
              editPwd(this.username,this.formLogin.password).then( response =>{
                let res=response.data;
                if(res.valid){
                  this.$Message.success(res.msg);
                  this.formLogin.password="";
                  this.formLogin.repassword="";
                }else {
                  this.$Message.error(res.msg);
                }
              })
            }else{
              this.$Message.error("两次密码不一致！");
            }
          }else{
            this.$Message.info('请输入新密码和原始密码');
          }
        })
      }
    }
	}
</script>

<style scoped lang="less">
  .item{
    margin-left: 15px;
    color: #ccc;
    font-size: 20px;
  }
  .ivu-menu-horizontal {
    height: 50px;
    line-height: 50px;
    .ivu-menu-item-active,
    .ivu-menu-item:hover{
      border-bottom:none!important;
    }
  }

  .ivu-menu-item{
    float:right;
    .ivu-menu-item>i{
      margin-right: 0;
    }
  }
  .vertical-center-modal{
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
  .ivu-modal{
    top: 0;
    bottom:0;
  }
  }
</style>
