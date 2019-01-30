@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-5">
                <div class="card-header">
                    <h4 class="card-title mt-3">{{$job->positions_name}}</h4>
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
                            <table class="table table-sm">
                                <tr>
                                    <th>Language</th>
                                    <th>Speaking</th>
                                    <th>Writing</th>
                                </tr>
                                @foreach ($job->languages as $language)
                                    <tr>
                                        <td>{{$language->language}}</td>
                                        <td>{{$language->speaking}}</td>
                                        <td>{{$language->writing}}</td>
                                    </tr>
                                @endforeach
                            </table>
                            <p>Minimum Academic Qualification: {{$job->minimum_academic_qualification}}</p>
                            <p>Academic Field: {{$job->academic_field}}</p>
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
                        </div>
                    </div>
                    <div class="mb-3">
                        <p class="mb-0"><strong>Facilities </strong></p>
                        <div class="ml-4">
                            {{$job->facilities}}
                        </div>
                    </div>
                    <div>
                        <p class="text-center"><a class="btn btn-success" href="#">Apply Online</a></p>
                        <p class="text-center">Contact info</p>
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
