import Vue from 'vue'
import Router from 'vue-router'
import Login from '../views/login/login'
import Home from '../views/home/home'
import PlaceDetail from '../views/detail/place_detail'

Vue.use(Router)

export default new Router({
  mode:'history',//去掉地址中的#
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home,
      // redirect :'/About',
      // children :[
      // 	{
      // 		path : '',
      // 		name : '',
      // 		component : 
      // 	}
      // ]
    },
    {
      path: '/PlaceDetail',
      name: 'PlaceDetail',
      component: PlaceDetail
    },
    {
      path: '/Login',
      name: 'Login',
      component: Login
    },
  ]
})
