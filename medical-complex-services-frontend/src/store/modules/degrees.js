import axios from 'axios'

const state = {
  degrees: []
}

const getters = {
  allDegrees: state => state.degrees,
  degreesOptions: state =>
    state.degrees.map(obj => {
      var optionsObj = {}
      optionsObj.label = obj.name
      optionsObj.value = obj.id
      return optionsObj
    })
}

const actions = {
  indexDegrees ({ commit }) {
    axios.get('degrees').then(
      response => { commit('getDegrees', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  storeDegree ({ commit }, degree) {
    axios.post('degrees', degree).then(
      response => { commit('storeDegree', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  updateDegree ({ commit }, [degreeId, degree]) {
    axios.put(`degrees/${degreeId}`, degree).then(
      response => { commit('updateDegree', [degreeId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  deleteDegree ({ commit }, degreeId) {
    axios.delete(`degrees/${degreeId}`).then(
      response => { commit('deleteDegree', degreeId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  }
}

const mutations = {
  getDegrees (state, degrees) {
    state.degrees = degrees
  },

  storeDegree (state, degree) {
    state.degrees.push(degree)
  },

  updateDegree (state, [degreeId, degree]) {
    var degreeIndex = state.degrees.findIndex((deg) => deg.id === degreeId)
    state.degrees.splice(degreeIndex, 1, degree)
  },

  deleteDegree (state, degreeId) {
    state.degrees = state.degrees.filter((deg) => deg.id !== degreeId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
