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

eval("$(document).ready(function () {\n  setTimeout(function () {\n    $('body').removeClass('loading'); // remove loader overlay when page is ready with 1 sec delay\n  }, 1000);\n  $('form.ajax-submit').on('submit', function (e) {\n    console.log('asd');\n    e.preventDefault();\n    var form = $(this);\n    var method = $(this).attr('method');\n    var url = $(this).attr('action');\n    var data = $(this).serializeArray();\n    var confirmation = $(this).attr('confirmation');\n    var confirmation_note = $(this).attr('confirmation-note');\n    var confirmation_cancelled_note = $(this).attr('confirmation-cancelled-note');\n\n    if (confirmation) {\n      swal({\n        title: \"Are you sure?\",\n        text: !confirmation_note ? \"Once deleted, you may not be able to recover this data.\" : confirmation_note,\n        icon: \"warning\",\n        buttons: true,\n        dangerMode: true\n      }).then(function (willDelete) {\n        if (willDelete) {\n          submitForm(form, method, url, data);\n        } else {\n          swal(\"Cancelled action\", !confirmation_cancelled_note ? \"Data is retain.\" : confirmation_cancelled_note);\n        }\n      });\n    } else {\n      submitForm(form, method, url, data);\n    }\n  });\n\n  function submitForm(form, method, url, data) {\n    toastr.options.positionClass = 'toast-bottom-right';\n    toastr.options.extendedTimeOut = 1000;\n    toastr.options.timeOut = 2000;\n    toastr.options.fadeOut = 250;\n    toastr.options.fadeIn = 250;\n    $.ajax({\n      type: method,\n      url: url,\n      data: data,\n      dataType: 'json',\n      processData: true,\n      success: function success(data) {\n        if (data.resetForm) {\n          form.trigger(\"reset\");\n        }\n\n        if (data.redirect !== undefined) {\n          toastr.success('Redirecting please wait...');\n          setTimeout(function () {\n            window.location = data.redirect;\n          }, 2500);\n        }\n\n        if (data.notifMessage !== undefined) {\n          toastr.success(data.notifMessage);\n        }\n      },\n      error: function error(data, text, _error) {\n        if (data.responseJSON.message.length) {\n          for (var index = 0; index < data.responseJSON.message.length; index++) {\n            var message = data.responseJSON.message[index];\n            toastr.warning(message);\n          }\n        } else if (data.responseJSON.notifMessage.length) {\n          toastr.warning(data.responseJSON.notifMessage);\n        }\n      }\n    });\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvYXBwLmpzPzZkNDAiXSwibmFtZXMiOlsiJCIsImRvY3VtZW50IiwicmVhZHkiLCJzZXRUaW1lb3V0IiwicmVtb3ZlQ2xhc3MiLCJvbiIsImUiLCJjb25zb2xlIiwibG9nIiwicHJldmVudERlZmF1bHQiLCJmb3JtIiwibWV0aG9kIiwiYXR0ciIsInVybCIsImRhdGEiLCJzZXJpYWxpemVBcnJheSIsImNvbmZpcm1hdGlvbiIsImNvbmZpcm1hdGlvbl9ub3RlIiwiY29uZmlybWF0aW9uX2NhbmNlbGxlZF9ub3RlIiwic3dhbCIsInRpdGxlIiwidGV4dCIsImljb24iLCJidXR0b25zIiwiZGFuZ2VyTW9kZSIsInRoZW4iLCJ3aWxsRGVsZXRlIiwic3VibWl0Rm9ybSIsInRvYXN0ciIsIm9wdGlvbnMiLCJwb3NpdGlvbkNsYXNzIiwiZXh0ZW5kZWRUaW1lT3V0IiwidGltZU91dCIsImZhZGVPdXQiLCJmYWRlSW4iLCJhamF4IiwidHlwZSIsImRhdGFUeXBlIiwicHJvY2Vzc0RhdGEiLCJzdWNjZXNzIiwicmVzZXRGb3JtIiwidHJpZ2dlciIsInJlZGlyZWN0IiwidW5kZWZpbmVkIiwid2luZG93IiwibG9jYXRpb24iLCJub3RpZk1lc3NhZ2UiLCJlcnJvciIsInJlc3BvbnNlSlNPTiIsIm1lc3NhZ2UiLCJsZW5ndGgiLCJpbmRleCIsIndhcm5pbmciXSwibWFwcGluZ3MiOiJBQUFBQSxDQUFDLENBQUNDLFFBQUQsQ0FBRCxDQUFZQyxLQUFaLENBQWtCLFlBQVc7QUFDekJDLFlBQVUsQ0FBQyxZQUFNO0FBQ2JILEtBQUMsQ0FBQyxNQUFELENBQUQsQ0FBVUksV0FBVixDQUFzQixTQUF0QixFQURhLENBQ3FCO0FBQ3JDLEdBRlMsRUFFUCxJQUZPLENBQVY7QUFHQUosR0FBQyxDQUFDLGtCQUFELENBQUQsQ0FBc0JLLEVBQXRCLENBQXlCLFFBQXpCLEVBQW1DLFVBQVVDLENBQVYsRUFBYTtBQUM1Q0MsV0FBTyxDQUFD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Q0FBQ1csT0FBUCxDQUFlekIsSUFBSSxDQUFDZ0MsWUFBcEI7QUFDSDtBQUNKLE9BbkJFO0FBb0JIQyxXQUFLLEVBQUcsZUFBU2pDLElBQVQsRUFBZU8sSUFBZixFQUFxQjBCLE1BQXJCLEVBQTRCO0FBQ2hDLFlBQUlqQyxJQUFJLENBQUNrQyxZQUFMLENBQWtCQyxPQUFsQixDQUEwQkMsTUFBOUIsRUFBc0M7QUFDbEMsZUFBSyxJQUFJQyxLQUFLLEdBQUcsQ0FBakIsRUFBb0JBLEtBQUssR0FBR3JDLElBQUksQ0FBQ2tDLFlBQUwsQ0FBa0JDLE9BQWxCLENBQTBCQyxNQUF0RCxFQUE4REMsS0FBSyxFQUFuRSxFQUF1RTtBQUNuRSxnQkFBTUYsT0FBTyxHQUFHbkMsSUFBSSxDQUFDa0MsWUFBTCxDQUFrQkMsT0FBbEIsQ0FBMEJFLEtBQTFCLENBQWhCO0FBQ0F2QixrQkFBTSxDQUFDd0IsT0FBUCxDQUFlSCxPQUFmO0FBQ0g7QUFDSixTQUxELE1BS08sSUFBSW5DLElBQUksQ0FBQ2tDLFlBQUwsQ0FBa0JGLFlBQWxCLENBQStCSSxNQUFuQyxFQUEyQztBQUM5Q3RCLGdCQUFNLENBQUN3QixPQUFQLENBQWV0QyxJQUFJLENBQUNrQyxZQUFMLENBQWtCRixZQUFqQztBQUNIO0FBQ0o7QUE3QkUsS0FBUDtBQStCSDtBQUNKLENBMUVEIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL2FwcC5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xyXG4gICAgc2V0VGltZW91dCgoKSA9PiB7XHJcbiAgICAgICAgJCgnYm9keScpLnJlbW92ZUNsYXNzKCdsb2FkaW5nJyk7IC8vIHJlbW92ZSBsb2FkZXIgb3ZlcmxheSB3aGVuIHBhZ2UgaXMgcmVhZHkgd2l0aCAxIHNlYyBkZWxheVxyXG4gICAgfSwgMTAwMCk7XHJcbiAgICAkKCdmb3JtLmFqYXgtc3VibWl0Jykub24oJ3N1Ym1pdCcsIGZ1bmN0aW9uIChlKSB7XHJcbiAgICAgICAgY29uc29sZS5sb2coJ2FzZCcpO1xyXG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICB2YXIgZm9ybSA9ICQodGhpcyk7XHJcbiAgICAgICAgdmFyIG1ldGhvZCA9ICQodGhpcykuYXR0cignbWV0aG9kJyk7XHJcbiAgICAgICAgdmFyIHVybCA9ICQodGhpcykuYXR0cignYWN0aW9uJyk7XHJcbiAgICAgICAgdmFyIGRhdGEgPSAkKHRoaXMpLnNlcmlhbGl6ZUFycmF5KCk7XHJcbiAgICAgICAgdmFyIGNvbmZpcm1hdGlvbiA9ICQodGhpcykuYXR0cignY29uZmlybWF0aW9uJyk7XHJcbiAgICAgICAgdmFyIGNvbmZpcm1hdGlvbl9ub3RlID0gJCh0aGlzKS5hdHRyKCdjb25maXJtYXRpb24tbm90ZScpO1xyXG4gICAgICAgIHZhciBjb25maXJtYXRpb25fY2FuY2VsbGVkX25vdGUgPSAkKHRoaXMpLmF0dHIoJ2NvbmZpcm1hdGlvbi1jYW5jZWxsZWQtbm90ZScpO1xyXG4gICAgICAgIFxyXG4gICAgICAgIGlmIChjb25maXJtYXRpb24pIHtcclxuICAgICAgICAgICAgc3dhbCh7XHJcbiAgICAgICAgICAgICAgICB0aXRsZTogXCJBcmUgeW91IHN1cmU/XCIsXHJcbiAgICAgICAgICAgICAgICB0ZXh0OiAgIWNvbmZpcm1hdGlvbl9ub3RlID8gXCJPbmNlIGRlbGV0ZWQsIHlvdSBtYXkgbm90IGJlIGFibGUgdG8gcmVjb3ZlciB0aGlzIGRhdGEuXCIgOiAgY29uZmlybWF0aW9uX25vdGUsXHJcbiAgICAgICAgICAgICAgICBpY29uOiBcIndhcm5pbmdcIixcclxuICAgICAgICAgICAgICAgIGJ1dHRvbnM6IHRydWUsXHJcbiAgICAgICAgICAgICAgICBkYW5nZXJNb2RlOiB0cnVlLFxyXG4gICAgICAgICAgICB9KVxyXG4gICAgICAgICAgICAudGhlbigod2lsbERlbGV0ZSkgPT4ge1xyXG4gICAgICAgICAgICAgICAgaWYgKHdpbGxEZWxldGUpIHtcclxuICAgICAgICAgICAgICAgICAgICBzdWJtaXRGb3JtKGZvcm0sIG1ldGhvZCwgdXJsLCBkYXRhKTtcclxuICAgICAgICAgICAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgICAgICAgICAgICAgc3dhbChcIkNhbmNlbGxlZCBhY3Rpb25cIiwgICFjb25maXJtYXRpb25fY2FuY2VsbGVkX25vdGUgPyBcIkRhdGEgaXMgcmV0YWluLlwiIDogIGNvbmZpcm1hdGlvbl9jYW5jZWxsZWRfbm90ZSk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0pO1xyXG4gICAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgICAgIHN1Ym1pdEZvcm0oZm9ybSwgbWV0aG9kLCB1cmwsIGRhdGEpO1xyXG4gICAgICAgIH0gXHJcbiAgICB9KTtcclxuXHJcbiAgICBmdW5jdGlvbiBzdWJtaXRGb3JtKGZvcm0sIG1ldGhvZCwgdXJsLCBkYXRhKSB7XHJcbiAgICAgICAgdG9hc3RyLm9wdGlvbnMucG9zaXRpb25DbGFzcyA9ICd0b2FzdC1ib3R0b20tcmlnaHQnO1xyXG4gICAgICAgIHRvYXN0ci5vcHRpb25zLmV4dGVuZGVkVGltZU91dCA9IDEwMDA7XHJcbiAgICAgICAgdG9hc3RyLm9wdGlvbnMudGltZU91dCA9IDIwMDA7XHJcbiAgICAgICAgdG9hc3RyLm9wdGlvbnMuZmFkZU91dCA9IDI1MDtcclxuICAgICAgICB0b2FzdHIub3B0aW9ucy5mYWRlSW4gPSAyNTA7XHJcblxyXG4gICAgICAgICQuYWpheCh7XHJcbiAgICAgICAgICAgIHR5cGUgOiBtZXRob2QsXHJcbiAgICAgICAgICAgIHVybDogdXJsLFxyXG4gICAgICAgICAgICBkYXRhIDogZGF0YSxcclxuICAgICAgICAgICAgZGF0YVR5cGUgOiAnanNvbicsXHJcbiAgICAgICAgICAgIHByb2Nlc3NEYXRhOiB0cnVlLFxyXG4gICAgICAgICAgICBzdWNjZXNzIDogZnVuY3Rpb24oZGF0YSkge1xyXG4gICAgICAgICAgICAgICAgaWYgKGRhdGEucmVzZXRGb3JtKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgZm9ybS50cmlnZ2VyKFwicmVzZXRcIik7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICBpZiAoZGF0YS5yZWRpcmVjdCAhPT0gdW5kZWZpbmVkKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgdG9hc3RyLnN1Y2Nlc3MoJ1JlZGlyZWN0aW5nIHBsZWFzZSB3YWl0Li4uJyk7XHJcblx0XHRcdFx0XHRzZXRUaW1lb3V0KGZ1bmN0aW9uKCkge1xyXG5cdFx0XHRcdFx0XHR3aW5kb3cubG9jYXRpb24gPSBkYXRhLnJlZGlyZWN0O1xyXG5cdFx0XHRcdFx0fSwgMjUwMCk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICBpZiAoZGF0YS5ub3RpZk1lc3NhZ2UgIT09IHVuZGVmaW5lZCkge1xyXG4gICAgICAgICAgICAgICAgICAgIHRvYXN0ci5zdWNjZXNzKGRhdGEubm90aWZNZXNzYWdlKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgZXJyb3IgOiBmdW5jdGlvbihkYXRhLCB0ZXh0LCBlcnJvcikge1xyXG4gICAgICAgICAgICAgICAgaWYgKGRhdGEucmVzcG9uc2VKU09OLm1lc3NhZ2UubGVuZ3RoKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgZm9yIChsZXQgaW5kZXggPSAwOyBpbmRleCA8IGRhdGEucmVzcG9uc2VKU09OLm1lc3NhZ2UubGVuZ3RoOyBpbmRleCsrKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbnN0IG1lc3NhZ2UgPSBkYXRhLnJlc3BvbnNlSlNPTi5tZXNzYWdlW2luZGV4XTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgdG9hc3RyLndhcm5pbmcobWVzc2FnZSk7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfSBlbHNlIGlmIChkYXRhLnJlc3BvbnNlSlNPTi5ub3RpZk1lc3NhZ2UubGVuZ3RoKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgdG9hc3RyLndhcm5pbmcoZGF0YS5yZXNwb25zZUpTT04ubm90aWZNZXNzYWdlKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG59KTsiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/app.js\n");

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