<template>
  <div class="" style="padding: 40px;">
    <Tabs :animated="false" type="card">
      <TabPane label="景点" icon="md-home">
        <Row>
          <i-col span="4">
            <div style="height: 400px; background-color: #f7f7f7;margin-right: 20px;padding:10px 10px;">
              <p style="margin-top: 15px;">级别：
                <i-select :model.sync="model1" style="width:70%;" size="small" placeholder="所有" @on-change="classSearch">
                  <i-option v-for="(item,index) in star" :value="item.value" :key="index">{{ item.label }}</i-option>
                </i-select>
              </p>
              <p style="margin-top: 15px;">区域：
                <i-select :model.sync="model1" style="width:70%;" size="small" placeholder="区(市)县" @on-change="areaSearch">
                  <i-option v-for="(item,index) in area" :value="item.value" :key="index">{{ item.label }}</i-option>
                </i-select>
              </p>
              <p style="margin-top: 15px;">
                <Input v-model="searchList.name" size="small" suffix="ios-search" placeholder="请输入名称" style="width: auto" clearable @on-blur="nameSearch"/>
              </p>
              <div style="margin-top:30px;border-top:1px dashed rgb(153, 153, 153);padding:10px 5px 0; ">
                <h4 style="font-weight: bold;margin-bottom: 10px;">热门景点</h4>
                <p>青城山<Divider type="vertical" />都江堰<Divider type="vertical" />锦里<Divider type="vertical" />锦里<Divider type="vertical" />都江堰<Divider type="vertical" />青城山</p>
              </div>
            </div>
          </i-col>
          <i-col span="20" >
            <div style="height: 100%; background-color: #f7f7f7;padding-top:20px;">
              <p style="height:100%;text-align:center;padding-bottom: 5px;">{{this.error_msg}}</p>
              <Row type="flex" justify="space-around">
                <i-col span="7" v-for="(item,index) in place_json" :key="index">
                  <div style="width:100%;border: 1px solid rgb(153, 153, 153);margin-bottom: 20px;">
                    <div style="width:100%;overflow: hidden;"><img :src="item.url" class="image"></div>
                    <p style="margin:0 10px;font-weight:bold;font-size:18px;font-family: 'Poppins', sans-serif;">{{item.name}}<span v-for="n in parseInt(item.star)" style="display: inline-block;float: right;"><Icon type="md-star" color="#f15b5c" size="20"/></span></p>
                    <p style="margin:10px"><Icon type="ios-pin" />{{item.address}} <span style="display: inline-block;float: right;">{{item.area}}</span></p>
                  </div>
                </i-col>
              </Row>
            </div>
            <div style="text-align: center;margin-top: 10px;">
              <Page :total="total" :page-size="6" :current="1" @on-change="getPic" show-total></Page>
            </div>
          </i-col>
        </Row>
      </TabPane>
      <TabPane label="美食" icon="ios-ice-cream">标签二的内容</TabPane>
      <TabPane label="路线" icon="md-paw">标签三的内容</TabPane>
    </Tabs>
  </div>
</template>
<script>
  import { getPics } from '../../../service/api'
	export default{
		data (){
			return{
        place_json:[],
        error_msg:'',
        page:0,  //控制翻页按钮是否可点击
        total:0,
        star: [
          {
            value: '所有',
            label: '所有'
          },{
            value: '5A',
            label: '5A'
          },{
            value: '4A',
            label: '4A'
          },{
            value: '3A',
            label: '3A'
          },{
            value: '2A',
            label: '2A'
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
            value: '双流',
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
          star:'',
          area:'',
          name:''
        }
			}
		},
    mounted (){
      this.getPic(1); //1：前6条地点  2：加载第6~12条
    },
    methods :{
      getPic (page){
        getPics(page,this.searchList.star,this.searchList.area).then(response=>{
              let res=response.data;
              if(res.valid){
                this.place_json=[];
                this.total=res.total;
                this.place_json=res.pics;
              }else{
                this.place_json=[];
                this.error_msg="没有数据";
              }
        })
       },
      classSearch(value){
        console.log(value);
        this.searchList.star=value;
        this.getPic(1);
      },
      areaSearch(value){
        console.log(value);
        this.searchList.area =value;
        this.getPic(1);
      },
      nameSearch(){
        console.log(this.searchList.name)
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
  }
  .ivu-tabs-bar .ivu-tabs-tab{
    margin-right: 10px!important;
  }
  .demo-tabs-style2 > .ivu-tabs.ivu-tabs-card > .ivu-tabs-bar .ivu-tabs-tab{
    border-radius: 0;
    background: #fff;
  }
  .image{
    width:100%;
    height:auto;
    transition: .5s;
  }
  .image:hover{
    transform: scale(1.1);
  }
</style>
