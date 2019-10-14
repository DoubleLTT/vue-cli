import qs from 'qs'
import axios from 'axios'
const url='http://localhost:8081/myWeb/';

export const  getPics=(page)=>{
  return axios({method:'post',url:url+'places.php',data:qs.stringify({action:'getPics',n:page})})
};
//picture detail
export const  getPlaceDetail=(id)=>{
  return axios({method:'post',url:url+'places.php',data:qs.stringify({action:'getPlaceDetail',placeId:id})})
};
//Advice
export const  getAdvice=()=>{
  return axios({method:'post',url:url+'articles.php',data:qs.stringify({action:'getArticles'})})
};
