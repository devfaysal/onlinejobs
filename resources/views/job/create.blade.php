@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-dark">
        <div class="col-12">
            <h4 class="text-center text-white pb-3 pt-4">Post Job </h4>
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card auth-form mb-5">
                <div class="card-body">
                        <a class="btn btn-info" href="{{route('employer.show')}}">Back</a>
                    <form method="POST" action="{{ route('job.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label text-right">{{ __('Title *') }}</label>
                            <div class="col-sm-8">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" placeholder="Title" required>

                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company" class="col-sm-4 col-form-label text-right">{{ __('Company *') }}</label>
                            <div class="col-sm-8">
                                <input id="company" type="text" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company" value="{{ old('company') }}" placeholder="Company" required>

                            @if ($errors->has('company'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('company') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-4 col-form-label text-right">{{ __('Job Description *') }}</label>
                            <div class="col-sm-8">
                                <textarea name="description" id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" cols="30" rows="10" required>{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location" class="col-sm-4 col-form-label text-right">{{ __('Location *') }}</label>
                            <div class="col-sm-8">
                                <input id="location" type="text" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" name="location" value="{{ old('location') }}" placeholder="Location" required>

                            @if ($errors->has('location'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('location') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="salary_range_1" class="col-sm-4 col-form-label text-right">{{ __('Salary Range *') }}</label>
                            <div class="col-sm-8">
                                <input id="salary_range_1" type="text" class="form-control{{ $errors->has('salary_range_1') ? ' is-invalid' : '' }}" name="salary_range_1" value="{{ old('salary_range_1') }}" placeholder="Salary Range" required>

                            @if ($errors->has('salary_range_1'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('salary_range_1') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="salary_range_2" class="col-sm-4 col-form-label text-right">{{ __('Salary Range *') }}</label>
                            <div class="col-sm-8">
                                <input id="salary_range_2" type="text" class="form-control{{ $errors->has('salary_range_1') ? ' is-invalid' : '' }}" name="salary_range_2" value="{{ old('salary_range_2') }}" placeholder="Salary Range" required>

                            @if ($errors->has('salary_range_1'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('salary_range_2') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vacancy" class="col-sm-4 col-form-label text-right">{{ __('Vacancy *') }}</label>
                            <div class="col-sm-8">
                                <input id="vacancy" type="text" class="form-control{{ $errors->has('vacancy') ? ' is-invalid' : '' }}" name="vacancy" value="{{ old('vacancy') }}" placeholder="Vacancy" required>

                            @if ($errors->has('vacancy'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('vacancy') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nature" class="col-sm-4 col-form-label text-right">{{ __('Nature *') }}</label>
                            <div class="col-sm-8">
                                <input id="nature" type="text" class="form-control{{ $errors->has('nature') ? ' is-invalid' : '' }}" name="nature" value="{{ old('nature') }}" placeholder="Nature" required>

                            @if ($errors->has('nature'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nature') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-1 ml-auto">
                                <input id="agreement" class="form-control checkbox" type="checkbox" name="agreement" checked required>
                            </div>
                            <label for="agreement" class="col-sm-8">I have read and agree to the<a href="">Terms and Conditions</a> governing the use of onlinejobs.my</label>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-warning btn-block">
                                {{ __('Post Job') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
