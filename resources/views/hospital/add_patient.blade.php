@extends('layout')

@section('title')
    Add patient
@endsection

@section('content')

    <div class="container text-center">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert-danger">
                    <p>{{$error}}</p>
                </div>
            @endforeach
        @endif
        <div class="card">
            <div class="card-header" style="text-align: right">Add patient</div>
            <div class="card-body" style="text-align: left">
                <form action="{{route('save.patient')}}" method="post">
                @csrf
                    <select name="patient" class="form-control">
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>

                    <small class="text-muted">If the user is not in the list, you can register him on the main page.</small><br><br>

                    <div class="btn-group" style="width: 100%">
                        <input type="submit" class="btn btn-outline-success" style="width: 70%" value="Save">
                        <a href="{{route('home')}}" class="btn btn-outline-secondary" style="width: 30%">Close</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
