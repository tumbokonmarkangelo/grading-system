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

eval("$(document).ready(function () {\n  setTimeout(function () {\n    $('body').removeClass('loading'); // remove loader overlay when page is ready with 1 sec delay\n  }, 1000);\n  $('form.ajax-submit').on('submit', function (e) {\n    e.preventDefault();\n    var form = $(this);\n    var method = $(this).attr('method');\n    var url = $(this).attr('action');\n    var data = $(this).serializeArray();\n    var confirmation = $(this).attr('confirmation');\n    var confirmation_note = $(this).attr('confirmation-note');\n    var confirmation_cancelled_note = $(this).attr('confirmation-cancelled-note');\n    var isComputation = form.hasClass('form-computation');\n\n    if (isComputation) {\n      var total = 0;\n      form.find('input[name=\"value[]\"]').each(function () {\n        var input = $(this);\n        var value = input.val();\n        var action = input.closest('.action-coverage').find('input.action-input').val();\n\n        if (value.length && action != 'delete') {\n          total += parseInt(value);\n        }\n      });\n\n      if (total != 100) {\n        swal({\n          title: \"Please check criteria values\",\n          text: \"Total of all values must be exactly 100.\",\n          icon: \"warning\",\n          dangerMode: true\n        });\n        return false;\n      }\n    }\n\n    var invalidRequest = false;\n    form.find('.three-inputs-container').each(function () {\n      var threeInputs = $(this);\n\n      if (threeInputs.find(':input').length && !threeInputs.closest('.row-template-container').length) {\n        var total = 0;\n        threeInputs.find(':input').each(function () {\n          var input = $(this);\n          var value = input.val();\n\n          if (value.length) {\n            total += parseInt(value);\n          }\n        });\n\n        if (total != 100) {\n          invalidRequest = true;\n        }\n      }\n    });\n\n    if (invalidRequest) {\n      swal({\n        title: \"Please check subject period values\",\n        text: \"Total of all values must be exactly 100.\",\n        icon: \"warning\",\n        dangerMode: true\n      });\n      return false;\n    }\n\n    if (confirmation) {\n      swal({\n        title: \"Are you sure?\",\n        text: !confirmation_note ? \"Once deleted, you may not be able to recover this data.\" : confirmation_note,\n        icon: \"warning\",\n        buttons: true,\n        dangerMode: true\n      }).then(function (willDelete) {\n        if (willDelete) {\n          submitForm(form, method, url, data);\n        } else {\n          swal(\"Cancelled action\", !confirmation_cancelled_note ? \"Data is retain.\" : confirmation_cancelled_note);\n        }\n      });\n    } else {\n      submitForm(form, method, url, data);\n    }\n  });\n\n  function submitForm(form, method, url, data) {\n    toastr.options.positionClass = 'toast-bottom-right';\n    toastr.options.extendedTimeOut = 1000;\n    toastr.options.timeOut = 2000;\n    toastr.options.fadeOut = 250;\n    toastr.options.fadeIn = 250;\n    $.ajax({\n      type: method,\n      url: url,\n      data: data,\n      dataType: 'json',\n      processData: true,\n      success: function success(data) {\n        if (data.resetForm) {\n          form.trigger(\"reset\");\n        }\n\n        if (data.redirect !== undefined) {\n          toastr.success('Redirecting please wait...');\n          setTimeout(function () {\n            window.location = data.redirect;\n          }, 2500);\n        }\n\n        if (data.notifMessage !== undefined) {\n          toastr.success(data.notifMessage);\n        }\n      },\n      error: function error(data, text, _error) {\n        if (data.responseJSON.message.length) {\n          for (var index = 0; index < data.responseJSON.message.length; index++) {\n            var message = data.responseJSON.message[index];\n            toastr.warning(message);\n          }\n        } else if (data.responseJSON.notifMessage.length) {\n          toastr.warning(data.responseJSON.notifMessage);\n        }\n      }\n    });\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvYXBwLmpzPzZkNDAiXSwibmFtZXMiOlsiJCIsImRvY3VtZW50IiwicmVhZHkiLCJzZXRUaW1lb3V0IiwicmVtb3ZlQ2xhc3MiLCJvbiIsImUiLCJwcmV2ZW50RGVmYXVsdCIsImZvcm0iLCJtZXRob2QiLCJhdHRyIiwidXJsIiwiZGF0YSIsInNlcmlhbGl6ZUFycmF5IiwiY29uZmlybWF0aW9uIiwiY29uZmlybWF0aW9uX25vdGUiLCJjb25maXJtYXRpb25fY2FuY2VsbGVkX25vdGUiLCJpc0NvbXB1dGF0aW9uIiwiaGFzQ2xhc3MiLCJ0b3RhbCIsImZpbmQiLCJlYWNoIiwiaW5wdXQiLCJ2YWx1ZSIsInZhbCIsImFjdGlvbiIsImNsb3Nlc3QiLCJsZW5ndGgiLCJwYXJzZUludCIsInN3YWwiLCJ0aXRsZSIsInRleHQiLCJpY29uIiwiZGFuZ2VyTW9kZSIsImludmFsaWRSZXF1ZXN0IiwidGhyZWVJbnB1dHMiLCJidXR0b25zIiwidGhlbiIsIndpbGxEZWxldGUiLCJzdWJtaXRGb3JtIiwidG9hc3RyIiwib3B0aW9ucyIsInBvc2l0aW9uQ2xhc3MiLCJleHRlbmRlZFRpbWVPdXQiLCJ0aW1lT3V0IiwiZmFkZU91dCIsImZhZGVJbiIsImFqYXgiLCJ0eXBlIiwiZGF0YVR5cGUiLCJwcm9jZXNzRGF0YSIsInN1Y2Nlc3MiLCJyZXNldEZvcm0iLCJ0cmlnZ2VyIiwicmVkaXJlY3QiLCJ1bmRlZmluZWQiLCJ3aW5kb3ciLCJsb2NhdGlvbiIsIm5vdGlmTWVzc2FnZSIsImVycm9yIiwicmVzcG9uc2VKU09OIiwibWVzc2FnZSIsImluZGV4Iiwid2FybmluZyJdLCJtYXBwaW5ncyI6IkFBQUFBLENBQUMsQ0FBQ0MsUUFBRCxDQUFELENBQVlDLEtBQVosQ0FBa0IsWUFBVztBQUN6QkMsWUFBVSxDQUFDLFlBQU07QUFDYkgsS0FBQyxDQUFDLE1BQUQsQ0FBRCxDQUFVSSxXQUFWLENBQXNCLFNBQXRCLEVBRGEsQ0FDcUI7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QWtCQyxPQUFsQixDQUEwQkMsS0FBMUIsQ0FBaEI7QUFDQXRCLGtCQUFNLENBQUN1QixPQUFQLENBQWVGLE9BQWY7QUFDSDtBQUNKLFNBTEQsTUFLTyxJQUFJakQsSUFBSSxDQUFDZ0QsWUFBTCxDQUFrQkYsWUFBbEIsQ0FBK0IvQixNQUFuQyxFQUEyQztBQUM5Q2EsZ0JBQU0sQ0FBQ3VCLE9BQVAsQ0FBZW5ELElBQUksQ0FBQ2dELFlBQUwsQ0FBa0JGLFlBQWpDO0FBQ0g7QUFDSjtBQTdCRSxLQUFQO0FBK0JIO0FBQ0osQ0E5SEQiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvYXBwLmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XHJcbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICAkKCdib2R5JykucmVtb3ZlQ2xhc3MoJ2xvYWRpbmcnKTsgLy8gcmVtb3ZlIGxvYWRlciBvdmVybGF5IHdoZW4gcGFnZSBpcyByZWFkeSB3aXRoIDEgc2VjIGRlbGF5XHJcbiAgICB9LCAxMDAwKTtcclxuICAgICQoJ2Zvcm0uYWpheC1zdWJtaXQnKS5vbignc3VibWl0JywgZnVuY3Rpb24gKGUpIHtcclxuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgdmFyIGZvcm0gPSAkKHRoaXMpO1xyXG4gICAgICAgIHZhciBtZXRob2QgPSAkKHRoaXMpLmF0dHIoJ21ldGhvZCcpO1xyXG4gICAgICAgIHZhciB1cmwgPSAkKHRoaXMpLmF0dHIoJ2FjdGlvbicpO1xyXG4gICAgICAgIHZhciBkYXRhID0gJCh0aGlzKS5zZXJpYWxpemVBcnJheSgpO1xyXG4gICAgICAgIHZhciBjb25maXJtYXRpb24gPSAkKHRoaXMpLmF0dHIoJ2NvbmZpcm1hdGlvbicpO1xyXG4gICAgICAgIHZhciBjb25maXJtYXRpb25fbm90ZSA9ICQodGhpcykuYXR0cignY29uZmlybWF0aW9uLW5vdGUnKTtcclxuICAgICAgICB2YXIgY29uZmlybWF0aW9uX2NhbmNlbGxlZF9ub3RlID0gJCh0aGlzKS5hdHRyKCdjb25maXJtYXRpb24tY2FuY2VsbGVkLW5vdGUnKTtcclxuXHJcbiAgICAgICAgdmFyIGlzQ29tcHV0YXRpb24gPSBmb3JtLmhhc0NsYXNzKCdmb3JtLWNvbXB1dGF0aW9uJyk7XHJcblxyXG4gICAgICAgIGlmIChpc0NvbXB1dGF0aW9uKSB7XHJcbiAgICAgICAgICAgIHZhciB0b3RhbCA9IDA7XHJcbiAgICAgICAgICAgIGZvcm0uZmluZCgnaW5wdXRbbmFtZT1cInZhbHVlW11cIl0nKS5lYWNoKGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgICAgIHZhciBpbnB1dCA9ICQodGhpcyk7XHJcbiAgICAgICAgICAgICAgICB2YXIgdmFsdWUgPSBpbnB1dC52YWwoKTtcclxuICAgICAgICAgICAgICAgIHZhciBhY3Rpb24gPSBpbnB1dC5jbG9zZXN0KCcuYWN0aW9uLWNvdmVyYWdlJykuZmluZCgnaW5wdXQuYWN0aW9uLWlucHV0JykudmFsKCk7XHJcbiAgICAgICAgICAgICAgICBpZiAodmFsdWUubGVuZ3RoICYmIGFjdGlvbiAhPSAnZGVsZXRlJykge1xyXG4gICAgICAgICAgICAgICAgICAgIHRvdGFsICs9IHBhcnNlSW50KHZhbHVlKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSk7XHJcblxyXG4gICAgICAgICAgICBpZiAodG90YWwgIT0gMTAwKSB7XHJcbiAgICAgICAgICAgICAgICBzd2FsKHtcclxuICAgICAgICAgICAgICAgICAgICB0aXRsZTogXCJQbGVhc2UgY2hlY2sgY3JpdGVyaWEgdmFsdWVzXCIsXHJcbiAgICAgICAgICAgICAgICAgICAgdGV4dDogIFwiVG90YWwgb2YgYWxsIHZhbHVlcyBtdXN0IGJlIGV4YWN0bHkgMTAwLlwiLFxyXG4gICAgICAgICAgICAgICAgICAgIGljb246IFwid2FybmluZ1wiLFxyXG4gICAgICAgICAgICAgICAgICAgIGRhbmdlck1vZGU6IHRydWUsXHJcbiAgICAgICAgICAgICAgICB9KVxyXG4gICAgICAgICAgICAgICAgcmV0dXJuIGZhbHNlO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICB2YXIgaW52YWxpZFJlcXVlc3QgPSBmYWxzZTtcclxuICAgICAgICBmb3JtLmZpbmQoJy50aHJlZS1pbnB1dHMtY29udGFpbmVyJykuZWFjaChmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgIHZhciB0aHJlZUlucHV0cyA9ICQodGhpcyk7XHJcbiAgICAgICAgICAgIGlmICh0aHJlZUlucHV0cy5maW5kKCc6aW5wdXQnKS5sZW5ndGggJiYgIXRocmVlSW5wdXRzLmNsb3Nlc3QoJy5yb3ctdGVtcGxhdGUtY29udGFpbmVyJykubGVuZ3RoKSB7XHJcbiAgICAgICAgICAgICAgICB2YXIgdG90YWwgPSAwO1xyXG4gICAgICAgICAgICAgICAgdGhyZWVJbnB1dHMuZmluZCgnOmlucHV0JykuZWFjaChmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgdmFyIGlucHV0ID0gJCh0aGlzKTtcclxuICAgICAgICAgICAgICAgICAgICB2YXIgdmFsdWUgPSBpbnB1dC52YWwoKTtcclxuICAgICAgICAgICAgICAgICAgICBpZiAodmFsdWUubGVuZ3RoKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHRvdGFsICs9IHBhcnNlSW50KHZhbHVlKTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9KTtcclxuICAgICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgICAgaWYgKHRvdGFsICE9IDEwMCkge1xyXG4gICAgICAgICAgICAgICAgICAgIGludmFsaWRSZXF1ZXN0ID0gdHJ1ZTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSAgXHJcbiAgICAgICAgfSk7XHJcblxyXG4gICAgICAgIGlmIChpbnZhbGlkUmVxdWVzdCkge1xyXG4gICAgICAgICAgICBzd2FsKHtcclxuICAgICAgICAgICAgICAgIHRpdGxlOiBcIlBsZWFzZSBjaGVjayBzdWJqZWN0IHBlcmlvZCB2YWx1ZXNcIixcclxuICAgICAgICAgICAgICAgIHRleHQ6ICBcIlRvdGFsIG9mIGFsbCB2YWx1ZXMgbXVzdCBiZSBleGFjdGx5IDEwMC5cIixcclxuICAgICAgICAgICAgICAgIGljb246IFwid2FybmluZ1wiLFxyXG4gICAgICAgICAgICAgICAgZGFuZ2VyTW9kZTogdHJ1ZSxcclxuICAgICAgICAgICAgfSlcclxuICAgICAgICAgICAgcmV0dXJuIGZhbHNlO1xyXG4gICAgICAgIH1cclxuICAgICAgICBcclxuICAgICAgICBpZiAoY29uZmlybWF0aW9uKSB7XHJcbiAgICAgICAgICAgIHN3YWwoe1xyXG4gICAgICAgICAgICAgICAgdGl0bGU6IFwiQXJlIHlvdSBzdXJlP1wiLFxyXG4gICAgICAgICAgICAgICAgdGV4dDogICFjb25maXJtYXRpb25fbm90ZSA/IFwiT25jZSBkZWxldGVkLCB5b3UgbWF5IG5vdCBiZSBhYmxlIHRvIHJlY292ZXIgdGhpcyBkYXRhLlwiIDogIGNvbmZpcm1hdGlvbl9ub3RlLFxyXG4gICAgICAgICAgICAgICAgaWNvbjogXCJ3YXJuaW5nXCIsXHJcbiAgICAgICAgICAgICAgICBidXR0b25zOiB0cnVlLFxyXG4gICAgICAgICAgICAgICAgZGFuZ2VyTW9kZTogdHJ1ZSxcclxuICAgICAgICAgICAgfSlcclxuICAgICAgICAgICAgLnRoZW4oKHdpbGxEZWxldGUpID0+IHtcclxuICAgICAgICAgICAgICAgIGlmICh3aWxsRGVsZXRlKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgc3VibWl0Rm9ybShmb3JtLCBtZXRob2QsIHVybCwgZGF0YSk7XHJcbiAgICAgICAgICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgICAgICAgICAgIHN3YWwoXCJDYW5jZWxsZWQgYWN0aW9uXCIsICAhY29uZmlybWF0aW9uX2NhbmNlbGxlZF9ub3RlID8gXCJEYXRhIGlzIHJldGFpbi5cIiA6ICBjb25maXJtYXRpb25fY2FuY2VsbGVkX25vdGUpO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9KTtcclxuICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgICBzdWJtaXRGb3JtKGZvcm0sIG1ldGhvZCwgdXJsLCBkYXRhKTtcclxuICAgICAgICB9IFxyXG4gICAgfSk7XHJcblxyXG4gICAgZnVuY3Rpb24gc3VibWl0Rm9ybShmb3JtLCBtZXRob2QsIHVybCwgZGF0YSkge1xyXG4gICAgICAgIHRvYXN0ci5vcHRpb25zLnBvc2l0aW9uQ2xhc3MgPSAndG9hc3QtYm90dG9tLXJpZ2h0JztcclxuICAgICAgICB0b2FzdHIub3B0aW9ucy5leHRlbmRlZFRpbWVPdXQgPSAxMDAwO1xyXG4gICAgICAgIHRvYXN0ci5vcHRpb25zLnRpbWVPdXQgPSAyMDAwO1xyXG4gICAgICAgIHRvYXN0ci5vcHRpb25zLmZhZGVPdXQgPSAyNTA7XHJcbiAgICAgICAgdG9hc3RyLm9wdGlvbnMuZmFkZUluID0gMjUwO1xyXG5cclxuICAgICAgICAkLmFqYXgoe1xyXG4gICAgICAgICAgICB0eXBlIDogbWV0aG9kLFxyXG4gICAgICAgICAgICB1cmw6IHVybCxcclxuICAgICAgICAgICAgZGF0YSA6IGRhdGEsXHJcbiAgICAgICAgICAgIGRhdGFUeXBlIDogJ2pzb24nLFxyXG4gICAgICAgICAgICBwcm9jZXNzRGF0YTogdHJ1ZSxcclxuICAgICAgICAgICAgc3VjY2VzcyA6IGZ1bmN0aW9uKGRhdGEpIHtcclxuICAgICAgICAgICAgICAgIGlmIChkYXRhLnJlc2V0Rm9ybSkge1xyXG4gICAgICAgICAgICAgICAgICAgIGZvcm0udHJpZ2dlcihcInJlc2V0XCIpO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgaWYgKGRhdGEucmVkaXJlY3QgIT09IHVuZGVmaW5lZCkge1xyXG4gICAgICAgICAgICAgICAgICAgIHRvYXN0ci5zdWNjZXNzKCdSZWRpcmVjdGluZyBwbGVhc2Ugd2FpdC4uLicpO1xyXG5cdFx0XHRcdFx0c2V0VGltZW91dChmdW5jdGlvbigpIHtcclxuXHRcdFx0XHRcdFx0d2luZG93LmxvY2F0aW9uID0gZGF0YS5yZWRpcmVjdDtcclxuXHRcdFx0XHRcdH0sIDI1MDApO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgaWYgKGRhdGEubm90aWZNZXNzYWdlICE9PSB1bmRlZmluZWQpIHtcclxuICAgICAgICAgICAgICAgICAgICB0b2FzdHIuc3VjY2VzcyhkYXRhLm5vdGlmTWVzc2FnZSk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIGVycm9yIDogZnVuY3Rpb24oZGF0YSwgdGV4dCwgZXJyb3IpIHtcclxuICAgICAgICAgICAgICAgIGlmIChkYXRhLnJlc3BvbnNlSlNPTi5tZXNzYWdlLmxlbmd0aCkge1xyXG4gICAgICAgICAgICAgICAgICAgIGZvciAobGV0IGluZGV4ID0gMDsgaW5kZXggPCBkYXRhLnJlc3BvbnNlSlNPTi5tZXNzYWdlLmxlbmd0aDsgaW5kZXgrKykge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb25zdCBtZXNzYWdlID0gZGF0YS5yZXNwb25zZUpTT04ubWVzc2FnZVtpbmRleF07XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHRvYXN0ci53YXJuaW5nKG1lc3NhZ2UpO1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH0gZWxzZSBpZiAoZGF0YS5yZXNwb25zZUpTT04ubm90aWZNZXNzYWdlLmxlbmd0aCkge1xyXG4gICAgICAgICAgICAgICAgICAgIHRvYXN0ci53YXJuaW5nKGRhdGEucmVzcG9uc2VKU09OLm5vdGlmTWVzc2FnZSk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuICAgIH1cclxufSk7Il0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/app.js\n");

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