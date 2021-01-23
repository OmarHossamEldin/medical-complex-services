import axios from 'axios'

const state = {
  doctors: []
}

const getters = {
  allDoctors: state => state.doctors
}

const actions = {
  indexDoctors ({ commit }) {
    axios.get('doctors').then(
      response => { commit('getDoctors', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  storeDoctor ({ commit }, doctor) {
    axios.post('doctors', doctor).then(
      response => { commit('storeDoctor', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  updateDoctor ({ commit }, [doctorId, doctor]) {
    axios.put(`doctors/${doctorId}`, doctor).then(
      response => { commit('updateDoctor', [doctorId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  deleteDoctor ({ commit }, doctorId) {
    axios.delete(`doctors/${doctorId}`).then(
      response => { commit('deleteDoctor', doctorId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  }
}

const mutations = {
  getDoctors (state, doctors) {
    state.doctors = doctors
  },

  storeDoctor (state, doctor) {
    state.doctors.push(doctor)
  },

  updateDoctor (state, [doctorId, doctor]) {
    var doctorIndex = state.doctors.findIndex((doc) => doc.system_worker_id === doctorId)
    state.doctors.splice(doctorIndex, 1, doctor)
  },

  deleteDoctor (state, doctorId) {
    state.doctors = state.doctors.filter((doc) => doc.system_worker_id !== doctorId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
