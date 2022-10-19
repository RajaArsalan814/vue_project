import Vue from 'vue'

// axios
import axios from 'axios'

const axiosIns = axios.create({ 
  baseURL: 'http://phpstack-764354-2704405.cloudwaysapps.com/admin/public/api'
  // You can add your headers here
  // ================================
  // baseURL: 'https://some-domain.com/api/',
  // timeout: 1000,
  // headers: {'X-Custom-Header': 'foobar'}
})

Vue.prototype.$http = axiosIns

export default axiosIns
