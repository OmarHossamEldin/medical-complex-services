"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;
var state = {
  errorMessage: "",
  requestFailed: false
};
var getters = {
  getErrorMessage: function getErrorMessage(state) {
    return state.errorMessage;
  },
  getRequestFailed: function getRequestFailed(state) {
    return state.requestFailed;
  }
};
var mutations = {
  failingRequest: function failingRequest(state, errorMessage) {
    state.errorMessage = errorMessage;
    state.requestFailed = true;
  },
  setFailingRequest: function setFailingRequest(state, value) {
    state.requestFailed = value;
  }
};
var _default = {
  state: state,
  getters: getters,
  mutations: mutations
};
exports["default"] = _default;