@extends('layouts.app')

@section('content')
@include('layouts.banner')

<style type="text/css">
    .hover-box:hover {
        box-shadow: 0 5px 65px 0 rgba(0, 0, 0, 0.3);
    }
</style>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(isset($users))
                    <!-- <h1>Search Results</h1> -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row verticle-center">
                                @foreach ($users as $user)
                                <div class="col-md-2 mb-2 text-center" style="border: 1px solid #e6edee; height: 210px; padding-top: 10px;">
                                    <img class="img-thumbnail" src="{{$user->profile->image != '' ? asset('storage/'.$user->profile->image) : asset('images/avatar.jpg')}}" style="height: 130px; width: 130px; border-radius: 50%; margin-bottom: 10px;" alt="{{$user->profile->name ?? '( Nil )'}}">
                                    <br>
                                    <a href="{{route('profile.public', $user->public_id)}}" class="btn btn-block btn-primary" target="_blank">Details</a>
                                </div>
                                <div class="col-md-4 mb-2" style="border: 1px solid #e6edee; border-left: none; height: 210px; padding-top: 10px;">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <th>Name</th>
                                            <th>:</th>
                                            <td>{{$user->profile->name ?? '( Nil )'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Age</th>
                                            <th>:</th>
                                            <td>
                                            <?php
                                                $birthday = $user->profile->date_of_birth;
                                                $date = new DateTime($birthday);
                                                $now = new DateTime();
                                                $interval = $now->diff($date);
                                                echo $interval->y;
                                            ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Religion</th>
                                            <th>:</th>
                                            <td>{{$user->profile->religion_data->name ?? '( Nil )'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nationality</th>
                                            <th>:</th>
                                            <td>{{$user->profile->nationality_data->name ?? '( Nil )'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Language<small>(s)</small></th>
                                            <th>:</th>
                                            <td>
                                                <?php $language_set = (array) json_decode($user->profile->language_set); ?>

                                                @if($language_set)
                                                    @foreach($languages as $language)
                                                        @if (isset($language_set[$language->slug]) && $language_set[$language->slug] == 'Yes')
                                                            {{$language->name}},
                                                        @endif
                                                    @endforeach
                                                @else
                                                    ( Nil )
                                                @endif

                                            </td>
                                        </tr>
                                    </table>
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
