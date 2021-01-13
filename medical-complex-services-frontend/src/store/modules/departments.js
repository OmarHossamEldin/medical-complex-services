import axios from 'axios'

const state = {
  departments: [],
}

const getters = {
  allDepartments: state => state.departments,
}

const actions = {
  indexDepartments({ commit }) {
    axios.get("http://127.0.0.1:8000/api/departments").then(
      response => { commit('getDepartments', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  storeDepartment({ commit }, department) {
    axios.post("departments", department).then(
      response => { commit('storeDepartment', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  updateDepartment({ commit }, [departmentId, department]) {

    axios.put(`departments/${departmentId}`, department).then(
      response => { commit('updateDepartment', [departmentId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  },

  deleteDepartment({ commit }, departmentId) {
    axios.delete(`departments/${departmentId}`).then(
      response => { commit('deleteDepartment', departmentId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors.name[0])
      })
  }
}

const mutations = {
  getDepartments(state, departments) {
    state.departments = departments
  },

  storeDepartment(state, department) {
    state.departments.push(department)
  },

  updateDepartment(state, [departmentId, department]) {
    var departmentIndex = state.departments.findIndex((dep) => dep.id == departmentId)
    state.departments.splice(departmentIndex, 1, department)
  },

  deleteDepartment(state, departmentId) {
    state.departments = state.departments.filter((dep) => dep.id != departmentId)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
