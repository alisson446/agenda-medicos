@extends('adminlte::page')

@section('title', 'Prestadores')

@section('content_header')
    <h1>Prestadores</h1>
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
            <th>Celular</th>
            <th>CPF</th>
            <th>Permite encaixe</th>
            <th class="dc_actions">Ações</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(value,index) in list">
            <td>@{{ value.name }}</td>
            <td>@{{ value.email }}</td>
            <td>@{{ value.cell_number }}</td>
            <td>@{{ value.cpf }}</td>
            <td v-if="value.allows_docking == 1">
                <i class="fa fa-check"></i>
            </td>
            <td v-else>
                <i class="fa fa-times"></i>
            </td>
            <td>
                <a href="javascript:void(0)" class="btn btn-sm btn-primary" v-on:click="edit(index)"><i
                            class="fa fa-edit"></i></a>
                <a href="javascript:void(0)" class="btn btn-sm btn-danger" v-on:click="del(index)"><i
                            class="fa fa-trash"></i></a>
            </td>
        </tr>
        </tbody>
    </table>

    <modal-component :title="titleModal" :data="form" size="modal-lg">
        <form @submit.prevent="add">
            <input type="hidden" v-model="form.id" value=""/>
            <div class="row">
                <div class="col-md-6">
                    <label>Nome:</label>
                    <input :style="errors.has('formName') ? 'border: 1px solid red !important;' : ''" name="formName"
                           type="text" autocomplete="off"
                           v-model="form.name" v-validate="'required'"
                           class="form-control"/>
                    <i v-show="errors.has('formName')" class="fa fa-warning"
                       :style="errors.has('formName') ? 'color: red !important' : ''"></i>
                    <span v-show="errors.has('formName')"
                          :style="errors.has('formName') ? 'color: red !important' : ''">Nome é obrigatório!</span>
                </div>
                <div class="col-md-6">
                    <label>Email:</label>
                    <input :style="errors.has('formEmail') ? 'border: 1px solid red !important;' : ''" type="email"
                           name="formEmail"
                           autocomplete="off" v-validate="'required'" v-model="form.email" class="form-control"/>
                    <i v-show="errors.has('formEmail')" class="fa fa-warning"
                       :style="errors.has('formEmail') ? 'color: red !important' : ''"></i>
                    <span v-show="errors.has('formEmail')"
                          :style="errors.has('formEmail') ? 'color: red !important' : ''">Email é obrigatório!</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Telefone:</label>
                    <input :style="errors.has('formPhoneNumber') ? 'border: 1px solid red !important;' : ''"
                           type="text" autocomplete="off" v-model="form.phone_number"
                           class="form-control" name="formPhoneNumber" v-validate="'required'"
                           v-mask="'(##) ####-####'"/>
                    <i v-show="errors.has('formPhoneNumber')" class="fa fa-warning"
                       :style="errors.has('formPhoneNumber') ? 'color: red !important' : ''"></i>
                    <span v-show="errors.has('formPhoneNumber')"
                          :style="errors.has('formPhoneNumber') ? 'color: red !important' : ''">Telefone é obrigatório!</span>
                </div>
                <div class="col-md-6">
                    <label>Celular:</label>
                    <input :style="errors.has('formCellNumber') ? 'border: 1px solid red !important;' : ''" type="text"
                           autocomplete="off" v-model="form.cell_number" class="form-control"
                           name="formCellNumber" v-validate="'required'" v-mask="'(##) #####-####'"/>
                    <i v-show="errors.has('formCellNumber')" class="fa fa-warning"
                       :style="errors.has('formCellNumber') ? 'color: red !important' : ''"></i>
                    <span v-show="errors.has('formCellNumber')"
                          :style="errors.has('formCellNumber') ? 'color: red !important' : ''">Celular é obrigatório!</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>Especialidades:</label>
                    <multiselect multiple :style="errors.has('specialties') ? 'border: 1px solid red !important;' : ''"
                                 name="specialties" v-validate="'required'" v-model="form.specialties"
                                 :options="listSpecialties" :multiple="true" :close-on-select="false"
                                 :clear-on-select="false" :preserve-search="true" placeholder="Escolha..." label="name"
                                 track-by="name" :preselect-first="true">
                        <template slot="selection" slot-scope="{ values, search, isOpen }"><span
                                    class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">@{{ values.length }} item(ns) selecionado(s)</span>
                        </template>
                    </multiselect>
                    <i v-show="errors.has('specialties')" class="fa fa-warning"
                       :style="errors.has('specialties') ? 'color: red !important' : ''"></i>
                    <span v-show="errors.has('specialties')"
                          :style="errors.has('specialties') ? 'color: red !important' : ''">Especialidade é obrigatória!</span>
                </div>
                <div class="col-md-2">
                    <label>Permite encaixe:</label>
                    <select :style="errors.has('allows_docking') ? 'border: 1px solid red !important;' : ''"
                            name="allows_docking"
                            class="form-control" style="width: 100%;" v-model="form.allows_docking"
                            v-validate="'required'">
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                    <i v-show="errors.has('allows_docking')" class="fa fa-warning"
                       :style="errors.has('allows_docking') ? 'color: red !important' : ''"></i>
                    <span v-show="errors.has('allows_docking')"
                          :style="errors.has('allows_docking') ? 'color: red !important' : ''">Campo é obrigatório!</span>
                </div>
                <div class="col-md-3">
                    <label>Sexo:</label>
                    <select :style="errors.has('formGender') ? 'border: 1px solid red !important;' : ''"
                            name="formGender"
                            class="form-control" style="width: 100%;" v-model="form.gender" v-validate="'required'">
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="O">Outros</option>
                    </select>
                    <i v-show="errors.has('formGender')" class="fa fa-warning"
                       :style="errors.has('formGender') ? 'color: red !important' : ''"></i>
                    <span v-show="errors.has('formGender')"
                          :style="errors.has('formGender') ? 'color: red !important' : ''">Sexo é obrigatório!</span>
                </div>
                <div class="col-md-3">
                    <label>Data Nasc.:</label>
                    <datepicker :style="errors.has('formBirthdayDate') ? 'border: 1px solid red !important;' : ''"
                                name="formBirthdayDate" v-validate="'required'"
                                placeholder="Data Nasc" :value="form.birthday_date" @set="setData" v-mask="'##/##/####'"></datepicker>
                    <i v-show="errors.has('formBirthdayDate')" class="fa fa-warning"
                       :style="errors.has('formBirthdayDate') ? 'color: red !important' : ''"></i>
                    <span v-show="errors.has('formBirthdayDate')"
                          :style="errors.has('formBirthdayDate') ? 'color: red !important' : ''">Data Nasc. é obrigatório!</span>
                </div>
            </div>

            <div class="row form-patient">
                <div class="col-md-12">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li :class="navActiveGeneral"><a href="#general" data-toggle="tab"
                                                             @click="changeNavActive('general')">Dados cadastrais</a>
                            </li>
                            <li :class="navActiveAddress"><a href="#address" data-toggle="tab"
                                                             @click="changeNavActive('address')">Endereço</a></li>
                            <li :class="navActiveProfission"><a href="#profission" data-toggle="tab"
                                                                @click="changeNavActive('profission')">Conselho
                                    Profissional</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" :class="navActiveGeneral" id="general">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>CPF:</label>
                                        <input :style="errors.has('cpf') ? 'border: 1px solid red !important;' : ''"
                                               v-validate="'required'" name="cpf" type="text" autocomplete="off"
                                               v-model="form.cpf"
                                               class="form-control" v-mask="'###.###.###-##'"/>
                                        <i v-show="errors.has('cpf')" class="fa fa-warning"
                                           :style="errors.has('cpf') ? 'color: red !important' : ''"></i>
                                        <span v-show="errors.has('cpf')"
                                              :style="errors.has('cpf') ? 'color: red !important' : ''">CPF é obrigatória!</span>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Identidade:</label>
                                        <input :style="errors.has('identity') ? 'border: 1px solid red !important;' : ''"
                                               v-validate="'required'" name="identity" type="text" autocomplete="off"
                                               v-model="form.identity"
                                               class="form-control"/>
                                        <i v-show="errors.has('identity')" class="fa fa-warning"
                                           :style="errors.has('identity') ? 'color: red !important' : ''"></i>
                                        <span v-show="errors.has('identity')"
                                              :style="errors.has('identity') ? 'color: red !important' : ''">Identidade é obrigatória!</span>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Data emissão:</label>
                                        <datepicker
                                                :style="errors.has('issuanceDate') ? 'border: 1px solid red !important;' : ''"
                                                v-validate="'required'" name="issuanceDate" placeholder="Data emissão"
                                                :value="form.issuance_date" v-mask="'##/##/####'"
                                                @set="setDataIssuanceDate"></datepicker>
                                        <i v-show="errors.has('issuanceDate')" class="fa fa-warning"
                                           :style="errors.has('issuanceDate') ? 'color: red !important' : ''"></i>
                                        <span v-show="errors.has('issuanceDate')"
                                              :style="errors.has('issuanceDate') ? 'color: red !important' : ''">Data emissão é obrigatória!</span>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Órgão emissor:</label>
                                        <input :style="errors.has('issuingAgency') ? 'border: 1px solid red !important;' : ''"
                                               v-validate="'required'" name="issuingAgency" type="text"
                                               autocomplete="off" v-model="form.issuing_agency"
                                               class="form-control"/>
                                        <i v-show="errors.has('issuingAgency')" class="fa fa-warning"
                                           :style="errors.has('issuingAgency') ? 'color: red !important' : ''"></i>
                                        <span v-show="errors.has('issuingAgency')"
                                              :style="errors.has('issuingAgency') ? 'color: red !important' : ''">Órgão emissão é obrigatório!</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" :class="navActiveAddress" id="address">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Cep:</label>
                                        <div class="input-group input-group-sm">
                                            <input :style="errors.has('formAddressCep') ? 'border: 1px solid red !important;' : ''"
                                                   v-validate="'required'" name="formAddressCep" type="text"
                                                   class="form-control" autocomplete="off"
                                                   v-model="form.address_cep" v-mask="'#####-###'">
                                            <span class="input-group-btn" @click="searchByCep()">
                                                <button type="button" class="btn btn-info btn-flat"><i
                                                            class="fa fa-search"></i></button>
                                            </span>

                                        </div>
                                        <div class="col-md-12">
                                            <i v-show="errors.has('formAddressCep')" class="fa fa-warning"
                                               :style="errors.has('formAddressCep') ? 'color: red !important' : ''"></i>
                                            <span v-show="errors.has('formAddressCep')"
                                                  :style="errors.has('formAddressCep') ? 'color: red !important' : ''">Cep é obrigatório!</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Logradouro:</label>
                                        <input :style="errors.has('formAddressStreet') ? 'border: 1px solid red !important;' : ''"
                                               v-validate="'required'" name="formAddressStreet" type="text"
                                               autocomplete="off" v-model="form.address_street"
                                               class="form-control"/>
                                        <i v-show="errors.has('formAddressStreet')" class="fa fa-warning"
                                           :style="errors.has('formAddressStreet') ? 'color: red !important' : ''"></i>
                                        <span v-show="errors.has('formAddressStreet')"
                                              :style="errors.has('formAddressStreet') ? 'color: red !important' : ''">Rua é obrigatória!</span>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Número:</label>
                                        <input :style="errors.has('formAddressNumber') ? 'border: 1px solid red !important;' : ''"
                                               v-validate="'required'" name="formAddressNumber" type="number" min="0"
                                               autocomplete="off"
                                               v-model="form.address_number" class="form-control"/>
                                        <i v-show="errors.has('formAddressNumber')" class="fa fa-warning"
                                           :style="errors.has('formAddressNumber') ? 'color: red !important' : ''"></i>
                                        <span v-show="errors.has('formAddressNumber')"
                                              :style="errors.has('formAddressNumber') ? 'color: red !important' : ''">Número é obrigatório!</span>
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
                                        <select :style="errors.has('countryId') ? 'border: 1px solid red !important;' : ''"
                                                v-validate="'required'" name="countryId"
                                                @change="changeAddress($event,'country')"
                                                class="form-control country_id" style="width: 100%;"
                                                v-model="form.country_id">
                                            <option v-for="(value,index) in listCountries" :value="value.id">@{{
                                                value.name }}
                                            </option>
                                        </select>
                                        <i v-show="errors.has('countryId')" class="fa fa-warning"
                                           :style="errors.has('countryId') ? 'color: red !important' : ''"></i>
                                        <span v-show="errors.has('countryId')"
                                              :style="errors.has('countryId') ? 'color: red !important' : ''">País é obrigatório!</span>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Estado:</label>
                                        <select :style="errors.has('stateId') ? 'border: 1px solid red !important;' : ''"
                                                v-validate="'required'" name="stateId"
                                                @change="changeAddress($event,'state')" disabled="disabled"
                                                class="form-control state_id" style="width: 100%;"
                                                v-model="form.state_id">
                                            <option v-for="(value,index) in listStates" :value="value.id">@{{ value.name
                                                }}
                                            </option>
                                        </select>
                                        <i v-show="errors.has('stateId')" class="fa fa-warning"
                                           :style="errors.has('stateId') ? 'color: red !important' : ''"></i>
                                        <span v-show="errors.has('stateId')"
                                              :style="errors.has('stateId') ? 'color: red !important' : ''">Estado é obrigatório!</span>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Cidade:</label>
                                        <select :style="errors.has('cityId') ? 'border: 1px solid red !important;' : ''"
                                                v-validate="'required'" name="cityId" disabled="disabled"
                                                class="form-control city_id"
                                                style="width: 100%;" v-model="form.city_id">
                                            <option v-for="(value,index) in listCities" :value="value.id">@{{ value.name
                                                }}
                                            </option>
                                        </select>
                                        <i v-show="errors.has('cityId')" class="fa fa-warning"
                                           :style="errors.has('cityId') ? 'color: red !important' : ''"></i>
                                        <span v-show="errors.has('cityId')"
                                              :style="errors.has('cityId') ? 'color: red !important' : ''">Cidade é obrigatória!</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" :class="navActiveProfission" id="profission">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Conselho:</label>
                                        <select :style="errors.has('professional_advice_id') ? 'border: 1px solid red !important;' : ''"
                                                name="professional_advice_id"
                                                class="form-control" style="width: 100%;"
                                                v-model="form.professional_advice_id" v-validate="'required'">
                                            <option v-for="(value,index) in listProfessionalAdvices" :value="value.id">
                                                @{{ value.name }}
                                            </option>
                                        </select>
                                        <i v-show="errors.has('professional_advice_id')" class="fa fa-warning"
                                           :style="errors.has('professional_advice_id') ? 'color: red !important' : ''"></i>
                                        <span v-show="errors.has('professional_advice_id')"
                                              :style="errors.has('professional_advice_id') ? 'color: red !important' : ''">Conselho é obrigatório!</span>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Número</label>
                                        <input :style="errors.has('professional_advice_number') ? 'border: 1px solid red !important;' : ''"
                                               v-validate="'required'" name="professional_advice_number" type="text"
                                               autocomplete="off"
                                               v-model="form.professional_advice_number"
                                               class="form-control"/>
                                        <i v-show="errors.has('professional_advice_number')" class="fa fa-warning"
                                           :style="errors.has('professional_advice_number') ? 'color: red !important' : ''"></i>
                                        <span v-show="errors.has('professional_advice_number')"
                                              :style="errors.has('professional_advice_number') ? 'color: red !important' : ''">Num. do conselho é obrigatório!</span>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Estado:</label>
                                        <select :style="errors.has('professionalAdviceStateId') ? 'border: 1px solid red !important;' : ''"
                                                v-validate="'required'" name="professionalAdviceStateId"
                                                class="form-control professionalAdviceStateId" style="width: 100%;"
                                                v-model="form.professional_advice_state_id">
                                            <option v-for="(value,index) in listStatesProfessionalAdvice"
                                                    :value="value.id">@{{ value.name
                                                }}
                                            </option>
                                        </select>
                                        <i v-show="errors.has('professionalAdviceStateId')" class="fa fa-warning"
                                           :style="errors.has('professionalAdviceStateId') ? 'color: red !important' : ''"></i>
                                        <span v-show="errors.has('professionalAdviceStateId')"
                                              :style="errors.has('professionalAdviceStateId') ? 'color: red !important' : ''">Estado do conselho é obrigatório!</span>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Tipo:</label>
                                        <select :style="errors.has('professional_advice_type') ? 'border: 1px solid red !important;' : ''"
                                                name="professional_advice_type"
                                                class="form-control" style="width: 100%;"
                                                v-model="form.professional_advice_type" v-validate="'required'">
                                            <option value="fisica">Física</option>
                                            <option value="juridica">Jurídica</option>
                                        </select>
                                        <i v-show="errors.has('professional_advice_type')" class="fa fa-warning"
                                           :style="errors.has('professional_advice_type') ? 'color: red !important' : ''"></i>
                                        <span v-show="errors.has('professional_advice_type')"
                                              :style="errors.has('professional_advice_type') ? 'color: red !important' : ''">Tipo do conselho é obrigatório!</span>
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
    <script type="text/javascript" src="{{asset("js/doctors.js")}}"></script>
@stop