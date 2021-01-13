import axios from 'axios'

const state = {
  systemWorkers: []
}

const getters = {
  allSystemWorkers: state => state.systemWorkers
}

const actions = {
  indexSystemWorkers({ commit }) {
    axios.get("http://127.0.0.1:8000/api/system-workers").then(
      response => { commit('getSystemWorkers', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

    storeSystemWorker({ commit }, systemWorker) {
    axios.post("system-workers", systemWorker).then(
      response => { commit('storeSystemWorkers', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  updateSystemWorker({ commit }, [systemWorkerId, systemWorker]) {

    axios.put(`system-workers/${systemWorkerId}`, systemWorker).then(
      response => { commit('updateSystemWorker', [systemWorkerId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  deleteSystemWorker({ commit }, systemWorkerId) {
    axios.delete(`system-workers/${systemWorkerId}`).then(
      response => { commit('deleteSystemWorker', systemWorkerId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  }
}

const mutations = {
  getSystemWorkers(state, systemWorkers) {
    state.systemWorkers = systemWorkers
  },

  storeSystemWorkers(state, systemWorkers) {
    state.systemWorkers.push(systemWorkers)
  },

  updatebSystemWorker(state, [systemWorkerId, systemWorker]) {
    var systemWorkerIndex = state.systemWorker.findIndex((sys) => sys.stakeholder_id == systemWorkerId)
    state.systemWorker.splice(systemWorkerIndex, 1, systemWorker)
  },

  deleteSystemWorker(state, systemWorkerId) {
    state.systemWorker = state.systemWorker.filter((sys) => sys.stakeholder_id != systemWorkerId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
