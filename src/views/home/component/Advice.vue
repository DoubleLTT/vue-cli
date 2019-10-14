<template>
    <div class="content-filled">
      <div class="title">
        <h1>Travel guide and Expert Advice</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-4" v-for="item in article_json">
            <div class="advice">
              <img :src="item.url" style="width: 100%;height: auto;">
              <div class="advice-content">
                <h3>{{ item.title }}</h3>
                <!--12July, 2019-->
                <p> {{ item.time }}<span class="glyphicon glyphicon-comment">43</span><span class="glyphicon glyphicon-user">10</span></p>
                <p>{{ item.content }}</p>
                <p>Read More &gt;</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
  import {getAdvice} from "../../../service/api";
  export default {
        name: "Advice",
        data (){
          return{
            article_json:[],
          }
        },
      methods:{
        getArticles(){
          getAdvice().then(response=>{
            let res=response.data;
            if(res.valid){
              console.log(res.articles);
              for(let i=0;i<res.articles.length;i++){
                res.articles[i].time=this.solveDate(res.articles[i].time)
              }
              this.article_json=res.articles;
            }else{
              console.log(res.msg)
            }
          })
        },
        solveDate(str){
          let date='';
          let arr1=str.split(' ');
          let arr2=arr1[0].split('-');
          let month=parseInt(arr2[1]);
          let months =
            [
              "January", "February", "March", "April", "May", "June",
              "July", "August", "Sep", "October", "November", "December"
            ];
          date=arr2[2]+months[month-1]+", "+arr2[0];
          return date
        }
      },
      mounted() {
          this.getArticles()
        }
    }
</script>

<style scoped>
  .content-filled{
    width:100%;
    height:100%;
    padding: 40px 0 40px 0;
    background-image: url(../../../../static/blog.jpg);
  }
  .title{
    color: #fff;
    margin-bottom: 5%;
    text-align: center;
  }
  .advice{
    background: #fff;
    padding-bottom: 20px;
  }
  .advice-content{
    padding:0 10px;
  }
  p span{
    float: right;
    padding-right: 10px;
  }
</style>
