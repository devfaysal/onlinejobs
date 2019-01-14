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
                    <p><strong>Vacancies Description: </strong>{{$job->vacancies_description}}</p>
                    <p><strong>Vacancy: </strong>{{$job->total_number_of_vacancies}}</p>
                    <p><strong>Scope of Duties: </strong>{{$job->scope_of_duties}}</p>
                    <p><strong>Salary: </strong>{{$job->salary_offer_currency}} {{$job->salary_offer}} {{$job->salary_offer_period}}</p>
                    <p><strong>Description: </strong>{{$job->description}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
