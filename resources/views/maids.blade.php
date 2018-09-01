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
                                        <input type="text" class="form-control" id="religion" name="religion" placeholder="Religion">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="country" name="country" placeholder="Country">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="language" name="language" placeholder="Language">
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
                                            <img class="img-responsive" src="{{$user->profile->image != '' ? asset('storage/'.$user->profile->image) :  asset('images/avatar.jpg')}}" alt="">
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
                                            <a href="" class="btn btn-block btn-warning">Details</a>
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
