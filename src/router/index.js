import Vue from 'vue'
import Router from 'vue-router'
import Login from '../views/login/login'
import Home from '../views/home/home'
import Place from '../views/home/component/Places'
import Food from '../views/home/component/Foods'
import Route from '../views/home/component/Routes'
import Advice from '../views/home/component/Advice'
import PlaceDetail from '../views/detail/place_detail'
import FoodDetail from '../views/detail/food_detail'
import RouteDetail from '../views/detail/route_detail'
import Manager from '../views/manager/manager'

Vue.use(Router)

export default new Router({
  mode:'history',//去掉地址中的#
  routes: [
    // {
    //   path: '/',
    //   name: 'Home',
    //   component: Home,
    // },
    {
      path: '/',
      name: 'Place',
      component: Place
    },
    {
      path: '/PlaceDetail',
      name: 'PlaceDetail',
      component: PlaceDetail
    },
    {
      path: '/Food',
      name: 'Food',
      component: Food
    },
    {
      path: '/FoodDetail',
      name: 'FoodDetail',
      component: FoodDetail
    },
    {
      path: '/Route',
      name: 'Route',
      component: Route
    },
    {
      path: '/RouteDetail',
      name: 'RouteDetail',
      component: RouteDetail
    },
    {
      path: '/Advice',
      name: 'Advice',
      component: Advice
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
