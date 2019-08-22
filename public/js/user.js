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
/******/ 	return __webpack_require__(__webpack_require__.s = 224);
/******/ })
/************************************************************************/
/******/ ({

/***/ 224:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(225);


/***/ }),

/***/ 225:
/***/ (function(module, exports) {

var app = new Vue({
    el: "#app",
    data: {
        "titleModal": 'Cadastro',
        "list": [],
        "form": {
            "id": null,
            "name": null,
            "email": null,
            "password": null
        },
        "logedUser": ""
    },
    mounted: function mounted() {
        var _this = this;

        //initial campaign data bid
        this.loadUsers();
        axios.get("/user/loged-user").then(function (res) {
            _this.logedUser = res.data;
        });
    },

    methods: {
        loadUsers: function loadUsers() {
            var _this2 = this;

            axios.get("/user/list").then(function (res) {
                Vue.set(_this2, "list", res.data);
            });
        },
        resetForm: function resetForm() {
            this.form.id = null;
            this.form.name = null;
            this.form.email = null;
            this.form.password = null;
        },

        openAdd: function openAdd() {
            app.resetForm();
            this.$validator.reset();
            app.titleModal = this.form.id === null ? "<i class='fa fa-fw fa-user'></i> Cadastro de usuário" : "<i class='fa fa-fw fa-user'></i> Edição de usuário";
            jQuery("#modalForm").modal('show');
        },
        add: function add(value) {
            var _this3 = this;

            this.$validator.validateAll().then(function (result) {
                if (result) {
                    value.type = "admin";
                    if (value.id === null && value.password === null) {
                        swal("Atenção!", "Senha é obrigatória!", 'warning');
                    } else {
                        axios.post("/user/add", value).then(function (res) {
                            jQuery("#modalForm").modal('hide');
                            _this3.list = [];
                            _this3.loadUsers();
                            swal("Sucesso!", value.id === null ? "Usuário cadastrado com sucesso!" : "Usuário editado com sucesso!", 'success');
                            setTimeout(function () {
                                app.resetForm();
                            }, 100);
                        });
                    }
                }
            });
        },
        edit: function edit(index) {
            var data = app.list[index];
            app.form = Object.assign({}, data);
            jQuery("#modalForm").modal("show");
        },
        del: function del(index) {
            var _this4 = this;

            swal({
                title: "Você tem certeza?",
                text: "Realmente deseja excluir este usuário?",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then(function (willDelete) {
                if (willDelete) {
                    swal("Usuário deletado com sucesso!", {
                        icon: "success"
                    });
                    axios.delete("/user/delete/" + app.list[index].id).then(function () {
                        _this4.list = [];
                        _this4.loadUsers();
                    });
                }
            });
        }
    }
});

/***/ })

/******/ });