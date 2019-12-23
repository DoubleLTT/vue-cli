<template>
  <div>
    <NavBar></NavBar>
    <div style="padding:40px;">
      <p style="cursor: pointer;margin-bottom: 40px;" ><router-link to="/">首页 &gt;</router-link></p>
      <Menu mode="horizontal" theme="light" active-name="1" @on-select="changeMenu">
        <MenuItem name="1">
          <Icon type="ios-paper" />
          行程简介
        </MenuItem>
        <MenuItem name="2">
          <Icon type="ios-people" />
          行程详情
        </MenuItem>
      </Menu>
      <div v-if="swt" v-for="(item,index) in details" :key="index" class="introduce">
        <h1>{{item.title}}</h1>
        <p>天数：<span>{{item.day}}</span>  观光地：<span>{{item.num}}</span>  全程：<span>{{item.distance}}</span></p>
        <p><span style="color: #999;">行程标签：</span>{{item.ps}}</p>
        <p>{{item.des}}</p>
      </div>
      <div v-else class="details">
        <h2>行程详情</h2>
        <Timeline style="margin-top: 20px">
          <TimelineItem>
            <h2>何时可掇</h2>
            <p>游玩指南：唐代诗人杜甫在成都的故居，诗人在这里居住了4年。园内亭台林立，古木参天，标志性景观“茅屋故居”，是借鉴川西民居的特点复建的。</p>
            <p>游玩时间：建议2-3小时</p>
            <p>开放时间：5月1日-10月31日8:00-19:00；11月1日-次年4月30日8:00-18:00；闭馆前60分钟停止售票。</p>
          </TimelineItem>
          <TimelineItem>2</TimelineItem>
          <TimelineItem>3</TimelineItem>
        </Timeline>
      </div>
    </div>
  </div>
</template>

<script>
  import {getRouteDetail} from "../../service/api";
  import NavBar from '../navbar/navbar'
  export default {
    data (){
      return{
        details:[],
        msg:'',
        swt:true
      }
    },
    components:{NavBar},
    mounted() {
      this.RouteDetail();
    },
    computed:{

    },
    methods:{
      RouteDetail(){
        const routeId=this.$route.query.id;
        getRouteDetail(routeId).then(response=>{
          let res=response.data;
          if(res.valid){
            this.details=res.routes;
            console.log(this.details)
          }else{
            alert(res.msg)
          }
        })
      },
      changeMenu(name){
        console.log(name);
        this.swt = name === "1";
      }
    }
  }
</script>

<style lang="less" scoped>
  .details,
  .introduce{
    padding: 20px 10px;
    >p{
      margin-bottom: 10px;
    }
  }
  .introduce :nth-child(2){
    margin-top: 40px;
    span{
      color:red;
      margin-right: 20px;
    }
  }
</style>
