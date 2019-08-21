import Vue from 'vue'
import Router from 'vue-router'
import Login from '../views/login/login'
import Home from '../views/home/home'

Vue.use(Router)

export default new Router({
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
      path: '/Login',
      name: 'Login',
      component: Login
    },
  ]
})
