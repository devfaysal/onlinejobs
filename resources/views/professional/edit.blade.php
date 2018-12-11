@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-dark">
        <div class="col-12">
            <h4 class="text-center text-white pb-3 pt-4"><span class="mr-3">Personal</span> <span class="mr-3 text-muted">Education</span> <span class="mr-3 text-muted">Experience</span></h4>
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card auth-form mb-5">
                <div class="card-body">
                    <form method="POST" action="{{ route('professional.update', $user->id) }}" aria-label="{{ __('Update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="role" value="professional">
                        <div class="form-group row">
                            <label for="resume_headline" class="col-sm-4 col-form-label text-right">{{ __('Resume Headline *') }}</label>
                            <div class="col-sm-8">
                                <input id="resume_headline" type="text" class="form-control{{ $errors->has('resume_headline') ? ' is-invalid' : '' }}" name="resume_headline" value="{{ $user->professional_profile->resume_headline }}" placeholder="Resume Headline" required>

                            @if ($errors->has('resume_headline'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('resume_headline') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="skills" class="col-sm-4 col-form-label text-right">{{ __('Skills (Seperate with comma)') }}</label>
                            <div class="col-sm-8">
                                <input id="skills" type="text" class="form-control{{ $errors->has('skills') ? ' is-invalid' : '' }}" name="skills" value="{{ $user->professional_profile->skills }}" placeholder="Skills">

                            @if ($errors->has('skills'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('skills') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-right">{{ __('Name *') }}</label>
                            <div class="col-sm-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->professional_profile->name }}" placeholder="Name" required>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-sm-4 col-form-label text-right">{{ __('City') }}</label>
                            <div class="col-sm-8">
                                <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ $user->professional_profile->city }}" placeholder="City" required>

                            @if ($errors->has('city'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="country" class="col-sm-4 col-form-label text-right">{{ __('Country') }}</label>
                            <div class="col-sm-8">
                                <input id="country" type="text" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" value="{{ $user->professional_profile->country }}" placeholder="Country" required>

                            @if ($errors->has('country'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="current_salary" class="col-sm-4 col-form-label text-right">{{ __('Current Salary') }}</label>
                            <div class="col-sm-8">
                                <input id="current_salary" type="text" class="form-control{{ $errors->has('current_salary') ? ' is-invalid' : '' }}" name="current_salary" value="{{ $user->professional_profile->current_salary }}" placeholder="Current Salary" required>

                            @if ($errors->has('current_salary'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('current_salary') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="expected_salary" class="col-sm-4 col-form-label text-right">{{ __('Expected Salary') }}</label>
                            <div class="col-sm-8">
                                <input id="expected_salary" type="text" class="form-control{{ $errors->has('expected_salary') ? ' is-invalid' : '' }}" name="expected_salary" value="{{ $user->professional_profile->expected_salary }}" placeholder="Expected Salary" required>

                            @if ($errors->has('expected_salary'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('expected_salary') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-right">{{ __('Email *') }}</label>
                            <div class="col-sm-8">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->professional_profile->email }}" placeholder="Email" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-4 col-form-label text-right">{{ __('Mobile Number *') }}</label>
                            <div class="col-sm-8">
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $user->professional_profile->phone }}" placeholder="Mobile Number" required>

                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="resume_file" class="col-sm-4 col-form-label text-right">{{ __('Upload Resume') }}</label>
                            <div class="col-sm-8">
                                <input id="resume_file" type="file" class="form-control-file{{ $errors->has('resume_file') ? ' is-invalid' : '' }}" name="resume_file" value="{{ old('resume_file') }}">
                                <p class="text-danger">Supported file format JPG, PNG & PDF. Maximum file size: 1MB</p>
                                @if($user->professional_profile->resume_file)
                                    <a class="btn btn-sm btn-secondary mt-2" target="_blank" href="{{asset('storage/resume/'.$user->professional_profile->resume_file)}}">View Resume</a>
                                @endif
                            @if ($errors->has('resume_file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('resume_file') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profile_image" class="col-sm-4 col-form-label text-right">{{ __('Upload Resume') }}</label>
                            <div class="col-sm-8">
                                <input id="profile_image" type="file" class="form-control-file{{ $errors->has('profile_image') ? ' is-invalid' : '' }}" name="profile_image" value="{{ old('profile_image') }}">
                                <p class="text-danger">Supported file format JPG, PNG & PDF. Maximum file size: 1MB</p>
                                @if($user->professional_profile->profile_image)
                                    <a class="btn btn-sm btn-secondary mt-2" target="_blank" href="{{asset('storage/resume/'.$user->professional_profile->profile_image)}}">View Profile Image</a>
                                @endif
                            @if ($errors->has('profile_image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('profile_image') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-warning btn-block">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
