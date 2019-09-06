<template>
  <div>
    <NavBar></NavBar>
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <div v-for="item in details">
            <h2>{{ item.title }}</h2>
            <p>{{ item.des }}</p>
            <img style="height: 500px" :src="item.url" class="img-responsive">
          </div>
          <div class="tab">
            <ul class="nav nav-pills">
              <li v-for="(item,index) in tabs" :class="(index==0)?'active':''"><a :href="item.href" data-toggle="tab">{{item.name}}</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade" :class="(index==0)?'in active':''"  :id="item.id" v-for="(item,index) in tab_content">
                <p>{{item.content}}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <h2>book your tour</h2>
        </div>
      </div>

    </div>

  </div>
</template>

<script>
  import NavBar from '../navbar/navbar'
    export default {
        data (){
          return{
            url: 'http://localhost:8081/myWeb/',
            details:[],
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
            tab_content:[
              // {id:'des',content:'description'},
              // {id:'tour',content:'tour guide'},
              // {id:'article',content:'articles'},
              // {id:'comment',content:'your comment'},
            ],
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
        this.getPlaceDetail()
      },
      methods:{
          getPlaceDetail(){
            const placeId=this.$route.query.id;
            this.$http.post(this.url+"places.php",{action:"getPlaceDetail",placeId:placeId},{emulateJSON:true}).then(response=>{
              let res=response.body;
              console.log(res);
              if(res.valid){
                this.details=res.pics;
                for ( let key in res.pics[0]){
                  if(key=="detail_des" || key=="article"){
                    let tab_content={};
                    tab_content.content=res.pics[0][key];
                    tab_content.id=key;
                    this.tab_content1.push(tab_content)
                  }
                }
                this.tab_content=this.tab_content.concat(this.tab_content1);
                console.log(this.tab_content)
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
  .col-md-5{
    height: 550px;
    border:1px solid red;
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
</style>
