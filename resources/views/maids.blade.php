@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <h2>Search Maids</h2>
                            </div>
                            <form method="POST" action="{{route('maids.search')}}">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="religion" id="religion" class="form-control">
                                            <option value="">--Religion--</option>
                                            @foreach ($religions as $religion)
                                                <option value="{{$religion->id}}">{{$religion->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="native_language" id="native_language" class="form-control">
                                            <option value="">--Language--</option>
                                            @foreach ($languages as $language)
                                                <option value="{{$language->id}}" >{{$language->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="nationality" id="nationality" class="form-control">
                                            <option value="">--Nationality--</option>
                                            @foreach ($nationalitys as $nationality)
                                                <option value="{{$nationality->id}}" >{{$nationality->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="submit" class="form-control btn btn-warning" value="Search">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if(isset($users))
                        <h1>Search Results</h1>
                        @foreach ($users as $user)
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row verticle-center">
                                        <div class="col-md-2">
                                            <img class="search-result-thumbnail" src="{{$user->profile->image != '' ? asset('storage/'.$user->profile->image) :  asset('images/avatar.jpg')}}" alt="">
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
                                            <a href="{{route('profile.public', $user->public_id)}}" class="btn btn-block btn-warning">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div><!--/.col-md-9-->
                <div class="col-md-3">
                    @include('layouts.sidebar')
                </div><!--/.col-md-3-->
            </div><!--/.row-->
        </div><!--/.container-->
    </div><!--/.content-->
@endsection
