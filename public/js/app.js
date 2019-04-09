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

eval("$(document).ready(function () {\n  setTimeout(function () {\n    $('body').removeClass('loading'); // remove loader overlay when page is ready with 1 sec delay\n  }, 1000);\n  $('form.ajax-submit').on('submit', function (e) {\n    e.preventDefault();\n    var form = $(this);\n    var method = $(this).attr('method');\n    var url = $(this).attr('action');\n    var data = $(this).serializeArray();\n    var confirmation = $(this).attr('confirmation');\n    var confirmation_note = $(this).attr('confirmation-note');\n    var confirmation_cancelled_note = $(this).attr('confirmation-cancelled-note');\n    var isComputation = form.hasClass('form-computation');\n\n    if (isComputation) {\n      var total = 0;\n      form.find('input[name=\"value[]\"]').each(function () {\n        var input = $(this);\n        var value = input.val();\n        var action = input.closest('.action-coverage').find('input.action-input').val();\n\n        if (value.length && action != 'delete') {\n          total += parseInt(value);\n        }\n      });\n\n      if (total != 100) {\n        swal({\n          title: \"Please check criteria values\",\n          text: \"Total of all values must be exactly 100.\",\n          icon: \"warning\",\n          dangerMode: true\n        });\n        return false;\n      }\n    }\n\n    if (confirmation) {\n      swal({\n        title: \"Are you sure?\",\n        text: !confirmation_note ? \"Once deleted, you may not be able to recover this data.\" : confirmation_note,\n        icon: \"warning\",\n        buttons: true,\n        dangerMode: true\n      }).then(function (willDelete) {\n        if (willDelete) {\n          submitForm(form, method, url, data);\n        } else {\n          swal(\"Cancelled action\", !confirmation_cancelled_note ? \"Data is retain.\" : confirmation_cancelled_note);\n        }\n      });\n    } else {\n      submitForm(form, method, url, data);\n    }\n  });\n\n  function submitForm(form, method, url, data) {\n    toastr.options.positionClass = 'toast-bottom-right';\n    toastr.options.extendedTimeOut = 1000;\n    toastr.options.timeOut = 2000;\n    toastr.options.fadeOut = 250;\n    toastr.options.fadeIn = 250;\n    $.ajax({\n      type: method,\n      url: url,\n      data: data,\n      dataType: 'json',\n      processData: true,\n      success: function success(data) {\n        if (data.resetForm) {\n          form.trigger(\"reset\");\n        }\n\n        if (data.redirect !== undefined) {\n          toastr.success('Redirecting please wait...');\n          setTimeout(function () {\n            window.location = data.redirect;\n          }, 2500);\n        }\n\n        if (data.notifMessage !== undefined) {\n          toastr.success(data.notifMessage);\n        }\n      },\n      error: function error(data, text, _error) {\n        if (data.responseJSON.message.length) {\n          for (var index = 0; index < data.responseJSON.message.length; index++) {\n            var message = data.responseJSON.message[index];\n            toastr.warning(message);\n          }\n        } else if (data.responseJSON.notifMessage.length) {\n          toastr.warning(data.responseJSON.notifMessage);\n        }\n      }\n    });\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvYXBwLmpzPzZkNDAiXSwibmFtZXMiOlsiJCIsImRvY3VtZW50IiwicmVhZHkiLCJzZXRUaW1lb3V0IiwicmVtb3ZlQ2xhc3MiLCJvbiIsImUiLCJwcmV2ZW50RGVmYXVsdCIsImZvcm0iLCJtZXRob2QiLCJhdHRyIiwidXJsIiwiZGF0YSIsInNlcmlhbGl6ZUFycmF5IiwiY29uZmlybWF0aW9uIiwiY29uZmlybWF0aW9uX25vdGUiLCJjb25maXJtYXRpb25fY2FuY2VsbGVkX25vdGUiLCJpc0NvbXB1dGF0aW9uIiwiaGFzQ2xhc3MiLCJ0b3RhbCIsImZpbmQiLCJlYWNoIiwiaW5wdXQiLCJ2YWx1ZSIsInZhbCIsImFjdGlvbiIsImNsb3Nlc3QiLCJsZW5ndGgiLCJwYXJzZUludCIsInN3YWwiLCJ0aXRsZSIsInRleHQiLCJpY29uIiwiZGFuZ2VyTW9kZSIsImJ1dHRvbnMiLCJ0aGVuIiwid2lsbERlbGV0ZSIsInN1Ym1pdEZvcm0iLCJ0b2FzdHIiLCJvcHRpb25zIiwicG9zaXRpb25DbGFzcyIsImV4dGVuZGVkVGltZU91dCIsInRpbWVPdXQiLCJmYWRlT3V0IiwiZmFkZUluIiwiYWpheCIsInR5cGUiLCJkYXRhVHlwZSIsInByb2Nlc3NEYXRhIiwic3VjY2VzcyIsInJlc2V0Rm9ybSIsInRyaWdnZXIiLCJyZWRpcmVjdCIsInVuZGVmaW5lZCIsIndpbmRvdyIsImxvY2F0aW9uIiwibm90aWZNZXNzYWdlIiwiZXJyb3IiLCJyZXNwb25zZUpTT04iLCJtZXNzYWdlIiwiaW5kZXgiLCJ3YXJuaW5nIl0sIm1hcHBpbmdzIjoiQUFBQUEsQ0FBQyxDQUFDQyxRQUFELENBQUQsQ0FBWUMsS0FBWixDQUFrQixZQUFXO0FBQ3pCQyxZQUFVLENBQUMsWUFBTTtBQUNiSCxLQUFDLENBQUMsTUFBRCxDQUFELENBQVVJLFdBQVYsQ0FBc0IsU0FBdEIsRUFEYSxDQUNxQjtBQUNyQyxHQUZTLEVBRVAsSUFGTyxDQUFWO0FBR0FK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S0FBSyxHQUFHaEQsSUFBSSxDQUFDOEMsWUFBTCxDQUFrQkMsT0FBbEIsQ0FBMEJoQyxNQUF0RCxFQUE4RGlDLEtBQUssRUFBbkUsRUFBdUU7QUFDbkUsZ0JBQU1ELE9BQU8sR0FBRy9DLElBQUksQ0FBQzhDLFlBQUwsQ0FBa0JDLE9BQWxCLENBQTBCQyxLQUExQixDQUFoQjtBQUNBdEIsa0JBQU0sQ0FBQ3VCLE9BQVAsQ0FBZUYsT0FBZjtBQUNIO0FBQ0osU0FMRCxNQUtPLElBQUkvQyxJQUFJLENBQUM4QyxZQUFMLENBQWtCRixZQUFsQixDQUErQjdCLE1BQW5DLEVBQTJDO0FBQzlDVyxnQkFBTSxDQUFDdUIsT0FBUCxDQUFlakQsSUFBSSxDQUFDOEMsWUFBTCxDQUFrQkYsWUFBakM7QUFDSDtBQUNKO0FBN0JFLEtBQVA7QUErQkg7QUFDSixDQWpHRCIsImZpbGUiOiIuL3Jlc291cmNlcy9qcy9hcHAuanMuanMiLCJzb3VyY2VzQ29udGVudCI6WyIkKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcclxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xyXG4gICAgICAgICQoJ2JvZHknKS5yZW1vdmVDbGFzcygnbG9hZGluZycpOyAvLyByZW1vdmUgbG9hZGVyIG92ZXJsYXkgd2hlbiBwYWdlIGlzIHJlYWR5IHdpdGggMSBzZWMgZGVsYXlcclxuICAgIH0sIDEwMDApO1xyXG4gICAgJCgnZm9ybS5hamF4LXN1Ym1pdCcpLm9uKCdzdWJtaXQnLCBmdW5jdGlvbiAoZSkge1xyXG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICB2YXIgZm9ybSA9ICQodGhpcyk7XHJcbiAgICAgICAgdmFyIG1ldGhvZCA9ICQodGhpcykuYXR0cignbWV0aG9kJyk7XHJcbiAgICAgICAgdmFyIHVybCA9ICQodGhpcykuYXR0cignYWN0aW9uJyk7XHJcbiAgICAgICAgdmFyIGRhdGEgPSAkKHRoaXMpLnNlcmlhbGl6ZUFycmF5KCk7XHJcbiAgICAgICAgdmFyIGNvbmZpcm1hdGlvbiA9ICQodGhpcykuYXR0cignY29uZmlybWF0aW9uJyk7XHJcbiAgICAgICAgdmFyIGNvbmZpcm1hdGlvbl9ub3RlID0gJCh0aGlzKS5hdHRyKCdjb25maXJtYXRpb24tbm90ZScpO1xyXG4gICAgICAgIHZhciBjb25maXJtYXRpb25fY2FuY2VsbGVkX25vdGUgPSAkKHRoaXMpLmF0dHIoJ2NvbmZpcm1hdGlvbi1jYW5jZWxsZWQtbm90ZScpO1xyXG5cclxuICAgICAgICB2YXIgaXNDb21wdXRhdGlvbiA9IGZvcm0uaGFzQ2xhc3MoJ2Zvcm0tY29tcHV0YXRpb24nKTtcclxuXHJcbiAgICAgICAgaWYgKGlzQ29tcHV0YXRpb24pIHtcclxuICAgICAgICAgICAgdmFyIHRvdGFsID0gMDtcclxuICAgICAgICAgICAgZm9ybS5maW5kKCdpbnB1dFtuYW1lPVwidmFsdWVbXVwiXScpLmVhY2goZnVuY3Rpb24gKCkge1xyXG4gICAgICAgICAgICAgICAgdmFyIGlucHV0ID0gJCh0aGlzKTtcclxuICAgICAgICAgICAgICAgIHZhciB2YWx1ZSA9IGlucHV0LnZhbCgpO1xyXG4gICAgICAgICAgICAgICAgdmFyIGFjdGlvbiA9IGlucHV0LmNsb3Nlc3QoJy5hY3Rpb24tY292ZXJhZ2UnKS5maW5kKCdpbnB1dC5hY3Rpb24taW5wdXQnKS52YWwoKTtcclxuICAgICAgICAgICAgICAgIGlmICh2YWx1ZS5sZW5ndGggJiYgYWN0aW9uICE9ICdkZWxldGUnKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgdG90YWwgKz0gcGFyc2VJbnQodmFsdWUpO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgICAgIGlmICh0b3RhbCAhPSAxMDApIHtcclxuICAgICAgICAgICAgICAgIHN3YWwoe1xyXG4gICAgICAgICAgICAgICAgICAgIHRpdGxlOiBcIlBsZWFzZSBjaGVjayBjcml0ZXJpYSB2YWx1ZXNcIixcclxuICAgICAgICAgICAgICAgICAgICB0ZXh0OiAgXCJUb3RhbCBvZiBhbGwgdmFsdWVzIG11c3QgYmUgZXhhY3RseSAxMDAuXCIsXHJcbiAgICAgICAgICAgICAgICAgICAgaWNvbjogXCJ3YXJuaW5nXCIsXHJcbiAgICAgICAgICAgICAgICAgICAgZGFuZ2VyTW9kZTogdHJ1ZSxcclxuICAgICAgICAgICAgICAgIH0pXHJcbiAgICAgICAgICAgICAgICByZXR1cm4gZmFsc2U7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgICAgXHJcbiAgICAgICAgaWYgKGNvbmZpcm1hdGlvbikge1xyXG4gICAgICAgICAgICBzd2FsKHtcclxuICAgICAgICAgICAgICAgIHRpdGxlOiBcIkFyZSB5b3Ugc3VyZT9cIixcclxuICAgICAgICAgICAgICAgIHRleHQ6ICAhY29uZmlybWF0aW9uX25vdGUgPyBcIk9uY2UgZGVsZXRlZCwgeW91IG1heSBub3QgYmUgYWJsZSB0byByZWNvdmVyIHRoaXMgZGF0YS5cIiA6ICBjb25maXJtYXRpb25fbm90ZSxcclxuICAgICAgICAgICAgICAgIGljb246IFwid2FybmluZ1wiLFxyXG4gICAgICAgICAgICAgICAgYnV0dG9uczogdHJ1ZSxcclxuICAgICAgICAgICAgICAgIGRhbmdlck1vZGU6IHRydWUsXHJcbiAgICAgICAgICAgIH0pXHJcbiAgICAgICAgICAgIC50aGVuKCh3aWxsRGVsZXRlKSA9PiB7XHJcbiAgICAgICAgICAgICAgICBpZiAod2lsbERlbGV0ZSkge1xyXG4gICAgICAgICAgICAgICAgICAgIHN1Ym1pdEZvcm0oZm9ybSwgbWV0aG9kLCB1cmwsIGRhdGEpO1xyXG4gICAgICAgICAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgICAgICAgICBzd2FsKFwiQ2FuY2VsbGVkIGFjdGlvblwiLCAgIWNvbmZpcm1hdGlvbl9jYW5jZWxsZWRfbm90ZSA/IFwiRGF0YSBpcyByZXRhaW4uXCIgOiAgY29uZmlybWF0aW9uX2NhbmNlbGxlZF9ub3RlKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgc3VibWl0Rm9ybShmb3JtLCBtZXRob2QsIHVybCwgZGF0YSk7XHJcbiAgICAgICAgfSBcclxuICAgIH0pO1xyXG5cclxuICAgIGZ1bmN0aW9uIHN1Ym1pdEZvcm0oZm9ybSwgbWV0aG9kLCB1cmwsIGRhdGEpIHtcclxuICAgICAgICB0b2FzdHIub3B0aW9ucy5wb3NpdGlvbkNsYXNzID0gJ3RvYXN0LWJvdHRvbS1yaWdodCc7XHJcbiAgICAgICAgdG9hc3RyLm9wdGlvbnMuZXh0ZW5kZWRUaW1lT3V0ID0gMTAwMDtcclxuICAgICAgICB0b2FzdHIub3B0aW9ucy50aW1lT3V0ID0gMjAwMDtcclxuICAgICAgICB0b2FzdHIub3B0aW9ucy5mYWRlT3V0ID0gMjUwO1xyXG4gICAgICAgIHRvYXN0ci5vcHRpb25zLmZhZGVJbiA9IDI1MDtcclxuXHJcbiAgICAgICAgJC5hamF4KHtcclxuICAgICAgICAgICAgdHlwZSA6IG1ldGhvZCxcclxuICAgICAgICAgICAgdXJsOiB1cmwsXHJcbiAgICAgICAgICAgIGRhdGEgOiBkYXRhLFxyXG4gICAgICAgICAgICBkYXRhVHlwZSA6ICdqc29uJyxcclxuICAgICAgICAgICAgcHJvY2Vzc0RhdGE6IHRydWUsXHJcbiAgICAgICAgICAgIHN1Y2Nlc3MgOiBmdW5jdGlvbihkYXRhKSB7XHJcbiAgICAgICAgICAgICAgICBpZiAoZGF0YS5yZXNldEZvcm0pIHtcclxuICAgICAgICAgICAgICAgICAgICBmb3JtLnRyaWdnZXIoXCJyZXNldFwiKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIGlmIChkYXRhLnJlZGlyZWN0ICE9PSB1bmRlZmluZWQpIHtcclxuICAgICAgICAgICAgICAgICAgICB0b2FzdHIuc3VjY2VzcygnUmVkaXJlY3RpbmcgcGxlYXNlIHdhaXQuLi4nKTtcclxuXHRcdFx0XHRcdHNldFRpbWVvdXQoZnVuY3Rpb24oKSB7XHJcblx0XHRcdFx0XHRcdHdpbmRvdy5sb2NhdGlvbiA9IGRhdGEucmVkaXJlY3Q7XHJcblx0XHRcdFx0XHR9LCAyNTAwKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIGlmIChkYXRhLm5vdGlmTWVzc2FnZSAhPT0gdW5kZWZpbmVkKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgdG9hc3RyLnN1Y2Nlc3MoZGF0YS5ub3RpZk1lc3NhZ2UpO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICBlcnJvciA6IGZ1bmN0aW9uKGRhdGEsIHRleHQsIGVycm9yKSB7XHJcbiAgICAgICAgICAgICAgICBpZiAoZGF0YS5yZXNwb25zZUpTT04ubWVzc2FnZS5sZW5ndGgpIHtcclxuICAgICAgICAgICAgICAgICAgICBmb3IgKGxldCBpbmRleCA9IDA7IGluZGV4IDwgZGF0YS5yZXNwb25zZUpTT04ubWVzc2FnZS5sZW5ndGg7IGluZGV4KyspIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgY29uc3QgbWVzc2FnZSA9IGRhdGEucmVzcG9uc2VKU09OLm1lc3NhZ2VbaW5kZXhdO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB0b2FzdHIud2FybmluZyhtZXNzYWdlKTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9IGVsc2UgaWYgKGRhdGEucmVzcG9uc2VKU09OLm5vdGlmTWVzc2FnZS5sZW5ndGgpIHtcclxuICAgICAgICAgICAgICAgICAgICB0b2FzdHIud2FybmluZyhkYXRhLnJlc3BvbnNlSlNPTi5ub3RpZk1lc3NhZ2UpO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcbn0pOyJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/app.js\n");

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