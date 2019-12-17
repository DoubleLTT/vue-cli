import Vue from 'vue'
import Router from 'vue-router'
import Login from '../views/login/login'
import Home from '../views/home/home'
import PlaceDetail from '../views/detail/place_detail'
import FoodDetail from '../views/detail/food_detail'
import Manager from '../views/manager/manager'

Vue.use(Router)

export default new Router({
  mode:'history',//去掉地址中的#
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home,
    },
    {
      path: '/PlaceDetail',
      name: 'PlaceDetail',
      component: PlaceDetail
    },
    {
      path: '/FoodDetail',
      name: 'FoodDetail',
      component: FoodDetail
    },
    {
      path: '/Login',
      name: 'Login',
      component: Login
    },
    {
      path: '/Manager',
      name: 'Manager',
      component: Manager
    },
  ]
})
