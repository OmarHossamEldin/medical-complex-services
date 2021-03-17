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
  pcs: []
};
var getters = {
  allPcs: function allPcs(state) {
    return state.pcs;
  }
};
var actions = {
  indexPcs: function indexPcs(_ref) {
    var commit = _ref.commit;

    _axios["default"].get("http://127.0.0.1:8000/api/pcs").then(function (response) {
      commit('getPcs', response.data[0]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  storePc: function storePc(_ref2, pc) {
    var commit = _ref2.commit;

    _axios["default"].post("pcs", pc).then(function (response) {
      commit('storePc', response.data[0]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.ip[0] + error.response.data.errors.mac_address[0]);
    });
  },
  updatePc: function updatePc(_ref3, _ref4) {
    var commit = _ref3.commit;

    var _ref5 = _slicedToArray(_ref4, 2),
        pcId = _ref5[0],
        pc = _ref5[1];

    _axios["default"].put("pcs/".concat(pcId), pc).then(function (response) {
      commit('updatePc', [pcId, response.data[0]]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.ip[0] + error.response.data.errors.mac_address[0]);
    });
  },
  deletePc: function deletePc(_ref6, pcId) {
    var commit = _ref6.commit;

    _axios["default"]["delete"]("pcs/".concat(pcId)).then(function (response) {
      commit('deletePc', pcId);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  }
};
var mutations = {
  getPcs: function getPcs(state, pcs) {
    state.pcs = pcs;
  },
  storePc: function storePc(state, pc) {
    state.pcs.push(pc);
  },
  updatePc: function updatePc(state, _ref7) {
    var _ref8 = _slicedToArray(_ref7, 2),
        pcId = _ref8[0],
        pc = _ref8[1];

    var pcIndex = state.pcs.findIndex(function (pcc) {
      return pcc.id == pcId;
    });
    state.pcs.splice(pcIndex, 1, pc);
  },
  deletePc: function deletePc(state, pcId) {
    state.pcs = state.pcs.filter(function (pcc) {
      return pcc.id != pcId;
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