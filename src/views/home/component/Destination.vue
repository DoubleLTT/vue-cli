<template>
  <!--暂时不用-->
  <div>
    <div class="title">
      <h1>Most Popular Destinations</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
    </div>
    <div class="container">
      <div class="tab">
        <ul class="nav nav-pills">
          <li v-for="(item,index) in tabs" :class="(index==0)?'active':''">
            <a :href="item.href" data-toggle="tab">
              {{item.name}}
            </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade" :class="(item.id=='Asia')? 'in active' :''"  :id="item.id" v-for="item in tab_content">
            <div class="row">
              <div class="col-md-3" v-for="image in item.imgs"><img :src="image.url"><p>{{image.content}}</p></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        data (){
        return{
          tabs:[
            {
            name:'Asia',
            href:'#Asia'
          },{
            name:'Europe',
            href:'#Europe'
          }, {
            name:'American',
            href:'#American'
          },{
            name:'American',
            href:'#American'
          }],
          tab_content:[
            {id:'Asia',
              imgs:[
                {content:'Thailand,Samui',url:require('../../../../static/destination/pd3.jpg')},
                {content:'Japan,chongsheng',url:require('../../../../static/destination/pd3.jpg')},
                {content:'China,Beijing',url:require('../../../../static/destination/pd3.jpg')},
                {content:'China,Beijing',url:require('../../../../static/destination/pd3.jpg')},
                ],
              },
            {id:'Europe',content:'your comment'}
          ]
        }
      }
    }
</script>

<style scoped>
  .title{
    text-align: center;
    margin-top: 40px;
    margin-bottom:30px ;
  }
  .tab li{
    width:15%;
    margin-left:8%;
    text-align: center;
  }
  .tab-pane{
    margin-top: 40px;
  }
  .tab-pane img{
    height:100%;
    margin-right:20px;
  }
  /*.tab-pane img{*/
    /*margin: 40px 20px 0 0;*/
    /*width:20%;*/
    /*height: 100%;*/
  /*}*/
</style>
