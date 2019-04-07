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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("$(document).ready(function () {\n  $('form.ajax-submit').on('submit', function (e) {\n    e.preventDefault();\n    var form = $(this);\n    var method = $(this).attr('method');\n    var url = $(this).attr('action');\n    var data = $(this).serializeArray();\n    toastr.options.positionClass = 'toast-bottom-right';\n    toastr.options.extendedTimeOut = 1000;\n    toastr.options.timeOut = 2000;\n    toastr.options.fadeOut = 250;\n    toastr.options.fadeIn = 250;\n    $.ajax({\n      type: method,\n      url: url,\n      data: data,\n      dataType: 'json',\n      processData: true,\n      success: function success(data) {\n        if (data.resetForm) {\n          form.trigger(\"reset\");\n        }\n\n        if (data.redirect !== 'undefined') {\n          toastr.success('Redirecting please wait...');\n          setTimeout(function () {\n            window.location = data.redirect;\n          }, 2500);\n        }\n\n        if (data.notifMessage !== 'undefined') {\n          toastr.success(data.notifMessage);\n        }\n      },\n      error: function error(data, text, _error) {\n        if (data.responseJSON.message.length) {\n          for (var index = 0; index < data.responseJSON.message.length; index++) {\n            var message = data.responseJSON.message[index];\n            toastr.warning(message);\n          }\n        } else if (data.responseJSON.notifMessage.length) {\n          toastr.warning(data.responseJSON.notifMessage);\n        }\n      }\n    });\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvYXBwLmpzPzZkNDAiXSwibmFtZXMiOlsiJCIsImRvY3VtZW50IiwicmVhZHkiLCJvbiIsImUiLCJwcmV2ZW50RGVmYXVsdCIsImZvcm0iLCJtZXRob2QiLCJhdHRyIiwidXJsIiwiZGF0YSIsInNlcmlhbGl6ZUFycmF5IiwidG9hc3RyIiwib3B0aW9ucyIsInBvc2l0aW9uQ2xhc3MiLCJleHRlbmRlZFRpbWVPdXQiLCJ0aW1lT3V0IiwiZmFkZU91dCIsImZhZGVJbiIsImFqYXgiLCJ0eXBlIiwiZGF0YVR5cGUiLCJwcm9jZXNzRGF0YSIsInN1Y2Nlc3MiLCJyZXNldEZvcm0iLCJ0cmlnZ2VyIiwicmVkaXJlY3QiLCJzZXRUaW1lb3V0Iiwid2luZG93IiwibG9jYXRpb24iLCJub3RpZk1lc3NhZ2UiLCJlcnJvciIsInRleHQiLCJyZXNwb25zZUpTT04iLCJtZXNzYWdlIiwibGVuZ3RoIiwiaW5kZXgiLCJ3YXJuaW5nIl0sIm1hcHBpbmdzIjoiQUFBQUEsQ0FBQyxDQUFDQyxRQUFELENBQUQsQ0FBWUMsS0FBWixDQUFrQixZQUFXO0FBQ3pCRixHQUFDLENBQUMsa0JBQUQsQ0FBRCxDQUFzQkcsRUFBdEIsQ0FBeUIsUUFBekIsRUFBbUMsVUFBVUMsQ0FBVixFQUFhO0FBQzVDQSxLQUFDLENBQUNDLGNBQUY7QUFDQSxRQUFJQyxJQUFJLEdBQUdOLENBQUMsQ0FBQyxJQUFELENBQVo7QUFDQSxRQUFJTyxNQUFNLEdBQUdQLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUVEsSUFBUixDQUFhLFFBQWIsQ0FBYjtBQUNBLFFBQUlDLEdBQUcsR0FBR1QsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRUSxJQUFSLENBQWEsUUFBYixDQUFWO0FBQ0EsUUFBSUUsSUFBSSxHQUFHVixDQUFDLENBQUMsSUFBRCxDQUFELENBQVFXLGNBQVIsRUFBWDtBQUVBQyxVQUFNLENBQUNDLE9BQVAsQ0FBZUMsYUFBZixHQUErQixvQkFBL0I7QUFDQUYsVUFBTSxDQUFDQyxPQUFQLENBQWVFLGVBQWYsR0FBaUMsSUFBakM7QUFDQUgsVUFBTSxDQUFDQyxPQUFQLENBQWVHLE9BQWYsR0FBeUIsSUFBekI7QUFDQUosVUFBTSxDQUFDQyxPQUFQLENBQWVJLE9BQWYsR0FBeUIsR0FBekI7QUFDQUwsVUFBTSxDQUFDQyxPQUFQLENBQWVLLE1BQWYsR0FBd0IsR0FBeEI7QUFFQWxCLEtBQUMsQ0FBQ21CLElBQUYsQ0FBTztBQUNIQyxVQUFJLEVBQUdiLE1BREo7QUFFSEUsU0FBRyxFQUFFQSxHQUZGO0FBR0hDLFVBQUksRUFBR0EsSUFISjtBQUlIVyxjQUFRLEVBQUcsTUFKUjtBQUtIQyxpQkFBVyxFQUFFLElBTFY7QUFNSEMsYUFBTyxFQUFHLGlCQUFTYixJQUFULEVBQWU7QUFDckIsWUFBSUEsSUFBSSxDQUFDYyxTQUFULEVBQW9CO0FBQ2hCbEIsY0FBSSxDQUFDbUIsT0FBTCxDQUFhLE9BQWI7QUFDSDs7QUFDRCxZQUFJZixJQUFJLENBQUNnQixRQUFMLEtBQWtCLFdBQXRCLEVBQW1DO0FBQy9CZCxnQkFBTSxDQUFDVyxPQUFQLENBQWUsNEJBQWY7QUFDZkksb0JBQVUsQ0FBQyxZQUFXO0FBQ3JCQyxrQkFBTSxDQUFDQyxRQUFQLEdBQWtCbkIsSUFBSSxDQUFDZ0IsUUFBdkI7QUFDQSxXQUZTLEVBRVAsSUFGTyxDQUFWO0FBR1k7O0FBQ0QsWUFBSWhCLElBQUksQ0FBQ29CLFlBQUwsS0FBc0IsV0FBMUIsRUFBdUM7QUFDbkNsQixnQkFBTSxDQUFDVyxPQUFQLENBQWViLElBQUksQ0FBQ29CLFlBQXBCO0FBQ0g7QUFDSixPQW5CRTtBQW9CSEMsV0FBSyxFQUFHLGVBQVNyQixJQUFULEVBQWVzQixJQUFmLEVBQXFCRCxNQUFyQixFQUE0QjtBQUNoQyxZQUFJckIsSUFBSSxDQUFDdUIsWUFBTCxDQUFrQkMsT0FBbEIsQ0FBMEJDLE1BQTlCLEVBQXNDO0FBQ2xDLGVBQUssSUFBSUMsS0FBSyxHQUFHLENBQWpCLEVBQW9CQSxLQUFLLEdBQUcxQixJQUFJLENBQUN1QixZQUFMLENBQWtCQyxPQUFsQixDQUEwQkMsTUFBdEQsRUFBOERDLEtBQUssRUFBbkUsRUFBdUU7QUFDbkUsZ0JBQU1GLE9BQU8sR0FBR3hCLElBQUksQ0FBQ3VCLFlBQUwsQ0FBa0JDLE9BQWxCLENBQTBCRSxLQUExQixDQUFoQjtBQUNBeEIsa0JBQU0sQ0FBQ3lCLE9BQVAsQ0FBZUgsT0FBZjtBQUNIO0FBQ0osU0FMRCxNQUtPLElBQUl4QixJQUFJLENBQUN1QixZQUFMLENBQWtCSCxZQUFsQixDQUErQkssTUFBbkMsRUFBMkM7QUFDOUN2QixnQkFBTSxDQUFDeUIsT0FBUCxDQUFlM0IsSUFBSSxDQUFDdUIsWUFBTCxDQUFrQkgsWUFBakM7QUFDSDtBQUNKO0FBN0JFLEtBQVA7QUErQkgsR0E1Q0Q7QUE2Q0gsQ0E5Q0QiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvYXBwLmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XG4gICAgJCgnZm9ybS5hamF4LXN1Ym1pdCcpLm9uKCdzdWJtaXQnLCBmdW5jdGlvbiAoZSkge1xuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgIHZhciBmb3JtID0gJCh0aGlzKTtcbiAgICAgICAgdmFyIG1ldGhvZCA9ICQodGhpcykuYXR0cignbWV0aG9kJyk7XG4gICAgICAgIHZhciB1cmwgPSAkKHRoaXMpLmF0dHIoJ2FjdGlvbicpO1xuICAgICAgICB2YXIgZGF0YSA9ICQodGhpcykuc2VyaWFsaXplQXJyYXkoKTtcbiAgICAgICAgXG4gICAgICAgIHRvYXN0ci5vcHRpb25zLnBvc2l0aW9uQ2xhc3MgPSAndG9hc3QtYm90dG9tLXJpZ2h0JztcbiAgICAgICAgdG9hc3RyLm9wdGlvbnMuZXh0ZW5kZWRUaW1lT3V0ID0gMTAwMDtcbiAgICAgICAgdG9hc3RyLm9wdGlvbnMudGltZU91dCA9IDIwMDA7XG4gICAgICAgIHRvYXN0ci5vcHRpb25zLmZhZGVPdXQgPSAyNTA7XG4gICAgICAgIHRvYXN0ci5vcHRpb25zLmZhZGVJbiA9IDI1MDtcblxuICAgICAgICAkLmFqYXgoe1xuICAgICAgICAgICAgdHlwZSA6IG1ldGhvZCxcbiAgICAgICAgICAgIHVybDogdXJsLFxuICAgICAgICAgICAgZGF0YSA6IGRhdGEsXG4gICAgICAgICAgICBkYXRhVHlwZSA6ICdqc29uJyxcbiAgICAgICAgICAgIHByb2Nlc3NEYXRhOiB0cnVlLFxuICAgICAgICAgICAgc3VjY2VzcyA6IGZ1bmN0aW9uKGRhdGEpIHtcbiAgICAgICAgICAgICAgICBpZiAoZGF0YS5yZXNldEZvcm0pIHtcbiAgICAgICAgICAgICAgICAgICAgZm9ybS50cmlnZ2VyKFwicmVzZXRcIik7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIGlmIChkYXRhLnJlZGlyZWN0ICE9PSAndW5kZWZpbmVkJykge1xuICAgICAgICAgICAgICAgICAgICB0b2FzdHIuc3VjY2VzcygnUmVkaXJlY3RpbmcgcGxlYXNlIHdhaXQuLi4nKTtcblx0XHRcdFx0XHRzZXRUaW1lb3V0KGZ1bmN0aW9uKCkge1xuXHRcdFx0XHRcdFx0d2luZG93LmxvY2F0aW9uID0gZGF0YS5yZWRpcmVjdDtcblx0XHRcdFx0XHR9LCAyNTAwKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgaWYgKGRhdGEubm90aWZNZXNzYWdlICE9PSAndW5kZWZpbmVkJykge1xuICAgICAgICAgICAgICAgICAgICB0b2FzdHIuc3VjY2VzcyhkYXRhLm5vdGlmTWVzc2FnZSk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIGVycm9yIDogZnVuY3Rpb24oZGF0YSwgdGV4dCwgZXJyb3IpIHtcbiAgICAgICAgICAgICAgICBpZiAoZGF0YS5yZXNwb25zZUpTT04ubWVzc2FnZS5sZW5ndGgpIHtcbiAgICAgICAgICAgICAgICAgICAgZm9yIChsZXQgaW5kZXggPSAwOyBpbmRleCA8IGRhdGEucmVzcG9uc2VKU09OLm1lc3NhZ2UubGVuZ3RoOyBpbmRleCsrKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICBjb25zdCBtZXNzYWdlID0gZGF0YS5yZXNwb25zZUpTT04ubWVzc2FnZVtpbmRleF07XG4gICAgICAgICAgICAgICAgICAgICAgICB0b2FzdHIud2FybmluZyhtZXNzYWdlKTtcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIH0gZWxzZSBpZiAoZGF0YS5yZXNwb25zZUpTT04ubm90aWZNZXNzYWdlLmxlbmd0aCkge1xuICAgICAgICAgICAgICAgICAgICB0b2FzdHIud2FybmluZyhkYXRhLnJlc3BvbnNlSlNPTi5ub3RpZk1lc3NhZ2UpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgfSk7XG59KTsiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/app.js\n");

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("// removed by extract-text-webpack-plugin//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvc2Fzcy9hcHAuc2Nzcz9mNmMyIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL3Nhc3MvYXBwLnNjc3MuanMiLCJzb3VyY2VzQ29udGVudCI6WyIvLyByZW1vdmVkIGJ5IGV4dHJhY3QtdGV4dC13ZWJwYWNrLXBsdWdpbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/sass/app.scss\n");

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\xampp\htdocs\diliman-grading-system\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\diliman-grading-system\resources\sass\app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });