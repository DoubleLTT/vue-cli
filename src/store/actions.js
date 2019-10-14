import {action_login} from '../service/api.js' //接口集中管理文件
//import * as types from './mutation-types'
export const getData = function ({commit, state}, {list, index}) {
  commit(types.SET_TIP_INFOR, {tipFlag: false, tipMsg: ''})
};

export const actionTest = function ({commit, state}, data) {
  action_login({
    //url: 'getPhoneCode.php',
    data: JSON.stringify({
      'phone': '18862533985'
    })
  })
    .then(response => {
      console.log(response.data)
     // commit(types.SET_ALERT_FLAG, {state: true, type: ''})
    })
};
