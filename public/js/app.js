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

eval("$(document).ready(function () {\n  setTimeout(function () {\n    $('body').removeClass('loading'); // remove loader overlay when page is ready with 1 sec delay\n  }, 1000);\n  $('form.ajax-submit').on('submit', function (e) {\n    e.preventDefault();\n    var form = $(this);\n    var method = $(this).attr('method');\n    var url = $(this).attr('action');\n    var data = $(this).serializeArray();\n    var confirmation = $(this).attr('confirmation');\n    var confirmation_note = $(this).attr('confirmation-note');\n    var confirmation_cancelled_note = $(this).attr('confirmation-cancelled-note');\n    var isComputation = form.hasClass('form-computation');\n\n    if (isComputation) {\n      var total = 0;\n      form.find('input[name=\"value[]\"]').each(function () {\n        var input = $(this);\n        var value = input.val();\n        var action = input.closest('.action-coverage').find('input.action-input').val();\n\n        if (value.length && action != 'delete') {\n          total += parseInt(value);\n        }\n      });\n\n      if (total != 100) {\n        swal({\n          title: \"Please check criteria values\",\n          text: \"Total of all values must be exactly 100.\",\n          icon: \"warning\",\n          dangerMode: true\n        });\n        return false;\n      }\n    }\n\n    var threeInputs = form.find('.three-inputs-container');\n\n    if (threeInputs.length) {\n      var total = 0;\n      threeInputs.find(':input').each(function () {\n        var input = $(this);\n        var value = input.val();\n\n        if (value.length) {\n          total += parseInt(value);\n        }\n      });\n\n      if (total != 100) {\n        swal({\n          title: \"Please check subject period values\",\n          text: \"Total of all values must be exactly 100.\",\n          icon: \"warning\",\n          dangerMode: true\n        });\n        return false;\n      }\n    }\n\n    if (confirmation) {\n      swal({\n        title: \"Are you sure?\",\n        text: !confirmation_note ? \"Once deleted, you may not be able to recover this data.\" : confirmation_note,\n        icon: \"warning\",\n        buttons: true,\n        dangerMode: true\n      }).then(function (willDelete) {\n        if (willDelete) {\n          submitForm(form, method, url, data);\n        } else {\n          swal(\"Cancelled action\", !confirmation_cancelled_note ? \"Data is retain.\" : confirmation_cancelled_note);\n        }\n      });\n    } else {\n      submitForm(form, method, url, data);\n    }\n  });\n\n  function submitForm(form, method, url, data) {\n    toastr.options.positionClass = 'toast-bottom-right';\n    toastr.options.extendedTimeOut = 1000;\n    toastr.options.timeOut = 2000;\n    toastr.options.fadeOut = 250;\n    toastr.options.fadeIn = 250;\n    $.ajax({\n      type: method,\n      url: url,\n      data: data,\n      dataType: 'json',\n      processData: true,\n      success: function success(data) {\n        if (data.resetForm) {\n          form.trigger(\"reset\");\n        }\n\n        if (data.redirect !== undefined) {\n          toastr.success('Redirecting please wait...');\n          setTimeout(function () {\n            window.location = data.redirect;\n          }, 2500);\n        }\n\n        if (data.notifMessage !== undefined) {\n          toastr.success(data.notifMessage);\n        }\n      },\n      error: function error(data, text, _error) {\n        if (data.responseJSON.message.length) {\n          for (var index = 0; index < data.responseJSON.message.length; index++) {\n            var message = data.responseJSON.message[index];\n            toastr.warning(message);\n          }\n        } else if (data.responseJSON.notifMessage.length) {\n          toastr.warning(data.responseJSON.notifMessage);\n        }\n      }\n    });\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvYXBwLmpzPzZkNDAiXSwibmFtZXMiOlsiJCIsImRvY3VtZW50IiwicmVhZHkiLCJzZXRUaW1lb3V0IiwicmVtb3ZlQ2xhc3MiLCJvbiIsImUiLCJwcmV2ZW50RGVmYXVsdCIsImZvcm0iLCJtZXRob2QiLCJhdHRyIiwidXJsIiwiZGF0YSIsInNlcmlhbGl6ZUFycmF5IiwiY29uZmlybWF0aW9uIiwiY29uZmlybWF0aW9uX25vdGUiLCJjb25maXJtYXRpb25fY2FuY2VsbGVkX25vdGUiLCJpc0NvbXB1dGF0aW9uIiwiaGFzQ2xhc3MiLCJ0b3RhbCIsImZpbmQiLCJlYWNoIiwiaW5wdXQiLCJ2YWx1ZSIsInZhbCIsImFjdGlvbiIsImNsb3Nlc3QiLCJsZW5ndGgiLCJwYXJzZUludCIsInN3YWwiLCJ0aXRsZSIsInRleHQiLCJpY29uIiwiZGFuZ2VyTW9kZSIsInRocmVlSW5wdXRzIiwiYnV0dG9ucyIsInRoZW4iLCJ3aWxsRGVsZXRlIiwic3VibWl0Rm9ybSIsInRvYXN0ciIsIm9wdGlvbnMiLCJwb3NpdGlvbkNsYXNzIiwiZXh0ZW5kZWRUaW1lT3V0IiwidGltZU91dCIsImZhZGVPdXQiLCJmYWRlSW4iLCJhamF4IiwidHlwZSIsImRhdGFUeXBlIiwicHJvY2Vzc0RhdGEiLCJzdWNjZXNzIiwicmVzZXRGb3JtIiwidHJpZ2dlciIsInJlZGlyZWN0IiwidW5kZWZpbmVkIiwid2luZG93IiwibG9jYXRpb24iLCJub3RpZk1lc3NhZ2UiLCJlcnJvciIsInJlc3BvbnNlSlNPTiIsIm1lc3NhZ2UiLCJpbmRleCIsIndhcm5pbmciXSwibWFwcGluZ3MiOiJBQUFBQSxDQUFDLENBQUNDLFFBQUQsQ0FBRCxDQUFZQyxLQUFaLENBQWtCLFlBQVc7QUFDekJDLFlBQVUsQ0FBQyxZQUFNO0FBQ2JILEtBQUMsQ0FBQyxNQUFELENBQUQsQ0FBVUksV0FBVixDQUFzQixTQUF0QixFQURhLENBQ3FCO0FBQ3JDLEdBRlMsRUFFUCxJ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LENBdkhEIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL2FwcC5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xyXG4gICAgc2V0VGltZW91dCgoKSA9PiB7XHJcbiAgICAgICAgJCgnYm9keScpLnJlbW92ZUNsYXNzKCdsb2FkaW5nJyk7IC8vIHJlbW92ZSBsb2FkZXIgb3ZlcmxheSB3aGVuIHBhZ2UgaXMgcmVhZHkgd2l0aCAxIHNlYyBkZWxheVxyXG4gICAgfSwgMTAwMCk7XHJcbiAgICAkKCdmb3JtLmFqYXgtc3VibWl0Jykub24oJ3N1Ym1pdCcsIGZ1bmN0aW9uIChlKSB7XHJcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgIHZhciBmb3JtID0gJCh0aGlzKTtcclxuICAgICAgICB2YXIgbWV0aG9kID0gJCh0aGlzKS5hdHRyKCdtZXRob2QnKTtcclxuICAgICAgICB2YXIgdXJsID0gJCh0aGlzKS5hdHRyKCdhY3Rpb24nKTtcclxuICAgICAgICB2YXIgZGF0YSA9ICQodGhpcykuc2VyaWFsaXplQXJyYXkoKTtcclxuICAgICAgICB2YXIgY29uZmlybWF0aW9uID0gJCh0aGlzKS5hdHRyKCdjb25maXJtYXRpb24nKTtcclxuICAgICAgICB2YXIgY29uZmlybWF0aW9uX25vdGUgPSAkKHRoaXMpLmF0dHIoJ2NvbmZpcm1hdGlvbi1ub3RlJyk7XHJcbiAgICAgICAgdmFyIGNvbmZpcm1hdGlvbl9jYW5jZWxsZWRfbm90ZSA9ICQodGhpcykuYXR0cignY29uZmlybWF0aW9uLWNhbmNlbGxlZC1ub3RlJyk7XHJcblxyXG4gICAgICAgIHZhciBpc0NvbXB1dGF0aW9uID0gZm9ybS5oYXNDbGFzcygnZm9ybS1jb21wdXRhdGlvbicpO1xyXG5cclxuICAgICAgICBpZiAoaXNDb21wdXRhdGlvbikge1xyXG4gICAgICAgICAgICB2YXIgdG90YWwgPSAwO1xyXG4gICAgICAgICAgICBmb3JtLmZpbmQoJ2lucHV0W25hbWU9XCJ2YWx1ZVtdXCJdJykuZWFjaChmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgICAgICB2YXIgaW5wdXQgPSAkKHRoaXMpO1xyXG4gICAgICAgICAgICAgICAgdmFyIHZhbHVlID0gaW5wdXQudmFsKCk7XHJcbiAgICAgICAgICAgICAgICB2YXIgYWN0aW9uID0gaW5wdXQuY2xvc2VzdCgnLmFjdGlvbi1jb3ZlcmFnZScpLmZpbmQoJ2lucHV0LmFjdGlvbi1pbnB1dCcpLnZhbCgpO1xyXG4gICAgICAgICAgICAgICAgaWYgKHZhbHVlLmxlbmd0aCAmJiBhY3Rpb24gIT0gJ2RlbGV0ZScpIHtcclxuICAgICAgICAgICAgICAgICAgICB0b3RhbCArPSBwYXJzZUludCh2YWx1ZSk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0pO1xyXG5cclxuICAgICAgICAgICAgaWYgKHRvdGFsICE9IDEwMCkge1xyXG4gICAgICAgICAgICAgICAgc3dhbCh7XHJcbiAgICAgICAgICAgICAgICAgICAgdGl0bGU6IFwiUGxlYXNlIGNoZWNrIGNyaXRlcmlhIHZhbHVlc1wiLFxyXG4gICAgICAgICAgICAgICAgICAgIHRleHQ6ICBcIlRvdGFsIG9mIGFsbCB2YWx1ZXMgbXVzdCBiZSBleGFjdGx5IDEwMC5cIixcclxuICAgICAgICAgICAgICAgICAgICBpY29uOiBcIndhcm5pbmdcIixcclxuICAgICAgICAgICAgICAgICAgICBkYW5nZXJNb2RlOiB0cnVlLFxyXG4gICAgICAgICAgICAgICAgfSlcclxuICAgICAgICAgICAgICAgIHJldHVybiBmYWxzZTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgdmFyIHRocmVlSW5wdXRzID0gZm9ybS5maW5kKCcudGhyZWUtaW5wdXRzLWNvbnRhaW5lcicpXHJcbiAgICAgICAgaWYgKHRocmVlSW5wdXRzLmxlbmd0aCkge1xyXG4gICAgICAgICAgICB2YXIgdG90YWwgPSAwO1xyXG4gICAgICAgICAgICB0aHJlZUlucHV0cy5maW5kKCc6aW5wdXQnKS5lYWNoKGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgICAgIHZhciBpbnB1dCA9ICQodGhpcyk7XHJcbiAgICAgICAgICAgICAgICB2YXIgdmFsdWUgPSBpbnB1dC52YWwoKTtcclxuICAgICAgICAgICAgICAgIGlmICh2YWx1ZS5sZW5ndGgpIHtcclxuICAgICAgICAgICAgICAgICAgICB0b3RhbCArPSBwYXJzZUludCh2YWx1ZSk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0pO1xyXG5cclxuICAgICAgICAgICAgaWYgKHRvdGFsICE9IDEwMCkge1xyXG4gICAgICAgICAgICAgICAgc3dhbCh7XHJcbiAgICAgICAgICAgICAgICAgICAgdGl0bGU6IFwiUGxlYXNlIGNoZWNrIHN1YmplY3QgcGVyaW9kIHZhbHVlc1wiLFxyXG4gICAgICAgICAgICAgICAgICAgIHRleHQ6ICBcIlRvdGFsIG9mIGFsbCB2YWx1ZXMgbXVzdCBiZSBleGFjdGx5IDEwMC5cIixcclxuICAgICAgICAgICAgICAgICAgICBpY29uOiBcIndhcm5pbmdcIixcclxuICAgICAgICAgICAgICAgICAgICBkYW5nZXJNb2RlOiB0cnVlLFxyXG4gICAgICAgICAgICAgICAgfSlcclxuICAgICAgICAgICAgICAgIHJldHVybiBmYWxzZTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgICBcclxuICAgICAgICBpZiAoY29uZmlybWF0aW9uKSB7XHJcbiAgICAgICAgICAgIHN3YWwoe1xyXG4gICAgICAgICAgICAgICAgdGl0bGU6IFwiQXJlIHlvdSBzdXJlP1wiLFxyXG4gICAgICAgICAgICAgICAgdGV4dDogICFjb25maXJtYXRpb25fbm90ZSA/IFwiT25jZSBkZWxldGVkLCB5b3UgbWF5IG5vdCBiZSBhYmxlIHRvIHJlY292ZXIgdGhpcyBkYXRhLlwiIDogIGNvbmZpcm1hdGlvbl9ub3RlLFxyXG4gICAgICAgICAgICAgICAgaWNvbjogXCJ3YXJuaW5nXCIsXHJcbiAgICAgICAgICAgICAgICBidXR0b25zOiB0cnVlLFxyXG4gICAgICAgICAgICAgICAgZGFuZ2VyTW9kZTogdHJ1ZSxcclxuICAgICAgICAgICAgfSlcclxuICAgICAgICAgICAgLnRoZW4oKHdpbGxEZWxldGUpID0+IHtcclxuICAgICAgICAgICAgICAgIGlmICh3aWxsRGVsZXRlKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgc3VibWl0Rm9ybShmb3JtLCBtZXRob2QsIHVybCwgZGF0YSk7XHJcbiAgICAgICAgICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgICAgICAgICAgIHN3YWwoXCJDYW5jZWxsZWQgYWN0aW9uXCIsICAhY29uZmlybWF0aW9uX2NhbmNlbGxlZF9ub3RlID8gXCJEYXRhIGlzIHJldGFpbi5cIiA6ICBjb25maXJtYXRpb25fY2FuY2VsbGVkX25vdGUpO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9KTtcclxuICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgICBzdWJtaXRGb3JtKGZvcm0sIG1ldGhvZCwgdXJsLCBkYXRhKTtcclxuICAgICAgICB9IFxyXG4gICAgfSk7XHJcblxyXG4gICAgZnVuY3Rpb24gc3VibWl0Rm9ybShmb3JtLCBtZXRob2QsIHVybCwgZGF0YSkge1xyXG4gICAgICAgIHRvYXN0ci5vcHRpb25zLnBvc2l0aW9uQ2xhc3MgPSAndG9hc3QtYm90dG9tLXJpZ2h0JztcclxuICAgICAgICB0b2FzdHIub3B0aW9ucy5leHRlbmRlZFRpbWVPdXQgPSAxMDAwO1xyXG4gICAgICAgIHRvYXN0ci5vcHRpb25zLnRpbWVPdXQgPSAyMDAwO1xyXG4gICAgICAgIHRvYXN0ci5vcHRpb25zLmZhZGVPdXQgPSAyNTA7XHJcbiAgICAgICAgdG9hc3RyLm9wdGlvbnMuZmFkZUluID0gMjUwO1xyXG5cclxuICAgICAgICAkLmFqYXgoe1xyXG4gICAgICAgICAgICB0eXBlIDogbWV0aG9kLFxyXG4gICAgICAgICAgICB1cmw6IHVybCxcclxuICAgICAgICAgICAgZGF0YSA6IGRhdGEsXHJcbiAgICAgICAgICAgIGRhdGFUeXBlIDogJ2pzb24nLFxyXG4gICAgICAgICAgICBwcm9jZXNzRGF0YTogdHJ1ZSxcclxuICAgICAgICAgICAgc3VjY2VzcyA6IGZ1bmN0aW9uKGRhdGEpIHtcclxuICAgICAgICAgICAgICAgIGlmIChkYXRhLnJlc2V0Rm9ybSkge1xyXG4gICAgICAgICAgICAgICAgICAgIGZvcm0udHJpZ2dlcihcInJlc2V0XCIpO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgaWYgKGRhdGEucmVkaXJlY3QgIT09IHVuZGVmaW5lZCkge1xyXG4gICAgICAgICAgICAgICAgICAgIHRvYXN0ci5zdWNjZXNzKCdSZWRpcmVjdGluZyBwbGVhc2Ugd2FpdC4uLicpO1xyXG5cdFx0XHRcdFx0c2V0VGltZW91dChmdW5jdGlvbigpIHtcclxuXHRcdFx0XHRcdFx0d2luZG93LmxvY2F0aW9uID0gZGF0YS5yZWRpcmVjdDtcclxuXHRcdFx0XHRcdH0sIDI1MDApO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgaWYgKGRhdGEubm90aWZNZXNzYWdlICE9PSB1bmRlZmluZWQpIHtcclxuICAgICAgICAgICAgICAgICAgICB0b2FzdHIuc3VjY2VzcyhkYXRhLm5vdGlmTWVzc2FnZSk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIGVycm9yIDogZnVuY3Rpb24oZGF0YSwgdGV4dCwgZXJyb3IpIHtcclxuICAgICAgICAgICAgICAgIGlmIChkYXRhLnJlc3BvbnNlSlNPTi5tZXNzYWdlLmxlbmd0aCkge1xyXG4gICAgICAgICAgICAgICAgICAgIGZvciAobGV0IGluZGV4ID0gMDsgaW5kZXggPCBkYXRhLnJlc3BvbnNlSlNPTi5tZXNzYWdlLmxlbmd0aDsgaW5kZXgrKykge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb25zdCBtZXNzYWdlID0gZGF0YS5yZXNwb25zZUpTT04ubWVzc2FnZVtpbmRleF07XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHRvYXN0ci53YXJuaW5nKG1lc3NhZ2UpO1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH0gZWxzZSBpZiAoZGF0YS5yZXNwb25zZUpTT04ubm90aWZNZXNzYWdlLmxlbmd0aCkge1xyXG4gICAgICAgICAgICAgICAgICAgIHRvYXN0ci53YXJuaW5nKGRhdGEucmVzcG9uc2VKU09OLm5vdGlmTWVzc2FnZSk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuICAgIH1cclxufSk7Il0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/app.js\n");

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