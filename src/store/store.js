import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
const store = new Vuex.Store({
  state:{
    isLogin:false
  },
  mutations:{
    loginState(state,name){
      state.isLogin=true;
      sessionStorage.setItem("username",name);
      sessionStorage.setItem("isLogin",true);
    }
  }
  });
export default store
