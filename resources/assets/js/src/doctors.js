var app = new Vue({
    el: "#app",
    data: {
        "titleModal": "<i class='fa fa-fw fa-user-md'></i> Cadastro de prestador",
        "navActiveGeneral": 'active',
        "navActiveAddress": '',
        "navActiveProfission": '',
        "list": [],
        "listProfessionalAdvices": [],
        "listCountries": [],
        "listStates": [],
        "listCities": [],
        "listStatesProfessionalAdvice": [],
        "listSpecialties": [],
        "form": {
            "id": null,
            "name": null,
            "email": null,
            "gender": null,
            "birthday_date": '01-01-2019',
            "phone_number": null,
            "cell_number": null,
            "address_cep": null,
            "address_street": null,
            "address_number": null,
            "address_complement": null,
            "country_id": null,
            "state_id": null,
            "city_id": null,
            "specialties": [],
            "cpf": null,
            "identity": null,
            "issuance_date": null,
            "issuing_agency": null,
            "professional_advice_id": null,
            "professional_advice_state_id": null,
            "professional_advice_number": null,
            "professional_advice_type": null
        }
    },
    mounted() {
        //initial campaign data bid
        axios.post("/countries").then((res) => {
            Vue.set(this, "listCountries", res.data)
        });
        axios.post("/states", {"country_id": 1}).then((res) => {
            Vue.set(this, "listStatesProfessionalAdvice", res.data);
        });
        axios.post("/professional_advices").then((res) => {
            Vue.set(this, "listProfessionalAdvices", res.data);
        });
        axios.get("/specialties/list").then((res) => {
            Vue.set(this, "listSpecialties", res.data);
        });
        axios.get("/doctors/list").then((res) => {
            Vue.set(this, "list", res.data)
        });
    },
    methods: {
        addTag (newTag) {
            console.log(newTag)
            const tag = {
                name: newTag,
                code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
            };
            this.listSpecialties.push(tag);
            this.specialties.push(tag);
        },
        changeAddress(event, type) {
            let val = event.target.value;
            switch (type) {
                case 'country':
                    axios.post("/states", {"country_id": val}).then((res) => {
                        Vue.set(this, "listStates", res.data);
                        $('.state_id').removeAttr("disabled");
                    });
                    break;
                case 'state':
                    axios.post("/cities", {"state_id": val}).then((res) => {
                        Vue.set(this, "listCities", res.data);
                        $('.city_id').removeAttr("disabled");
                    });
                    break;
            }

            return true;
        },
        changeNavActive(type) {
            switch (type) {
                case 'general':
                    Vue.set(this, "navActiveGeneral", 'active');
                    Vue.set(this, "navActiveAddress", '');
                    Vue.set(this, "navActiveProfission", '');
                    break;
                case 'address':
                    Vue.set(this, "navActiveGeneral", '');
                    Vue.set(this, "navActiveAddress", 'active');
                    Vue.set(this, "navActiveProfission", '');
                    break;
                case 'profission':
                    Vue.set(this, "navActiveGeneral", '');
                    Vue.set(this, "navActiveAddress", '');
                    Vue.set(this, "navActiveProfission", 'active');
                    break;
            }
        },
        setData(data) {
            app.form.birthday_date = data;
        },
        setDataIssuanceDate(data) {
            app.form.issuance_date = data;
        },
        resetForm() {
            app.changeNavActive('general');
            this.form.id = null;
            this.form.name = null;
            this.form.email = null;
            this.form.gender = null;
            this.form.birthday_date = null;
            this.form.phone_number = null;
            this.form.cell_number = null;
            this.form.address_cep = null;
            this.form.address_street = null;
            this.form.address_number = null;
            this.form.address_complement = null;
            this.form.country_id = null;
            this.form.state_id = null;
            this.form.city_id = null;
            this.form.specialties = [];
            this.form.cpf = null;
            this.form.identity = null;
            this.form.issuance_date = null;
            this.form.issuing_agency = null;
            this.form.professional_advice_id = null;
            this.form.professional_advice_state_id = null;
            this.form.professional_advice_number = null;
            this.form.professional_advice_type = null;
        },
        searchByCep() {
            let cep = this.form.address_cep;
            let country_id = 1;
            if (cep)
                cep = cep.replace(/\D+/g, '');

            axios.post('searchByCep', {'cep': cep}).then(function (res) {
                if (res.data.status === 200) {
                    Vue.set(app.form, "address_street", res.data.result.logradouro);
                    Vue.set(app.form, "address_complement", res.data.result.complemento);
                    Vue.set(app.form, "country_id", country_id);
                    app.changeAddress({target: {value: country_id}}, 'country');
                    setTimeout(() => {
                        app.listStates.map(function (state) {
                            if (res.data.result.uf === state.abbreviation) {
                                Vue.set(app.form, "state_id", state.id);

                                app.changeAddress({target: {value: state.id}}, 'state');
                                setTimeout(() => {
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
        openAdd() {
            this.resetForm();
            this.$validator.reset();
            app.titleModal = "<i class='fa fa-fw fa-user-md'></i> Cadastro de prestador";
            jQuery("#modalForm").modal('show');
        },
        add(value) {
            this.$validator.validateAll().then((result) => {
                if (result) {
                    axios.post("/doctors/add", value).then(function (res) {
                        jQuery("#modalForm").modal('hide');
                        app.list = res.data;
                        swal("Sucesso!", (value.id === null) ? "Prestador cadastrado com sucesso!" : "Prestador editado com sucesso!", 'success');
                        setTimeout(() => {
                            app.resetForm();
                        }, 100);
                    });
                    return true;
                }
            });
        },
        edit(index) {
            app.titleModal = "<i class='fa fa-fw fa-user-md'></i> Edição de prestador";
            let data = app.list[index];
            app.form = Object.assign({}, data);
            app.changeAddress({target: {value: data.country_id}}, 'country');
            setTimeout(() => {
                app.listStates.map(function (state) {
                    Vue.set(app.form, "state_id", data.state_id);
                    app.changeAddress({target: {value: data.state_id}}, 'state');
                    setTimeout(() => {
                        app.listCities.map(function (city) {
                            Vue.set(app.form, "city_id", data.city_id);
                        });
                    }, 250);
                });
            }, 250);
            jQuery("#modalForm").modal("show");
        },
        del(index) {
            swal({
                title: "Você tem certeza?",
                text: "Realmente deseja excluir este prestador?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Prestador deletado com sucesso!", {
                            icon: "success",
                        });
                        axios.delete("/doctors/delete/" + app.list[index].id).then(function () {
                            app.list.splice(index, 1);
                        });
                    }
                });
        }
    },
});