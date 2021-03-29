@extends('layout')

@section('title')
    Chat
@endsection

@section('content')
    <div style="width: 100%; height: 100%; position: absolute; background-color: #ffffff">
        <chat :auth_user="{{$auth_user}}"></chat>
    </div>
@endsection
