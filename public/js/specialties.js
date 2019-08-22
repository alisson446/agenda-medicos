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
/******/ 	return __webpack_require__(__webpack_require__.s = 214);
/******/ })
/************************************************************************/
/******/ ({

/***/ 214:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(215);


/***/ }),

/***/ 215:
/***/ (function(module, exports) {

var app = new Vue({
    el: "#app",
    data: {
        "titleModal": "<i class='fa fa-fw fa-stethoscope'></i> Cadastro de especialidade",
        "list": [],
        "form": {
            "id": null,
            "name": null
        }
    },
    mounted: function mounted() {
        var _this = this;

        //initial campaign data bid
        axios.get("/specialties/list").then(function (res) {
            Vue.set(_this, "list", res.data);
        });
    },

    methods: {
        resetForm: function resetForm() {
            this.form.id = null;
            this.form.name = null;
        },
        openAdd: function openAdd() {
            app.resetForm();
            this.$validator.reset();
            app.titleModal = "<i class='fa fa-fw fa-stethoscope'></i> Cadastro de especialidade";
            jQuery("#modalForm").modal('show');
        },
        add: function add(value) {
            this.$validator.validateAll().then(function (result) {
                if (result) {
                    axios.post("/specialties/add", value).then(function (res) {
                        jQuery("#modalForm").modal('hide');
                        app.list = res.data;
                        swal("Sucesso!", value.id === null ? "Especialidade cadastrada com sucesso!" : "Especialidade editada com sucesso!", 'success');
                        setTimeout(function () {
                            app.resetForm();
                        }, 100);
                    });
                    return true;
                }
            });
        },
        edit: function edit(index) {
            app.titleModal = "<i class='fa fa-fw fa-stethoscope'></i> Edição de especialidade";
            var data = app.list[index];
            app.form = Object.assign({}, data);
            jQuery("#modalForm").modal("show");
        },
        del: function del(index) {
            swal({
                title: "Você tem certeza?",
                text: "Realmente deseja excluir esta especialidade?",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then(function (willDelete) {
                if (willDelete) {
                    swal("Especialidade deletada com sucesso!", {
                        icon: "success"
                    });
                    axios.delete("/specialties/delete/" + app.list[index].id).then(function () {
                        app.list.splice(index, 1);
                    });
                }
            });
        }
    }
});

/***/ })

/******/ });