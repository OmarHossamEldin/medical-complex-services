import axios from 'axios'

const state = {
  pcs: []
}

const getters = {
  allPcs: state => state.pcs
}

const actions = {
  indexPcs({ commit }) {
    axios.get("http://127.0.0.1:8000/api/pcs").then(
      response => { commit('getPcs', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  storePc({ commit }, pc) {
    axios.post("pcs", pc).then(
      response => { commit('storePc', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.ip[0] + error.response.data.errors.mac_address[0])
      })
  },

  updatePc({ commit }, [pcId, pc]) {

    axios.put(`pcs/${pcId}`, pc).then(
      response => { commit('updatePc', [pcId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.ip[0] + error.response.data.errors.mac_address[0])
      })
  },

  deletePc({ commit }, pcId) {
    axios.delete(`pcs/${pcId}`).then(
      response => { commit('deletePc', pcId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  }
}

const mutations = {
  getPcs(state, pcs) {
    state.pcs = pcs
  },

  storePc(state, pc) {
    state.pcs.push(pc)
  },

  updatePc(state, [pcId, pc]) {
    var pcIndex = state.pcs.findIndex((pcc) => pcc.id == pcId)
    state.pcs.splice(pcIndex, 1, pc)
  },

  deletePc(state, pcId) {
    state.pcs = state.pcs.filter((pcc) => pcc.id != pcId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
