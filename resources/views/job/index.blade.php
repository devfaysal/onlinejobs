@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-dark">
        <div class="col-12">
            <h4 class="text-center text-white pb-3 pt-4">Jobs</h4>
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card auth-form mb-5">
                <div class="card-body">
                    @foreach ($jobs as $job)
                        <a href="{{route('job.show', $job->id)}}" target="_blank">{{$job->title}}</a><br/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
