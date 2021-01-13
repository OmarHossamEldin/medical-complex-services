import axios from 'axios'

const state = {
  closedIntervals: []
}

const getters = {
  allClosedIntervals: state => state.closedIntervals
}

const actions = {
  indexClosedIntervals({ commit }) {
    axios.get("http://127.0.0.1:8000/api/closed-intervals").then(
      response => { commit('getClosedIntervals', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

    storeClosedInterval({ commit }, closedInterval) {
    axios.post("closed-intervals", closedInterval).then(
      response => { commit('storeClosedInterval', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  updateClosedInterval({ commit }, [closedIntervalId, closedInterval]) {

    axios.put(`closed-intervals/${closedIntervalId}`, closedInterval).then(
      response => { commit('updateClosedInterval', [closedIntervalId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  deleteBillingOption({ commit }, billingOptionId) {
    axios.delete(`billing-options/${billingOptionId}`).then(
      response => { commit('deleteBillingOption', billingOptionId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  }
}

const mutations = {
  getClosedIntervals(state, closedIntervals) {
    state.closedIntervals = closedIntervals
  },

  storeClosedInterval(state, closedInterval) {
    state.closedInterval.push(closedInterval)
  },

  updatebClosedInterval(state, [closedIntervalId, closedInterval]) {
    var billingOptionIndex = state.billingOption.findIndex((bil) => bil.id == billingOptionId)
    state.closedInterval.splice(closedIntervalIndex, 1, closedInterval)
  },

  deleteBillingOption(state, billingOptionId) {
    state.billingOption = state.billingOption.filter((fin) => fin.id != billingOptionId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
