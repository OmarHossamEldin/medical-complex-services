const state = {
  errorMessage: '',
  requestFailed: false
}

const getters = {
  getErrorMessage: state => state.errorMessage,
  getRequestFailed: state => state.requestFailed
}

const mutations = {
  failingRequest (state, errorMessage) {
    console.log(errorMessage)
    state.errorMessage = errorMessage
    state.requestFailed = true
  },

  setFailingRequest (state, value) {
    state.requestFailed = value
  }
}

export default {
  state,
  getters,
  mutations
}
