<template>
  <div>
    <NavBar></NavBar>
    <p style="padding: 20px 0 0 20px;cursor: pointer" ><router-link to="/">首页 &gt;</router-link></p>
    <Row v-for="(item,index) in details" :key="index" style="padding-top: 10px;" type="flex" justify="space-around">
      <i-col span="11"><img :src="item.url" style="width:100%;height:auto"></i-col>
      <i-col span="11">
        <h1>{{item.name}}</h1>
        <p><span style="color:red">{{item.star}}</span>级景区</p>
        <p style="margin-top: 30px"><span style="font-weight: bold;margin-right: 15px;">地址</span>{{item.address}}</p>
        <p style="margin-top: 10px"><span style="font-weight: bold;margin-right: 15px;">开放时间</span>3月1日-11月30日（夏季） 09:00-18:00；12月1日-次年2月28日（冬季） 09:00-17:30；网络票取票时间：08:30-17:00，最晚入园时间：17:30 夏季17:30停止入场；冬季17:00停止入场。</p>
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
            num:0, //评论数量
            price:0,//单价
            sum:0,//总价
            start:"",
            end:"",
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
        getNowDate(){
          let day=new Date().getDate();
          let month=new Date().getMonth()+1;
          let year=new Date().getFullYear();
          let str=(month<10)?year+"-0"+month+"-"+day : year+"-"+month+"-"+day;
          this.start=str;
          this.end=str;
        },
          PlaceDetail(){
            const placeId=this.$route.query.id;
            getPlaceDetail(placeId).then(response=>{
              let res=response.data;
              if(res.valid){
                this.details=res.pics;
                console.log(this.details)
              }else{
                alert(res.msg)
              }
            })
          }
      }
    }
</script>

<style scoped>

</style>
