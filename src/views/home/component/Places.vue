<template>
  <div class="" style="padding: 40px;">
    <Tabs :animated="false" type="card">
      <TabPane label="景点" icon="md-home">
        <Row>
          <i-col span="4">
            <div style="height: 400px; background-color: #f7f7f7;margin-right: 20px;padding:10px 10px;">
              <p style="margin-top: 10px;">级别：
                <i-select :model.sync="model1" style="width:60%;" size="small" placeholder="所有">
                  <i-option v-for="item in star" :value="item.value">{{ item.label }}</i-option>
                </i-select>
              </p>
              <p style="margin-top: 10px;">区域：
                <i-select :model.sync="model1" style="width:60%;" size="small" placeholder="区(市)县">
                  <i-option v-for="item in area" :value="item.value">{{ item.label }}</i-option>
                </i-select>
              </p>
              <p style="margin-top: 10px;">搜索</p>
            </div>
          </i-col>
          <i-col span="20" >
            <div style="height: 100%; background-color: #f7f7f7;padding-top:20px;">
              <Row type="flex" justify="space-around">
                <i-col span="7" v-for="item in place_json">
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
      <TabPane label="美食" icon="md-home">标签二的内容</TabPane>
      <TabPane label="路线" icon="md-home">标签三的内容</TabPane>
    </Tabs>
  </div>
</template>
<script>
  import { getPics } from '../../../service/api'
	export default{
		data (){
			return{
        place_json:[
          // {
          //   id:1,
          //   name:'Dubai',
          //   price:'$500',
          //   star:5,
          //   url:require('../../../../static/packages/1.jpg')
          // },
          // {
          //   id:2,
          //   name:'Thailand',
          //   price:'$800',
          //   star:5,
          //   url:require('../../../../static/packages/2.jpg')
          // },
          // {
          //   id:3,
          //   name:'England',
          //   price:'$600',
          //   star:4,
          //   url:require('../../../../static/packages/3.jpg')
          // },
        ],
        error_msg:'',
        page:0,  //控制翻页按钮是否可点击
        total:0,
        star: [
          {
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
            value: 'dujiangyan',
            label: '都江堰'
          },{
            value: 'jinjiang',
            label: '锦江'
          },{
            value: 'qinyang',
            label: '青羊'
          },
        ],
        model1: ''
			}
		},
    mounted (){
      this.getPic(1); //1：前6条地点  2：加载第6~12条
    },
    methods :{
      getPic (page){
        this.total=30;
        getPics(page).then(response=>{
              let res=response.data;
              if(res.valid){
                this.place_json=[];
                // res.pics.star = res.pics.star.substring(0,1);
                this.place_json=res.pics
              }
        })
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
