import axios from 'axios'

const state = {
  transactions: []
}

const getters = {
  allTransactions: state => state.transactions
}

const actions = {
  indexTransactions ({ commit }) {
    axios.get('transactions').then(
      response => { commit('getTransactions', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  storeTransaction ({ commit }, transaction) {
    axios.post('transactions', transaction).then(
      response => { commit('storeTransaction', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  updateTransaction ({ commit }, [transactionId, transaction]) {
    axios.put(`transactions/${transactionId}`, transaction).then(
      response => { commit('updateTransaction', [transactionId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  deleteTransaction ({ commit }, transactionId) {
    axios.delete(`transactions/${transactionId}`).then(
      response => { commit('deleteTransaction', transactionId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  }
}

const mutations = {
  getTransactions (state, transactions) {
    state.transactions = transactions
  },

  storeTransaction (state, transaction) {
    state.transactions.push(transaction)
  },

  updateTransaction (state, [transactionId, transaction]) {
    var transactionIndex = state.transactions.findIndex((tran) => tran.id === transactionId)
    state.transactions.splice(transactionIndex, 1, transaction)
  },

  deleteTransaction (state, transactionId) {
    state.transactions = state.transactions.filter((tran) => tran.id !== transactionId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
