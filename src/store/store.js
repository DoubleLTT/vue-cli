import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
import {getQuestion} from "../service/api";
const store = new Vuex.Store({
  state:{
    isLogin:false,
    article_json:[],
    page:0,
    total:0,
    current:1,
    error_msg:'',
  },
  mutations:{
    loginState(state,name){
      state.isLogin=true;
      sessionStorage.setItem("username",name);
      sessionStorage.setItem("isLogin",true);
    },
    getQuestions(state,payload){
      state.current=payload.page;
      state.error_msg="";
      state.total=0;
      state.article_json=[];
      getQuestion(payload.page,payload.search,payload.name).then(response=>{
        let res=response.data;
        if(res.valid){
          state.total=res.total;
          state.article_json=res.qs;
        }else{
          state.total=0;
          state.error_msg="暂时没有问题";
        }
      })
    },
  }
  });
export default store
