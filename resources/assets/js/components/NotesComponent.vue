<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <nav class="navbar navbar-dark bg-primary">
                    <span class="navbar-brand">Mural de Anotações</span>
                </nav>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-11">
                <p align="right">
                    <a href="javascript:void(0)" v-on:click="openAdd" class="btn btn-primary">
                        <i class="fa fa-plus"></i>
                    </a>
                </p>

                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Data</th>
                        <th>Médico</th>
                        <th>Paciente</th>
                        <th>Descrição</th>
                        <th>Lembrete</th>
                        <th class="dc_actions">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr :key="index" v-for="(value,index) in list">
                        <td>{{ moment(value.updated_at).format('DD/MM/YYYY') }}</td>
                        <td>{{ value.doctor_name }}</td>
                        <td>{{ value.patient_name }}</td>
                        <td>{{ value.note }}</td>
                        <td>{{ moment(value.reminder).format('DD/MM/YYYY HH:mm:ss') }}</td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-sm btn-primary" v-on:click="edit(index)"><i
                                        class="fa fa-edit"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger" v-on:click="del(index)"><i
                                        class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <modal-component id="modalNotes" :title="titleModal" :data="form" @submit="add">
                    <form @submit.prevent="add">
                        <input type="hidden" v-model="form.id" value=""/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Médico:</label>
                                    <select :style="errors.has('formDoctor') ? 'border: 1px solid red !important;' : ''"
                                        name="formDoctor" class="form-control" style="width: 100%;"
                                        v-model="form.doctor_id">
                                        <option v-bind:key="index" v-for="(value,index) in listDoctors" :value="value.id">
                                            {{ value.name }}
                                        </option>
                                    </select>
                                    <i v-show="errors.has('formDoctor')" class="fa fa-warning"
                                        :style="errors.has('formDoctor') ? 'color: red !important' : ''"></i>
                                    <span v-show="errors.has('formDoctor')"
                                        :style="errors.has('formDoctor') ? 'color: red !important' : ''">
                                        Médico é obrigatório!
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Paciente:</label>
                                    <select :style="errors.has('formPatient') ? 'border: 1px solid red !important;' : ''"
                                        name="formPatient" class="form-control" style="width: 100%;"
                                        v-model="form.patient_id">
                                        <option v-bind:key="index" v-for="(value,index) in listPatients" :value="value.id">
                                            {{ value.name }}
                                        </option>
                                    </select>
                                    <i v-show="errors.has('formPatient')" class="fa fa-warning"
                                        :style="errors.has('formPatient') ? 'color: red !important' : ''"></i>
                                    <span v-show="errors.has('formPatient')"
                                        :style="errors.has('formPatient') ? 'color: red !important' : ''">Paciente é obrigatório!</span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Anotação:</label>
                                    <input :style="errors.has('formNote') ? 'border: 1px solid red !important;' : ''"
                                        name="formNote" type="text"
                                        autocomplete="off" v-model="form.note" class="form-control"/>
                                    <i v-show="errors.has('formNote')" class="fa fa-warning"
                                        :style="errors.has('formNote') ? 'color: red !important' : ''"></i>
                                    <span v-show="errors.has('formNote')"
                                        :style="errors.has('formNote') ? 'color: red !important' : ''">Anotação é obrigatório!</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Data Lembrete:</label>
                                <input :style="errors.has('formReminderDate') ? 'border: 1px solid red !important;' : ''"
                                    name="formReminderDate" type="text" autocomplete="off"
                                    v-model="form.reminderDate" placeholder="dd/mm/yyyy" class="form-control" v-mask="'##/##/####'" />
                                <i v-show="errors.has('formReminderDate')" class="fa fa-warning"
                                    :style="errors.has('formReminderDate') ? 'color: red !important' : ''"></i>
                                <span v-show="errors.has('formReminderDate')" :style="errors.has('formReminderDate') ? 'color: red !important' : ''">
                                    Data é obrigatório!
                                </span>
                            </div>
                            <div class="col-md-3">
                                <label>Hora Lembrete:</label>
                                <input :style="errors.has('formReminderHour') ? 'border: 1px solid red !important;' : ''"
                                    name="formReminderHour" type="text" autocomplete="off"
                                    v-model="form.reminderHour" placeholder="HH:mm:ss" class="form-control" v-mask="'##:##:##'" />
                                <i v-show="errors.has('formReminderHour')" class="fa fa-warning"
                                    :style="errors.has('formReminderHour') ? 'color: red !important' : ''"></i>
                                <span v-show="errors.has('formReminderHour')"
                                    :style="errors.has('formReminderHour') ? 'color: red !important' : ''">
                                    Hora é obrigatória!
                                </span>
                            </div>
                        </div>
                    </form>
                </modal-component>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        data() {
            return {
                titleModal: "<i class='fa fa-fw fa-stethoscope'></i> Cadastro de Anotações",
                list: [],
                form: {
                    "id": null,
                    "patient_id": null,
                    "doctor_id": null,
                    "note": null,
                    "reminderDate": null,
                    "reminderHour": null
                },
                listPatients: [],
                listDoctors: [],
            }
        },
        mounted() {
            //initial campaign data bid
            axios.get("/notes/list").then((res) => {
                Vue.set(this, "list", res.data)
            });
            axios.get("/doctors/list").then((res) => {
                Vue.set(this, "listDoctors", res.data);
            });
            axios.get("/patients/list").then((res) => {
                Vue.set(this, "listPatients", res.data)
            });
        },
        methods: {
            resetForm() {
                this.form.id = null;
                this.form.patient_id = null;
                this.form.doctor_id = null;
                this.form.note = null;
                this.form.reminderDate = null;
                this.form.reminderHour = null;
            },
            openAdd() {
                this.resetForm();
                this.$validator.reset();
                this.titleModal = "<i class='fa fa-fw fa-stethoscope'></i> Cadastro de Anotação";
                jQuery("#modalNotes").modal('show');
            },
            add(value) {
                let self = this;

                self.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.post("/notes/add", value).then(function (res) {
                            jQuery("#modalNotes").modal('hide');
                            self.list = res.data;
                            swal("Sucesso!", (value.id === null) ? "Anotação cadastrada com sucesso!" : "Anotação editada com sucesso!", 'success');
                            setTimeout(() => {
                                self.resetForm();
                            }, 100);
                        });
                        return true;
                    }
                });
            },
            edit(index) {
                axios.get("/patients/list").then((res) => {
                    Vue.set(this, "listPatients", res.data)
                });
                axios.post("/doctors/getSpecialtiesByDoctor", {
                    "id": this.form.doctor_id
                }).then((res) => {
                    Vue.set(this, "listSpecialties", res.data);
                });

                this.titleModal = "<i class='fa fa-fw fa-stethoscope'></i> Edição de Anotação";
                let data = this.list[index];
                data = this.formatDates(data);
                this.form = Object.assign({}, data);
                jQuery("#modalNotes").modal("show");
            },
            formatDates(data) {
                data.reminderDate = moment(data.reminder).format('DD/MM/YYYY');
                data.reminderHour = moment(data.reminder).format('HH:mm:ss');
                return data;
            },
            del(index) {
                let self = this;

                swal({
                    title: "Você tem certeza?",
                    text: "Realmente deseja excluir esta Anotação?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Anotação deletada com sucesso!", {
                                icon: "success",
                            });
                            axios.delete("/notes/delete/" + self.list[index].id).then(function () {
                                self.list.splice(index, 1);
                            });
                        }
                    });
            },
            moment
        }
    }
</script>
