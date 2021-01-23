import axios from 'axios'

const state = {
  roles: []
}

const getters = {
  allRoles: state => state.roles,
  rolesOptions: state =>
    state.roles.map(obj => {
      var optionsObj = {}
      optionsObj.label = obj.name
      optionsObj.value = obj.id
      return optionsObj
    })
}

const actions = {
  indexRoles ({ commit }) {
    axios.get('roles').then(
      response => { commit('getRoles', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  storeRole ({ commit }, role) {
    axios.post('roles', role).then(
      response => { commit('storeRole', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  updateRole ({ commit }, [roleId, role]) {
    axios.put(`roles/${roleId}`, role).then(
      response => { commit('updateRole', [roleId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  deleteRole ({ commit }, roleId) {
    axios.delete(`roles/${roleId}`).then(
      response => { commit('deleteRole', roleId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  }
}

const mutations = {
  getRoles (state, roles) {
    state.roles = roles
  },

  storeRole (state, role) {
    state.roles.push(role)
  },

  updateRole (state, [roleId, role]) {
    var roleIndex = state.roles.findIndex((role) => role.id === roleId)
    state.roles.splice(roleIndex, 1, role)
  },

  deleteRole (state, roleId) {
    state.roles = state.roles.filter((role) => role.id !== roleId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
