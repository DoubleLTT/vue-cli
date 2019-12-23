import qs from 'qs'
import axios from 'axios'
const url='http://localhost:8081/myWeb/';

export const  register=(un,pw)=>{
  return axios({method:'post',url:url+'register.php',data:qs.stringify({name:un,password:pw})})
};
export const  login=(un,pw)=>{
  return axios({method:'post',url:url+'login.php',data:qs.stringify({name:un,password:pw})})
};
//picture
export const  getPics=(page,star,area,name)=>{
  return axios({method:'post',url:url+'places.php',data:qs.stringify({action:'getPics',n:page,star:star,area:area,name:name})})
};
export const  getPlaceDetail=(id)=>{
  return axios({method:'post',url:url+'places.php',data:qs.stringify({action:'getPlaceDetail',placeId:id})})
};
//food
export const  getFoods=(page,menu,area,name)=>{
  return axios({method:'post',url:url+'foods.php',data:qs.stringify({action:'getFoods',n:page,menu:menu,area:area,name:name})})
};
export const  getFoodDetail=(id)=>{
  return axios({method:'post',url:url+'foods.php',data:qs.stringify({action:'getFoodDetail',foodId:id})})
};
//route
export const  getRoutes=(page)=>{
  return axios({method:'post',url:url+'routes.php',data:qs.stringify({action:'getRoutes',n:page})})
};
export const  getRouteDetail=(id)=>{
  return axios({method:'post',url:url+'routes.php',data:qs.stringify({action:'getRouteDetail',routeId:id})})
};
//Advice
export const  getAdvice=()=>{
  return axios({method:'post',url:url+'articles.php',data:qs.stringify({action:'getArticles'})})
};
