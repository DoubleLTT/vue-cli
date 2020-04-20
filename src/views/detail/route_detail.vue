<template>
  <div>
    <!--<NavBar></NavBar>-->
    <div style="padding:20px;">
      <Breadcrumb separator=">" style="margin-bottom: 10px;">
        <BreadcrumbItem to="/Route"><span style="color: #2d8cf0;">行程</span></BreadcrumbItem>
        <BreadcrumbItem>{{name}}</BreadcrumbItem>
      </Breadcrumb>
<!--      <Menu mode="horizontal" theme="light" :active-name="name" @on-select="changeMenu">-->
<!--        <MenuItem name="行程简介">-->
<!--          <Icon type="ios-paper" />-->
<!--          行程简介-->
<!--        </MenuItem>-->
<!--        <MenuItem name="行程详情">-->
<!--          <Icon type="ios-people" />-->
<!--          行程详情-->
<!--        </MenuItem>-->
<!--      </Menu>-->
      <div v-for="(item,index) in details" :key="index" class="introduce">
        <h1>{{item.title}}</h1>
        <p>天数：<span>{{item.day}}</span>  观光地：<span>{{item.num}}</span>  全程：<span>{{item.distance}}</span></p>
        <p><span style="color: #999;">包含景点：</span>{{places_name}}</p>
        <p><span style="color: #999;">行程标签：</span>{{item.ps}}</p>
        <p>{{item.des}}</p>
      </div>
      <div class="details">
        <h2>行程详情</h2>
        <div v-for="n in days">
          <h3>第{{n}}天</h3>
          <Timeline style="margin-top: 20px">
            <TimelineItem v-for="(item,index) in places[n-1]" :key="index">
              <div style="float: right;width:160px;height:160px;overflow: hidden;margin-left: 80px;">
                <img :src=item.url title="查看景点" style="width: 100%;height: 100%;cursor: pointer" @click="goPlace(item.id)">
              </div>
              <h2>{{item.name}}</h2>
              <p>游玩指南：{{item.des}}</p>
              <p>游玩时间：{{item.visit_time}}</p>
              <p>开放时间：{{item.open_time}}</p>
              <p>门票价格：{{item.ticket}}</p>
            </TimelineItem>
          </Timeline>
        </div>
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
        places:[],
        days:0,
        places_name:"",
        name:'行程简介',//面包屑导航名
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
          let res=response.data,
              me=this;
          if(res.valid){
            me.details=res.routes;
            me.places=res.places;
            me.days=res.places.length;
            for (let i=0;i<res.places.length;i++){
              res.places[i].forEach(function (value) {
                me.places_name += value.name+" ";
              })
            }
            console.log(this.places_name)
          }else{
            alert(res.msg)
          }
        })
      },
      goPlace(id){
        this.$router.push({name:'PlaceDetail',path:'/PlaceDetail',query:{id:id} })
      },
      changeMenu(name){
        this.name=name;
        this.swt = name === "行程简介";
      }
    }
  }
</script>

<style lang="less" scoped>
  .details,
  .introduce{
    padding: 20px 100px 0 20px;
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
  .details h2{
    margin-bottom: 20px;
  }
  .details p{
    margin-bottom: 5px;
  }
</style>
