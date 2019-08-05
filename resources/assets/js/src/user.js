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
    mounted() {
        //initial campaign data bid
        this.loadUsers();
        axios.get("/user/loged-user").then((res) => {
            this.logedUser = res.data;
        });
    },
    methods: {
        loadUsers() {
            axios.get("/user/list").then((res) => {
                Vue.set(this, "list", res.data)
            });
        },
        resetForm() {
            this.form.id = null;
            this.form.name = null;
            this.form.email = null;
            this.form.password = null;
        },
        openAdd: function () {
            app.resetForm();
            this.$validator.reset();
            app.titleModal = this.form.id === null ? "<i class='fa fa-fw fa-user'></i> Cadastro de usuário" : "<i class='fa fa-fw fa-user'></i> Edição de usuário";
            jQuery("#modalForm").modal('show');
        },
        add: function (value) {
            this.$validator.validateAll().then((result) => {
                if (result) {
                    value.type = "admin";
                    if(value.id === null && value.password === null){
                        swal("Atenção!", "Senha é obrigatória!", 'warning');
                    }else{
                        axios.post("/user/add", value).then((res) => {
                            jQuery("#modalForm").modal('hide');
                            this.list = [];
                            this.loadUsers();
                            swal("Sucesso!", (value.id === null) ? "Usuário cadastrado com sucesso!" : "Usuário editado com sucesso!", 'success');
                            setTimeout(() => {
                                app.resetForm();
                            }, 100);
                        });
                    }
                }
            });
        },
        edit: function (index) {
            let data = app.list[index];
            app.form = Object.assign({}, data);
            jQuery("#modalForm").modal("show");
        },
        del: function (index) {
            swal({
                title: "Você tem certeza?",
                text: "Realmente deseja excluir este usuário?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Usuário deletado com sucesso!", {
                            icon: "success",
                        });
                        axios.delete("/user/delete/" + app.list[index].id).then(() => {
                            this.list = [];
                            this.loadUsers();
                        });
                    }
                });

        }
    }
});