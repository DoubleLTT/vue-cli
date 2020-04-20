<template>
    <div style="padding:40px 20px;">
      <Row>
        <i-col span="10">
          <div class="left2" style="padding-bottom: 20px">
            <h4 style="color: #2db7f5">回答专题</h4>
            <img src="../../../../static/advise.jpg" style="width :300px;height:auto">
            <div style="float: right;margin: 0 50px 10px 0;">
              <h2>绿荫山涧VS清凉大海，夏季去哪里？</h2>
              <p>夏日避暑，大家是愿意去海边，还是山区里面？</p>
              <p>遇龙河漂流哪段比较好？还是推荐走全程？</p>
              <p>打算七八月份去草原避暑，有什么好的推荐？</p>
              <p>国内避暑胜地有哪些呢？</p>
              <p>算七八月份去草原避暑，有什么好的推荐？</p>
            </div>
          </div>
        </i-col>
        <i-col span="14">
          <div class="left1" style="">
            <div style="width: 70%;float: left;margin-right: 40px;">
              <Input v-model="searchs" @on-search="getQuestions()" search enter-button="Search" size="large" placeholder="看看你的问题是否已经有人询问过~"/>
            </div>
            <Button type="warning" icon="md-add" size="large" @click="modal1 = true" style="margin-right: 10px">我要提问</Button>
            <Button type="info" icon="md-chatboxes" size="large" @click="getAllQuestions()">查看全部</Button>
          </div>
          <p class="error_msg">{{this.$store.state.error_msg}}</p>
          <List style="background-color: #fff;padding: 0 20px;margin: 0 0 0 60px;">
            <ListItem v-for="(item,index) in this.$store.state.article_json" :key="index">
              <ListItemMeta avatar="../../../../static/blog/comments1.jpg" :title="item.name" :description="item.title" />
              <span class="time">发表于{{item.time}}</span>
              <template slot="action">
                <li>
                  <span @click="setComment(item.id,item.title)"><a href="javascript:void(0)">回复</a></span>
                </li>
                <li>
                  <span @click="moreComment(item.id,item.title)"><a href="javascript:void(0)">全部评论</a></span>
                </li>
              </template>
            </ListItem>
          </List>
          <div style="text-align: center;margin-top: 10px;">
            <Page :total="this.$store.state.total" :page-size="6" :current="this.$store.state.current" @on-change="getQuestions" show-total></Page>
          </div>
        </i-col>
      </Row>
      <Modal
        v-model="modal1"
        @on-ok="answerOk(1)"
        okText="发布问题"
        title="我要提问"
        :styles="{top: '30%'}"
        class-name="vertical-center-modal">
        <div style="padding:20px 30px;">
          <span style="margin-right: 20px">问题描述</span>
          <Input v-model="question" maxlength="30" show-word-limit type="textarea" placeholder="Enter something..." style="width: 300px" />
        </div>
        </Modal>
      <Modal
        v-model="modal2"
        @on-ok="answerOk(2)"
        okText="提交"
        title="我要回复"
        :styles="{top: '30%'}">
        <div style="padding: 0 20px 20px;">
          <h3 style="margin-bottom: 20px;"><Icon type="md-help-circle" color="#34b1ea"/>{{title}}</h3>
          <span style="margin-right: 20px">问题回复</span>
          <Input v-model="answer" maxlength="200" show-word-limit type="textarea" placeholder="Enter your comments..." style="width: 300px" />
        </div>
      </Modal>
      <Modal
        v-model="modal3"
        title="全部回答"
        width="800px"
        height="600px"
        footer-hide
        :styles="{top: '30%'}">
        <div style="padding: 0 20px 20px;height:250px;overflow-y: auto">
          <h3><Icon type="md-help-circle" color="#34b1ea"/>{{title}}</h3>
          <p class="error_msg">{{this.comment_error_msg}}</p>
          <List style="">
            <ListItem v-for="(item,index) in comment_json" :key="index">
              <ListItemMeta avatar="../../../../static/blog/comments2.jpg" :title="item.name" :description="item.title" />
              <span class="time">发表于{{item.time}}</span>
              <template slot="action">
                <li>
                  <Icon type="ios-star-outline" /> 50
                </li>
                <li>
                  <Icon type="ios-thumbs-up-outline" /> 22
                </li>
              </template>
            </ListItem>
          </List>
        </div>
      </Modal>
    </div>
</template>

<script>
  import {getQuestion,submitQuestion,submitComment,getComment} from "../../../service/api";
  export default {
        name: "Advice",
        data (){
          return{
            modal1:false,
            modal2:false,
            modal3:false,
            question:'',
            answer:'',
            searchs:'',
            belongId:'',
            title:'',
            article_json:[],
            comment_json:[],
            comment_total:0,
            page:0,  //控制翻页按钮是否可点击
            total:0,
            current:1,
            error_msg:'',
            comment_error_msg:''
          }
        },
      methods:{
        answerOk(type){
          let isLogin = this.$store.state.isLogin;
          let user = sessionStorage.getItem("username");
          console.log(isLogin);
          if(isLogin){
            let str="";
            if(type===1){
              str = this.question;
              if(str===""){
                this.$Message.warning("请输入问题！");
                return
              }
              submitQuestion(user,str).then(response=>{
                let res=response.data;
                if(res.valid){
                  this.$Message.success(res.msg);
                  this.getQuestions(1);
                  this.question=""
                }else{
                  this.$Message.error(res.msg);
                }
              })
            }else{
              str = this.answer;
              if(str===""){
                this.$Message.warning("请输入回答！");
                return
              }
              submitComment(this.belongId,user,str).then(response=>{
                let res=response.data;
                if(res.valid){
                  this.$Message.success(res.msg);
                  this.getQuestions(1);
                  this.answer=""
                }else{
                  this.$Message.error(res.msg);
                }
              })
            }

          }else{
            this.$Message.warning("请先登录或注册！");
          }
        },
        getAllQuestions(){
          this.searchs = "";
          this.$store.commit("getQuestions",{page:1,search:this.searchs});
        },
        getQuestions(){
          const name=this.$route.query.id;
          if(name){
            this.$store.commit("getQuestions",{page:1,search:this.searchs,name:name});
          }else{
            this.$store.commit("getQuestions",{page:1,search:this.searchs});
          }
          // this.current=page;
          // this.error_msg="";
          // this.total=0;
          // this.article_json=[];
          // getQuestion(page,this.searchs).then(response=>{
          //   let res=response.data;
          //   if(res.valid){
          //     this.total=res.total;
          //     this.article_json=res.qs;
          //   }else{
          //     this.total=0;
          //     this.error_msg="暂时没有问题";
          //   }
          // })
        },
        setComment(id,title){
          this.modal2 = true;
          this.belongId=id;
          this.title=title
        },
        moreComment(id,title){
          this.modal3 = true;
          this.title=title;
          this.comment_error_msg="";
          this.comment_json=[];
          this.comment_total=0;
          getComment(id).then(response=>{
            let res=response.data;
            if(res.valid){
              this.comment_json=res.comments;
              this.title=title+'（共'+res.comments.length+'条回答）';
            }else{
              this.title=title+'（共0条回答）';
              this.comment_error_msg="暂时没有回答";
            }
          })
        },
      },
      mounted() {
          this.getQuestions()
      }
    }
</script>

<style scoped lang="less">
  .left1,
  .left2{
    margin-right: 20px;
    margin-bottom: 20px;
    padding:10px 20px;
    border: 1px solid #f3f3f3;
  >p{
    margin-top: 15px;
  span{
    margin-right: 5px;
  }
  }
  }
  .left1{
    height: 100%;
    margin-left:40px;
  }
  .left2{
    height: 100%;
    background-color: #fff;
    div p{
      margin-top: 10px;
      font-size: 16px;
    }
  }
  .vertical-center-modal{
    display: flex;
    align-items: center;
    justify-content: center;

    .ivu-modal{
      top: 0;
    }
  }
  .error_msg{
    text-align:center;
    /*padding-bottom: 15px;*/
  }
  .time{
    font-size: 12px;
    color: #999;
  }
  .ivu-list-item-meta-title{
    font-weight: bold!important;
  }
</style>
