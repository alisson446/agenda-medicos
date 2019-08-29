@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Usuários</h1>
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
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
{{--            <th scope="col" v-if="logedUser == logedUser" class="text-center">ACL</th>--}}
            <th scope="col" class="dc_actions">Ações</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(value,index) in list">
            <td>@{{ value.name }}</td>
            <td>@{{ value.email }}</td>
{{--            <td v-if="value.email != logedUser" class="text-center">--}}
{{--                <label class="btn-sm  btn-info">--}}
{{--                    <acl-checkbox-component :index="index" page="facebook"></acl-checkbox-component>--}}
{{--                    Facebook</label>--}}
{{--                <label class="btn-sm  btn-info">--}}
{{--                    <acl-checkbox-component :index="index" page="server"></acl-checkbox-component>--}}
{{--                    Servidores</label>--}}
{{--                <label class="btn-sm  btn-info">--}}
{{--                    <acl-checkbox-component :index="index" page="notifications"></acl-checkbox-component>--}}
{{--                    Notificações</label>--}}
{{--                <label class="btn-sm  btn-info">--}}
{{--                    <acl-checkbox-component :index="index" page="user"></acl-checkbox-component>--}}
{{--                    Usuários</label>--}}
{{--            </td>--}}
{{--            <td v-else></td>--}}
            <td>
                <a href="javascript:void(0)" class="btn btn-sm btn-primary" v-on:click="edit(index)"><i
                            class="fa fa-edit"></i></a>
                <a href="javascript:void(0)" class="btn btn-sm btn-danger"
                   :class="value.email == logedUser ? 'disabled' : ''" v-on:click="del(index)"><i
                            class="fa fa-trash"></i></a>
            </td>
        </tr>
        </tbody>
    </table>

    <modal-component title="Usuários" :data="form" @submit="add">
        <form>
            <input type="hidden" v-model="form.id" value=""/>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nome:</label>
                        <input :style="errors.has('formName') ? 'border: 1px solid red !important;' : ''"
                               name="formName" type="text" autocomplete="off"
                               v-model="form.name" class="form-control"/>
                        <i v-show="errors.has('formName')" class="fa fa-warning"
                           :style="errors.has('formName') ? 'color: red !important' : ''"></i>
                        <span v-show="errors.has('formName')"
                              :style="errors.has('formName') ? 'color: red !important' : ''">Nome é obrigatório!</span>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input :style="errors.has('formEmail') ? 'border: 1px solid red !important;' : ''"
                               name="formEmail" type="email" autocomplete="off"
                               v-model="form.email" class="form-control"/>
                        <i v-show="errors.has('formEmail')" class="fa fa-warning"
                           :style="errors.has('formEmail') ? 'color: red !important' : ''"></i>
                        <span v-show="errors.has('formEmail')"
                              :style="errors.has('formEmail') ? 'color: red !important' : ''">Email é obrigatório!</span>
                    </div>
                    <div class="form-group">
                        <label>Senha:</label>
                        <input name="formPassword" type="password" autocomplete="off"
                               v-model="form.password" class="form-control"/>
                    </div>
                </div>
            </div>
        </form>
    </modal-component>

@stop

@section('js')
    <script type="text/javascript" src="{{asset("js/user.js")}}"></script>
@stop