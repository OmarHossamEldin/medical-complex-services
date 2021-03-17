import Vue from 'vue'
import axios from 'axios'

axios.defaults.baseURL = 'http://127.0.0.1:8000/api/'
Vue.prototype.$axios = axios

const token = `Bearer ${localStorage.getItem('token')}`
if (token) {
  Vue.prototype.$axios.defaults.headers.common.Authorization = token
}
