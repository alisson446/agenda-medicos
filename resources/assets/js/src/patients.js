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
    mounted() {
        //initial campaign data bid
        axios.post("/countries").then((res) => {
            Vue.set(this, "listCountries", res.data)
        });
        axios.get("/patients/list").then((res) => {
            Vue.set(this, "list", res.data)
        });
    },
    methods: {
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
        setData(data) {
            app.form.birthday_date = data;
        },
        setDataPlanCardValid(data) {
            app.form.plan_card_valid = data;
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
            app.titleModal = "<i class='fa fa-fw fa-users'></i> Cadastro de paciente";
            jQuery("#modalForm").modal('show');
        },
        add(value) {
            this.$validator.validateAll().then((result) => {
                if (result) {
                    axios.post("/patients/add", value).then(function (res) {
                        jQuery("#modalForm").modal('hide');
                        app.list = res.data;
                        swal("Sucesso!", (value.id === null) ? "Paciente cadastrada com sucesso!" : "Paciente editada com sucesso!", 'success');
                        setTimeout(() => {
                            app.resetForm();
                        }, 100);
                    });
                    return true;
                }
            });
        },
        edit(index) {
            app.titleModal = "<i class='fa fa-fw fa-users'></i> Edição de paciente";
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
                text: "Realmente deseja excluir este paciente?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Paciente deletado com sucesso!", {
                            icon: "success",
                        });
                        axios.delete("/patients/delete/" + app.list[index].id).then(function () {
                            app.list.splice(index, 1);
                        });
                    }
                });
        }
    },
});