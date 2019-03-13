@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-5">
                <div class="card-header">
                    <h4 class="card-title mt-3">{{$job->positions_name}} 
                        @auth
                        @if(Auth::user()->hasRole('employer')) <a href="{{route('job.edit', $job->id)}}">Edit</a> @endif
                        @endauth
                    </h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <p class="mb-0"><strong>Vacancy </strong></p>
                        <div class="ml-4">
                            {{$job->total_number_of_vacancies}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <p class="mb-0"><strong>Vacancies Description </strong></p>
                        <div class="ml-4">
                            {{$job->vacancies_description}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <p class="mb-0"><strong>Vacancies Type </strong></p>
                        <div class="ml-4">
                            {{$job->job_vacancies_type}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <p class="mb-0"><strong>Scope of Duties </strong></p>
                        <div class="ml-4">
                            {{$job->scope_of_duties}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <p class="mb-0"><strong>Required Experience </strong></p>
                        <div class="ml-4">
                            {{$job->related_experience_year ?? 0 }} Year {{$job->related_experience_month ?? 0}} Month
                        </div>
                    </div>
                    <div class="mb-3">
                        <p class="mb-0"><strong>Salary Offer </strong></p>
                        <div class="ml-4">
                            {{$job->salary_offer_currency}} {{$job->salary_offer}} {{$job->salary_offer_period}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <p class="mb-0"><strong>Required Skills </strong></p>
                        <div class="ml-4">
                            {{$job->skills}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <p class="mb-0"><strong>Candidates Requirement </strong></p>
                        <div class="ml-4">
                            <p class="mb-0">Gender: {{$job->gender}}</p>
                            <p class="mb-0">Marital Status: {{$job->marital_status}}</p>
                            <p class="mb-0">Race: {{$job->race}}</p>
                            <p class="mb-0">Age Range: {{$job->age_eligibillity}}</p>
                            <p class="mb-0">Other Requirements: {{$job->other_requirements}}</p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="ml-4">
                            @if($job->languages->count() > 0)
                            <table class="table table-sm">
                                <tr>
                                    <th>Language</th>
                                    <th>Speaking</th>
                                    <th>Writing</th>
                                </tr>
                                @foreach ($job->languages as $language)
                                    <tr>
                                        <td>{{$language->language_data->name}}</td>
                                        <td>{{$language->speaking}}</td>
                                        <td>{{$language->writing}}</td>
                                    </tr>
                                @endforeach
                            </table>
                            @endif
                            <p>Minimum Academic Qualification: {{$job->minimum_academic_qualification}}</p>
                            <p>Academic Field: {{$job->academic_field}}</p>
                            @if($job->academics->count() > 0)
                            <table class="table table-sm">
                                <tr>
                                    <th>Academic Qualification</th>
                                    <th>Academic Field</th>
                                </tr>
                                @foreach ($job->academics as $academic)
                                    <tr>
                                        <td>{{$academic->academic_qualification}}</td>
                                        <td>{{$academic->academic_field}}</td>
                                    </tr>
                                @endforeach
                            </table>
                            @endif
                        </div>
                    </div>
                    @if($job->facilities)
                    <div class="mb-3">
                        <p class="mb-0"><strong>Facilities </strong></p>
                        <div class="ml-4">
                            {{$job->facilities}}
                        </div>
                    </div>
                    @endif
                    @if($job->driving_license != '')
                    <div class="mb-3">
                        <p class="mb-0"><strong>Driving license </strong></p>
                        <div class="ml-4">
                            Required : {{$job->driving_license}}
                        </div>
                    </div>
                    @endif
                    @if($job->other_requirements)
                    <div class="mb-3">
                        <p class="mb-0"><strong>Other Requirements </strong></p>
                        <div class="ml-4">
                            {{$job->other_requirements}}
                        </div>
                    </div>
                    @endif
                    @if($job->other_skills)
                    <div class="mb-3">
                        <p class="mb-0"><strong>Other Skills </strong></p>
                        <div class="ml-4">
                            {{$job->other_skills}}
                        </div>
                    </div>
                    @endif
                    <div class="mt-5">
                        <p class="text-center"><a class="btn btn-success" href="#">Apply Online</a></p>
                        <p class="text-center">Contact info</p>
                        <p class="text-center mb-0">Company Name: {{$job->company()->company_name}}</p>
                        <p class="text-center mb-0">{{$job->district ? 'District: '.$job->district : ''}} {{$job->town ? 'Town: '.$job->town : ''}} {{$job->state ? 'State: '.$job->state : '' }} {{$job->postcode ? 'Post Code: '.$job->postcode : '' }}</p>
                        <p class="text-center mb-0">{{$job->person_in_charge}}</p>
                        <p class="text-center mb-0">{{$job->telephone_number}}, {{$job->handphone_number}}</p>
                        <p class="text-center mb-0">{{$job->email}}</p>
                    </div>
                    <div class="mt-3">
                        <p class="text-center">Closing Date: <strong>{{\Carbon\Carbon::parse($job->closing_date)->format('d/m/Y')}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
