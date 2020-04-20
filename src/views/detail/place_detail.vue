<template>
  <div style="padding: 20px;">
    <Breadcrumb separator=">" style="padding: 0 0 0 10px;">
      <BreadcrumbItem to="/"><span style="color: #2d8cf0;">景点</span></BreadcrumbItem>
      <BreadcrumbItem>{{name}}详情</BreadcrumbItem>
    </Breadcrumb>
    <Row v-for="(item,index) in details" :key="index" style="padding-top: 10px;" type="flex" justify="space-around">
      <i-col span="8"><img :src="item.url" style="width:100%;height:auto"></i-col>
      <i-col span="10">
        <h1>{{item.name}}</h1>
        <p style="margin-top: 10px"><span style="color:red">{{item.star}}</span>级景区</p>
        <p style="margin-top: 30px"><span style="font-weight: bold;margin-right: 15px;">地址</span>{{item.address}}</p>
        <p style="margin-top: 10px"><span style="font-weight: bold;margin-right: 15px;">开放时间</span>{{item.open_time}}</p>
      </i-col>
      <i-col span="4">
        <span :class="{'heart':true,'heart1':!isActive,'heart2':isActive}" @click="Wanna" ref="wanna"><Icon type="md-heart" size="21" color="white"/></span>
        <span style="font-size: 15px;">想去</span>
      </i-col>
    </Row>
    <div>
      <h2>推荐行程</h2>
    </div>
  </div>
</template>

<script>
  import {getPlaceDetail} from "../../service/api";
  import NavBar from '../navbar/navbar'
    export default {
        data (){
          return{
            details:[],
            name:'',
            num:0, //评论数量
            number:0,
            msg:'',
            isActive:false
          }
        },
      components:{NavBar},
      mounted() {
        this.PlaceDetail();
        // this.getNowDate();
      },
      computed:{

      },
      methods:{
          PlaceDetail(){
            const placeId=this.$route.query.id;
            getPlaceDetail(placeId).then(response=>{
              let res=response.data;
              if(res.valid){
                this.details=res.pics;
                console.log(this.details)
                this.name=this.details[0].name;
              }else{
                //alert(res.msg);
                this.$Message.error({
                  content: res.msg,
                  duration: 3,
                });
              }
            })
          },
          Wanna(){
            if(!this.$store.state.isLogin){
              this.isActive=true;
              this.$Message.success({
                content: '收藏成功',
                duration: 3,
                closable: true
              });
            }
          }
      }
    }
</script>

<style scoped>
.heart{
  text-align: center;
  padding-top: 7px;
  margin-right: 6px;
  display: inline-block;
  /*background-color: #bbe4f7;*/
  height: 35px;
  width:35px;
  border-radius: 50%;
}
.heart1{
  background-color: #bbe4f7;
}
.heart2{
  background-color: red;
}
.heart:hover{
  background-color: red;
}
</style>
