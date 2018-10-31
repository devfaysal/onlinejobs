@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card auth-form mb-5">
                <div class="card-header"><h2 class="text-center">{{ __('Agent!!! Sign up today, its easy!') }}</h2></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="role" value="agent">
                        {{-- <div class="form-group row">
                            <label for="agent_code" class="col-sm-4 col-form-label">{{ __('Agent Code') }}</label>
                            <div class="col-sm-8">
                                <input id="agent_code" type="text" class="form-control{{ $errors->has('agent_code') ? ' is-invalid' : '' }}" name="agent_code" value="{{ old('agent_code') }}" placeholder="Agent Code" required>

                                @if ($errors->has('agent_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agent_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}
                        
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <h3>Company Information</h3>
                                </div>
                                <div class="form-group row">
                                    <label for="agency_registered_name" class="col-sm-4 col-form-label">{{ __('Agency Registered Name *') }}</label>
                                    <div class="col-sm-8">
                                        <input id="agency_registered_name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="agency_registered_name" value="{{ old('agency_registered_name') }}" placeholder="Agency Registered Name" required>

                                        @if ($errors->has('agency_registered_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('agency_registered_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>                            
                                </div>

                                <div class="form-group row">
                                    <label for="agency_address" class="col-sm-4 col-form-label">{{ __('Agency Address') }}</label>
                                    <div class="col-sm-8">
                                        <input id="agency_address" type="text" class="form-control{{ $errors->has('agency_address') ? ' is-invalid' : '' }}" name="agency_address" value="{{ old('agency_address') }}" placeholder="Agency Address">

                                        @if ($errors->has('agency_address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('agency_address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="agency_city" class="col-sm-4 col-form-label">{{ __('Agency City') }}</label>
                                    <div class="col-sm-8">
                                        <input id="agency_city" type="text" class="form-control{{ $errors->has('agency_city') ? ' is-invalid' : '' }}" name="agency_city" value="{{ old('agency_city') }}" placeholder="Agency City">

                                    @if ($errors->has('agency_city'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('agency_city') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="agency_country" class="col-sm-4 col-form-label">{{ __('Agency Country *') }}</label>
                                    <div class="col-sm-8">
                                        <select name="agency_country" id="agency_country" class="form-control{{ $errors->has('agency_country') ? ' is-invalid' : '' }}" required>
                                            <option value="">--Select Country--</option>
                                            @foreach ($countrys as $country)
                                                <option value="{{$country->id}}" {{$country->id == old('agency_country') ? 'selected':''}}>{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    @if ($errors->has('agency_country'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('agency_country') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="agency_phone" class="col-sm-4 col-form-label">{{ __('Agency Phone *') }}</label>
                                    <div class="col-sm-8">
                                        <input id="agency_phone" type="text" class="form-control{{ $errors->has('agency_phone') ? ' is-invalid' : '' }}" name="agency_phone" value="{{ old('agency_phone') }}" placeholder="Agency Phone" required>

                                    @if ($errors->has('agency_phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('agency_phone') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="agency_email" class="col-sm-4 col-form-label">{{ __('Agency Email *') }}</label>
                                    <div class="col-sm-8">
                                        <input id="agency_email" type="email" class="form-control{{ $errors->has('agency_email') ? ' is-invalid' : '' }}" name="agency_email" value="{{ old('agency_email') }}" placeholder="Agency Email" required>

                                    @if ($errors->has('agency_email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('agency_email') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="agency_fax" class="col-sm-4 col-form-label">{{ __('Agency Fax') }}</label>
                                    <div class="col-sm-8">
                                        <input id="agency_fax" type="text" class="form-control{{ $errors->has('agency_fax') ? ' is-invalid' : '' }}" name="agency_fax" value="{{ old('agency_fax') }}" placeholder="Agency Fax">

                                    @if ($errors->has('agency_fax'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('agency_fax') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="license_no" class="col-sm-4 col-form-label">{{ __('License No *') }}</label>
                                    <div class="col-sm-8">
                                        <input id="license_no" type="text" class="form-control{{ $errors->has('license_no') ? ' is-invalid' : '' }}" name="license_no" value="{{ old('license_no') }}" placeholder="License No" required>

                                    @if ($errors->has('license_no'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('license_no') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="license_issue_date" class="col-sm-4 col-form-label">{{ __('License Issue Date') }}</label>
                                    <div class="col-sm-8">
                                        <input id="license_issue_date" type="date" class="form-control{{ $errors->has('license_issue_date') ? ' is-invalid' : '' }}" name="license_issue_date" min="1900-01-01" max="2200-01-01" value="{{old('license_expire_date') ? \Carbon\Carbon::parse(old('license_issue_date'))->format('Y-m-d') : ''}}" placeholder="license_issue_date">

                                    @if ($errors->has('license_issue_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('license_issue_date') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="license_expire_date" class="col-sm-4 col-form-label">{{ __('License Expire Date') }}</label>
                                    <div class="col-sm-8">
                                        <input id="license_expire_date" type="date" class="form-control{{ $errors->has('license_expire_date') ? ' is-invalid' : '' }}" name="license_expire_date" min="1900-01-01" max="2200-01-01" value="{{old('license_expire_date') ? \Carbon\Carbon::parse(old('license_expire_date'))->format('Y-m-d') : ''}}" placeholder="license_expire_date">

                                    @if ($errors->has('license_expire_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('license_expire_date') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="license_file" class="col-sm-4 col-form-label">{{ __('Upload License') }}</label>
                                    <div class="col-sm-8">
                                        <input id="license_file" type="file" class="form-control-file{{ $errors->has('license_file') ? ' is-invalid' : '' }}" name="license_file" value="{{ old('license_file') }}" placeholder="license_file">
                                        <p class="text-danger">Supported file format JPG, PNG & PDF. Maximum file size: 1MB</p>
                                    @if ($errors->has('license_file'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('license_file') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h3>Sign Up Information</h3>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label">{{ __('Email *') }}</label>
                                    <div class="col-sm-8">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-4 col-form-label">{{ __('Password *') }}</label>
                                    <div class="col-sm-8">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-sm-4 col-form-label">{{ __('Confirm Password *') }}</label>

                                    <div class="col-sm-8">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">


                                <div class="form-group">
                                    <h3>Contact Information</h3>
                                </div>
                                <div class="form-group row">
                                    <label for="first_name" class="col-sm-4 col-form-label">{{ __('First Name *') }}</label>
                                    <div class="col-sm-8">
                                        <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required>

                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="middle_name" class="col-sm-4 col-form-label">{{ __('Middle Name') }}</label>
                                    <div class="col-sm-8">
                                        <input id="middle_name" type="text" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" name="middle_name" value="{{ old('middle_name') }}" placeholder="Middle Name">

                                    @if ($errors->has('middle_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('middle_name') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="last_name" class="col-sm-4 col-form-label">{{ __('Last Name') }}</label>
                                    <div class="col-sm-8">
                                        <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">

                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="designation" class="col-sm-4 col-form-label">{{ __('Designation') }}</label>
                                    <div class="col-sm-8">
                                        <input id="designation" type="text" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" name="designation" value="{{ old('designation') }}" placeholder="Designation">

                                    @if ($errors->has('designation'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('designation') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-4 col-form-label">{{ __('Address') }}</label>
                                    <div class="col-sm-8">
                                        <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" placeholder="Address">

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nationality" class="col-sm-4 col-form-label">{{ __('Nationality *') }}</label>
                                    <div class="col-sm-8">
                                        <select name="nationality" id="nationality" class="form-control{{ $errors->has('nationality') ? ' is-invalid' : '' }}">
                                            <option value="">--Select Nationality--</option>
                                            @foreach ($nationalitys as $nationality)
                                                <option value="{{$nationality->id}}" {{$nationality->id == old('nationality') ? 'selected':''}}>{{$nationality->name}}</option>
                                            @endforeach
                                        </select>
                                    @if ($errors->has('nationality'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nationality') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="passport" class="col-sm-4 col-form-label">{{ __('Passport/NIC') }}</label>
                                    <div class="col-sm-8">
                                        <input id="passport" type="text" class="form-control{{ $errors->has('passport') ? ' is-invalid' : '' }}" name="passport" value="{{ old('passport') }}" placeholder="Passport/NIC">

                                    @if ($errors->has('passport'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('passport') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label for="nic" class="col-sm-4 col-form-label">{{ __('NIC') }}</label>
                                    <div class="col-sm-8">
                                        <input id="nic" type="text" class="form-control{{ $errors->has('nic') ? ' is-invalid' : '' }}" name="nic" value="{{ old('nic') }}" placeholder="NIC" >

                                    @if ($errors->has('nic'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nic') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label for="passport_file" class="col-sm-4 col-form-label">{{ __('Passport/NIC (Upload Scanned copy) *') }}</label>
                                    <div class="col-sm-8">
                                        <input id="passport_file" type="file" class="form-control-file{{ $errors->has('passport_file') ? ' is-invalid' : '' }}" name="passport_file" value="{{ old('passport_file') }}">
                                        <p class="text-danger">Supported file format JPG, PNG & PDF. Maximum file size: 1MB</p>
                                    @if ($errors->has('passport_file'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('passport_file') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="contact_phone" class="col-sm-4 col-form-label">{{ __('Phone Number *') }}</label>
                                    <div class="col-sm-8">
                                        <input id="contact_phone" type="text" class="form-control{{ $errors->has('contact_phone') ? ' is-invalid' : '' }}" name="contact_phone" value="{{ old('contact_phone') }}" placeholder="Phone Number">

                                    @if ($errors->has('contact_phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('contact_phone') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="contact_email" class="col-sm-4 col-form-label">{{ __('E-Mail Address *') }}</label>
                                    <div class="col-sm-8">
                                        <input id="contact_email" type="contact_email" class="form-control{{ $errors->has('contact_email') ? ' is-invalid' : '' }}" name="contact_email" value="{{ old('contact_email') }}" placeholder="E-Mail">

                                    @if ($errors->has('contact_email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('contact_email') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>                        
                                <div class="form-group row">
                                        <div class="col-sm-1 ml-auto">
                                            <input id="agreement" class="checkbox" type="checkbox" name="agreement" required>
                                        </div>
                                        <label for="agreement" class="col-sm-8">I have read and agree to the<a href="">Terms and Conditions</a> governing the use of onlinejobs.my</label>
                                </div>



                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-warning btn-block">
                                {{ __('Register') }}
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
