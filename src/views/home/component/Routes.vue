<template>
  <div class="" style="padding: 40px 40px 40px 20px;">
    <Row>
      <i-col span="7">
        <div class="left1">
          <h4>行程搜索</h4>
          <div>
            <span>行程天数:</span>
            <span style="margin-right: 20px;" @click="daymore=!daymore"><Icon type="md-arrow-dropdown" />更多</span>
            <Checkbox-group v-model="checkDays" size="small" @on-change="checkDaysChange">
              <Checkbox label="不限"></Checkbox>
              <Checkbox label="'1天'">1天</Checkbox>
              <Checkbox label="'2天'">2天</Checkbox>
              <Checkbox label="'3天'">3天</Checkbox>
              <Checkbox label="'5天'" v-if="daymore">5天</Checkbox>
              <Checkbox label="'7天'" v-if="daymore">7天</Checkbox>
            </Checkbox-group>
          </div>
          <div>
            <span>行程亮点:</span>
            <span style="margin-right: 20px;" @click="lightmore=!lightmore"><Icon type="md-arrow-dropdown" />更多</span>
            <Checkbox-group v-model="light" size="small" @on-change="checkLights">
              <Checkbox label="不限"></Checkbox>
              <Checkbox label="公园"></Checkbox>
              <Checkbox label="城市观光"></Checkbox>
              <Checkbox label="户外" v-if="lightmore"></Checkbox>
              <Checkbox label="人文" v-if="lightmore"></Checkbox>
              <Checkbox label="暑假" v-if="lightmore"></Checkbox>
            </Checkbox-group>
          </div>
          <div>
            <span>包含景点:</span>
            <Checkbox-group v-model="sence" size="small" @on-change="checkSences">
              <Checkbox label="不限"></Checkbox>
              <Checkbox label="234">建川博物馆</Checkbox>
              <Checkbox label="227">刘氏庄园</Checkbox>
              <Checkbox label="229">武侯祠</Checkbox>
              <Checkbox label="226">青城山</Checkbox>
              <Checkbox label="225">都江堰</Checkbox>
            </Checkbox-group>
          </div>
          <div style="margin: 20px auto;width:80%;"><Button type="info" long>搜索</Button></div>
          <p>
            <span>历史搜索</span>
            <Tag closable>1天 公园</Tag>
            <Tag closable>2天 人文 暑假</Tag>
          </p>
        </div>
        <div class="left2">
          <h4 style="margin-bottom: 10px;color: #f15b5c;">热门景点</h4>
          <p>青城山<Divider type="vertical" />都江堰<Divider type="vertical" />锦里<Divider type="vertical" />锦里<Divider type="vertical" />武侯祠<Divider type="vertical" />青城山</p>
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
        daymore:false,
        lightmore:false,
        scenemore:false,
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
<style scoped lang="less">
  /*ul{*/
    /*list-style-type: none;*/
    /*padding-top:15px;*/
    /*height:30px;*/
  /*}*/
  /*ul li{*/
    /*margin-right: 6px;*/
    /*cursor: pointer;*/
    /*float: left;*/
  /*}*/
  /*li a{*/
    /*padding:2px 3px;*/
  /*}*/
  /*li a:hover,*/
  /*li a:active{*/
    /*color:#fff;*/
    /*background-color: dodgerblue;*/
  /*}*/
  /*li:nth-child(1) a{*/
    /*color:#fff;*/
    /*background-color: dodgerblue;*/
  /*}*/
  .left1,
  .left2{
    background-color: #fff;
    margin-right: 20px;
    margin-bottom: 20px;
    padding:10px 10px;
    border: 1px solid #f3f3f3;
  }
  .left1{
    height: 100%;
    h4{
      color: #2db7f5;
      margin-bottom: 10px;
    }
    >div{
      margin-bottom: 20px;
      >span:nth-child(1){
        float: left;
        margin-right: 10px;
        font-weight: bold;
      }
      >span:nth-child(2){
        cursor: pointer;
        float: right;
        color:#2b85e4;
      }
    }
    p{
      font-size: 12px;
      margin-top: 20px;
      color:#ccc;
      span{
        margin-right: 10px;
      }
    }
  }
  .left2{
    height: 150px;
  }
  .right{
    height: 100%;
    padding:0 5px;
  }
  .error_msg{
    height:100%;
    text-align:center;
  }
  .place{
    position: relative;
    width:100%;
    border: 1px solid #f3f3f3;
    background-color: #fff;
    margin-bottom: 20px;
    overflow: hidden;
  }
  .image{
    float: left;
    margin-right: 10px;
    height:auto;
  }
</style>
