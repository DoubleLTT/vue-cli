<template>
  <div class="" style="padding: 20px;">
    <Row>
      <i-col span="7">
        <div class="left">
          <div style="margin-top: 15px;">
            <span>行程天数：</span>
            <Checkbox v-model="single" @on-change="checkDaysChange">不限</Checkbox>
            <Checkbox-group v-model="checkDays" @on-change="checkDaysChange" style="display: inline-block">
              <Checkbox label="1天"></Checkbox>
              <Checkbox label="2天"></Checkbox>
              <Checkbox label="3天"></Checkbox>
              <Checkbox label="5天"></Checkbox>
              <Checkbox label="7天"></Checkbox>
            </Checkbox-group>
            <!--<ul style="width:70%;display: inline-block">-->
              <!--<li v-for="(item,index) in days" :key="index" @click="searchDay(index)">-->
                <!--<a href="#">{{ item.value }}</a>-->
              <!--</li>-->
            <!--</ul>-->
          </div>
          <p style="margin-top: 15px;">行程亮点：
            <i-select :model.sync="model1" style="width:70%;" size="small" placeholder="区(市)县" @on-change="areaSearch">
              <i-option v-for="(item,index) in area" :value="item.value" :key="index">{{ item.label }}</i-option>
            </i-select>
          </p>
          <p style="margin-top: 15px;">
            <Input v-model="searchList.name" size="small" search placeholder="请输入名称查询" style="width: auto" @on-change="nameSearch"/>
          </p>
          <div class="hot_places">
            <h4 style="font-weight: bold;margin-bottom: 10px;">热门景点</h4>
            <p>青城山<Divider type="vertical" />都江堰<Divider type="vertical" />锦里<Divider type="vertical" />锦里<Divider type="vertical" />武侯祠<Divider type="vertical" />青城山</p>
          </div>
        </div>
      </i-col>
      <i-col span="17" >
        <div class="right">
          <p class="error_msg">{{this.error_msg}}</p>
          <div class="place" @click="detail(1)" v-for="(item,index) in route_json" :key="index">
            <img :src="item.url" class="image">
            <div style="height:100%;padding: 10px">
              <h1>{{ item.title }}</h1>
              <p style="margin-top: 10px">{{ item.des }}</p>
              <p style="position: absolute;bottom: 10px;left:190px;"><span style="color:#999">行程标签：</span>{{ item.ps }}</p>
            </div>
          </div>
        </div>
        <div style="text-align: center;margin-top: 10px;">
          <Page :total="total" :page-size="4" :current="current" @on-change="getRoute" show-total></Page>
        </div>
      </i-col>
    </Row>
  </div>
</template>
<script>
  import { getRoutes } from '../../../service/api'
  export default{
    data (){
      return{
        route_json:[],
        error_msg:'',
        page:0,  //控制翻页按钮是否可点击
        total:0,
        current:1,
        single:true,
        checkDays: [],
        area: [
          {
            value: '所有',
            label: '所有'
          },{
            value: '都江堰',
            label: '都江堰'
          },{
            value: '锦江',
            label: '锦江区'
          },{
            value: '青羊',
            label: '青羊区'
          },{
            value: '武侯',
            label: '武侯区'
          },{
            value: '金牛',
            label: '金牛区'
          },{
            value: '成华',
            label: '成华区'
          },{
            value: '新都',
            label: '新都区'
          },{
            value: '温江',
            label: '温江区'
          },{
            value: '双流',
            label: '双流县'
          },
          {
            value: '新津',
            label: '新津县'
          },{
            value: '天府新区',
            label: '天府新区'
          },{
            value: '龙泉驿',
            label: '龙泉驿区'
          },{
            value: '大邑',
            label: '大邑县'
          },{
            value: '崇州',
            label: '崇州'
          },{
            value: '彭州',
            label: '彭州'
          },{
            value: '邛崃',
            label: '邛崃'
          },
        ],
        model1: '',
        searchList:{
          star:'',
          area:'',
          name:''
        }
      }
    },
    mounted (){
      this.getRoute(1); //1：前6条地点  2：加载第6~12条
    },
    methods :{
      getRoute (page){
        this.current=page;
        this.error_msg="";
        this.total=0;
        this.route_json=[];
        getRoutes(page).then(response=>{
          let res=response.data;
          if(res.valid){
            this.total=res.total;
            this.route_json=res.routes;
          }else{
            this.error_msg="没有数据";
          }
        })
      },
      checkDaysChange(value){
        console.log(value);
        if(typeof value === "boolean"){
          this.checkDays=[];
        }else{
          this.single=false;
        }
      },
      classSearch(value){
        this.searchList.star=value;
        this.current=1;
        this.getPic(1);
      },
      areaSearch(value){
        this.searchList.area =value;
        this.current=1;
        this.getPic(1);
      },
      nameSearch(value){
        this.current=1;
        this.getPic(1);
      },
      detail (id){
        this.$router.push({name:'PlaceDetail',path:'/PlaceDetail',query:{id:id} })
        //this.$router.push({name:'PlaceDetail',path:'/PlaceDetail/:id',params:{id:id} }) //通过params传递的路由参数需要用 :参数名 来占个坑
      }
    }
  }
</script>
<style scoped>
  ul{
    list-style-type: none;
    padding-top:15px;
    height:30px;
  }
  ul li{
    margin-right: 6px;
    cursor: pointer;
    float: left;
  }
  li a{
    padding:2px 3px;
  }
  li a:hover,
  li a:active{
    color:#fff;
    background-color: dodgerblue;
  }
  li:nth-child(1) a{
    color:#fff;
    background-color: dodgerblue;
  }
  .left{
    height: 400px;
    background-color: #f7f7f7;
    margin-right: 20px;
    padding:10px 10px;
  }
  .hot_places{
    margin-top:30px;
    border-top:1px dashed rgb(153, 153, 153);
    padding:10px 5px 0;
  }
  .right{
    height: 100%;
    padding:0 5px;
    background-color: #f7f7f7;
  }
  .error_msg{
    height:100%;
    text-align:center;
    padding-bottom: 15px;
  }
  .place{
    position: relative;
    width:100%;
    border: 1px solid rgb(153, 153, 153);
    margin-bottom: 20px;
    overflow: hidden;
  }
  .place_name{
    margin:0 10px;
    font-weight:bold;
    font-size:18px;
    font-family: 'Poppins', sans-serif;
  }
  .image{
    float: left;
    margin-right: 10px;
    height:auto;
  }
  .float_right{
    display: inline-block;
    float: right;
  }
</style>
