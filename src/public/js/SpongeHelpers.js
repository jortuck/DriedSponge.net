/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/SpongeHelpers.js":
/*!***************************************!*\
  !*** ./resources/js/SpongeHelpers.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

!function (t) {
  var o = {};

  function e(n) {
    if (o[n]) return o[n].exports;
    var r = o[n] = {
      i: n,
      l: !1,
      exports: {}
    };
    return t[n].call(r.exports, r, r.exports, e), r.l = !0, r.exports;
  }

  e.m = t, e.c = o, e.d = function (t, o, n) {
    e.o(t, o) || Object.defineProperty(t, o, {
      enumerable: !0,
      get: n
    });
  }, e.r = function (t) {
    "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {
      value: "Module"
    }), Object.defineProperty(t, "__esModule", {
      value: !0
    });
  }, e.t = function (t, o) {
    if (1 & o && (t = e(t)), 8 & o) return t;
    if (4 & o && "object" == _typeof(t) && t && t.__esModule) return t;
    var n = Object.create(null);
    if (e.r(n), Object.defineProperty(n, "default", {
      enumerable: !0,
      value: t
    }), 2 & o && "string" != typeof t) for (var r in t) {
      e.d(n, r, function (o) {
        return t[o];
      }.bind(null, r));
    }
    return n;
  }, e.n = function (t) {
    var o = t && t.__esModule ? function () {
      return t["default"];
    } : function () {
      return t;
    };
    return e.d(o, "a", o), o;
  }, e.o = function (t, o) {
    return Object.prototype.hasOwnProperty.call(t, o);
  }, e.p = "", e(e.s = 0);
}([function (t, o, e) {
  "use strict";

  e.r(o), window.$ = function () {
    for (var t = [], o = 0; o < arguments.length; o++) {
      t[o] = arguments[o];
    }

    if ("function" == typeof t[0]) {
      var e = t[0];
      console.log("Document loaded"), document.addEventListener("DOMContentLoaded", e);
    } else {
      if ("string" == typeof t[0]) {
        var r = t[0];
        return n.apply(document.querySelectorAll(r));
      }

      if (t[0] instanceof HTMLElement) return n.apply([t[0]]);
    }
  };

  var n = function n() {
    return n.prototype.queue = [], n.prototype.delayed = !1, n.prototype["this"] = this, n.prototype;
  };

  n.prototype.hide = function () {
    n.prototype["this"].forEach(function (t) {
      t.style.display = "none";
    });
  }, n.prototype.show = function () {
    n.prototype["this"].forEach(function (t) {
      t.style.display = " ";
    });
  }, n.prototype.css = function () {
    for (var t = [], o = 0; o < arguments.length; o++) {
      t[o] = arguments[o];
    }

    if ("string" == typeof t[0]) {
      var e = t[0],
          r = t[1];
      n.prototype["this"].forEach(function (t) {
        t.style[e] = r;
      });
    } else if ("object" == _typeof(t[0])) {
      var i = Object.entries(t[0]);
      n.prototype["this"].forEach(function (t) {
        i.forEach(function (o) {
          var e = o[0],
              n = o[1];
          t.style[e] = n;
        });
      });
    }
  }, n.prototype.addClass = function (t) {
    n.prototype["this"].forEach(function (o) {
      o.classList.add(t);
    });
  }, n.prototype.removeClass = function (t) {
    n.prototype["this"].forEach(function (o) {
      o.classList.remove(t);
    });
  }, n.prototype.on = function (t, o) {
    n.prototype["this"].forEach(function (e) {
      e.addEventListener(t, o);
    });
  }, n.prototype.submit = function (t) {
    n.prototype["this"].forEach(function (o) {
      o.addEventListener("submit", t);
    });
  }, n.prototype.click = function (t) {
    n.prototype["this"].forEach(function (o) {
      o.addEventListener("click", t);
    });
  }, n.prototype.val = function (t) {
    var o = n.prototype["this"][0];
    if ("string" != typeof t) return o.value;
    o.value = t;
  }, n.prototype.attr = function (t, o) {
    if (void 0 === o) return n.prototype["this"][0].getAttribute(t);
    n.prototype["this"].forEach(function (e) {
      e.setAttribute(t, o);
    });
  }, n.prototype.html = function (t) {
    n.prototype["this"].forEach(function (o) {
      o.innerHTML = t;
    });
  };
}]);

/***/ }),

/***/ 1:
/*!*********************************************!*\
  !*** multi ./resources/js/SpongeHelpers.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\info\resources\js\SpongeHelpers.js */"./resources/js/SpongeHelpers.js");


/***/ })

/******/ });