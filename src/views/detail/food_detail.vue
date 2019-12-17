<template>
  <div>
    <NavBar></NavBar>
    <p style="padding: 20px 0 0 20px;cursor: pointer" ><router-link to="/">首页 &gt;</router-link></p>
    <Row v-for="(item,index) in details" :key="index" style="padding-top: 10px;" type="flex" justify="space-around">
      <i-col span="11">
        <img :src="item.url" style="width:100%;height:auto">
      </i-col>
      <i-col span="11">
        <h1>{{item.name}} <span style="color:red;font-size: 16px;margin-left: 40px;">{{item.menu}}</span></h1>
        <h3><span style="color:#9ea7b4;font-size: 30px;">{{item.e_name}}</span></h3>
        <p style="margin-top: 30px"><span style="font-weight: bold;margin-right: 15px;">地址</span>{{item.address}}</p>
        <p style="margin-top: 10px"><span style="font-weight: bold;margin-right: 15px;">开放时间</span>{{item.open}}</p>
      </i-col>
    </Row>
  </div>
</template>

<script>
  import {getFoodDetail} from "../../service/api";
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
        this.FoodDetail();
      },
      computed:{

      },
      methods:{
          FoodDetail(){
            const foodId=this.$route.query.id;
            getFoodDetail(foodId).then(response=>{
              let res=response.data;
              if(res.valid){
                this.details=res.foods;
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
