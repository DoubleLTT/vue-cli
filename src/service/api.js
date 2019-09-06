const url='http://localhost:8081/';
import Vue from 'vue'
import VueResource from 'vue-resource'
Vue.use(VueResource);
export const action_login =function (username,password) {
  window.$http.post(url+'login.php',{name:username,password:password},{emulateJSON:true}).then(
    response =>{
      return response
    }
  )
};

export default {
  name:action_login()
}
