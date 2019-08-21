@extends('adminlte::page')

@section('title', 'Salas')

@section('content_header')
    <h1>Salas</h1>
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
            <th class="dc_actions">Ações</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(value,index) in list">
            <td>@{{ value.name }}</td>
            <td>
                <a href="javascript:void(0)" class="btn btn-sm btn-primary" v-on:click="edit(index)"><i
                            class="fa fa-edit"></i></a>
                <a href="javascript:void(0)" class="btn btn-sm btn-danger" v-on:click="del(index)"><i
                            class="fa fa-trash"></i></a>
            </td>
        </tr>
        </tbody>
    </table>

    <modal-component :title="titleModal" :data="form">
        <form @submit.prevent="add">
            <input type="hidden" v-model="form.id" value=""/>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nome:</label>
                        <input :style="errors.has('formName') ? 'border: 1px solid red !important;' : ''"
                               v-validate="'required'" name="formName" type="text"
                               autocomplete="off" v-model="form.name" class="form-control"/>
                        <i v-show="errors.has('formName')" class="fa fa-warning"
                           :style="errors.has('formName') ? 'color: red !important' : ''"></i>
                        <span v-show="errors.has('formName')"
                              :style="errors.has('formName') ? 'color: red !important' : ''">Nome é obrigatório!</span>
                    </div>
                </div>
            </div>
        </form>
    </modal-component>


@stop

@section('js')
    <script type="text/javascript" src="{{asset("js/rooms.js")}}"></script>
@stop
