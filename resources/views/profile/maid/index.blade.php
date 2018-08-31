@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <div class="col-md-4 text-center">
                        <img class="thumbnail center-thumbnail-image" src="{{$profile->full_image != '' ? asset('storage/'.$profile->full_image) :  asset('images/avatar.jpg')}}" alt="avatar">
                        <h1 class="text-warning">{{$profile->name}}</h1>
                        <a href="{{route('profile.edit', $profile->id)}}" class="btn btn-warning">Edit Basic information</a>
                    </div>
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h4 class="text-uppercase">Basic Information</h4></div>
                            <div class="panel-body jobs-in-reach">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Name</p>
                                            <p>{{$profile->name}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Phone</p>
                                            <p>{{$profile->phone}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.col-md-9-->
                <div class="col-md-3">
                    @include('layouts.sidebar')
                </div><!--/.col-md-3-->
            </div><!--/.row-->
        </div><!--/.container-->
    </div><!--/.content-->
@endsection
