import axios from 'axios'

const state = {
  priceTypes: []
}

const getters = {
  allPriceTypes: state => state.priceTypes,
  priceTypesOptions: state =>
    state.priceTypes.map(obj => {
      var optionsObj = {}
      optionsObj.label = obj.name
      optionsObj.value = obj.id
      return optionsObj
    })
}

const actions = {
  indexPriceTypes ({ commit }) {
    axios.get('price-types').then(
      response => { commit('getPriceTypes', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  storePriceType ({ commit }, priceType) {
    axios.post('price-types', priceType).then(
      response => { commit('storePriceType', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  updatePriceType ({ commit }, [priceTypeId, priceType]) {
    axios.put(`price-types/${priceTypeId}`, priceType).then(
      response => { commit('updatePriceType', [priceTypeId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  deletePriceType ({ commit }, priceTypeId) {
    axios.delete(`price-types/${priceTypeId}`).then(
      response => { commit('deletePriceType', priceTypeId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  }
}

const mutations = {
  getPriceTypes (state, priceTypes) {
    state.priceTypes = priceTypes
  },

  storePriceType (state, priceType) {
    state.priceTypes.push(priceType)
  },

  updatePriceType (state, [priceTypeId, priceType]) {
    var priceTypeIndex = state.priceTypes.findIndex((priceType) => priceType.id === priceTypeId)
    state.priceTypes.splice(priceTypeIndex, 1, priceType)
  },

  deletePriceType (state, priceTypeId) {
    state.priceTypes = state.priceTypes.filter((priceType) => priceType.id !== priceTypeId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
