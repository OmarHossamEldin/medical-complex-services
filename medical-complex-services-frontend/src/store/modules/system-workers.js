import axios from 'axios'

const state = {
  systemWorkers: []
}

const getters = {
  allSystemWorkers: state => state.systemWorkers,
  systemWorkersOptions: state =>
    state.systemWorkers.map(obj => {
      var optionsObj = {}
      optionsObj.label = obj.username
      optionsObj.value = obj.id
      return optionsObj
    })
}

const actions = {
  indexSystemWorkers ({ commit }) {
    axios.get('system-workers').then(
      response => { commit('getSystemWorkers', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  storeSystemWorker ({ commit }, systemWorker) {
    axios.post('system-workers', systemWorker).then(
      response => { commit('storeSystemWorkers', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  updateSystemWorker ({ commit }, [systemWorkerId, systemWorker]) {
    axios.put(`system-workers/${systemWorkerId}`, systemWorker).then(
      response => { commit('updateSystemWorker', [systemWorkerId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  deleteSystemWorker ({ commit }, systemWorkerId) {
    axios.delete(`system-workers/${systemWorkerId}`).then(
      response => { commit('deleteSystemWorker', systemWorkerId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  }
}

const mutations = {
  getSystemWorkers (state, systemWorkers) {
    state.systemWorkers = systemWorkers
  },

  storeSystemWorkers (state, systemWorkers) {
    state.systemWorkers.push(systemWorkers)
  },

  updatebSystemWorker (state, [systemWorkerId, systemWorker]) {
    var systemWorkerIndex = state.systemWorkers.findIndex((sys) => sys.stakeholder_id === systemWorkerId)
    state.systemWorkers.splice(systemWorkerIndex, 1, systemWorker)
  },

  deleteSystemWorker (state, systemWorkerId) {
    state.systemWorkers = state.systemWorkers.filter((sys) => sys.stakeholder_id !== systemWorkerId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
