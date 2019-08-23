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
/******/ 	return __webpack_require__(__webpack_require__.s = 221);
/******/ })
/************************************************************************/
/******/ ({

/***/ 221:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(222);


/***/ }),

/***/ 222:
/***/ (function(module, exports) {

var app = new Vue({
    el: "#app",
    data: {
        "titleModal": "<i class='fa fa-fw fa-users'></i> Cadastro de paciente",
        "navActiveGeneral": 'active',
        "navActiveAddress": '',
        "navActiveSupplementaryData": '',
        "list": [],
        "listCountries": [],
        "listStates": [],
        "listCities": [],
        "form": {
            "id": null,
            "name": null,
            "email": null,
            "gender": null,
            "birthday_date": null,
            "phone_number": null,
            "cell_number": null,
            "observation": null,
            "plan": null,
            "plan_card_number": null,
            "plan_card_valid": null,
            "address_cep": null,
            "address_street": null,
            "address_number": null,
            "address_complement": null,
            "country_id": null,
            "state_id": null,
            "city_id": null,
            "phonetic_name": null,
            "job": null,
            "cpf": null,
            "civil_status": null,
            "mother_name": null,
            "mother_job": null,
            "father_name": null,
            "father_job": null,
            "identity": null,
            "issuance_date": null,
            "issuing_agency": null,
            "num_birth_registration": null,
            "blood_type": null,
            "cns": null
        }
    },
    mounted: function mounted() {
        var _this = this;

        //initial campaign data bid
        axios.post("/countries").then(function (res) {
            Vue.set(_this, "listCountries", res.data);
        });
        axios.get("/patients/list").then(function (res) {
            Vue.set(_this, "list", res.data);
        });
    },

    methods: {
        changeAddress: function changeAddress(event, type) {
            var _this2 = this;

            var val = event.target.value;
            switch (type) {
                case 'country':
                    axios.post("/states", { "country_id": val }).then(function (res) {
                        Vue.set(_this2, "listStates", res.data);
                        $('.state_id').removeAttr("disabled");
                    });
                    break;
                case 'state':
                    axios.post("/cities", { "state_id": val }).then(function (res) {
                        Vue.set(_this2, "listCities", res.data);
                        $('.city_id').removeAttr("disabled");
                    });
                    break;
            }

            return true;
        },
        changeNavActive: function changeNavActive(type) {
            switch (type) {
                case 'general':
                    Vue.set(this, "navActiveGeneral", 'active');
                    Vue.set(this, "navActiveAddress", '');
                    Vue.set(this, "navActiveSupplementaryData", '');
                    break;
                case 'address':
                    Vue.set(this, "navActiveGeneral", '');
                    Vue.set(this, "navActiveAddress", 'active');
                    Vue.set(this, "navActiveSupplementaryData", '');
                    break;
                case 'supplementary_data':
                    Vue.set(this, "navActiveGeneral", '');
                    Vue.set(this, "navActiveAddress", '');
                    Vue.set(this, "navActiveSupplementaryData", 'active');
                    break;
            }
        },
        setData: function setData(data) {
            app.form.birthday_date = data;
        },
        setDataPlanCardValid: function setDataPlanCardValid(data) {
            app.form.plan_card_valid = data;
        },
        setDataIssuanceDate: function setDataIssuanceDate(data) {
            app.form.issuance_date = data;
        },
        resetForm: function resetForm() {
            app.changeNavActive('general');
            this.form.id = null;
            this.form.name = null;
            this.form.email = null;
            this.form.gender = null;
            this.form.birthday_date = null;
            this.form.phone_number = null;
            this.form.cell_number = null;
            this.form.observation = null;
            this.form.plan = null;
            this.form.plan_card_number = null;
            this.form.plan_card_valid = null;
            this.form.address_cep = null;
            this.form.address_street = null;
            this.form.address_number = null;
            this.form.address_complement = null;
            this.form.country_id = null;
            this.form.state_id = null;
            this.form.city_id = null;
            this.form.phonetic_name = null;
            this.form.job = null;
            this.form.cpf = null;
            this.form.civil_status = null;
            this.form.mother_name = null;
            this.form.mother_job = null;
            this.form.father_name = null;
            this.form.father_job = null;
            this.form.identity = null;
            this.form.issuance_date = null;
            this.form.issuing_agency = null;
            this.form.num_birth_registration = null;
            this.form.blood_type = null;
            this.form.cns = null;
        },
        searchByCep: function searchByCep() {
            var cep = this.form.address_cep;
            var country_id = 1;
            if (cep) cep = cep.replace(/\D+/g, '');

            axios.post('searchByCep', { 'cep': cep }).then(function (res) {
                if (res.data.status === 200) {
                    Vue.set(app.form, "address_street", res.data.result.logradouro);
                    Vue.set(app.form, "address_complement", res.data.result.complemento);
                    Vue.set(app.form, "country_id", country_id);
                    app.changeAddress({ target: { value: country_id } }, 'country');
                    setTimeout(function () {
                        app.listStates.map(function (state) {
                            if (res.data.result.uf === state.abbreviation) {
                                Vue.set(app.form, "state_id", state.id);

                                app.changeAddress({ target: { value: state.id } }, 'state');
                                setTimeout(function () {
                                    app.listCities.map(function (city) {
                                        if (res.data.result.localidade === city.name) {
                                            Vue.set(app.form, "city_id", city.id);
                                        }
                                    });
                                }, 250);
                            }
                        });
                    }, 250);
                } else {
                    swal("Atenção!", "Localidade não encontrada!", 'warning');
                }
            });
        },
        openAdd: function openAdd() {
            this.resetForm();
            this.$validator.reset();
            app.titleModal = "<i class='fa fa-fw fa-users'></i> Cadastro de paciente";
            jQuery("#modalPatient").modal('show');
        },
        add: function add(value) {
            this.$validator.validateAll().then(function (result) {
                if (result) {
                    axios.post("/patients/add", value).then(function (res) {
                        jQuery("#modalPatient").modal('hide');
                        app.list = res.data;
                        swal("Sucesso!", value.id === null ? "Paciente cadastrada com sucesso!" : "Paciente editada com sucesso!", 'success');
                        setTimeout(function () {
                            app.resetForm();
                        }, 100);
                    });
                    return true;
                }
            });
        },
        edit: function edit(index) {
            app.titleModal = "<i class='fa fa-fw fa-users'></i> Edição de paciente";
            var data = app.list[index];
            app.form = Object.assign({}, data);
            app.changeAddress({ target: { value: data.country_id } }, 'country');
            setTimeout(function () {
                app.listStates.map(function (state) {
                    Vue.set(app.form, "state_id", data.state_id);
                    app.changeAddress({ target: { value: data.state_id } }, 'state');
                    setTimeout(function () {
                        app.listCities.map(function (city) {
                            Vue.set(app.form, "city_id", data.city_id);
                        });
                    }, 250);
                });
            }, 250);
            jQuery("#modalPatient").modal("show");
        },
        del: function del(index) {
            swal({
                title: "Você tem certeza?",
                text: "Realmente deseja excluir este paciente?",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then(function (willDelete) {
                if (willDelete) {
                    swal("Paciente deletado com sucesso!", {
                        icon: "success"
                    });
                    axios.delete("/patients/delete/" + app.list[index].id).then(function () {
                        app.list.splice(index, 1);
                    });
                }
            });
        }
    }
});

/***/ })

/******/ });