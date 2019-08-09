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
    mounted() {
        //initial campaign data bid
        axios.get("/specialties/list").then((res) => {
            Vue.set(this, "list", res.data)
        });
    },
    methods: {
        resetForm() {
            this.form.id = null;
            this.form.name = null;
        },
        openAdd() {
            app.resetForm();
            this.$validator.reset();
            app.titleModal = "<i class='fa fa-fw fa-stethoscope'></i> Cadastro de especialidade";
            jQuery("#modalForm").modal('show');
        },
        add(value) {
            this.$validator.validateAll().then((result) => {
                if (result) {
                    axios.post("/specialties/add", value).then(function (res) {
                        jQuery("#modalForm").modal('hide');
                        app.list = res.data;
                        swal("Sucesso!", (value.id === null) ? "Especialidade cadastrada com sucesso!" : "Especialidade editada com sucesso!", 'success');
                        setTimeout(() => {
                            app.resetForm();
                        }, 100);
                    });
                    return true;
                }
            });
        },
        edit(index) {
            app.titleModal = "<i class='fa fa-fw fa-stethoscope'></i> Edição de especialidade";
            let data = app.list[index];
            app.form = Object.assign({}, data);
            jQuery("#modalForm").modal("show");
        },
        del(index) {
            swal({
                title: "Você tem certeza?",
                text: "Realmente deseja excluir esta especialidade?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Especialidade deletada com sucesso!", {
                            icon: "success",
                        });
                        axios.delete("/specialties/delete/" + app.list[index].id).then(function () {
                            app.list.splice(index, 1);
                        });
                    }
                });
        }
    },
});