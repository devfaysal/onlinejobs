@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-5">
                <div class="card-header">
                    <h4 class="card-title mt-3">{{$job->title}}</h4>
                </div>
                <div class="card-body">
                    <p><strong>Company: </strong>{{$job->company}}</p>
                    <p><strong>Location: </strong>{{$job->location}}</p>
                    <p><strong>Vacancy: </strong>{{$job->vacancy}}</p>
                    <p><strong>Nature: </strong>{{$job->nature}}</p>
                    <p><strong>Salary Range: </strong>{{$job->salary_range_1}} - {{$job->salary_range_2}}</p>
                    <p><strong>Description: </strong>{{$job->description}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
