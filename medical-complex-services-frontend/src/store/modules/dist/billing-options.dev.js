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
  billingOptions: []
};
var getters = {
  allBillingOptions: function allBillingOptions(state) {
    return state.billingOptions;
  }
};
var actions = {
  indexBillingOptions: function indexBillingOptions(_ref) {
    var commit = _ref.commit;

    _axios["default"].get("http://127.0.0.1:8000/api/billing-options").then(function (response) {
      commit('getBillingOptions', response.data[0]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  storeBillingOption: function storeBillingOption(_ref2, billingOption) {
    var commit = _ref2.commit;

    _axios["default"].post("billing-options", billingOption).then(function (response) {
      commit('storeBillingOptions', response.data[0]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  updateBillingOption: function updateBillingOption(_ref3, _ref4) {
    var commit = _ref3.commit;

    var _ref5 = _slicedToArray(_ref4, 2),
        billingOptionId = _ref5[0],
        billingOption = _ref5[1];

    _axios["default"].put("billing-options/".concat(billingOptionId), billingOption).then(function (response) {
      commit('updateBillingOption', [billingOptionId, response.data[0]]);
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
  getBillingOptions: function getBillingOptions(state, billingOptions) {
    state.billingOptions = billingOptions;
  },
  storeBillingOptions: function storeBillingOptions(state, billingOptions) {
    state.billingOptions.push(billingOptions);
  },
  updatebBillingOption: function updatebBillingOption(state, _ref7) {
    var _ref8 = _slicedToArray(_ref7, 2),
        billingOptionId = _ref8[0],
        billingOption = _ref8[1];

    var billingOptionIndex = state.billingOption.findIndex(function (bil) {
      return bil.id == billingOptionId;
    });
    state.billingOption.splice(billingOptionIndex, 1, billingOption);
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