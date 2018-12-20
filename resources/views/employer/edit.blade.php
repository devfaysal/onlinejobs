@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card auth-form">
                <div class="card-header">
                    @if(Auth::user()->hasRole('superadministrator'))
                    <h3 class="mt-2"><a href="{{route('admin.employerApplication')}}" class="btn btn-danger pull-left">Back </a></h3>
                    @elseif(Auth::user()->hasRole('employer'))
                    <h3 class="mt-2"><a href="{{route('employer.show')}}" class="btn btn-danger pull-left">Back </a></h3>
                    @endif
                    <h2 class="text-center">{{ __('Update Employer Inofrmation') }}</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('employer.update', $employer->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="role" value="employer">
                        
                        <div class="form-group">
                            <h3>Contact Information</h3>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">{{ __('Name *') }}</label>
                            <div class="col-sm-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $employer->name }}" placeholder="Name" required>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nric" class="col-sm-4 col-form-label">{{ __('NRIC *') }}</label>
                            <div class="col-sm-8">
                                <input id="nric" type="text" class="form-control{{ $errors->has('nric') ? ' is-invalid' : '' }}" name="nric" value="{{ $employer->employer_profile->nric }}" placeholder="NRIC" required>

                            @if ($errors->has('nric'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nric') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-4 col-form-label">{{ __('Phone *') }}</label>
                            <div class="col-sm-8">
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $employer->phone }}" placeholder="Phone" required>

                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-4 col-form-label">{{ __('Address') }}</label>
                            <div class="col-sm-8">
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $employer->employer_profile->address }}" placeholder="Address">

                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="country" class="col-sm-4 col-form-label">{{ __('Country') }}</label>
                            <div class="col-sm-8">
                                <select name="country" id="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}">
                                    <option value="">--Select Country--</option>
                                    @foreach ($countrys as $country)
                                        <option value="{{$country->id}}" {{$country->id == $employer->employer_profile->country ? 'selected':''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                            @if ($errors->has('country'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <h3>Company Information</h3>
                        </div>
                        <div class="form-group row">
                            <label for="company_name" class="col-sm-4 col-form-label">{{ __('Company Name') }}</label>
                            <div class="col-sm-8">
                                <input id="company_name" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ $employer->employer_profile->company_name }}" placeholder="Company Name">

                                @if ($errors->has('company_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>
                        <div class="form-group row">
                            <label for="roc" class="col-sm-4 col-form-label">{{ __('ROC') }}</label>
                            <div class="col-sm-8">
                                <input id="roc" type="text" class="form-control{{ $errors->has('roc') ? ' is-invalid' : '' }}" name="roc" value="{{ $employer->employer_profile->roc }}" placeholder="ROC">

                            @if ($errors->has('roc'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('roc') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">{{ __('Email *') }}</label>
                            <div class="col-sm-8">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $employer->email }}" placeholder="Email" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company_address" class="col-sm-4 col-form-label">{{ __('Company Address') }}</label>
                            <div class="col-sm-8">
                                <input id="company_address" type="text" class="form-control{{ $errors->has('company_address') ? ' is-invalid' : '' }}" name="company_address" value="{{ $employer->employer_profile->company_address }}" placeholder="Company Address">

                                @if ($errors->has('company_address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="company_city" class="col-sm-4 col-form-label">{{ __('City') }}</label>
                            <div class="col-sm-8">
                                <input id="company_city" type="text" class="form-control{{ $errors->has('company_city') ? ' is-invalid' : '' }}" name="company_city" value="{{ $employer->employer_profile->company_city }}" placeholder="City">

                            @if ($errors->has('company_city'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('company_city') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="state" class="col-sm-4 col-form-label">{{ __('State') }}</label>
                            <div class="col-sm-8">
                                <input id="state" type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" value="{{ $employer->employer_profile->state }}" placeholder="State">

                            @if ($errors->has('state'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('state') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company_country" class="col-sm-4 col-form-label">{{ __('Country') }}</label>
                            <div class="col-sm-8">
                                <select name="company_country" id="company_country" class="form-control{{ $errors->has('company_country') ? ' is-invalid' : '' }}">
                                    <option value="">--Select Country--</option>
                                    @foreach ($countrys as $country)
                                        <option value="{{$country->id}}" {{$country->id == $employer->employer_profile->company_country ? 'selected':''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                            @if ($errors->has('company_country'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('company_country') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-warning btn-block">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
