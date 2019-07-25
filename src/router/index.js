import Vue from 'vue'
import Router from 'vue-router'
import Login from '@/views/login/login'
import Home from '@/views/home/home'
import About from '@/views/about/about'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Login',
      component: Login
    },
    {
      path: '/Home',
      name: 'Home',
      component: Home,
      // redirect :'/About',
      children :[
      	{
      		path : '/About',
      		name : 'About',
      		component : About
      	}
      ]
    }
  ]
})
