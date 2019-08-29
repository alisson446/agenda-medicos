@extends('adminlte::page')

@section('title', 'Pacientes')

@section('content_header')
    <h1>Pacientes</h1>
@stop

@section('content')

    <p align="right">
        <a href="javascript:void(0)" v-on:click="openAdd" class="btn btn-primary">
            <i class="fa fa-plus"></i>
        </a>
    </p>

    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Data Nasc.</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Celular</th>
            <th class="dc_actions">Ações</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(value,index) in list">
            <td>@{{ value.name }}</td>
            <td>@{{ value.email }}</td>
            <td>@{{ value.birthday_date }}</td>
            <td>@{{ value.cpf }}</td>
            <td>@{{ value.phone_number }}</td>
            <td>@{{ value.cell_number }}</td>
            <td>
                <a href="javascript:void(0)" class="btn btn-sm btn-primary" v-on:click="edit(index)"><i
                            class="fa fa-edit"></i></a>
                <a href="javascript:void(0)" class="btn btn-sm btn-danger" v-on:click="del(index)"><i
                            class="fa fa-trash"></i></a>
            </td>
        </tr>
        </tbody>
    </table>

    <modal-component :title="titleModal" :data="form" size="modal-lg" @submit="add">
        <form>
            <input type="hidden" v-model="form.id" value=""/>
            <div class="row">
                <div class="col-md-6">
                    <label>Nome:</label>
                    <input :style="errors.has('formName') ? 'border: 1px solid red !important;' : ''" name="formName"
                           type="text" autocomplete="off"
                           v-model="form.name"
                           class="form-control"/>
                    <i v-show="errors.has('formName')" class="fa fa-warning"
                       :style="errors.has('formName') ? 'color: red !important' : ''"></i>
                    <span v-show="errors.has('formName')"
                          :style="errors.has('formName') ? 'color: red !important' : ''">Nome é obrigatório!</span>
                </div>
                <div class="col-md-6">
                    <label>Email:</label>
                    <input type="email" autocomplete="off" v-model="form.email" class="form-control"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label>Sexo:</label>
                    <select class="form-control" style="width: 100%;" v-model="form.gender">
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="O">Outros</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Data Nasc.:</label>
                    <input name="birthday_date" type="text" autocomplete="off"
                        v-model="form.birthday_date" placeholder="Data Nasc" class="form-control" v-mask="'##/##/####'" />
                    <!-- <datepicker name="formBirthdayDate" placeholder="Data Nasc" :value="form.birthday_date"
                                @set="setData"></datepicker> -->
                </div>
                <div class="col-md-3">
                    <label>Telefone:</label>
                    <input type="text" autocomplete="off" v-model="form.phone_number"
                           class="form-control"
                           v-mask="'(##) #####-####'"/>
                </div>
                <div class="col-md-3">
                    <label>Celular:</label>
                    <input type="text" autocomplete="off" v-model="form.cell_number" class="form-control" v-mask="'(##) #####-####'"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label>Observação:</label>
                    <textarea v-model="form.observation" class="form-control" rows="3"
                              placeholder="Digite observações..."></textarea>
                </div>
            </div>

            <div class="row form-patient">
                <div class="col-md-12">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li :class="navActiveGeneral"><a href="#general" data-toggle="tab"
                                                             @click="changeNavActive('general')">Gerais</a></li>
                            <li :class="navActiveAddress"><a href="#address" data-toggle="tab"
                                                             @click="changeNavActive('address')">Endereço</a></li>
                            <li :class="navActiveSupplementaryData"><a href="#supplementary_data" data-toggle="tab"
                                                                       @click="changeNavActive('supplementary_data')">Dados
                                    complementares</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" :class="navActiveGeneral" id="general">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Plano de Saúde:</label>
                                        <select class="form-control" style="width: 100%;" v-model="form.plan">
                                            <option value="1">Particular</option>
                                            <option value="2">Público</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Núm. da Carteira:</label>
                                        <input name="formPlanCardNumber" type="number" min="0"
                                               autocomplete="off"
                                               v-model="form.plan_card_number" class="form-control"/>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Valid. Carteira:</label>
                                        <input name="plan_card_valid" type="text" autocomplete="off"
                                            v-model="form.plan_card_valid" placeholder="Valid. Carteira" class="form-control" v-mask="'##/##/####'" />
                                        {{-- <datepicker placeholder="Valid. Carteira" :value="form.plan_card_valid"
                                                @set="setDataPlanCardValid"></datepicker> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" :class="navActiveAddress" id="address">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Cep:</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text"
                                                   class="form-control" autocomplete="off"
                                                   v-model="form.address_cep" v-mask="'#####-###'">
                                            <span class="input-group-btn" @click="searchByCep()">
                                                <button type="button" class="btn btn-info btn-flat"><i
                                                            class="fa fa-search"></i></button>
                                            </span>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Logradouro:</label>
                                        <input type="text"
                                               autocomplete="off" v-model="form.address_street"
                                               class="form-control"/>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Número:</label>
                                        <input type="number" min="0"
                                               autocomplete="off"
                                               v-model="form.address_number" class="form-control"/>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Complemento:</label>
                                        <input type="text" autocomplete="off" v-model="form.address_complement"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>País:</label>
                                        <select @change="changeAddress($event,'country')"
                                                class="form-control country_id" style="width: 100%;"
                                                v-model="form.country_id">
                                            <option v-for="(value,index) in listCountries" :value="value.id">@{{
                                                value.name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Estado:</label>
                                        <select @change="changeAddress($event,'state')" disabled="disabled"
                                                class="form-control state_id" style="width: 100%;"
                                                v-model="form.state_id">
                                            <option v-for="(value,index) in listStates" :value="value.id">@{{ value.name
                                                }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Cidade:</label>
                                        <select disabled="disabled"
                                                class="form-control city_id"
                                                style="width: 100%;" v-model="form.city_id">
                                            <option v-for="(value,index) in listCities" :value="value.id">@{{ value.name
                                                }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" :class="navActiveSupplementaryData" id="supplementary_data">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Nome fonético:</label>
                                        <input type="text" autocomplete="off" v-model="form.phonetic_name"
                                               class="form-control"/>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Profissão:</label>
                                        <input type="text" autocomplete="off" v-model="form.job"
                                               class="form-control"/>
                                    </div>
                                    <div class="col-md-4">
                                        <label>CPF:</label>
                                        <input type="text" autocomplete="off"
                                               v-model="form.cpf"
                                               class="form-control" v-mask="'###.###.###-##'"/>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Estado Civil:</label>
                                        <select class="form-control"
                                                style="width: 100%;"
                                                v-model="form.civil_status">
                                            <option value="1">Solteiro</option>
                                            <option value="2">Casado</option>
                                            <option value="3">Viúvo</option>
                                            <option value="4">Separado</option>
                                            <option value="5">Estável</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Nome da mãe:</label>
                                        <input type="text" autocomplete="off" v-model="form.mother_name"
                                               class="form-control"/>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Profissão Mãe:</label>
                                        <input type="text" autocomplete="off" v-model="form.mother_job"
                                               class="form-control"/>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Pai da mãe:</label>
                                        <input type="text" autocomplete="off" v-model="form.father_name"
                                               class="form-control"/>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Profissão Pai:</label>
                                        <input type="text" autocomplete="off" v-model="form.father_job"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Identidade:</label>
                                        <input type="text" autocomplete="off"
                                               v-model="form.identity"
                                               class="form-control"/>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Data emissão:</label>
                                        <input name="issuanceDate" type="text" autocomplete="off"
                                            v-model="form.issuance_date" placeholder="Data Nasc" class="form-control" v-mask="'##/##/####'" />
                                        {{-- <datepicker placeholder="Data emissão"
                                                :value="form.issuance_date"
                                                @set="setDataIssuanceDate"></datepicker> --}}
                                    </div>
                                    <div class="col-md-2">
                                        <label>Órgão emissor:</label>
                                        <input type="text"
                                               autocomplete="off" v-model="form.issuing_agency"
                                               class="form-control"/>
                                    </div>
                                    <div class="col-md-2">
                                        <label>N Reg. Nasc.:</label>
                                        <input type="number" min="0" required autocomplete="off"
                                               v-model="form.num_birth_registration" class="form-control"/>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Tipo sanguíneo:</label>
                                        <select class="form-control"
                                                style="width: 100%;" v-model="form.blood_type">
                                            <option value="1">AB+</option>
                                            <option value="2">AB-</option>
                                            <option value="3">O+</option>
                                            <option value="4">O-</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>CNS:</label>
                                        <input type="text" autocomplete="off"
                                               v-model="form.cns" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                </div>
            </div>
        </form>
    </modal-component>


@stop

@section('js')
    <script type="text/javascript" src="{{asset("js/patients.js")}}"></script>
@stop
