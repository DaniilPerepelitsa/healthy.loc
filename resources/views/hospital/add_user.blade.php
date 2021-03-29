@extends('layout')

@section('title')
    Home page
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
            <div class="card-header" style="text-align: right">Add user</div>
            <div class="card-body" style="text-align: left">
                <form action="{{route('save.user')}}" method="post">
                    @csrf
                    <input type="text" class="form-control" name="name" placeholder="Enter name..." style="margin-top: 15px">
                    <input type="email" class="form-control" name="email" placeholder="Enter email..." style="margin-top: 15px">
                    <input type="password" class="form-control" name="password" placeholder="Enter password..." style="margin-top: 15px">

                    <div class="btn-group" style="width: 100%; margin-top: 15px">
                        <input type="submit" class="btn btn-outline-success" value="Save" style="width: 70%">
                        <a href="{{route('home')}}" class="btn btn-outline-secondary" style="width: 30%">Close</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
