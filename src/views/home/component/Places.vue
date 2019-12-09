<template>
  <div class="" style="padding: 40px;">
    <Tabs :animated="false" type="card">
      <TabPane label="标签一" icon="md-home">
        <Row>
          <Col span="4">
            <div style="height: 400px; background-color: #f7f7f7;margin-right: 20px">
              推荐
            </div>
          </Col>
          <Col span="20" >
            <div style="height: 400px; background-color: #f7f7f7; margin: 5px">
              <Card style="width:320px">
                <div style="text-align:center">
                  <img src="../../../../static/places/dujiangyan.jpg">
                  <h3>A high quality UI Toolkit based on Vue.js</h3>
                </div>
              </Card>
            </div>
          </Col>
        </Row>
      </TabPane>
      <TabPane label="标签二" icon="md-home">标签二的内容</TabPane>
      <TabPane label="标签三" icon="md-home">标签三的内容</TabPane>
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
        page:0  //控制翻页按钮是否可点击
			}
		},
    mounted (){
      this.getPic(0); //0：加载热度最高的前3条地点  3：加载第4~6条
    },
    methods :{
      getPic (page){
        this.page=page;
        getPics(page).then(response=>{
              let res=response.data;
              if(res.valid){
                this.place_json=[];
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
  .ivu-tabs-bar{
    margin-bottom:0!important;
  }
  .ivu-tabs-bar .ivu-tabs-tab{
    margin-right: 10px!important;
  }
  .demo-tabs-style2 > .ivu-tabs.ivu-tabs-card > .ivu-tabs-bar .ivu-tabs-tab{
    border-radius: 0;
    background: #fff;
  }
</style>
