import axios from 'axios'

const state = {
  reports: [],
  results: []
}

const getters = {
  allReports: state => state.reports,
  reportsOptions: state =>
    state.reports.map(obj => {
      var optionsObj = {}
      optionsObj.label = obj.name
      optionsObj.value = obj.id
      return optionsObj
    }),
  reportResults: state => state.results
}

const actions = {
  indexReports ({ commit }) {
    axios.get('reports').then(
      response => { commit('getReports', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  storeReport ({ commit }, report) {
    axios.post('reports', report).then(
      response => { commit('storeReport', response.data[0]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  updateReport ({ commit }, [reportId, report]) {
    axios.put(`reports/${reportId}`, report).then(
      response => { commit('updateReport', [reportId, response.data[0]]) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  deleteReport ({ commit }, reportId) {
    axios.delete(`reports/${reportId}`).then(
      response => { commit('deleteReport', reportId) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  },

  executeReport ({ commit }, [reportId, paramObject]) {
    axios.get(`reports/execute/${reportId}`, {
      params: paramObject
    }).then(
      response => { commit('executeReport', response.data) }
    )
      .catch(error => {
        commit('failingRequest', error.response.data.errors)
      })
  }
}

const mutations = {
  getReports (state, reports) {
    state.reports = reports
  },

  storeReport (state, report) {
    state.reports.push(report)
  },

  updateReport (state, [reportId, report]) {
    var reportIndex = state.reports.findIndex((report) => report.id === reportId)
    state.reports.splice(reportIndex, 1, report)
  },

  deleteReport (state, reportId) {
    state.reports = state.reports.filter((report) => report.id !== reportId)
  },

  executeReport (state, results) {
    state.results = results
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
