import axios from 'axios'

const state = {
  billingOptions: []
}

const getters = {
  allBillingOptions: state => state.billingOptions
}

const actions = {
  indexBillingOptions({ commit }) {
    axios.get("http://127.0.0.1:8000/api/billing-options").then(
      response => { commit('getBillingOptions', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

    storeBillingOption({ commit }, billingOption) {
    axios.post("billing-options", billingOption).then(
      response => { commit('storeBillingOptions', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  updateBillingOption({ commit }, [billingOptionId, billingOption]) {

    axios.put(`billing-options/${billingOptionId}`, billingOption).then(
      response => { commit('updateBillingOption', [billingOptionId, response.data[0]]) }
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
  getBillingOptions(state, billingOptions) {
    state.billingOptions = billingOptions
  },

  storeBillingOptions(state, billingOptions) {
    state.billingOptions.push(billingOptions)
  },

  updatebBillingOption(state, [billingOptionId, billingOption]) {
    var billingOptionIndex = state.billingOption.findIndex((bil) => bil.id == billingOptionId)
    state.billingOption.splice(billingOptionIndex, 1, billingOption)
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
