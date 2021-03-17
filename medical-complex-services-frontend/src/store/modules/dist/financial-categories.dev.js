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
  financialCategories: []
};
var getters = {
  allFinancialCategories: function allFinancialCategories(state) {
    return state.financialCategories;
  }
};
var actions = {
  indexFinancialCategories: function indexFinancialCategories(_ref) {
    var commit = _ref.commit;

    _axios["default"].get("http://127.0.0.1:8000/api/financial-categories").then(function (response) {
      commit('getFinancialCategories', response.data[0]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  storeFinancialCategories: function storeFinancialCategories(_ref2, financialCategories) {
    var commit = _ref2.commit;

    _axios["default"].post("financial-categories", financialCategories).then(function (response) {
      commit('storeFinancialCategories', response.data[0]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  updateFinancialCategories: function updateFinancialCategories(_ref3, _ref4) {
    var commit = _ref3.commit;

    var _ref5 = _slicedToArray(_ref4, 2),
        financialCategoriesId = _ref5[0],
        financialCategories = _ref5[1];

    _axios["default"].put("financial-categories/".concat(financialCategoriesId), financialCategories).then(function (response) {
      commit('updateFinancialCategories', [financialCategoriesId, response.data[0]]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  deleteFinancialCategories: function deleteFinancialCategories(_ref6, financialCategoriesId) {
    var commit = _ref6.commit;

    _axios["default"]["delete"]("financial-categories/".concat(financialCategoriesId)).then(function (response) {
      commit('deleteFinancialCategories', financialCategoriesId);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  }
};
var mutations = {
  getFinancialCategories: function getFinancialCategories(state, financialCategories) {
    state.financialCategories = financialCategories;
  },
  storeFinancialCategories: function storeFinancialCategories(state, financialCategories) {
    state.financialCategories.push(financialCategories);
  },
  updateFinancialCategories: function updateFinancialCategories(state, _ref7) {
    var _ref8 = _slicedToArray(_ref7, 2),
        financialCategoriesId = _ref8[0],
        financialCategories = _ref8[1];

    var financialCategoriesIndex = state.financialCategories.findIndex(function (fin) {
      return fin.id == financialCategoriesId;
    });
    state.financialCategories.splice(financialCategoriesIndex, 1, financialCategories);
  },
  deleteFinancialCategories: function deleteFinancialCategories(state, financialCategoriesId) {
    state.financialCategories = state.financialCategories.filter(function (fin) {
      return fin.id != financialCategoriesId;
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