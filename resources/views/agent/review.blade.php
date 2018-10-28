@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            @if(Session::has('message'))
            <div class="col-md-12">
                <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                    <strong>{{ Session::get('message') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif
            <div class="col-12">
                <div class="jumbotron">
                    <h1 class="display-4">Hello, Agent!</h1>
                    <hr class="my-4">
                    <p>Your account need to be approved by admin for further action</p>
                    <a class="btn btn-success" href="{{route('agent.edit', Auth::user()->id)}}">Edit Profile</a>
                    <a class="btn btn-success" href="{{route('agent.print', [Auth::user()->id, 'details'])}}">Print Details</a>
                    <a class="btn btn-success" href="" onclick="printJS('{{asset('storage/'.Auth::user()->agent_profile->license_file)}}');return false;">Print License</a>
                    <a class="btn btn-success" href="" onclick="printJS('{{asset('storage/'.Auth::user()->agent_profile->passport_file)}}');return false;">Print Passport/NIC</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection