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
        <p style="margin-top: 10px"><span style="font-weight: bold;margin-right: 15px;">开放时间</span>3月1日-11月30日（夏季） 09:00-18:00；12月1日-次年2月28日（冬季） 09:00-17:30；网络票取票时间：08:30-17:00，最晚入园时间：17:30 夏季17:30停止入场；冬季17:00停止入场。</p>
      </i-col>
      <i-col span="4">
        <span class="heart"><Icon type="md-heart" size="21" color="white"/></span>
        <span style="font-size: 15px;">想去</span>
      </i-col>
    </Row>
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
            tabs:[{
              name:'描述',
              href:'#detail_des'
              },{
                name:'行程',
                href:'#tour'
              }, {
                name:'游记',
                href:'#article'
              },{
                name:'评论',
                href:'#comment'
              }],
            tab_content:[],
            tab_content1:[
              {id:'tour',content:'tour guide'},
              {id:'comment',content:'your comment'}
              ]
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
                alert(res.msg)
              }
            })
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
  background-color: #bbe4f7;
  height: 35px;
  width:35px;
  border-radius: 50%;
}
</style>
