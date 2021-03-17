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
  departments: []
};
var getters = {
  allDepartments: function allDepartments(state) {
    return state.departments;
  }
};
var actions = {
  indexDepartments: function indexDepartments(_ref) {
    var commit = _ref.commit;

    _axios["default"].get("http://127.0.0.1:8000/api/departments").then(function (response) {
      commit('getDepartments', response.data[0]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  storeDepartment: function storeDepartment(_ref2, department) {
    var commit = _ref2.commit;

    _axios["default"].post("departments", department).then(function (response) {
      commit('storeDepartment', response.data[0]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  updateDepartment: function updateDepartment(_ref3, _ref4) {
    var commit = _ref3.commit;

    var _ref5 = _slicedToArray(_ref4, 2),
        departmentId = _ref5[0],
        department = _ref5[1];

    _axios["default"].put("departments/".concat(departmentId), department).then(function (response) {
      commit('updateDepartment', [departmentId, response.data[0]]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  deleteDepartment: function deleteDepartment(_ref6, departmentId) {
    var commit = _ref6.commit;

    _axios["default"]["delete"]("departments/".concat(departmentId)).then(function (response) {
      commit('deleteDepartment', departmentId);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  }
};
var mutations = {
  getDepartments: function getDepartments(state, departments) {
    state.departments = departments;
  },
  storeDepartment: function storeDepartment(state, department) {
    state.departments.push(department);
  },
  updateDepartment: function updateDepartment(state, _ref7) {
    var _ref8 = _slicedToArray(_ref7, 2),
        departmentId = _ref8[0],
        department = _ref8[1];

    var departmentIndex = state.departments.findIndex(function (dep) {
      return dep.id == departmentId;
    });
    state.departments.splice(departmentIndex, 1, department);
  },
  deleteDepartment: function deleteDepartment(state, departmentId) {
    state.departments = state.departments.filter(function (dep) {
      return dep.id != departmentId;
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