import axios from 'axios'

const state = {
  billingOptions: []
}

const getters = {
  allBillingOptions: state => state.billingOptions,
  billingOptionsOptions: state =>
    state.billingOptions.map(obj => {
      var optionsObj = {}
      optionsObj.label = obj.name
      optionsObj.value = obj.id
      return optionsObj
    })
}

const actions = {
  indexBillingOptions ({ commit }) {
    axios.get('billing-options').then(
      response => { commit('getBillingOptions', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  storeBillingOption ({ commit }, billingOption) {
    axios.post('billing-options', billingOption).then(
      response => { commit('storeBillingOption', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  updateBillingOption ({ commit }, [billingOptionId, billingOption]) {
    axios.put(`billing-options/${billingOptionId}`, billingOption).then(
      response => { commit('updateBillingOption', [billingOptionId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  deleteBillingOption ({ commit }, billingOptionId) {
    axios.delete(`billing-options/${billingOptionId}`).then(
      response => { commit('deleteBillingOption', billingOptionId) }
    )
      .catch(error => {
        console.log(error)
        commit('failingRequest', error.response.data.errors)
      })
  }
}

const mutations = {
  getBillingOptions (state, billingOptions) {
    state.billingOptions = billingOptions
  },

  storeBillingOption (state, billingOption) {
    state.billingOptions.push(billingOption)
  },

  updateBillingOption (state, [billingOptionId, billingOption]) {
    var billingOptionIndex = state.billingOptions.findIndex((bil) => bil.id === billingOptionId)
    state.billingOptions.splice(billingOptionIndex, 1, billingOption)
  },

  deleteBillingOption (state, billingOptionId) {
    state.billingOptions = state.billingOptions.filter((fin) => fin.id !== billingOptionId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
