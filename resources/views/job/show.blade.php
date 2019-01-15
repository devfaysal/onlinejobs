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
                    <div>
                        <p class="text-center"><a class="btn btn-success" href="#">Apply Online</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
