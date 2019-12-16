<template>
  <div class="" style="padding: 20px;">
    <Row>
      <i-col span="4">
            <div class="left">
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
                <Input v-model="searchList.name" size="small" search placeholder="请输入名称查询" style="width: auto" @on-change="nameSearch"/>
              </p>
              <div class="hot_places">
                <h4 style="font-weight: bold;margin-bottom: 10px;">热门景点</h4>
                <p>青城山<Divider type="vertical" />都江堰<Divider type="vertical" />锦里<Divider type="vertical" />锦里<Divider type="vertical" />武侯祠<Divider type="vertical" />青城山</p>
              </div>
            </div>
          </i-col>
          <i-col span="20" >
            <div class="right">
              <p class="error_msg">{{this.error_msg}}</p>
              <Row type="flex" justify="space-around">
                <i-col span="7" v-for="(item,index) in place_json" :key="index">
                  <div class="place">
                    <div style="width:100%;overflow: hidden;"><img :src="item.url" class="image"></div>
                    <p class="place_name">{{item.name}}<span v-for="n in parseInt(item.star)" class="float_right"><Icon type="md-star" color="#f15b5c" size="20"/></span></p>
                    <p style="margin:10px"><Icon type="ios-pin" />{{item.address}} <span class="float_right">{{item.area}}</span></p>
                  </div>
                </i-col>
              </Row>
            </div>
            <div style="text-align: center;margin-top: 10px;">
              <Page :total="total" :page-size="6" :current="current" @on-change="getPic" show-total></Page>
            </div>
          </i-col>
    </Row>
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
        current:1,
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
      this.getPic(1); //1：前6条地点  2：加载第6~12条
    },
    methods :{
      getPic (page){
        this.current=page;
        this.error_msg="";
        this.total=0;
        getPics(page,this.searchList.star,this.searchList.area,this.searchList.name).then(response=>{
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
    border: 1px solid rgb(153, 153, 153);
    margin-bottom: 20px;
  }
  .place_name{
    margin:0 10px;
    font-weight:bold;
    font-size:18px;
    font-family: 'Poppins', sans-serif;
  }
  .image{
    width:100%;
    height:auto;
    transition: .5s;
  }
  .image:hover{
    transform: scale(1.1);
  }
  .float_right{
    display: inline-block;
    float: right;
  }
</style>
