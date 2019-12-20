<template>
  <div class="" style="padding: 20px;">
    <Row>
      <i-col span="4">
            <div class="left">
              <p style="margin-top: 15px;">分类：
                <i-select :model.sync="model1" style="width:70%;" size="small" placeholder="所有" @on-change="classSearch">
                  <i-option v-for="(item,index) in menu" :value="item.value" :key="index">{{ item.label }}</i-option>
                </i-select>
              </p>
              <p style="margin-top: 15px;">区域：
                <i-select :model.sync="model1" style="width:70%;" size="small" placeholder="区(市)县" @on-change="areaSearch">
                  <i-option v-for="(item,index) in area" :value="item.value" :key="index">{{ item.label }}</i-option>
                </i-select>
              </p>
              <p style="margin-top: 15px;">
                <Input v-model="searchList.name" size="small" suffix="ios-search" placeholder="请输入名称" style="width: auto" clearable @on-change="nameSearch"/>
              </p>
              <div class="hot_places">
                <h4 style="font-weight: bold;margin-bottom: 10px;">热门美食</h4>
                <p>火锅<Divider type="vertical" />川菜<Divider type="vertical" />烤鱼<Divider type="vertical" />小吃<Divider type="vertical" />海鲜<Divider type="vertical" />烤肉</p>
              </div>
            </div>
          </i-col>
          <i-col span="20" >
            <div class="right">
              <p class="error_msg">{{this.error_msg}}</p>
              <Row type="flex" justify="space-around">
                <i-col span="7" v-for="(item,index) in food_json" :key="index">
                  <div class="place" @click="detail(item.id)">
                    <div style="width:100%;height:65%;overflow: hidden;"><img :src="item.url" class="image"></div>
                    <p class="place_name">{{item.name}}<span class="float_right">{{item.menu}}</span></p>
                    <p class="place_address"><Icon type="ios-pin" />{{item.address}}</p>
                  </div>
                </i-col>
              </Row>
            </div>
            <div style="text-align: center;margin-top: 10px;">
              <Page :total="total" :page-size="6" :current="current" @on-change="getFood" show-total></Page>
            </div>
          </i-col>
    </Row>
  </div>
</template>
<script>
  import { getFoods } from '../../../service/api'
  export default{
    data (){
      return{
        food_json:[],
        error_msg:'',
        page:0,  //控制翻页按钮是否可点击
        total:0,
        current:1,
        menu: [
          {
            value: '所有',
            label: '所有'
          },{
            value: '火锅',
            label: '火锅'
          },{
            value: '川菜',
            label: '川菜'
          },{
            value: '小吃',
            label: '小吃'
          },{
            value: '烤鱼',
            label: '烤鱼'
          },
        ],
        area: [
          {
            value: '所有',
            label: '所有'
          },{
            value: '都江堰',
            label: '都江堰'
          },{
            value: '锦江区',
            label: '锦江区'
          },{
            value: '青羊区',
            label: '青羊区'
          },{
            value: '武侯区',
            label: '武侯区'
          },{
            value: '金牛区',
            label: '金牛区'
          },{
            value: '成华区',
            label: '成华区'
          },{
            value: '双流区',
            label: '双流区'
          },{
            value: '天府新区',
            label: '天府新区'
          },{
            value: '龙泉驿',
            label: '龙泉驿区'
          },{
            value: '大邑',
            label: '大邑县'
          },
        ],
        model1: '',
        searchList:{
          menu:'',
          area:'',
          name:''
        }
      }
    },
    mounted (){
      //this.getFood(1); //1：前6条地点  2：加载第6~12条
    },
    methods :{
      getFood (page){
          this.current=page;
          this.error_msg="";
          this.total=0;
          this.food_json=[];
        getFoods(page,this.searchList.menu,this.searchList.area,this.searchList.name).then(response=>{
              let res=response.data;
              if(res.valid){
                this.total=res.total;
                this.food_json=res.foods;
              }else{
                this.total=0;
                this.error_msg="没有数据";
              }
        })
       },
      classSearch(value){
        this.searchList.menu=value;
        this.current=1;
        this.getFood(1);
      },
      areaSearch(value){
        this.searchList.area =value;
        this.current=1;
        this.getFood(1);
      },
      nameSearch(value){
        this.current=1;
        this.getFood(1);
      },
      detail (id){
        this.$router.push({name:'FoodDetail',path:'/FoodDetail',query:{id:id} })
      }
    }
  }
</script>
<style scoped>
  ul{
    list-style-type: none;
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
    background-color: #f7f7f7;
    padding-top:20px;
  }
  .error_msg{
    height:100%;
    text-align:center;
    padding-bottom: 15px;
  }
  .place{
    width:100%;
    height:240px;
    border: 1px solid rgb(153, 153, 153);
    margin-bottom: 20px;
  }
  .place_name{
    margin:10px 10px 0;
    font-weight:bold;
    font-size:18px;
    font-family: 'Poppins', sans-serif;
  }
  .place_address{
    margin:10px;
    width: 95%;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
  }
  .image{
    width:100%;
    height:auto;
    overflow: hidden;
    transition: .5s;
  }
  .image:hover{
    transform: scale(1.1);
  }
  .float_right{
    display: inline-block;
    float: right;
    width: 40%;
    text-align: right;
    font-size: 10px;
    margin-top: 5px;
    color:#f15b5c;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
  }
</style>
