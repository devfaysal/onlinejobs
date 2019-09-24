@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-3">
            <img class="img-fluid" src="{{asset('storage/'.$job->company()->company_logo)}}" alt="">
        </div>
        <div class="col-md-5">
            <ul>
                <li class="font-18">
                    <h5 class="font-22">
                        {{$job->positions_name}} 
                        @auth
                        @if(Auth::user()->hasRole('employer')) <a href="{{route('job.edit', $job->id)}}">Edit</a> @endif
                        @endauth
                    </h5>
                </li>
                <li class="font-18">{{$job->company()->company_name ?? 'N/A'}}</li>
                <li class="font-18">{{$job->district ? $job->district . ',' : ''}} {{$job->town ? $job->town . ',' : ''}} {{$job->state ? $job->state . ',': ''}} {{$job->postcode}}</li>
                <li class="font-18">{{$job->related_experience_year ?? 'N/A'}} Year Experience</li>
                <li class="font-18">{{$job->total_number_of_vacancies ?? 'N/A'}} Vacancies</li>
                <li class="font-18">Gender: {{$job->gender ?? 'N/A'}}</li>
                <li class="font-18">Marital Status: {{$job->marital_status ?? 'N/A'}}</li>
                <li class="font-18">Race: {{$job->race ?? 'N/A'}}</li>
                <li class="font-18">Age Eligibility: {{$job->age_eligibillity ?? 'N/A'}}</li>
            </ul>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <p class=" my-0 ">Offered Salary</p>
                <p class=" my-0 font-weight-bold">{{$job->salary_offer_currency}} {{$job->salary_offer}} {{$job->salary_offer_period}}</p>
            </div>
            <div>
                <p class=" my-0 ">Type Position</p>
                <p class=" my-0 font-weight-bold">{{$job->job_vacancies_type ?? 'N/A'}}</p>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <p class="mb-0"><strong>Vacancies Description </strong></p>
            <div>
                {{$job->vacancies_description ?? 'N/A'}}
            </div>
        </div>
    </div>
    <div class="row mt-3 d-flex align-items-end">
        <div class="col-md-7">
            <div class="pr-5">
                <p class="mb-0"><strong>Scope of Duties </strong></p>
                <div>
                    {{$job->scope_of_duties ?? 'N/A'}}
                </div>
            </div>
            <div class="mt-2">
                <p class="mb-0"><strong>Academic Qualification</strong></p>

                <p class="mb-0">- {{$job->minimum_academic_qualification}} ({{$job->academic_field}})</p>
                @foreach ($job->academics as $academic)
                <p class="mb-0">- {{$academic->academic_qualification}} ({{$academic->academic_field}})</p>
                @endforeach
            </div>
            <div class="mt-2">
                <p class="mb-0"><strong>Required Skills</strong></p>
                <p class="mb-0">{{$job->skills ?? 'N/A'}}</p>
            </div>
            <div class="mt-2">
                <p class="mb-0"><strong>Other Requirements</strong></p>
                <p class="mb-0">{{$job->other_requirements ?? 'N/A'}}</p>
            </div>
            <div class="mt-2">
                <p class="mb-0"><strong>Facilities</strong></p>
                <p class="mb-0">{{$job->facilities ?? 'N/A'}} {{ $job->other_facilities ? ', ' . $job->other_facilities : '' }}</p>
            </div>
            <div class="mt-2">
                <p class="mb-0"><strong>Language</strong></p>
                @foreach ($job->languages as $language)
                    <div class="mb-2">
                        <p class="mb-0">{{$language->language_data->name}}</p>
                        <p class="mb-0"><strong>Speaking: </strong> {{$language->speaking}}, <strong>Writing: </strong>{{$language->writing}}</strong></p>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-5 text-right">
            <p class="mb-0">Closing Date</p>
            <p class="mb-0"><strong>{{\Carbon\Carbon::parse($job->closing_date)->format('d/m/Y')}}</strong></p>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-md-12">
            <p class="text-center"><a class="btn btn-success" href="#">Apply Online</a></p>
            {{-- <p class="text-center mb-0">Company Name: {{$job->company()->company_name}}</p> --}}
            <p class="text-center mb-0">{{$job->district ? $job->district . ',': ''}} {{$job->town ? $job->town . ',' : ''}} {{$job->state ? $job->state . ',' : '' }} {{$job->postcode}}</p>
            {{-- <p class="text-center mb-0">{{$job->person_in_charge}}</p> --}}
            {{-- <p class="text-center mb-0">{{$job->telephone_number}}, {{$job->handphone_number}}</p> --}}
            {{-- <p class="text-center mb-0">{{$job->email}}</p> --}}
        </div>
    </div>
</div>
@endsection
