<template>
  <div>
    <NavBar></NavBar>
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <div v-for="item in details">
            <h2>{{ item.title }}</h2>
            <p>{{ item.des }}<span style="color: indianred;"> ${{item.price}}/per</span></p>
            <img style="height: 500px" :src="item.url" class="img-responsive">
          </div>
          <div class="tab">
            <ul class="nav nav-pills">
              <li v-for="(item,index) in tabs" :class="(index==0)?'active':''">
                <a :href="item.href" data-toggle="tab">
                  {{item.name}}
                  <span class="badge" v-if="index==3">{{ num }}</span>
                </a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade" :class="(item.id=='detail_des')? 'in active' :''"  :id="item.id" v-for="item in tab_content">
                <p>{{item.content}}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-md-offset-1">
          <h2>book your tour</h2>
          <p>Lorem ipsum dolor sit amet, consectet ur adipiscing elit, sedpr do eiusmod tempor incididunt ut.</p>
          <ul>
            <li><label for="start">出发日期：</label><input type="date" id="start" v-model="start"></li>
            <li><label for="end">返回日期：</label><input type="date" id="end" v-model="end"><span style="color: red;"> {{ msg }}</span></li>
            <li><label for="people">出行人数：</label><input type="number" id="people" min="0" v-model="number"></li>
          </ul>
          <div class="price">
            <p>单价：${{this.price}}/人/天</p>
            <P>总计：{{ getSum }}</P>
          </div>
          <div class="book"><button class="btn btn-danger">BOOK NOW</button></div>
        </div>
      </div>

    </div>

  </div>
</template>

<script>
  import {getPlaceDetail} from "../../service/api";
  import NavBar from '../navbar/navbar'
    export default {
        data (){
          return{
            details:[],
            num:0, //评论数量
            price:0,//单价
            sum:0,//总价
            start:"",
            end:"",
            number:0,
            msg:'',
            tabs:[{
              name:'描述',
              href:'#detail_des'
              },{
                name:'行程',
                href:'#tour'
              }, {
                name:'游记',
                href:'#article'
              },{
                name:'评论',
                href:'#comment'
              }],
            tab_content:[],
            tab_content1:[
              {id:'tour',content:'tour guide'},
              {id:'comment',content:'your comment'}
              ]
          }
        },
      components:{NavBar},
      mounted() {
          //console.log(this.$route.params);
        //console.log(this.$route.query);
        this.PlaceDetail();
        this.getNowDate();
      },
      computed:{
         getSum(){
           this.msg="";
           let date1=new Date(this.start);
           let date2=new Date(this.end);
           if (date1-date2>0) {
             this.msg="日期不符！";
             return 0
           }
           let day=parseInt(Math.abs(date1-date2)/1000/60/60/24);
           return (isNaN(day)) ? 0 : this.number*this.price*day;
         }
      },
      methods:{
        getNowDate(){
          let day=new Date().getDate();
          let month=new Date().getMonth()+1;
          let year=new Date().getFullYear();
          let str=(month<10)?year+"-0"+month+"-"+day : year+"-"+month+"-"+day;
          this.start=str;
          this.end=str;
        },
          PlaceDetail(){
            const placeId=this.$route.query.id;
            getPlaceDetail(placeId).then(response=>{
              let res=response.data;
              if(res.valid){
                this.details=res.pics;
                this.num=res.pics[0].says;
                this.price=res.pics[0].price;
                for ( let key in res.pics[0]){
                  if(key=="detail_des" || key=="article"){
                    let tab_content={};
                    tab_content.content=res.pics[0][key];
                    tab_content.id=key;
                    this.tab_content1.push(tab_content)
                  }
                }
                this.tab_content=this.tab_content.concat(this.tab_content1);
              }else{
                alert(res.msg)
              }
            })
          }
      }
    }
</script>

<style scoped>
.container{
  margin-top: 50px;
}
  .col-md-4{
    margin:98px 0 0 0;
    height: 490px;
    background: #e9ecef;
  }
  .tab{
    margin-top: 30px;
  }
  .tab li{
    width:20%;
    text-align: center;
  }
.tab li a{
    color: #000;
    font-size: 16px;
  }
.nav-pills > li.active > a, .nav-pills > li.active > a:hover,
.nav-pills > li.active > a:focus {
  color: red;
  background-color: white;
}
  .badge{
    background: #e80b0b;
  }
.nav-pills > .active > a > .badge,
a:focus>.badge{
  background: #e80b0b;
  color:#fff;
}
.tab-content{
  margin-top:30px;
}
  .col-md-4 input{
    width: 50%;
    height: 30px;
    margin: 5px 0;
  }
  .price{
    margin-top: 30px;
    margin-right: 30px;
  }
.col-md-4 ul{
    padding:30px 0;
    border-bottom:1px dashed #000;
  }
  .book{
    margin-top: 20px;
  }
</style>
