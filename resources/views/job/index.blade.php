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
            
                @forelse ($jobs as $job)
                <a class="text-dark nav-link" href="{{route('job.show', $job->id)}}" target="_blank">
                    <div class="card auth-form mb-3">
                        <div class="card-body">
                            <h4 class="text-success">{{$job->positions_name}}</h4>
                            <p class="mb-0"><i class="mr-3 fa fa-map-marker" aria-hidden="true"></i> {{$job->district}}, {{$job->town}}, {{$job->state}}</p>
                            <p class="mb-0"><i class="mr-2 fa fa-briefcase" aria-hidden="true"></i> {{$job->related_experience_year ?? 0 }} Year {{$job->related_experience_month ?? 0}} Month</p>
                            <p class="mb-0"><i class="mr-2 fa fa-graduation-cap" aria-hidden="true"></i> {{$job->minimum_academic_qualification}}</p>
                            <p class=" mb-0 text-right"><i class="fa fa-calendar" aria-hidden="true"></i> Closing Date: {{\Carbon\Carbon::parse($job->closing_date)->format('d/m/Y')}}</p>
                        </div>
                    </div>
                </a>
                @empty
                <div class="card auth-form mb-5">
                    <div class="card-body">
                        No Jobs Found
                    </div>
                </div>
                @endforelse
                
        </div>
    </div>
</div>
@endsection
