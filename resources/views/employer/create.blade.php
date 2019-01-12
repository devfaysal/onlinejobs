@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card auth-form">
                <div class="card-header"><h2>{{ __('Employer Registration, Good Day') }}</h2>Already have account?<a class="btn btn-default" href="{{route('login')}}">Login</a></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="role" value="employer">
                        {{-- <div class="form-group">
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
                        </div> --}}

                        <div class="form-group">
                            <h3>Contact Information</h3>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">{{ __('Name *') }}</label>
                            <div class="col-sm-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name" required>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="contact_email" class="col-sm-4 col-form-label">{{ __('Email *') }}</label>
                            <div class="col-sm-8">
                                <input id="contact_email" type="contact_email" class="form-control{{ $errors->has('contact_email') ? ' is-invalid' : '' }}" name="contact_email" value="{{ old('contact_email') }}" placeholder="Email" required>

                            @if ($errors->has('contact_email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('contact_email') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nric" class="col-sm-4 col-form-label">{{ __('NRIC *') }}</label>
                            <div class="col-sm-8">
                                <input id="nric" type="text" class="form-control{{ $errors->has('nric') ? ' is-invalid' : '' }}" name="nric" value="{{ old('nric') }}" placeholder="NRIC" required>

                            @if ($errors->has('nric'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nric') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-4 col-form-label">{{ __('Contact Number *') }}</label>
                            <div class="col-sm-8">
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="Contact Number" required>

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
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" placeholder="Address">

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
                                        <option value="{{$country->id}}" {{$country->id == old('country') ? 'selected':''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                            @if ($errors->has('country'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        
                        {{-- <div class="form-group row">
                            <label for="passport" class="col-sm-4 col-form-label">{{ __('Passport') }}</label>
                            <div class="col-sm-8">
                                <input id="passport" type="text" class="form-control{{ $errors->has('passport') ? ' is-invalid' : '' }}" name="passport" value="{{ old('passport') }}" placeholder="Passport">

                            @if ($errors->has('passport'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('passport') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nic" class="col-sm-4 col-form-label">{{ __('NIC') }}</label>
                            <div class="col-sm-8">
                                <input id="nic" type="text" class="form-control{{ $errors->has('nic') ? ' is-invalid' : '' }}" name="nic" value="{{ old('nic') }}" placeholder="NIC" >

                            @if ($errors->has('nic'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nic') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="passport_file" class="col-sm-4 col-form-label">{{ __('Passport/NIC (Upload Scanned copy) *') }}</label>
                            <div class="col-sm-8">
                                <input id="passport_file" type="file" class="form-control-file{{ $errors->has('passport_file') ? ' is-invalid' : '' }}" name="passport_file" value="{{ old('passport_file') }}">

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
                        </div>    --}}
                        <div class="form-group">
                            <h3>Company Information</h3>
                        </div>
                        <div class="form-group row">
                            <label for="company_name" class="col-sm-4 col-form-label">{{ __('Company Name *') }}</label>
                            <div class="col-sm-8">
                                <input id="company_name" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ old('name') }}" placeholder="Company Name" required>

                                @if ($errors->has('company_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>
                        <div class="form-group row">
                            <label for="roc" class="col-sm-4 col-form-label">{{ __('ROC *') }}</label>
                            <div class="col-sm-8">
                                <input id="roc" type="text" class="form-control{{ $errors->has('roc') ? ' is-invalid' : '' }}" name="roc" value="{{ old('roc') }}" placeholder="ROC" required>

                            @if ($errors->has('roc'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('roc') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">{{ __('Company Email *') }}</label>
                            <div class="col-sm-8">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Company Email" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="website" class="col-sm-4 col-form-label">{{ __('Company Website') }}</label>
                            <div class="col-sm-8">
                                <input id="website" type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" name="website" value="{{ old('website') }}" placeholder="Company Website">

                            @if ($errors->has('website'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('website') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company_phone" class="col-sm-4 col-form-label">{{ __('Company Phone ') }}</label>
                            <div class="col-sm-8">
                                <input id="company_phone" type="text" class="form-control{{ $errors->has('company_phone') ? ' is-invalid' : '' }}" name="company_phone" value="{{ old('company_phone') }}" placeholder="Company Phone">

                            @if ($errors->has('company_phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('company_phone') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company_address" class="col-sm-4 col-form-label">{{ __('Company Address') }}</label>
                            <div class="col-sm-8">
                                <input id="company_address" type="text" class="form-control{{ $errors->has('company_address') ? ' is-invalid' : '' }}" name="company_address" value="{{ old('company_address') }}" placeholder="Company Address">

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
                                <input id="company_city" type="text" class="form-control{{ $errors->has('company_city') ? ' is-invalid' : '' }}" name="company_city" value="{{ old('company_city') }}" placeholder="City">

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
                                <input id="state" type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" value="{{ old('state') }}" placeholder="State">

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
                                        <option value="{{$country->id}}" {{$country->id == old('company_country') ? 'selected':''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                            @if ($errors->has('company_country'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('company_country') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4" for="">Looking For * </label>
                            <div class="col-sm-8">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="looking_for" class="custom-control-input" required>
                                    <label class="custom-control-label" for="customRadio1">Professional</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="looking_for" class="custom-control-input" required>
                                    <label class="custom-control-label" for="customRadio2">General Worker</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio3" name="looking_for" class="custom-control-input" required>
                                    <label class="custom-control-label" for="customRadio3">Domestic Maid</label>
                                </div>
                            </div>
                        </div>
                                 
                        <div class="form-group row">
                            <div class="col-sm-8 ml-auto">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="agreement" id="customCheck1" required checked>
                                    <label class="custom-control-label" for="customCheck1">I have read and agree to the<a href="">Terms and Conditions</a> governing the use of onlinejobs.my</label>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <div class="col-sm-1 ml-auto">
                                <input id="agreement" class="checkbox" type="checkbox" name="agreement" required>
                            </div>
                            <label for="agreement" class="col-sm-7">I have read and agree to the<a href="">Terms and Conditions</a> governing the use of onlinejobs.my</label>
                        </div> --}}
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
