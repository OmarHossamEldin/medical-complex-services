import axios from 'axios'

const state = {
  financialCategories: []
}

const getters = {
  allFinancialCategories: state => state.financialCategories
}

const actions = {
  indexFinancialCategories ({ commit }) {
    axios.get('financial-categories').then(
      response => { commit('getFinancialCategories', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  storeFinancialCategories ({ commit }, financialCategories) {
    axios.post('financial-categories', financialCategories).then(
      response => { commit('storeFinancialCategories', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  updateFinancialCategories ({ commit }, [financialCategoriesId, financialCategories]) {
    axios.put(`financial-categories/${financialCategoriesId}`, financialCategories).then(
      response => { commit('updateFinancialCategories', [financialCategoriesId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  deleteFinancialCategories ({ commit }, financialCategoriesId) {
    axios.delete(`financial-categories/${financialCategoriesId}`).then(
      response => { commit('deleteFinancialCategories', financialCategoriesId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  }
}

const mutations = {
  getFinancialCategories (state, financialCategories) {
    state.financialCategories = financialCategories
  },

  storeFinancialCategories (state, financialCategories) {
    state.financialCategories.push(financialCategories)
  },

  updateFinancialCategories (state, [financialCategoriesId, financialCategories]) {
    var financialCategoriesIndex = state.financialCategories.findIndex((fin) => fin.id === financialCategoriesId)
    state.financialCategories.splice(financialCategoriesIndex, 1, financialCategories)
  },

  deleteFinancialCategories (state, financialCategoriesId) {
    state.financialCategories = state.financialCategories.filter((fin) => fin.id !== financialCategoriesId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
