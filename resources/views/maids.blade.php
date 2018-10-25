@extends('layouts.app')

@section('content')
@include('layouts.banner')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(isset($users))
                    <!-- <h1>Search Results</h1> -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row verticle-center">
                                @foreach ($users as $user)
                                <div class="col-md-2">
                                    <img class="img-thumbnail" src="{{$user->profile->image != '' ? asset('storage/'.$user->profile->image) : asset('images/avatar.jpg')}}" alt="">
                                    <br>
                                    <a href="{{route('profile.public', $user->public_id)}}" class="btn btn-block btn-primary">Details</a>
                                </div>
                                <div class="col-md-4">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <th>Name</th>
                                            <th>:</th>
                                            <td>{{$user->profile->name ?? 'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Date of birth</th>
                                            <th>:</th>
                                            <td>{{ (($user->profile->date_of_birth != '') ? \Carbon\Carbon::parse($user->profile->date_of_birth)->format('d/m/Y') : 'N/A') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Age</th>
                                            <th>:</th>
                                            <td>{{ \Carbon\Carbon::parse($user->profile->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y years %m months')}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nationality</th>
                                            <th>:</th>
                                            <td>{{$user->profile->nationality_data->name ?? 'N/A'}}</td>
                                        </tr>
                                    </table>
                                    {{--<p class="profile-title"><strong>Name : </strong>{{$user->profile->name ?? 'N/A'}}</p>
                                    <p class="profile-title"><strong>Date of birth: </strong>{{ (($user->profile->date_of_birth != '') ? \Carbon\Carbon::parse($user->profile->date_of_birth)->format('d/m/Y') : 'N/A') }}</p>
                                    <p class="profile-title"><strong>Age: </strong>{{ \Carbon\Carbon::parse($user->profile->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y years %m months')}}</p>
                                    <p class="profile-title"><strong>Nationality: </strong>{{$user->profile->nationality_data->name ?? 'N/A'}}</p>--}}
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div><!--/.col-md-9-->
        </div><!--/.row-->
    </div><!--/.container-->
@endsection
