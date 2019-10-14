<template>
	<div>
      <div class="title">
        <h1>Our Most Popular Packges</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br>labore et dolore magna aliqua. Ut enim ad minim veniam</p>
      </div>
      <div class="container">
        <ul class="row">
          <li class="col-md-4"  v-for="(item,index) in place_json">
            <div class="thumbnail">
              <div class="imgBox"><img v-bind:src="item.url" alt="缩略图"></div>
              <div class="caption">
                <h3>{{item.title}}</h3>
                <p>{{item.des}} <span style="color:#dc3545;float:right">${{item.price}}</span></p>
                <p class="book">
                  <button  class="btn btn-success" @click="detail(item.id)">Book Now</button>
                  <span v-for="n in item.star" class="glyphicon glyphicon-star"></span>
                </p>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <ul class="pager">
        <li :class="(page==0) ? 'disabled':'' " @click="getPic(0)"><a>&larr;</a></li>
        <li :class="(page==3) ? 'disabled':'' " @click="getPic(3)"><a>&rarr;</a></li>
      </ul>
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
  .title{
    text-align: center;
  }
  .glyphicon-star{
    color: #dc3545;
    font-size: 20px;
    padding-left: 5px;
    top: 5px;
  }
  .book span{
    float: right;
  }
  .pager{
    margin: 0;
  }
</style>
