"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _axios = _interopRequireDefault(require("axios"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance"); }

function _iterableToArrayLimit(arr, i) { if (!(Symbol.iterator in Object(arr) || Object.prototype.toString.call(arr) === "[object Arguments]")) { return; } var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

var state = {
  doctors: []
};
var getters = {
  allDoctors: function allDoctors(state) {
    return state.doctors;
  }
};
var actions = {
  indexDoctors: function indexDoctors(_ref) {
    var commit = _ref.commit;

    _axios["default"].get("http://127.0.0.1:8000/api/doctors").then(function (response) {
      commit('getDoctors', response.data[0]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  storeDoctor: function storeDoctor(_ref2, doctor) {
    var commit = _ref2.commit;

    _axios["default"].post("doctors", doctor).then(function (response) {
      commit('storeDoctor', response.data[0]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  updateDoctor: function updateDoctor(_ref3, _ref4) {
    var commit = _ref3.commit;

    var _ref5 = _slicedToArray(_ref4, 2),
        systemWorkerId = _ref5[0],
        doctor = _ref5[1];

    _axios["default"].put("doctors/".concat(systemWorkerId), doctor).then(function (response) {
      commit('updateDoctor', [systemWorkerId, response.data[0]]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  deleteDoctor: function deleteDoctor(_ref6, systemWorkerId) {
    var commit = _ref6.commit;

    _axios["default"]["delete"]("doctors/".concat(systemWorkerId)).then(function (response) {
      commit('deleteDoctor', systemWorkerId);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  }
};
var mutations = {
  getDoctors: function getDoctors(state, doctors) {
    state.doctors = doctors;
  },
  storeDoctor: function storeDoctor(state, doctor) {
    state.doctors.push(doctor);
  },
  updateDoctor: function updateDoctor(state, _ref7) {
    var _ref8 = _slicedToArray(_ref7, 2),
        systemWorkerId = _ref8[0],
        doctor = _ref8[1];

    var doctorIndex = state.doctors.findIndex(function (doc) {
      return doc.system_worker_id == systemWorkerId;
    });
    state.doctors.splice(doctorIndex, 1, doctor);
  },
  deleteDoctor: function deleteDoctor(state, systemWorkerId) {
    state.doctors = state.doctors.filter(function (doc) {
      return doc.system_worker_id != systemWorkerId;
    });
  }
};
var _default = {
  state: state,
  getters: getters,
  actions: actions,
  mutations: mutations
};
exports["default"] = _default;