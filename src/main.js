// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store/store'
import axios from 'axios'
import VueAxios from 'vue-axios'
import qs from 'qs'
import ViewUI from  'view-design'
import 'view-design/dist/styles/iview.css';
// import '../node_modules/bootstrap3/dist/css/bootstrap.css'
// import '../node_modules/bootstrap3/dist/js/bootstrap.js'

Vue.config.productionTip = false;
Vue.prototype.qs=qs;
Vue.use(ViewUI,VueAxios,axios);
/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})
