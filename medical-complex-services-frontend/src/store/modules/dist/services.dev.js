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
  services: []
};
var getters = {
  allServices: function allServices(state) {
    return state.services;
  }
};
var actions = {
  indexServices: function indexServices(_ref) {
    var commit = _ref.commit;

    _axios["default"].get("http://127.0.0.1:8000/api/services").then(function (response) {
      commit('getServices', response.data[0]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  },
  storeService: function storeService(_ref2, service) {
    var commit = _ref2.commit;

    _axios["default"].post("services", service).then(function (response) {
      commit('storeService', response.data[0]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.ip[0] + error.response.data.errors.mac_address[0]);
    });
  },
  updateService: function updateService(_ref3, _ref4) {
    var commit = _ref3.commit;

    var _ref5 = _slicedToArray(_ref4, 2),
        serviceId = _ref5[0],
        service = _ref5[1];

    _axios["default"].put("services/".concat(serviceId), service).then(function (response) {
      commit('updateService', [serviceId, response.data[0]]);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.ip[0] + error.response.data.errors.mac_address[0]);
    });
  },
  deleteService: function deleteService(_ref6, serviceId) {
    var commit = _ref6.commit;

    _axios["default"]["delete"]("services/".concat(serviceId)).then(function (response) {
      commit('deleteService', serviceId);
    })["catch"](function (error) {
      commit('failingRequest', error.response.data.errors.name[0]);
    });
  }
};
var mutations = {
  getServices: function getServices(state, services) {
    state.services = services;
  },
  storeService: function storeService(state, service) {
    state.services.push(service);
  },
  updateService: function updateService(state, _ref7) {
    var _ref8 = _slicedToArray(_ref7, 2),
        serviceId = _ref8[0],
        service = _ref8[1];

    var serviceIndex = state.services.findIndex(function (serv) {
      return serv.id == serviceId;
    });
    state.services.splice(serviceIndex, 1, service);
  },
  deleteService: function deleteService(state, serviceId) {
    state.services = state.services.filter(function (serv) {
      return serv.id != serviceId;
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