import axios from 'axios'

const state = {
  stakeholders: []
}

const getters = {
  allStakeholders: state => state.stakeholders,
  stakeholdersOptions: state =>
    state.stakeholders.map(obj => {
      var optionsObj = {}
      optionsObj.label = obj.name
      optionsObj.value = obj.id
      return optionsObj
    })
}

const actions = {
  indexStakeholders ({ commit }) {
    axios.get('stakeholders').then(
      response => { commit('getStakeholders', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  storeStakeholder ({ commit }, stakeholder) {
    axios.post('stakeholders', stakeholder).then(
      response => { commit('storeStakeholder', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  updateStakeholder ({ commit }, [stakeholderId, stakeholder]) {
    axios.put(`stakeholders/${stakeholderId}`, stakeholder).then(
      response => { commit('updateStakeholder', [stakeholderId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  deleteStakeholder ({ commit }, stakeholderId) {
    axios.delete(`stakeholders/${stakeholderId}`).then(
      response => { commit('deleteStakeholder', stakeholderId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  }
}

const mutations = {
  getStakeholders (state, stakeholders) {
    state.stakeholders = stakeholders
  },

  storeStakeholder (state, stakeholder) {
    state.stakeholders.push(stakeholder)
  },

  updateStakeholder (state, [stakeholderId, stakeholder]) {
    var stakeholderIndex = state.stakeholders.findIndex((satkeholder) => satkeholder.id === stakeholderId)
    state.stakeholders.splice(stakeholderIndex, 1, stakeholder)
  },

  deleteStakeholder (state, stakeholderId) {
    state.stakeholders = state.stakeholders.filter((satkeholder) => satkeholder.id !== stakeholderId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
