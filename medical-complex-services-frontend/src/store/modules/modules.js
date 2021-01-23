import axios from 'axios'

const state = {
  modules: []
}

const getters = {
  allModules: state => state.modules
}

const actions = {
  indexModules ({ commit }) {
    axios.get('modules').then(
      response => { commit('getModules', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  storeModule ({ commit }, module) {
    axios.post('modules', module).then(
      response => { commit('storeModule', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  updateModule ({ commit }, [moduleId, module]) {
    axios.put(`modules/${moduleId}`, module).then(
      response => { commit('updateModule', [moduleId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  deleteModule ({ commit }, moduleId) {
    axios.delete(`modules/${moduleId}`).then(
      response => { commit('deleteModule', moduleId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  }
}

const mutations = {
  getModules (state, modules) {
    state.modules = modules
  },

  storeModule (state, module) {
    state.modules.push(module)
  },

  updateModule (state, [moduleId, module]) {
    var moduleIndex = state.modules.findIndex((mod) => mod.id === moduleId)
    state.modules.splice(moduleIndex, 1, module)
  },

  deleteModule (state, moduleId) {
    state.modules = state.modules.filter((mod) => mod.id !== moduleId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
