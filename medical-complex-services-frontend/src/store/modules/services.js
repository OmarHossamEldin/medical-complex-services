import axios from 'axios'

const state = {
  services: []
}

const getters = {
  allServices: state => state.services,
  servicesOptions: state =>
    state.services.map(obj => {
      var optionsObj = {}
      optionsObj.label = obj.name
      optionsObj.value = obj.id
      return optionsObj
    })
}

const actions = {
  indexServices ({ commit }) {
    axios.get('services').then(
      response => { commit('getServices', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  storeService ({ commit }, service) {
    axios.post('services', service).then(
      response => { commit('storeService', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  updateService ({ commit }, [serviceId, service]) {
    axios.put(`services/${serviceId}`, service).then(
      response => { commit('updateService', [serviceId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  deleteService ({ commit }, serviceId) {
    axios.delete(`services/${serviceId}`).then(
      response => { commit('deleteService', serviceId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  }
}

const mutations = {
  getServices (state, services) {
    state.services = services
  },

  storeService (state, service) {
    state.services.push(service)
  },

  updateService (state, [serviceId, service]) {
    var serviceIndex = state.services.findIndex((serv) => serv.id === serviceId)
    state.services.splice(serviceIndex, 1, service)
  },

  deleteService (state, serviceId) {
    state.services = state.services.filter((serv) => serv.id !== serviceId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
