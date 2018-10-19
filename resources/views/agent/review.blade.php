@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-12">
                <div class="jumbotron">
                    <h1 class="display-4">Hello, Agent!</h1>
                    <hr class="my-4">
                    <p>Your account need to be approved by admin for further action</p>
                    <a class="btn btn-success" href="{{route('agent.print', [Auth::user()->id, 'details'])}}">Print Details</a>
                    <a class="btn btn-success" href="{{route('agent.print', [Auth::user()->id,'license'])}}">Print License</a>
                    <a class="btn btn-success" href="{{route('agent.print', [Auth::user()->id,'passport'])}}">Print Passport/NIC</a>
                </div>
            </div>
        </div>
    </div>
@endsection