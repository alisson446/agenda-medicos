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
/******/ 	return __webpack_require__(__webpack_require__.s = 62);
/******/ })
/************************************************************************/
/******/ ({

/***/ 62:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(63);


/***/ }),

/***/ 63:
/***/ (function(module, exports) {

var pages = 30;
var app = new Vue({
    el: "#app",
    data: {
        form: {
            tipo: null,
            mensagem: null,
            link: null,
            permissao: "*"
        },
        list: [],
        notifications: [],
        selectedPanel: null,
        toSelectPanels: [],
        selectedPanels: [],
        link_prefix: "https://",
        link: "",
        painel: 1,
        editing: null,
        limite_caracteres: 200,
        mensagem: "",
        server: "",
        paginator: {
            jump: pages,
            limit: pages,
            offset: 0
        },
        saving: null
    },
    mounted: function mounted() {
        var _this = this;

        axios.get("/server/list").then(function (res) {
            _this.toSelectPanels = res.data;
            _this.list = res.data;
        });
        this.loadNotifications();
    },

    watch: {
        painel: function painel() {
            // console.log();
            if (this.painel == 1) {
                this.form.permissao = "*";
            } else {
                this.unselectPanelAll();
            }
        },
        mensagem: function mensagem() {
            this.form.mensagem = this.mensagem;
            this.limite_caracteres = 200 - this.form.mensagem.length;
        },
        selectedPanel: function selectedPanel() {
            this.selectedPanels = [];
            this.selectedPanels.push(this.toSelectPanels[this.selectedPanel]);
        },
        link: function link() {
            this.form.link = this.link_prefix + this.link;
        }
    },
    methods: {
        setServer: function setServer(index) {
            this.server = index;
        },
        openAdd: function openAdd() {
            jQuery("#modalForm").modal('show');
            this.unselectPanelAll();
            this.cleanForm();
            this.saving = null;
            $(document).find(".sz_progress").addClass("progress-bar-animated");
        },
        cleanForm: function cleanForm() {
            this.mensagem = "";
            this.form.link = null;
            this.link = null;
            this.form.permissao = "*";
            this.form.tipo = null;
            this.panel_id = null;
            this.form._id = null;
            this.editing = null;
            delete this.form.selectedPanels;
            this.unselectPanelAll();
        },
        selectPanel: function selectPanel(index) {
            this.selectedPanels.push(this.toSelectPanels[index]);
            this.toSelectPanels.splice(index, 1);
        },
        unselectPanel: function unselectPanel(index) {
            this.toSelectPanels.push(this.selectedPanels[index]);
            this.selectedPanels.splice(index, 1);
        },
        unselectPanelAll: function unselectPanelAll() {
            var _this2 = this;

            if (this.selectedPanels.length > 0) {
                this.selectedPanels.map(function (value, index) {
                    _this2.toSelectPanels.push(value);
                });
                this.selectedPanels = [];
            }
        },
        selectPanelAll: function selectPanelAll() {
            var _this3 = this;

            if (this.toSelectPanels.length > 0) {
                this.toSelectPanels.map(function (value, index) {
                    if (value.notify_receive != false) {
                        _this3.selectedPanels.push(value);
                    }
                });
                this.toSelectPanels = [];
            }
        },
        loadNotifications: function loadNotifications() {
            var _this4 = this;

            axios.get("/notifications/list").then(function (res) {
                _this4.notifications = [];
                _this4.notifications = res.data;
                _this4.paginator.total = res.data.length;

                _this4.notifications.map(function (element, index) {

                    element.panels.sort(function (a, b) {
                        if (a.name < b.name) return -1;
                        if (a.name > b.name) return 1;
                        return 0;
                    });
                });
            });
        },
        add: function add(value) {
            var _this5 = this;

            var id = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;


            var self = this;
            //Validações
            if (this.painel == 1) {
                if (this.selectedPanels.length <= 0 && this.panel_id == null) {
                    swal('Atenção', 'É necessário selecionar pelo menos um painel.', 'warning');
                    return false;
                }
            } else {
                if (this.form.permissao == "") {
                    swal('Atenção', 'É necessário definir as permissões.', 'warning');
                    return false;
                }
                if (this.selectedPanel == null && this.panel_id == null) {
                    swal('Atenção', 'É necessário definir um painel.', 'warning');
                    return false;
                }
            }
            if (this.form.tipo == null) {
                swal('Atenção', 'É necessário definir uma tipo.', 'warning');
                return false;
            }
            if (this.form.mensagem == null) {
                swal('Atenção', 'É necessário definir uma mensagem.', 'warning');
                return false;
            }
            if (this.form.link == null) {
                swal('Atenção', 'É necessário definir um link.', 'warning');
                return false;
            }
            swal({
                title: "Você tem certeza?",
                text: "Tem certeza que deseja enviar a notificação aos paineis?",
                buttons: {
                    cancel: "Cancelar",
                    confirm: "Enviar"
                }
            }).then(function (willDelete) {
                if (willDelete) {

                    if (_this5.selectedPanels) {

                        var dataSend = {
                            notification: _this5.form
                        };
                        _this5.saving = _this5.selectedPanels;

                        //Insere notificação no mongo
                        axios.post('/notifications/save-notify', dataSend).then(function (res) {

                            var notification = res.data.notification;
                            var id = res.data.id;

                            var panel = {
                                created_at: null,
                                name: null,
                                notify_receive: null,
                                server: null,
                                updated_at: null,
                                _id: null
                            };

                            _this5.selectedPanels.map(function (e, i) {

                                panel.created_at = e.created_at;
                                panel.name = e.name;
                                panel.notify_receive = e.notify_receive;
                                panel.server = e.server;
                                panel.updated_at = e.updated_at;
                                panel._id = e._id;

                                if (_this5.editing == true && e.success == true) {
                                    panel.id = e.response.response.id;
                                }

                                _this5.saveNotify({ 'panel': panel, 'notification': notification, 'id': id }, i);

                                panel = {
                                    created_at: null,
                                    name: null,
                                    notify_receive: null,
                                    server: null,
                                    updated_at: null,
                                    _id: null
                                };
                            });
                        });
                    }
                }
            });
        },
        saveNotify: function saveNotify(data, index) {
            var _this6 = this;

            axios.post('/notifications/insert-panel', data).then(function (res_) {

                var item = $(document).find("#item" + index);
                var objResult = null;

                try {
                    objResult = $.parseJSON(res_.data.content);
                } catch (ex) {
                    objResult = { success: false, response: res_.data.content };
                }

                if (objResult.success == true) {
                    item.addClass('bg-success').removeClass('progress-bar-animated').html("<strong>Notificação enviada com sucesso!</strong>");
                } else {
                    item.addClass('bg-danger').removeClass('progress-bar-animated').html("<strong>" + objResult.response + "</strong>");
                }

                _this6.loadNotifications();
            });
        },
        sliceString: function sliceString(string, max) {
            var newstring = "";
            if (string.length > max) newstring = string.substring(0, max) + "...";else newstring = string;
            return newstring;
        },
        defineType: function defineType(type) {
            var typeString = "";
            switch (type) {
                case '1':
                    typeString = "Aviso";
                    break;
                case '2':
                    typeString = "Novidades";
                    break;
                case '3':
                    typeString = "Integração";
                    break;
                case '4':
                    typeString = "Atualização";
                    break;
                case '5':
                    typeString = "Saldo";
                    break;
            }
            return typeString;
        },
        setPanels: function setPanels(index) {
            var _this7 = this;

            this.unselectPanelAll();
            var notify = this.notifications[index].panels;
            notify.map(function (value, index) {
                _this7.toSelectPanels.map(function (value_, index) {
                    if (value_._id == value._id) {
                        if (value._id != undefined) {
                            value_.id = value._id;
                        }
                        _this7.selectedPanels.push(value_);
                        _this7.toSelectPanels.splice(index, 1);
                    }
                });
            });
        },
        edit: function edit(index) {
            this.editing = true;
            var notifyData = this.notifications[index];
            this.setPanels(index);
            this.link = notifyData.link.split("://").pop();
            this.form.tipo = notifyData.tipo;
            this.mensagem = notifyData.mensagem;
            this.form.permissao = notifyData.permissao;
            this.form._id = notifyData._id;
            this.form.selectedPanels = this.notifications[index].panels;
            this.selectedPanels = this.notifications[index].panels;
            this.saving = null;
            $(document).find(".sz_progress").addClass("progress-bar-animated");
            $("#modalForm").modal();
        },
        limiteCaracteres: function limiteCaracteres() {
            this.limite_caracteres--;
        },
        del: function del(index) {
            var _this8 = this;

            swal({
                title: "Você tem certeza?",
                text: "Esta ação vai excluir a notificação de todos os paineis possíveis.",
                icon: "warning",
                button: {
                    text: "Excluir",
                    closeModal: false
                },
                dangerMode: true
            }).then(function (willDelete) {
                if (willDelete) {
                    var notifyData = _this8.notifications[index];
                    axios.post('/notifications/delete', notifyData).then(function (res) {
                        swal("Notificação excluída com sucesso!", {
                            icon: "success"
                        });

                        console.log(res);
                        _this8.loadNotifications();
                    });
                }
            });
        },
        checkEditable: function checkEditable(index) {
            var painels = this.notifications[index].panels;
            var retorno = false;

            painels.map(function (value, index) {
                if (value.deletable != null && value.deletable != false) {
                    retorno = true;
                }
            });
            return retorno;
        },
        formatData: function formatData(data) {
            var date = data.split(" ")[0];
            var time = data.split(" ").pop();
            return date.split("-").reverse().join("/") + " " + time;
        },
        pageNext: function pageNext() {
            this.paginator.offset += this.paginator.jump;
            this.paginator.limit += this.paginator.jump;
        },
        pagePrev: function pagePrev() {
            if (this.paginator.limit <= this.paginator.jump) {
                this.paginator.limit = this.paginator.jump;
                this.paginator.offset = 0;
            } else {
                this.paginator.offset -= this.paginator.jump;
                this.paginator.limit -= this.paginator.jump;
            }
        },
        recicleMessage: function recicleMessage(message) {
            this.$nextTick(function () {
                this.form.mensagem = message;
                this.mensagem = message;
            });
            this.openAdd();
        },
        setLinkPrefix: function setLinkPrefix() {
            if (this.link_prefix == 'https://') {
                this.link_prefix = 'http://';
            } else {
                this.link_prefix = 'https://';
            }
            this.form.link = this.link_prefix + this.link;
        }
    }
});

/***/ })

/******/ });