import axios from 'axios'

const state = {
  user: JSON.parse(localStorage.getItem('user')) || null,
  status: false,
  token: localStorage.getItem('token') || '',
  role: '',
  permissions: []
}

const getters = {
  isLoggedIn: state => !!state.token,
  authStatus: state => state.status,
  user: state => state.user
}

const actions = {
  login ({ commit }, [username, password]) {
    return new Promise((resolve, reject) => {
      commit('auth_request')
      axios.post('login', { username: username, password: password })
        .then(response => {
          const token = response.data.api_token
          const user = response.data.user
          localStorage.setItem('token', token)
          localStorage.setItem('user', JSON.stringify(user))
          axios.defaults.headers.common.Authorization = `Bearer ${token}`
          commit('auth_success', [token, user])
          resolve(response)
        })
        .catch(error => {
          commit('auth_error')
          localStorage.removeItem('token')
          localStorage.removeItem('user')
          commit('failingRequest', error.response.data.errors)
          reject(error)
        })
    })
  },
  logout ({ commit }) {
    return new Promise((resolve, reject) => {
      commit('logout')
      localStorage.removeItem('token')
      localStorage.removeItem('user')
      delete axios.defaults.headers.common.Authorization
      resolve()
    })
  }
}

const mutations = {
  auth_request (state) {
    state.status = 'loading'
  },
  auth_success (state, [token, user]) {
    state.status = 'success'
    state.token = token
    state.user = user
  },
  auth_error (state) {
    state.status = 'error'
  },
  logout (state) {
    state.status = ''
    state.token = ''
    state.user = null
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
