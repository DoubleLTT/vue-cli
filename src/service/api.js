import qs from 'qs'
import axios from 'axios'
const url='http://localhost:8081/myWeb/';

export const  register=(un,pw)=>{
  return axios({method:'post',url:url+'register.php',data:qs.stringify({name:un,password:pw})})
};
export const  login=(un,pw)=>{
  return axios({method:'post',url:url+'login.php',data:qs.stringify({name:un,password:pw})})
};
export const  getPics=(page,star,area,name)=>{
  return axios({method:'post',url:url+'places.php',data:qs.stringify({action:'getPics',n:page,star:star,area:area,name:name})})
};
//picture detail
export const  getPlaceDetail=(id)=>{
  return axios({method:'post',url:url+'places.php',data:qs.stringify({action:'getPlaceDetail',placeId:id})})
};
export const  getFoods=(page,menu,area)=>{
  return axios({method:'post',url:url+'foods.php',data:qs.stringify({action:'getFoods',n:page,menu:menu,area:area})})
};

//Advice
export const  getAdvice=()=>{
  return axios({method:'post',url:url+'articles.php',data:qs.stringify({action:'getArticles'})})
};
