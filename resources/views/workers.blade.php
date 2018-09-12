@extends('layouts.app')

@section('content')
@include('layouts.banner')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(isset($users))
                    <h1>Search Results</h1>
                    @foreach ($users as $user)
                        <div class="card">
                            <div class="card-body">
                                <div class="row verticle-center">
                                    <div class="col-md-2">
                                        <img class="img-thumbnail" src="{{$user->profile->image != '' ? asset('storage/'.$user->profile->image) :  asset('images/avatar.jpg')}}" alt="">
                                    </div>
                                    <div class="col-md-3">
                                        <p class="profile-title">Name</p>
                                        <p class="">{{$user->profile->name}}</p>
                                        <p class="profile-title">Date of birth</p>
                                        <p class="">{{$user->profile->date_of_birth}}</p>
                                    </div>
                                    <div class="col-md-3">
                                            <p class="profile-title">Name</p>
                                            <p class="">{{$user->profile->name}}</p>
                                            <p class="profile-title">Date of birth</p>
                                            <p class="">{{$user->profile->date_of_birth}}</p>
                                    </div>
                                    <div class="col-md-2">
                                            <p class="profile-title">Name</p>
                                            <p class="">{{$user->profile->name}}</p>
                                            <p class="profile-title">Date of birth</p>
                                            <p class="">{{$user->profile->date_of_birth}}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{route('profile.public', $user->public_id)}}" class="btn btn-block btn-primary">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div><!--/.col-md-9-->
        </div><!--/.row-->
    </div><!--/.container-->
@endsection
