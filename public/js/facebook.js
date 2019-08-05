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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 58);
/******/ })
/************************************************************************/
/******/ ({

/***/ 58:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(59);


/***/ }),

/***/ 59:
/***/ (function(module, exports) {

var app = new Vue({
    el: "#app",
    data: {
        "list": [],
        "servers": [],
        "form": {
            "_id": null,
            "name": null,
            "server": null,
            "token": null
        }
    },
    mounted: function mounted() {
        var _this = this;

        //initial campaign data bid
        axios.get("/facebook/list").then(function (res) {
            Vue.set(_this, "list", res.data);
        });
        axios.get("/server/list").then(function (res) {
            Vue.set(_this, "servers", res.data);
        });
    },

    methods: {
        validate: function validate() {
            var retorno = {
                success: false,
                message: 'O(s) campo(s)'
            };
            if (this.form.name == null) {
                retorno.success = false;
                retorno.message += " empresa, ";
            } else {
                retorno.success = true;
            }
            if (this.form.server == null) {
                retorno.success = false;
                retorno.message += " server, ";
            } else {
                retorno.success = true;
            }
            if (this.form.token == null) {
                retorno.success = false;
                retorno.message += " token";
            } else {
                retorno.success = true;
            }
            retorno.message += " deve(m) ser preenchido(s)";
            return retorno;
        },
        openAdd: function openAdd() {
            jQuery("#modalForm").modal('show');
        },
        add: function add(value) {

            var confirm = this.validate();
            if (confirm.success == false) {
                swal("Atenção!", confirm.message, 'warning');
                return false;
            }

            axios.post("/facebook/add", value).then(function (res) {
                jQuery("#modalForm").modal('hide');
                app.list = res.data;
                app.form = {
                    "_id": null,
                    "name": null,
                    "server": null,
                    "token": null
                };
            });
        },
        edit: function edit(index) {
            var painel = app.list[index];
            app.form = painel;
            jQuery("#modalForm").modal("show");
        },
        del: function del(index) {
            swal({
                title: "Você tem certeza?",
                text: "Realmente deseja excluir este facebook?",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then(function (willDelete) {
                if (willDelete) {
                    swal("Facebook deletado com sucesso!", {
                        icon: "success"
                    });
                    axios.delete("/facebook/delete/" + app.list[index]._id).then(function () {
                        app.list.splice(index, 1);
                    });
                }
            });
        }
    }
});

/***/ })

/******/ });