<template>
  <div class="" style="padding: 20px;">
    <Row>
      <i-col span="7">
        <div class="left">
          <div style="margin-top: 15px;">
            <span style="float: left">行程天数：</span>
            <Checkbox-group v-model="checkDays" size="small" @on-change="checkDaysChange">
              <Checkbox label="不限"></Checkbox>
              <Checkbox label="'1天'">1天</Checkbox>
              <Checkbox label="'2天'">2天</Checkbox>
              <Checkbox label="'3天'">3天</Checkbox>
              <Checkbox label="'5天'">5天</Checkbox>
              <Checkbox label="'7天'">7天</Checkbox>
            </Checkbox-group>
          </div>
          <div style="margin-top: 15px;">
            <span style="float: left">行程亮点：</span>
            <Checkbox-group v-model="light" size="small" @on-change="checkLights">
              <Checkbox label="不限"></Checkbox>
              <Checkbox label="公园"></Checkbox>
              <Checkbox label="人文"></Checkbox>
              <Checkbox label="户外"></Checkbox>
              <Checkbox label="城市观光"></Checkbox>
              <Checkbox label="暑假"></Checkbox>
            </Checkbox-group>
          </div>
          <div style="margin-top: 15px;">
            <span style="float: left">景&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;点：</span>
            <Checkbox-group v-model="sence" size="small" @on-change="checkSences">
              <Checkbox label="不限"></Checkbox>
              <Checkbox label="234">建川博物馆</Checkbox>
              <Checkbox label="227">刘氏庄园</Checkbox>
              <Checkbox label="229">武侯祠</Checkbox>
              <Checkbox label="226">青城山</Checkbox>
              <Checkbox label="225">都江堰</Checkbox>
            </Checkbox-group>
          </div>
          <div class="hot_places">
            <h4 style="font-weight: bold;margin-bottom: 10px;">热门景点</h4>
            <p>青城山<Divider type="vertical" />都江堰<Divider type="vertical" />锦里<Divider type="vertical" />锦里<Divider type="vertical" />武侯祠<Divider type="vertical" />青城山</p>
          </div>
        </div>
      </i-col>
      <i-col span="17" >
        <div class="right">
          <p class="error_msg">{{this.error_msg}}</p>
          <div class="place" @click="detail(item.id)" v-for="(item,index) in route_json" :key="index">
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
        checkDays: ["不限"],
        light:["不限"],
        sence:["不限"],
        searchList:{
          day:'',
          light:'',
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
        getRoutes(page,this.searchList.day,this.searchList.light,this.searchList.name).then(response=>{
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
        let days=[];
        if(value[0]==="不限" && value.length!==1){
          this.checkDays.shift();
        }else if(value.indexOf("不限") !== -1){
          this.checkDays=["不限"]
        }
        console.log(this.checkDays);
        // for (let i=0;i<this.checkDays.length;i++){
        //   let day = "'"+this.checkDays[i]+"'";
        //   days.push(day);
        // }
        // this.searchList.day = days.join(',');
        this.searchList.day = this.checkDays.join(',');
        console.log(this.searchList.day);
        this.getRoute(1);
      },
      checkLights(value){
        if(value[0]==="不限" && value.length!==1){
          this.light.shift();
        }else if(value.indexOf("不限") !== -1){
          this.light=["不限"]
        }
        console.log(this.light);
        this.searchList.light = this.light.join('|');
        console.log(this.searchList.light);
        this.getRoute(1);
      },
      checkSences(value){
        if(value[0]==="不限" && value.length!==1){
          this.sence.shift();
        }else if(value.indexOf("不限") !== -1){
          this.sence=["不限"]
        }
        console.log(this.sence);
        this.searchList.name = this.sence.join('|');
        console.log(this.searchList.name);
        this.getRoute(1);
      },
      detail (id){
        this.$router.push({name:'RouteDetail',path:'/RouteDetail',query:{id:id} })
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
