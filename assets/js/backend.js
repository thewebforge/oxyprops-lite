/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/backend.js":
/*!***************************!*\
  !*** ./src/js/backend.js ***!
  \***************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _sass_backend_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../sass/backend.scss */ \"./src/sass/backend.scss\");\n\n\nvar myFunction = function myFunction() {\n  console.log(\"OxyPRops Lite scripts available on BackEnd\");\n};\n\nvar switchTab = function switchTab(e) {\n  e.preventDefault();\n  document.querySelector(\"ul.nav-tabs li.active\").classList.remove(\"active\");\n  document.querySelector(\".tab-pane.active\").classList.remove(\"active\");\n  var targetTab = e.currentTarget;\n  var anchor = e.target;\n  var activePaneID = anchor.getAttribute(\"href\");\n  var targetPane = document.querySelector(activePaneID);\n  targetTab.classList.add(\"active\");\n  targetPane.classList.add(\"active\");\n};\n\nvar manageTabs = function manageTabs() {\n  var tabs = document.querySelectorAll(\"ul.nav-tabs > li\");\n  tabs.forEach(function (element) {\n    element.addEventListener(\"click\", switchTab);\n  });\n};\n\nwindow.addEventListener(\"load\", manageTabs);\nmyFunction();\n\n//# sourceURL=webpack://oxyprops-lite/./src/js/backend.js?");

/***/ }),

/***/ "./src/sass/backend.scss":
/*!*******************************!*\
  !*** ./src/sass/backend.scss ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n\n\n//# sourceURL=webpack://oxyprops-lite/./src/sass/backend.scss?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./src/js/backend.js");
/******/ 	
/******/ })()
;