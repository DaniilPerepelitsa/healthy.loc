
@extends('layout')

@section('title')
    Make Appointment
@endsection

@section('content')

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert-danger">
                <p>{{$error}}</p>
            </div>
        @endforeach
    @endif

    <div>
        <make-appointment></make-appointment>
    </div>

@endsection
