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
  closedIntervals: []
};
var getters = {
  allClosedIntervals: function allClosedIntervals(state) {
    return state.closedIntervals;
  }
};
var actions = {
  indexClosedIntervals: function indexClosedIntervals(_ref) {
    var commit = _ref.commit;

    _axios["default"].get("http://127.0.0.1:8000/api/closed-intervals").then(function (response) {
      commit('getClosedIntervals', response.data[0]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  storeClosedInterval: function storeClosedInterval(_ref2, closedInterval) {
    var commit = _ref2.commit;

    _axios["default"].post("closed-intervals", closedInterval).then(function (response) {
      commit('storeClosedInterval', response.data[0]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  updateClosedInterval: function updateClosedInterval(_ref3, _ref4) {
    var commit = _ref3.commit;

    var _ref5 = _slicedToArray(_ref4, 2),
        closedIntervalId = _ref5[0],
        closedInterval = _ref5[1];

    _axios["default"].put("closed-intervals/".concat(closedIntervalId), closedInterval).then(function (response) {
      commit('updateClosedInterval', [closedIntervalId, response.data[0]]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  deleteBillingOption: function deleteBillingOption(_ref6, billingOptionId) {
    var commit = _ref6.commit;

    _axios["default"]["delete"]("billing-options/".concat(billingOptionId)).then(function (response) {
      commit('deleteBillingOption', billingOptionId);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  }
};
var mutations = {
  getClosedIntervals: function getClosedIntervals(state, closedIntervals) {
    state.closedIntervals = closedIntervals;
  },
  storeClosedInterval: function storeClosedInterval(state, closedInterval) {
    state.closedInterval.push(closedInterval);
  },
  updatebClosedInterval: function updatebClosedInterval(state, _ref7) {
    var _ref8 = _slicedToArray(_ref7, 2),
        closedIntervalId = _ref8[0],
        closedInterval = _ref8[1];

    var billingOptionIndex = state.billingOption.findIndex(function (bil) {
      return bil.id == billingOptionId;
    });
    state.closedInterval.splice(closedIntervalIndex, 1, closedInterval);
  },
  deleteBillingOption: function deleteBillingOption(state, billingOptionId) {
    state.billingOption = state.billingOption.filter(function (fin) {
      return fin.id != billingOptionId;
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