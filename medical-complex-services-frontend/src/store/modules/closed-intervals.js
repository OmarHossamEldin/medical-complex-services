import axios from 'axios'

const state = {
  closedIntervals: []
}

const getters = {
  allClosedIntervals: state => state.closedIntervals
}

const actions = {
  indexClosedIntervals ({ commit }) {
    axios.get('closed-intervals').then(
      response => { commit('getClosedIntervals', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  storeClosedInterval ({ commit }, closedInterval) {
    axios.post('closed-intervals', closedInterval).then(
      response => { commit('storeClosedInterval', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  updateClosedInterval ({ commit }, [closedIntervalId, closedInterval]) {
    axios.put(`closed-intervals/${closedIntervalId}`, closedInterval).then(
      response => { commit('updateClosedInterval', [closedIntervalId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  deleteClosedInterval ({ commit }, closedIntervalId) {
    axios.delete(`closed-intervals/${closedIntervalId}`).then(
      response => { commit('deleteClosedInterval', closedIntervalId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  }
}

const mutations = {
  getClosedIntervals (state, closedIntervals) {
    state.closedIntervals = closedIntervals
  },

  storeClosedInterval (state, closedInterval) {
    state.closedIntervals.push(closedInterval)
  },

  updatebClosedInterval (state, [closedIntervalId, closedInterval]) {
    var closedIntervalIndex = state.closedIntervals.findIndex((closedInterval) => closedInterval.id === closedIntervalId)
    state.closedIntervals.splice(closedIntervalIndex, 1, closedInterval)
  },

  deleteClosedInterval (state, closedIntervalId) {
    state.closedIntervals = state.closedIntervals.filter((closedInterval) => closedInterval.id !== closedIntervalId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
