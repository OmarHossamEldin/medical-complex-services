import axios from 'axios'

const state = {
  transactions: []
}

const getters = {
  allTransactions: state => state.transactions
}

const actions = {
  indexTransactions({ commit }) {
    axios.get("http://127.0.0.1:8000/api/transactions").then(
      response => { commit('getTransactions', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  storeTransaction({ commit }, transaction) {
    axios.post("transactions", transaction).then(
      response => { commit('storeTransaction', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  updateTransaction({ commit }, [transactionId, transaction]) {

    axios.put(`transactions/${transactionId}`, transaction).then(
      response => { commit('updateTransaction', [transactionId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  deleteTransaction({ commit }, transactionId) {
    axios.delete(`transactions/${transactionId}`).then(
      response => { commit('deleteTransaction', transactionId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  }
}

const mutations = {
  getTransactions(state, transactions) {
    state.transactions = transactions
  },

  storeTransaction(state, transaction) {
    state.transactions.push(transaction)
  },

  updateTransaction(state, [transactionId, transaction]) {
    var transactionIndex = state.transactions.findIndex((tran) => tran.transaction_id == transactionId)
    state.transactions.splice(transactionIndex, 1, transaction)
  },

  deleteTransaction(state, transactionId) {
    state.transactions = state.transactions.filter((tran) => tran.transaction_id != transactionId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
