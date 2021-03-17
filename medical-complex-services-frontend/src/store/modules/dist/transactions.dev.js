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
  transactions: []
};
var getters = {
  allTransactions: function allTransactions(state) {
    return state.transactions;
  }
};
var actions = {
  indexTransactions: function indexTransactions(_ref) {
    var commit = _ref.commit;

    _axios["default"].get("http://127.0.0.1:8000/api/transactions").then(function (response) {
      commit('getTransactions', response.data[0]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  storeTransaction: function storeTransaction(_ref2, transaction) {
    var commit = _ref2.commit;

    _axios["default"].post("transactions", transaction).then(function (response) {
      commit('storeTransaction', response.data[0]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  updateTransaction: function updateTransaction(_ref3, _ref4) {
    var commit = _ref3.commit;

    var _ref5 = _slicedToArray(_ref4, 2),
        transactionId = _ref5[0],
        transaction = _ref5[1];

    _axios["default"].put("transactions/".concat(transactionId), transaction).then(function (response) {
      commit('updateTransaction', [transactionId, response.data[0]]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  deleteTransaction: function deleteTransaction(_ref6, transactionId) {
    var commit = _ref6.commit;

    _axios["default"]["delete"]("transactions/".concat(transactionId)).then(function (response) {
      commit('deleteTransaction', transactionId);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  }
};
var mutations = {
  getTransactions: function getTransactions(state, transactions) {
    state.transactions = transactions;
  },
  storeTransaction: function storeTransaction(state, transaction) {
    state.transactions.push(transaction);
  },
  updateTransaction: function updateTransaction(state, _ref7) {
    var _ref8 = _slicedToArray(_ref7, 2),
        transactionId = _ref8[0],
        transaction = _ref8[1];

    var transactionIndex = state.transactions.findIndex(function (tran) {
      return tran.transaction_id == transactionId;
    });
    state.transactions.splice(transactionIndex, 1, transaction);
  },
  deleteTransaction: function deleteTransaction(state, transactionId) {
    state.transactions = state.transactions.filter(function (tran) {
      return tran.transaction_id != transactionId;
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