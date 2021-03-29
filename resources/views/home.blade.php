@extends('layout')

@section('title')
    Home page
@endsection

@section('content')

    <div class="container text-center">
        <div class="card">
            <div class="card-header" style="text-align: right">{{ __(Auth::user()->email) }}</div>
            <div class="card-body" style="text-align: right">
                <h3>{{Auth::user()->name}}</h3>
                <h5>ID: {{Auth::id()}}</h5>
                <a href="{{route('add.user')}}" class="btn btn-outline-success" style="margin-top: 15px">Add user</a><br>
            </div>
        </div>

        <div class="card" style="margin-top: 20px">
            <div class="card-body" style="text-align: right">
                <a href="{{route('add.doctor')}}" class="btn btn-outline-success" style="margin-top: 15px">Add doctor &#10010;</a><br>
                <a href="{{route('add.patient')}}" class="btn btn-outline-primary" style="margin-top: 15px">Add patient &#9786;</a><br>
                <a href="{{route('make.appointment.view')}}" class="btn btn-outline-secondary" style="margin-top: 15px; margin-bottom: 15px;">Make appointment &#9998;</a><br>
            </div>
        </div>
    </div>

@endsection
