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
  modules: []
};
var getters = {
  allModules: function allModules(state) {
    return state.modules;
  }
};
var actions = {
  indexModules: function indexModules(_ref) {
    var commit = _ref.commit;

    _axios["default"].get("http://127.0.0.1:8000/api/modules").then(function (response) {
      commit('getModules', response.data[0]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  storeModule: function storeModule(_ref2, module) {
    var commit = _ref2.commit;

    _axios["default"].post("modules", module).then(function (response) {
      commit('storeModule', response.data[0]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  updateModule: function updateModule(_ref3, _ref4) {
    var commit = _ref3.commit;

    var _ref5 = _slicedToArray(_ref4, 2),
        moduleId = _ref5[0],
        module = _ref5[1];

    _axios["default"].put("modules/".concat(moduleId), module).then(function (response) {
      commit('updateModule', [moduleId, response.data[0]]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  deleteModule: function deleteModule(_ref6, moduleId) {
    var commit = _ref6.commit;

    _axios["default"]["delete"]("modules/".concat(moduleId)).then(function (response) {
      commit('deleteModule', moduleId);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  }
};
var mutations = {
  getModules: function getModules(state, modules) {
    state.modules = modules;
  },
  storeModule: function storeModule(state, module) {
    state.modules.push(module);
  },
  updateModule: function updateModule(state, _ref7) {
    var _ref8 = _slicedToArray(_ref7, 2),
        moduleId = _ref8[0],
        module = _ref8[1];

    var moduleIndex = state.modules.findIndex(function (mod) {
      return mod.id == moduleId;
    });
    state.modules.splice(moduleIndex, 1, module);
  },
  deleteModule: function deleteModule(state, moduleId) {
    state.modules = state.modules.filter(function (mod) {
      return mod.id != moduleId;
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