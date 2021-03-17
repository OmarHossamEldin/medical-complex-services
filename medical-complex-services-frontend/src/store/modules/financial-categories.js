import axios from 'axios'

const state = {
  financialCategories: []
}

const getters = {
  allFinancialCategories: state => state.financialCategories,
  financialCategoriesOptions: state =>
    state.financialCategories.map(obj => {
      var optionsObj = {}
      optionsObj.label = obj.name
      optionsObj.value = obj.id
      return optionsObj
    })
}

const actions = {
  indexFinancialCategories ({ commit }) {
    axios.get('financial-categories').then(
      response => { commit('getFinancialCategories', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  storeFinancialCategory ({ commit }, financialCategories) {
    axios.post('financial-categories', financialCategories).then(
      response => { commit('storeFinancialCategory', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  updateFinancialCategory ({ commit }, [financialCategoryId, financialCategories]) {
    axios.put(`financial-categories/${financialCategoryId}`, financialCategories).then(
      response => { commit('updateFinancialCategory', [financialCategoryId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  deleteFinancialCategory ({ commit }, financialCategoryId) {
    axios.delete(`financial-categories/${financialCategoryId}`).then(
      response => { commit('deleteFinancialCategory', financialCategoryId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  }
}

const mutations = {
  getFinancialCategories (state, financialCategories) {
    state.financialCategories = financialCategories
  },

  storeFinancialCategory (state, financialCategories) {
    state.financialCategories.push(financialCategories)
  },

  updateFinancialCategory (state, [financialCategoryId, financialCategories]) {
    var financialCategoriesIndex = state.financialCategories.findIndex((fin) => fin.id === financialCategoryId)
    state.financialCategories.splice(financialCategoriesIndex, 1, financialCategories)
  },

  deleteFinancialCategory (state, financialCategoryId) {
    state.financialCategories = state.financialCategories.filter((fin) => fin.id !== financialCategoryId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
