import axios from 'axios'

const state = {
  doctors: [],
}

const getters = {
  allDoctors: state => state.doctors,
}

const actions = {
  indexDoctors({ commit }) {
    axios.get("http://127.0.0.1:8000/api/doctors").then(
      response => { commit('getDoctors', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  storeDoctor({ commit }, doctor) {
    axios.post("doctors", doctor).then(
      response => { commit('storeDoctor', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  updateDoctor({ commit }, [systemWorkerId, doctor]) {

    axios.put(`doctors/${systemWorkerId}`, doctor).then(
      response => { commit('updateDoctor', [systemWorkerId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  deleteDoctor({ commit }, systemWorkerId) {
    axios.delete(`doctors/${systemWorkerId}`).then(
      response => { commit('deleteDoctor', systemWorkerId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  }
}

const mutations = {
  getDoctors(state, doctors) {
    state.doctors = doctors
  },

  storeDoctor(state, doctor) {
    state.doctors.push(doctor)
  },

  updateDoctor(state, [systemWorkerId, doctor]) {
    var doctorIndex = state.doctors.findIndex((doc) => doc.system_worker_id == systemWorkerId)
    state.doctors.splice(doctorIndex, 1, doctor)
  },

  deleteDoctor(state, systemWorkerId) {
    state.doctors = state.doctors.filter((doc) => doc.system_worker_id != systemWorkerId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
