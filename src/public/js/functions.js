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

/***/ "./resources/js/functions.js":
/*!***********************************!*\
  !*** ./resources/js/functions.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.Validate = function Validate(inputid, showmsg) {
  if (showmsg == null) {
    showmsg = false;
  }

  var feedbackid = $(inputid).attr("feedback");
  $(feedbackid).addClass("valid-feedback");
  $(feedbackid).removeClass("invalid-feedback");

  if (showmsg) {
    $(feedbackid).html("Looks good!");
  } else {
    $(feedbackid).html("");
  }

  $(inputid).removeClass("is-invalid");
  $(inputid).addClass("is-valid");
};

window.InValidate = function InValidate(inputid, msg) {
  var feedbackid = $(inputid).attr("feedback");
  $(inputid).addClass("is-invalid");
  $(feedbackid).addClass("invalid-feedback");
  $(feedbackid).html(msg);
};

window.Loading = function Loading(show, id) {
  if (show) {
    $(id).removeClass("d-none");
    $(id).html("<div class=\"text-center\"><div class=\"spinner-border text-primary \" role=\"status\"><span class=\"sr-only\">Loading...</span></div><br><p class=\"paragraph\"><b>Loading...</b></p></div>");
  } else {
    $(id).addClass("d-none");
  }
};

window.AlertSuccess = function AlertSuccess(msg) {
  toastr["success"](msg, "Congratulations!");
};

window.AlertError = function AlertError(msg) {
  toastr["error"](msg, "Error!");
};

window.Copy = function Copy(string) {
  navigator.clipboard.writeText(string);
  AlertMaterializeSuccess('Copied!');
};

window.getCookie = function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');

  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];

    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }

    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }

  return "";
};

window.MaterialInvalidate = function MaterialInvalidate(id, msg) {
  console.log(msg);
  $("".concat(id, " + label + span")).attr('data-error', msg);
  $(id).removeClass('valid');
  $(id).addClass('invalid');
};

window.MaterialValidate = function MaterialValidate(id) {
  $(id).removeClass('invalid');
  $(id).addClass('valid');
};

window.AlertMaterializeSuccess = function AlertMaterializeSuccess(msg) {
  M.toast({
    html: msg,
    classes: 'green'
  });
};

window.AlertMaterializeError = function AlertMaterializeError(msg) {
  M.toast({
    html: msg,
    classes: 'red'
  });
};

window.setCookie = function setCookie(name, value) {
  var d = new Date();
  d.setTime(d.getTime() + 365 * 24 * 60 * 60 * 1000);
  var expires = "expires=" + d.toUTCString();
  document.cookie = name + "=" + value + ";" + expires + ";path=/";
};

$(function () {
  $('.click-to-reveal').click(function () {
    console.log($(this).data('revealed'));

    if ($(this).attr('data-revealed') === 'false') {
      $(this).text($(this).data('reveal-content'));
      $(this).attr('data-revealed', 'true');
      console.log('set true');
    } else {
      console.log('set false');
      $(this).attr('data-revealed', false);
      $(this).html('Click to reveal');
    }
  });
});

/***/ }),

/***/ 1:
/*!*****************************************!*\
  !*** multi ./resources/js/functions.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\info\resources\js\functions.js */"./resources/js/functions.js");


/***/ })

/******/ });