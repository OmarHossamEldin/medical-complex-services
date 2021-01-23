import axios from 'axios'

const state = {
  pcs: []
}

const getters = {
  allPcs: state => state.pcs,
  pcsOptions: state =>
    state.pcs.map(obj => {
      var optionsObj = {}
      optionsObj.label = obj.name
      optionsObj.value = obj.id
      return optionsObj
    })
}

const actions = {
  indexPcs ({ commit }) {
    axios.get('pcs').then(
      response => { commit('getPcs', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  storePc ({ commit }, pc) {
    axios.post('pcs', pc).then(
      response => { commit('storePc', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  updatePc ({ commit }, [pcId, pc]) {
    axios.put(`pcs/${pcId}`, pc).then(
      response => { commit('updatePc', [pcId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  deletePc ({ commit }, pcId) {
    axios.delete(`pcs/${pcId}`).then(
      response => { commit('deletePc', pcId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  }
}

const mutations = {
  getPcs (state, pcs) {
    state.pcs = pcs
  },

  storePc (state, pc) {
    state.pcs.push(pc)
  },

  updatePc (state, [pcId, pc]) {
    var pcIndex = state.pcs.findIndex((pcc) => pcc.id === pcId)
    state.pcs.splice(pcIndex, 1, pc)
  },

  deletePc (state, pcId) {
    state.pcs = state.pcs.filter((pcc) => pcc.id !== pcId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
