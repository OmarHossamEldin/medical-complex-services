import axios from 'axios'

const state = {
  ranks: []
}

const getters = {
  allRanks: state => state.ranks,
  ranksOptions: state =>
    state.ranks.map(obj => {
      var optionsObj = {}
      optionsObj.label = obj.name
      optionsObj.value = obj.id
      return optionsObj
    })
}

const actions = {
  indexRanks ({ commit }) {
    axios.get('ranks').then(
      response => { commit('getRanks', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  storeRank ({ commit }, rank) {
    axios.post('ranks', rank).then(
      response => { commit('storeRank', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  updateRank ({ commit }, [rankId, rank]) {
    axios.put(`ranks/${rankId}`, rank).then(
      response => { commit('updateRank', [rankId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  deleteRank ({ commit }, rankId) {
    axios.delete(`ranks/${rankId}`).then(
      response => { commit('deleteRank', rankId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  }
}

const mutations = {
  getRanks (state, ranks) {
    state.ranks = ranks
  },

  storeRank (state, rank) {
    state.ranks.push(rank)
  },

  updateRank (state, [rankId, rank]) {
    var rankIndex = state.ranks.findIndex((rank) => rank.id === rankId)
    state.ranks.splice(rankIndex, 1, rank)
  },

  deleteRank (state, rankId) {
    state.ranks = state.ranks.filter((rank) => rank.id !== rankId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
