import axios from 'axios'

const state = {
  modules: [],
}

const getters = {
  allModules: state => state.modules,
}

const actions = {
  indexModules({ commit }) {
    axios.get("http://127.0.0.1:8000/api/modules").then(
      response => { commit('getModules', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  storeModule({ commit }, module) {
    axios.post("modules", module).then(
      response => { commit('storeModule', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  updateModule({ commit }, [moduleId, module]) {

    axios.put(`modules/${moduleId}`, module).then(
      response => { commit('updateModule', [moduleId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  deleteModule({ commit }, moduleId) {
    axios.delete(`modules/${moduleId}`).then(
      response => { commit('deleteModule', moduleId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  }
}

const mutations = {
  getModules(state, modules) {
    state.modules = modules
  },

  storeModule(state, module) {
    state.modules.push(module)
  },

  updateModule(state, [moduleId, module]) {
    var moduleIndex = state.modules.findIndex((mod) => mod.id == moduleId)
    state.modules.splice(moduleIndex, 1, module)
  },

  deleteModule(state, moduleId) {
    state.modules = state.modules.filter((mod) => mod.id != moduleId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
