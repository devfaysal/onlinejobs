@extends('layouts.app')

@section('content')

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
                @if(Request()->q == 'location')
                <h4 class="text-center pb-3 pt-4">Jobs by Location</h4>
                <a class="btn btn-sm btn-success" href="/job?q=location&c=Malaysia">Malaysia</a>
                <a class="btn btn-sm btn-success" href="/job?q=location&c=Bangladesh">Bangladesh</a>
                <a class="btn btn-sm btn-success" href="/job?q=location&c=Cambodia">Cambodia</a>
                <hr>
                @elseif(Request()->q == 'skill')
                    <h4 class="text-center pb-3 pt-4">Jobs by Skill</h4>
                @elseif(Request()->q == 'designation')
                    <h4 class="text-center pb-3 pt-4">Jobs by Designation</h4>
                @elseif(Request()->q == 'category')
                    <h4 class="text-center pb-3 pt-4">Jobs by Category</h4>
                @else
                    <h4 class="text-center pb-3 pt-4">All Jobs</h4>
                @endif
            <div class="card auth-form mb-5">
                <div class="card-body">
                    @forelse ($jobs as $job)
                        <a href="{{route('job.show', $job->id)}}" target="_blank">{{$job->positions_name}}</a><br/>
                    @empty
                        No Jobs Found
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
