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
  systemWorkers: []
};
var getters = {
  allSystemWorkers: function allSystemWorkers(state) {
    return state.systemWorkers;
  }
};
var actions = {
  indexSystemWorkers: function indexSystemWorkers(_ref) {
    var commit = _ref.commit;

    _axios["default"].get("http://127.0.0.1:8000/api/system-workers").then(function (response) {
      commit('getSystemWorkers', response.data[0]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  storeSystemWorker: function storeSystemWorker(_ref2, systemWorker) {
    var commit = _ref2.commit;

    _axios["default"].post("system-workers", systemWorker).then(function (response) {
      commit('storeSystemWorkers', response.data[0]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  updateSystemWorker: function updateSystemWorker(_ref3, _ref4) {
    var commit = _ref3.commit;

    var _ref5 = _slicedToArray(_ref4, 2),
        systemWorkerId = _ref5[0],
        systemWorker = _ref5[1];

    _axios["default"].put("system-workers/".concat(systemWorkerId), systemWorker).then(function (response) {
      commit('updateSystemWorker', [systemWorkerId, response.data[0]]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  deleteSystemWorker: function deleteSystemWorker(_ref6, systemWorkerId) {
    var commit = _ref6.commit;

    _axios["default"]["delete"]("system-workers/".concat(systemWorkerId)).then(function (response) {
      commit('deleteSystemWorker', systemWorkerId);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  }
};
var mutations = {
  getSystemWorkers: function getSystemWorkers(state, systemWorkers) {
    state.systemWorkers = systemWorkers;
  },
  storeSystemWorkers: function storeSystemWorkers(state, systemWorkers) {
    state.systemWorkers.push(systemWorkers);
  },
  updatebSystemWorker: function updatebSystemWorker(state, _ref7) {
    var _ref8 = _slicedToArray(_ref7, 2),
        systemWorkerId = _ref8[0],
        systemWorker = _ref8[1];

    var systemWorkerIndex = state.systemWorker.findIndex(function (sys) {
      return sys.stakeholder_id == systemWorkerId;
    });
    state.systemWorker.splice(systemWorkerIndex, 1, systemWorker);
  },
  deleteSystemWorker: function deleteSystemWorker(state, systemWorkerId) {
    state.systemWorker = state.systemWorker.filter(function (sys) {
      return sys.stakeholder_id != systemWorkerId;
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