@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="title-block">
            <a class="btn btn-info" href="{{route('applicants', $job->id)}}">Back</a>
            <h1 class="title">Position: {{ $job->positions_name}} </h1>
            <p>{{ $job->total_number_of_vacancies }} {{ $job->job_vacancies_type }} vacancy open</p>
            <p>Comapny: <a href="{{ route('employer.public', $job->company()->user->public_id)}}">{{ $job->company()->company_name}}</a></p>
        </div>
        <h1>{{ $applicant->professional_profile->name ?? $applicant->name}} </h1>
        <p>Interview Date: {{$data->interview_date ? $data->interview_date->format('d-m-Y') : ''}}</p>
        <p>Hiring Date: {{$data->hiring_date ? $data->hiring_date->format('d-m-Y') : ''}}</p>
        <div class="row">
            <div class="col-md-6">
                <form method="POST" action="{{route('applicants.updatestatus', [$job->id, $applicant->id])}}">
                    @csrf
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                            <option> --Select Type-- </option>
                            @foreach ($statuses as $index => $status)
                                <option value="{{$index}}" {{ $index == $data->status ? 'selected' : '' }}>{{$status}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                         <label for="date">Date</label>
                        <input class="form-control" type="date" name="date" id="date">
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button type="submit" class="btn btn-warning btn-block">
                            {{ __('Update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('javascript')

@endsection