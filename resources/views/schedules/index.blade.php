@extends('adminlte::page')

@section('title', 'Agenda')

@section('content_header')
    <h1>Agenda</h1>
@stop

@section('content')
    <calendar-component></calendar-component>
@stop

@section('js')
    <script type="text/javascript" src="{{asset("js/schedules.js")}}"></script>
@stop
