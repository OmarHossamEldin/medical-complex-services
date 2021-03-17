import axios from 'axios'

const state = {
  serviceTypes: []
}

const getters = {
  allServiceTypes: state => state.serviceTypes,
  serviceTypesOptions: state =>
    state.serviceTypes.map(obj => {
      var optionsObj = {}
      optionsObj.label = obj.name
      optionsObj.value = obj.id
      return optionsObj
    })
}

const actions = {
  indexServiceTypes ({ commit }) {
    axios.get('service-types').then(
      response => { commit('getServiceTypes', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  storeServiceType ({ commit }, serviceType) {
    axios.post('service-types', serviceType).then(
      response => { commit('storeServiceType', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  updateServiceType ({ commit }, [serviceTypeId, serviceType]) {
    axios.put(`service-types/${serviceTypeId}`, serviceType).then(
      response => { commit('updateServiceType', [serviceTypeId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  deleteServiceType ({ commit }, serviceTypeId) {
    axios.delete(`service-types/${serviceTypeId}`).then(
      response => { commit('deleteServiceType', serviceTypeId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  }
}

const mutations = {
  getServiceTypes (state, serviceTypes) {
    state.serviceTypes = serviceTypes
  },

  storeServiceType (state, serviceType) {
    state.serviceTypes.push(serviceType)
  },

  updateServiceType (state, [serviceTypeId, serviceType]) {
    var serviceTypeIndex = state.serviceTypes.findIndex((ser) => ser.id === serviceTypeId)
    state.serviceTypes.splice(serviceTypeIndex, 1, serviceType)
  },

  deleteServiceType (state, serviceTypeId) {
    state.serviceTypes = state.serviceTypes.filter((ser) => ser.id !== serviceTypeId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
