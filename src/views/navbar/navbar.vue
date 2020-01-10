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
            <Icon type="ios-people" />
            退出
          </MenuItem>
          <MenuItem name="user">
            <Icon type="ios-people" />
            用户：{{ this.username }}
          </MenuItem>
        </template>
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
	</div>
</template>

<script>
  import Login from "../login/login"
	export default {
		name:"NavBar",
    components:{Login},
    data(){
		  return{
		    isLogin: false,
        model:false,
        active_name:'place',
        username:''
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
