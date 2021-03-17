"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

var _vue = _interopRequireDefault(require("vue"));

var _vuex = _interopRequireDefault(require("vuex"));

var _alerts = _interopRequireDefault(require("./modules/alerts"));

var _departments = _interopRequireDefault(require("./modules/departments"));

var _pcs = _interopRequireDefault(require("./modules/pcs"));

var _financialCategories = _interopRequireDefault(require("./modules/financial-categories"));

var _doctors = _interopRequireDefault(require("./modules/doctors"));

var _billingOptions = _interopRequireDefault(require("./modules/billing-options"));

var _transactions = _interopRequireDefault(require("./modules/transactions"));

var _modules = _interopRequireDefault(require("./modules/modules"));

var _services = _interopRequireDefault(require("./modules/services"));

var _closedIntervals = _interopRequireDefault(require("./modules/closed-intervals"));

var _systemWorkers = _interopRequireDefault(require("./modules/system-workers"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

_vue["default"].use(_vuex["default"]);
/*
 * If not building with SSR mode, you can
 * directly export the Store instantiation;
 *
 * The function below can be async too; either use
 * async/await or return a Promise which resolves
 * with the Store instance.
 */


function _default()
/* { ssrContext } */
{
  var Store = new _vuex["default"].Store({
    modules: {
      alerts: _alerts["default"],
      departments: _departments["default"],
      pcs: _pcs["default"],
      financial_categories: _financialCategories["default"],
      doctors: _doctors["default"],
      billing_options: _billingOptions["default"],
      transactions: _transactions["default"],
      modules: _modules["default"],
      services: _services["default"],
      closed_intervals: _closedIntervals["default"],
      system_workers: _systemWorkers["default"]
    },
    // enable strict mode (adds overhead!)
    // for dev mode only
    strict: process.env.DEBUGGING
  });
  return Store;
}