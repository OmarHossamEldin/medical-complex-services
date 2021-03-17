"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _getRequireWildcardCache() { if (typeof WeakMap !== "function") return null; var cache = new WeakMap(); _getRequireWildcardCache = function _getRequireWildcardCache() { return cache; }; return cache; }

function _interopRequireWildcard(obj) { if (obj && obj.__esModule) { return obj; } if (obj === null || _typeof(obj) !== "object" && typeof obj !== "function") { return { "default": obj }; } var cache = _getRequireWildcardCache(); if (cache && cache.has(obj)) { return cache.get(obj); } var newObj = {}; var hasPropertyDescriptor = Object.defineProperty && Object.getOwnPropertyDescriptor; for (var key in obj) { if (Object.prototype.hasOwnProperty.call(obj, key)) { var desc = hasPropertyDescriptor ? Object.getOwnPropertyDescriptor(obj, key) : null; if (desc && (desc.get || desc.set)) { Object.defineProperty(newObj, key, desc); } else { newObj[key] = obj[key]; } } } newObj["default"] = obj; if (cache) { cache.set(obj, newObj); } return newObj; }

var routes = [{
  path: '/',
  component: function component() {
    return Promise.resolve().then(function () {
      return _interopRequireWildcard(require('layouts/MainLayout.vue'));
    });
  },
  children: [{
    path: '',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('pages/Index.vue'));
      });
    }
  }]
}, // Always leave this as last one,
// but you can also remove it
{
  path: '*',
  component: function component() {
    return Promise.resolve().then(function () {
      return _interopRequireWildcard(require('pages/Error404.vue'));
    });
  }
}, {
  path: '/admin',
  component: function component() {
    return Promise.resolve().then(function () {
      return _interopRequireWildcard(require('layouts/admin/AdminLayout.vue'));
    });
  },
  children: [{
    path: 'login',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('pages/admin/authentication/Login.vue'));
      });
    }
  }, {
    path: 'departments',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('pages/admin/departments/Index.vue'));
      });
    }
  }, {
    path: 'doctors',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('pages/admin/doctors/Index.vue'));
      });
    }
  }, {
    path: 'financial-categories',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('pages/admin/financial-categories/Index.vue'));
      });
    }
  }, {
    path: 'main-services',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('pages/admin/main-services/Index.vue'));
      });
    }
  }, {
    path: 'medical-services',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('pages/admin/medical-services/Index.vue'));
      });
    }
  }, {
    path: 'pcs',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('pages/admin/pcs/Index.vue'));
      });
    }
  }, {
    path: 'reports',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('pages/admin/reports/Index.vue'));
      });
    }
  }, {
    path: 'systemworkers',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('pages/admin/systemworkers/Index.vue'));
      });
    }
  }, {
    path: 'transactions',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('pages/admin/transactions/Index.vue'));
      });
    }
  }, {
    path: 'billing-option',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('pages/admin/billing-option/Index.vue'));
      });
    }
  }, {
    path: 'closed-interval',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('pages/admin/closed-interval/Index.vue'));
      });
    }
  }]
}, {
  path: '/admin-panel',
  component: function component() {
    return Promise.resolve().then(function () {
      return _interopRequireWildcard(require('layouts/admin/AdminLayout.vue'));
    });
  }
}];
var _default = routes;
exports["default"] = _default;