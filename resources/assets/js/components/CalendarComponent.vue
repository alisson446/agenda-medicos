<template>
  <div class="container">
    <div class="modal fade" id="modalForm" tabindex="-1" role="dialog">

      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="dc_modal_content">

          <div class="modal-header">
            <div class="row">
              <div class="col-md-11">
                <h4 class="modal-title" v-html="titleModal"></h4>
              </div>
              <div class="col-md-1">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>

          <div class="modal-body">
            <form @submit.prevent="add">
              <input type="hidden" v-model="form.id" value="" />
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Paciente:</label>
                    <select :style="errors.has('formPatient') ? 'border: 1px solid red !important;' : ''"
                      v-validate="'required'" name="formPatient" class="form-control" style="width: 100%;"
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
                    <label>Médico:</label>
                    <select :style="errors.has('formDoctor') ? 'border: 1px solid red !important;' : ''"
                      v-validate="'required'" name="formDoctor" class="form-control" style="width: 100%;"
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
                    <label>Especialidade:</label>
                    <select :style="errors.has('formSpecialty') ? 'border: 1px solid red !important;' : ''"
                      v-validate="'required'" name="formSpecialty" class="form-control" style="width: 100%;"
                      v-model="form.specialty_id">
                      <option v-bind:key="index" v-for="(value,index) in listSpecialties" :value="value.id">
                        {{ value.name }}
                      </option>
                    </select>
                    <i v-show="errors.has('formSpecialty')" class="fa fa-warning"
                      :style="errors.has('formSpecialty') ? 'color: red !important' : ''"></i>
                    <span v-show="errors.has('formSpecialty')"
                      :style="errors.has('formSpecialty') ? 'color: red !important' : ''">
                      Especialidede é obrigatória!
                    </span>
                  </div>
                </div>
                <div class="col-md-7">
                  <label>Data início:</label>
                  <input :style="errors.has('formInitialDate') ? 'border: 1px solid red !important;' : ''"
                    v-validate="'required'" name="formInitialDate" type="text" autocomplete="off"
                    v-model="form.initial_date" placeholder="dd/mm/yyyy" class="form-control" v-mask="'##/##/####'" />
                  <i v-show="errors.has('formInitialDate')" class="fa fa-warning"
                    :style="errors.has('formInitialDate') ? 'color: red !important' : ''"></i>
                  <span v-show="errors.has('formInitialDate')" :style="errors.has('formInitialDate') ? 'color: red !important' : ''">
                    Data inicial é obrigatória!
                  </span>
                </div>
                <div class="col-md-5">
                  <label>Hora início:</label>
                  <input :style="errors.has('formInitialHour') ? 'border: 1px solid red !important;' : ''"
                    v-validate="'required'" name="formInitialHour" type="text" autocomplete="off"
                    v-model="form.initial_hour" placeholder="hh:mm:ss" class="form-control" v-mask="'##:##:##'" />
                  <i v-show="errors.has('formInitialHour')" class="fa fa-warning"
                    :style="errors.has('formInitialHour') ? 'color: red !important' : ''"></i>
                  <span v-show="errors.has('formInitialHour')"
                    :style="errors.has('formInitialHour') ? 'color: red !important' : ''">
                    Hora inicial é obrigatória!
                  </span>
                </div>
                <div class="col-md-7">
                  <label>Data final:</label>
                  <input :style="errors.has('formFinalDate') ? 'border: 1px solid red !important;' : ''"
                    v-validate="'required'" name="formFinalDate" type="text" autocomplete="off"
                    v-model="form.finish_date" placeholder="dd/mm/yyyy" class="form-control" v-mask="'##/##/####'" />
                  <i v-show="errors.has('formFinalDate')" class="fa fa-warning"
                    :style="errors.has('formFinalDate') ? 'color: red !important' : ''"></i>
                  <span v-show="errors.has('formFinalDate')"
                    :style="errors.has('formFinalDate') ? 'color: red !important' : ''">
                    Data final é obrigatória!
                  </span>
                </div>
                <div class="col-md-5">
                  <label>Hora final:</label>
                  <input :style="errors.has('formFinishHour') ? 'border: 1px solid red !important;' : ''"
                    v-validate="'required'" name="formFinishHour" type="text" autocomplete="off"
                    v-model="form.finish_hour" placeholder="hh:mm:ss" class="form-control" v-mask="'##:##:##'" />
                  <i v-show="errors.has('formFinishHour')" class="fa fa-warning"
                    :style="errors.has('formFinishHour') ? 'color: red !important' : ''"></i>
                  <span v-show="errors.has('formFinishHour')"
                    :style="errors.has('formFinishHour') ? 'color: red !important' : ''">
                    Hora final é obrigatória!
                    </span>
                </div>
                <div class="col-md-7">
                  <label>Plano de Saúde:</label>
                  <select :style="errors.has('formPlan') ? 'border: 1px solid red !important;' : ''" name="formPlan"
                    class="form-control" v-validate="'required'" style="width: 100%;" v-model="form.plan">
                    <option value="1">Particular</option>
                  </select>
                  <i v-show="errors.has('formPlan')" class="fa fa-warning"
                    :style="errors.has('formPlan') ? 'color: red !important' : ''"></i>
                  <span v-show="errors.has('formPlan')"
                    :style="errors.has('formPlan') ? 'color: red !important' : ''">
                    Plano é obrigatório!
                  </span>
                </div>
                <div class="col-md-5">
                  <label>Valor da consulta:</label>
                  <input :style="errors.has('formValue') ? 'border: 1px solid red !important;' : ''"
                    v-validate="'required'" name="formValue" type="text" autocomplete="off" v-model="form.value"
                    class="form-control" v-money="money" />
                  <i v-show="errors.has('formValue')" class="fa fa-warning"
                    :style="errors.has('formValue') ? 'color: red !important' : ''"></i>
                  <span v-show="errors.has('formValue')"
                    :style="errors.has('formValue') ? 'color: red !important' : ''">
                    Valor da consulta é obrigatória!
                  </span>
                </div>
              </div>
            </form>
          </div>

          <div class="modal-footer">
            <button v-show="btnSaveModal === 'Editar'" type="button" @click="del(form.id)"
              class="btn btn-danger">Remover</button>
            <button type="submit" @click="add()" class="btn btn-primary">{{ btnSaveModal }}</button>
          </div>
          <div class="sz_loading"></div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-2">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><center>Profissionais</center></h5>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item" v-bind:key="index" v-for="(value,index) in listDoctors">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" v-model="doctorFilter" :value="value.id" :id="value.id">
                <label class="form-check-label" :for="value.id">
                  {{ value.name }}
                </label>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-8">
        <Fullcalendar defaultView="dayGridMonth" ref="calendar"
            :header="{left: 'prev,next today',center: 'title',right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'}"
            @eventDrop="eventDrop" @dateClick="handleDateClick" @eventClick="editEvent" :droppable="droppable"
            all-day-text="Todos os dias" :editable="editable" :plugins="calendarPlugins" :weekends="true"
            :events.sync="events" locale="pt-br" :button-text="button" />
      </div>
    </div>
  </div>
</template>

<script>
  import Fullcalendar from "@fullcalendar/vue";
  import dayGridPlugin from "@fullcalendar/daygrid";
  import timeGridPlugin from '@fullcalendar/timegrid'
  import interactionPlugin from "@fullcalendar/interaction";

  export default {
    components: {
      Fullcalendar
    },
    data() {
      return {
        calendarPlugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        events: [],
        newEvent: {
          event_name: "",
          start_date: "",
          end_date: ""
        },
        button: {
          today: 'Hoje',
          month: 'Mês',
          week: 'Semana',
          day: 'Dia'
        },
        editable: true,
        droppable: true,
        addingMode: true,
        indexToUpdate: "",
        doctorFilter: [],
        listDoctors: [],
        btnSaveModal: "Salvar",
        titleModal: "<i class='fa fa-fw fa-calendar'></i> Cadastro de Consulta",
        listPatients: [],
        listSpecialties: [],
        form: {
          "id": null,
          "patient_id": null,
          "doctor_id": null,
          "specialty_id": null,
          "initial_date": null,
          "finish_date": null,
          "initial_hour": null,
          "finish_hour": null,
          "plan": null,
          "value": null
        },
        money: {
          decimal: ',',
          thousands: '.',
          prefix: 'R$ ',
          precision: 2,
          masked: false
        }

      };
    },
    computed: {
      doctor_id() {
        return this.form.doctor_id;
      }
    },
    mounted() {
      Vue.set(this, "events", []);
      axios.get("/doctors/list").then((res) => {
        Vue.set(this, "listDoctors", res.data);
      });
    },
    methods: {
      changeDoctor(event) {
        let val = event.target.value;
        axios.post("/schedules/list", {
          "doctor_id": val
        }).then((res) => {
          Vue.set(this, "events", res.data);
        });
      },
      editEvent(arg) {
        this.btnSaveModal = "Editar";
        axios.get("/patients/list").then((res) => {
          Vue.set(this, "listPatients", res.data)
        });
        axios.post("/doctors/getSpecialtiesByDoctor", {
          "id": this.form.doctor_id
        }).then((res) => {
          Vue.set(this, "listSpecialties", res.data);
        });

        this.titleModal = "<i class='fa fa-fw fa-stethoscope'></i> Edição de consulta";
        let data = this.events[this.events.findIndex(res => res.id === parseInt(arg.event.id))];
        this.form = Object.assign({}, data);
        jQuery("#modalForm").modal("show");
      },
      handleDateClick(arg) {
        this.openAdd(arg);
      },
      eventDrop: function (event, dayDelta, minuteDelta, allDay) {
        // console.log(event)
        // let start = event.event.start;
        // let end = event.event.end;
        // let objDataValue = this.resDateFormatted(start,end);
        // let data = Object.assign({}, event.event.extendedProps);
        // data.id = event.event.id;
        // data.initial_date = objDataValue.initial_date;
        // data.finish_date = objDataValue.finish_date;
        // data.initial_hour = objDataValue.initial_hour;
        // data.finish_hour = objDataValue.finish_hour;
        //
        // console.log(data);
      },
      resetForm() {
        this.form.id = null;
        this.form.patient_id = null;
        this.form.doctor_id = null;
        this.form.specialty_id = null;
        this.form.initial_date = null;
        this.form.finish_date = null;
        this.form.initial_hour = null;
        this.form.finish_hour = null;
        this.form.plan = null;
        this.form.value = null;
      },
      openAdd(argDate) {
        this.resetForm();
        this.$validator.reset();
        this.btnSaveModal = "Salvar";

        axios.get("/patients/list").then((res) => {
          Vue.set(this, "listPatients", res.data)
        });

        this.setIntervalDates(argDate);
        this.titleModal = "<i class='fa fa-fw fa-calendar'></i> Cadastro de Consulta";
        jQuery("#modalForm").modal('show');
      },
      add() {
        let value = this.form;
        let self = this;
        this.$validator.validateAll().then((result) => {
          if (result) {
            axios.post("/schedules/add", value).then(function (res) {
              jQuery("#modalForm").modal('hide');
              Vue.set(self, "events", res.data);
              swal("Sucesso!", (value.id === null) ? "Consulta cadastrada com sucesso!" :
                "Consulta editada com sucesso!", 'success');
              setTimeout(() => {
                self.resetForm();
              }, 100);
            });
            return true;
          }
        });
      },
      del(schedule_id) {
        let data = this.events.find(res => res.id === parseInt(schedule_id));
        let self = this;
        swal({
            title: "Você tem certeza?",
            text: "Realmente deseja excluir esta consulta?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              swal("Consulta deletada com sucesso!", {
                icon: "success",
              });
              axios.post("/schedules/delete", {
                "schedule_id": schedule_id,
                "doctor_id": data.doctor_id
              }).then(function (res) {
                Vue.set(self, "events", res.data);
                jQuery("#modalForm").modal('hide');
                setTimeout(() => {
                  self.resetForm();
                }, 100);
              });
            }
          });
      },
      setIntervalDates(args) {
        let dateChoosed = args.dateStr.split('-', 3);
        let year = dateChoosed[0];
        let month = dateChoosed[1];
        let day = dateChoosed[2];
        Vue.set(this.form, "initial_date", `${day}/${month}/${year}`);
        Vue.set(this.form, "finish_date", `${day}/${month}/${year}`);
      },
      resDateFormatted(start, end) {
        let startD = new Date(start);
        let endD = new Date(end);

        console.log(startD);
        console.log(endD);
        return {
          "initial_date": (startD.getDay().length === 1 ? parseInt("0" + startD.getDay()) : startD.getDay()) + "/" + (
              startD.getMonth().length === 1 ? parseInt("0" + startD.getMonth()) : startD.getMonth()) + "/" + startD
            .getFullYear(),
          "finish_date": (endD.getDay().length === 1 ? parseInt("0" + endD.getDay()) : endD.getDay()) + "/" + (endD
            .getMonth().length === 1 ? parseInt("0" + endD.getMonth()) : endD.getMonth()) + "/" + endD.getFullYear(),
          "initial_hour": (startD.getHours().length === 1 ? parseInt("0" + startD.getHours()) : startD.getHours()) +
            ":" + (startD.getMinutes().length === 1 ? parseInt("0" + startD.getMinutes()) : startD.getMinutes()) + ":" +
            (startD.getSeconds().length === 1 ? parseInt("0" + startD.getSeconds()) : startD.getSeconds()),
          "finish_hour": (endD.getHours().length === 1 ? parseInt("0" + endD.getHours()) : endD.getHours()) + ":" + (
            endD.getMinutes().length === 1 ? parseInt("0" + endD.getMinutes()) : endD.getMinutes()) + ":" + (endD
            .getSeconds().length === 1 ? parseInt("0" + endD.getSeconds()) : endD.getSeconds())
        };
      }
    },
    watch: {
      indexToUpdate() {
        return this.indexToUpdate;
      },
      doctorFilter(newValue, oldValue) {
        axios.post("/schedules/list", {
          "doctor_id": newValue
        }).then((res) => {
          Vue.set(this, "events", res.data);
        });
      },
      doctor_id(newValue, oldValue) {
        axios.post("/doctors/getSpecialtiesByDoctor", {
          "id": newValue
        }).then((res) => {
          Vue.set(this, "listSpecialties", res.data);
        });
      }
    }
  };
</script>

<style lang="css">
  @import "~@fullcalendar/core/main.css";
  @import "~@fullcalendar/daygrid/main.css";
  @import "~@fullcalendar/timegrid/main.css";

  .fc-title {
    color: #fff;
  }

  .fc-title:hover {
    cursor: pointer;
  }
</style>