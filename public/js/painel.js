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
/******/ 	return __webpack_require__(__webpack_require__.s = 56);
/******/ })
/************************************************************************/
/******/ ({

/***/ 56:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(57);


/***/ }),

/***/ 57:
/***/ (function(module, exports) {

var app = new Vue({
    el: "#app",
    data: {
        "list": [],
        "form": {
            "_id": null,
            "name": null,
            "server": null,
            "notify_receive": true
        }
    },
    mounted: function mounted() {
        //initial campaign data bid
        this.loadList();
    },

    methods: {
        loadList: function loadList() {
            var _this = this;

            axios.get("/server/list").then(function (res) {
                Vue.set(_this, "list", res.data);
            });
        },

        validate: function validate() {
            var retorno = {
                success: false,
                message: 'O(s) campo(s)'
            };
            if (this.form.name == null) {
                retorno.success = false;
                retorno.message += " nome, ";
            } else {
                retorno.success = true;
            }

            if (this.form.server == null) {
                retorno.success = false;
                retorno.message += " servidor";
            } else {
                retorno.success = true;
            }
            retorno.message += " deve(m) ser preenchido(s)";
            return retorno;
        },
        openAdd: function openAdd() {
            this.form._id = null;
            this.form.name = null;
            this.form.server = null;
            jQuery("#modalForm").modal('show');
        },

        add: function add(value) {
            var confirm = this.validate();

            console.log(confirm);
            if (confirm.success == false) {
                swal("Atenção!", confirm.message, 'warning');
                return false;
            }
            axios.post("/server/add", value).then(function (res) {
                jQuery("#modalForm").modal('hide');
                app.list = res.data;
            });
        },

        edit: function edit(index) {
            console.log("Edit");
            var painel = app.list[index];
            app.form = painel;
            this.id_edit = index;
            jQuery("#modalForm").modal("show");
        },

        del: function del(index) {
            swal({
                title: "Você tem certeza?",
                text: "Realmente deseja excluir este servidor?",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then(function (willDelete) {
                if (willDelete) {
                    swal("Servidor deletado com sucesso!", {
                        icon: "success"
                    });
                    axios.delete("/server/delete/" + app.list[index]._id).then(function () {
                        app.list.splice(index, 1);
                    });
                }
            });
        },
        saveStatus: function saveStatus(index) {
            var actual_status = !this.list[index].notify_receive;
            var _id = this.list[index]._id;
            axios.post('/server/update-status', { notify_receive: actual_status, _id: _id }).then(function (res) {
                swal("A configuração de recepção foi atualizada.", {
                    icon: "success"
                });
            });
        }
    }

});

/***/ })

/******/ });