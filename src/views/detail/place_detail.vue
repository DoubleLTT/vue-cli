<template>
  <div style="padding: 20px;">
    <Breadcrumb separator=">" style="padding: 0 0 0 10px;">
      <BreadcrumbItem to="/"><span style="color: #2d8cf0;">景点</span></BreadcrumbItem>
      <BreadcrumbItem>{{name}}详情</BreadcrumbItem>
    </Breadcrumb>
    <Row v-for="(item,index) in details" :key="index" style="padding-top: 10px;" type="flex" justify="space-around">
      <i-col span="8"><img :src="item.url" style="width:100%;height:auto"></i-col>
      <i-col span="6">
        <h1>{{item.name}}</h1>
        <p style="margin-top: 10px"><span style="color:red">{{item.star}}</span>级景区</p>
        <p style="margin-top: 30px"><span style="font-weight: bold;margin-right: 15px;">地址</span>{{item.address}}</p>
        <p style="margin-top: 10px"><span style="font-weight: bold;margin-right: 15px;">开放时间</span>{{item.open_time}}</p>
      </i-col>
      <i-col span="7">
            <div class="amap-wrapper">
              <el-amap vid="amapDemo" :zoom="zoom" :center="center" class="amap-demo">
                <el-amap-marker v-for="(marker, index) in markers" :position="marker.position" :events="marker.events" :visible="marker.visible" :draggable="marker.draggable" :vid="index"></el-amap-marker>
              </el-amap>
            </div>
<!--        <span :class="{'heart':true,'heart1':!isActive,'heart2':isActive}" @click="Wanna" ref="wanna"><Icon type="md-heart" size="21" color="white"/></span>-->
<!--        <span style="font-size: 15px;">想去</span>-->
      </i-col>
    </Row>
    <div style="margin-top:40px;margin-left: 20px;">
      <Row type="flex">
        <i-col span="8">
          <div id="travel_time" style="height:400px;"></div>
        </i-col>
        <i-col span="8">
          <div id="month_people" style="height:400px;"></div>
        </i-col>
        <i-col span="8">
          <div id="people_age" style="height:400px;"></div>
        </i-col>
      </Row>
    </div>
  </div>
</template>

<script>
  import {getPlaceDetail} from "../../service/api";
  import NavBar from '../navbar/navbar'

  const echarts = require('echarts');

  export default {
        data (){
          return{
            zoom: 14,
            center: [],
            markers: [
              {
                position: [],
                events: {
                  click: () => {
                    alert('click marker');
                  },
                },
                visible: true,
                draggable: false,
                template: '<span>1</span>',
              }
            ],
            details:[],
            time_people:[],
            month_people:[],
            age_people:[{value:0,name: '0-10'},
              {value:0,name: '10-20'},
              {value:0,name: '20-30'},
              {value:0,name: '30-40'},
              {value:0,name: '40-50'},
              {value:0,name: '50-60'},
              {value:0,name: '>60'}],
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
                this.name=this.details[0].name;
                this.time_people=[];
                this.month_people=[];
                // this.age_people=[];
                this.center =this.markers[0].position =  [];
                this.time_people = this.details[0].time_people.split(',');
                this.month_people = this.details[0].month_people.split(',');
                let people_ages = this.details[0].ages.split(',');
                for(let i = 0;i<this.age_people.length;i++){
                  for (let key in this.age_people[i]) {
                    if(key === 'value'&& this.age_people[i].hasOwnProperty(key)){
                      this.age_people[i][key] = parseInt(people_ages[i]);
                    }
                  }
                }
                this.center = this.markers[0].position= this.details[0].positions.split(',');
                console.log(this.age_people);
                this.people_total();
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
          },
          people_total(){
            // 基于准备好的dom，初始化echarts实例
            const myChart1 = echarts.init(document.getElementById('travel_time'));
            const myChart2 = echarts.init(document.getElementById('month_people'));
            const myChart3 = echarts.init(document.getElementById('people_age'));
            myChart1.setOption({
              title: {
                text: '游客入园时间统计'
              },
              tooltip: {},
              xAxis: {
                data: ['0-2点', '2-4点', '4-6点', '6-8点', '8-10点', '10-12点',
                  '12-14点', '14-16点', '16-18点', '18-20点', '20-22点', '22-24点']
              },
              yAxis: {},
              series: [{
                name: '入园人数',
                type: 'bar',
                data:this.time_people
                // data: [5, 20, 36, 10, 10, 20,46,54,23,54,43,24]
              }]
            });
            myChart2.setOption({
              title: {
                text: '月均游客统计'
              },
              xAxis: {
                type: 'category',
                data: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月']
              },
              yAxis: {
                type: 'value'
              },
              series: [{
                data:this.month_people,
                markPoint: {
                  data: [
                    {type: 'max', name: '最大值'},
                  ]
                },
                // data: [820, 932, 901, 934, 1290, 1330, 1320,254,454,201,154,145],
                type: 'line'
              }]
            });
            myChart3.setOption({
              title: {
                text: '游客人群占比（年龄）',
                // subtext: '纯属虚构',
                left: 'center'
              },
              tooltip: {
                trigger: 'item',
                formatter: '{a} <br/>{b} : {c} ({d}%)'
              },
              legend: {
                orient: 'vertical',
                left: 'left',
                data: ['0-10', '10-20', '20-30', '30-40', '40-50','50-60','>60']
              },
              series: [
                {
                  name: '游客来源',
                  type: 'pie',
                  radius: '55%',
                  center: ['50%', '60%'],
                  data:this.age_people,
                  // data: [
                    // {value: 335, name: '0-10'},
                    // {value: 310, name: '10-20'},
                    // {value: 234, name: '20-30'},
                    // {value: 135, name: '30-40'},
                    // {value: 1548, name: '40-50'},
                    // {value: 58, name: '50-60'},
                    // {value: 30, name: '>60'},
                  // ],
                  emphasis: {
                    itemStyle: {
                      shadowBlur: 10,
                      shadowOffsetX: 0,
                      shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                  }
                }
              ]
            })
          }
      }
    }
</script>

<style scoped>
  .amap-wrapper {
    /*width: 500px;*/
    margin: 0;
    padding:0;
    height: 300px;
    /*padding-left: 20px;*/
    /*float:right*/
    /*padding-right:20px*/
  }
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
