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
                    <form method="POST" action="{{ route('retiredPersonnel.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="role" value="professional">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-right">{{ __('Name *') }}</label>
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
                            <label for="nric" class="col-sm-4 col-form-label text-right">{{ __('NRIC *') }}</label>
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
                            <label for="address" class="col-sm-4 col-form-label text-right">{{ __('Address *') }}</label>
                            <div class="col-sm-8">
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" placeholder="Address" required>

                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="postcode" class="col-sm-4 col-form-label text-right">{{ __('Postcode *') }}</label>
                            <div class="col-sm-8">
                                <input id="postcode" type="text" class="form-control{{ $errors->has('postcode') ? ' is-invalid' : '' }}" name="postcode" value="{{ old('postcode') }}" placeholder="Postcode" required>

                            @if ($errors->has('postcode'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('postcode') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="state" class="col-sm-4 col-form-label text-right">{{ __('State *') }}</label>
                            <div class="col-sm-8">
                                <input id="state" type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" value="{{ old('state') }}" placeholder="State" required>

                            @if ($errors->has('state'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('state') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="age" class="col-sm-4 col-form-label text-right">{{ __('Age *') }}</label>
                            <div class="col-sm-8">
                                <input id="age" type="text" class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}" name="age" value="{{ old('age') }}" placeholder="Age" required>

                            @if ($errors->has('age'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('age') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="col-sm-4 col-form-label text-right">{{ __('Gender *') }}</label>
                            <div class="col-sm-8">
                                <input id="gender" type="text" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="{{ old('gender') }}" placeholder="Gender" required>

                            @if ($errors->has('gender'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-right">{{ __('Email *') }}</label>
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
                            <label for="phone" class="col-sm-4 col-form-label text-right">{{ __('Contuct No *') }}</label>
                            <div class="col-sm-8">
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="Contuct No" required>

                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="marital_status" class="col-sm-4 col-form-label text-right">{{ __('Marital Status *') }}</label>
                            <div class="col-sm-8">
                                <input id="marital_status" type="text" class="form-control{{ $errors->has('marital_status') ? ' is-invalid' : '' }}" name="marital_status" value="{{ old('marital_status') }}" placeholder="Marital Status" required>

                            @if ($errors->has('marital_status'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('marital_status') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="country" class="col-sm-4 col-form-label text-right">{{ __('Nationality *') }}</label>
                            <div class="col-sm-8">
                                <select name="country" id="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" required>
                                    <option value="">--Select Nationality--</option>
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
                        <div class="form-group row">
                            <label for="government_employee" class="col-sm-4 col-form-label text-right">{{ __('Were you government employee ?') }}</label>
                            <div class="col-sm-8 ml-auto mt-3">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="government_employee1" name="government_employee" value="yes" class="custom-control-input">
                                    <label class="custom-control-label" for="government_employee1">Yes</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="government_employee2" name="government_employee" value="no" class="custom-control-input">
                                    <label class="custom-control-label" for="government_employee2">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="highest_academic_qualification" class="col-sm-4 col-form-label text-right">{{ __('Highest Academic Qualification *') }}</label>
                            <div class="col-sm-8">
                                <input id="highest_academic_qualification" type="text" class="form-control{{ $errors->has('highest_academic_qualification') ? ' is-invalid' : '' }}" name="highest_academic_qualification" value="{{ old('highest_academic_qualification') }}" placeholder="highest_academic_qualification" required>

                            @if ($errors->has('highest_academic_qualification'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('highest_academic_qualification') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="specialization" class="col-sm-4 col-form-label text-right">{{ __('Specialization *') }}</label>
                            <div class="col-sm-8">
                                <input id="specialization" type="text" class="form-control{{ $errors->has('specialization') ? ' is-invalid' : '' }}" name="specialization" value="{{ old('specialization') }}" placeholder="specialization" required>

                            @if ($errors->has('specialization'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('specialization') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="government_employee" class="col-sm-4 col-form-label text-right">{{ __('Prefer Working hours ?') }}</label>
                            <div class="col-sm-8 ml-auto mt-2">
                                <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="full_time" name="full_time" value="yes" class="custom-control-input">
                                        <label class="custom-control-label" for="full_time">Full Time</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="part_time" name="full_time" value="no" class="custom-control-input">
                                        <label class="custom-control-label" for="part_time">Part Time</label>
                                </div>
                            </div>


                            {{-- <label for="full_time" class="col-sm-4 col-form-label text-right">{{ __('Full Time ?') }}</label>
                            <div class="col-sm-1 mr-auto">
                                <input id="full_time" class="form-control checkbox" type="checkbox" name="full_time">
                            </div> --}}
                        </div>
                        <div class="form-group row">
                            <label for="describe_working_hours" class="col-sm-4 col-form-label text-right">{{ __('Describe Working Hours') }}</label>
                            <div class="col-sm-8">
                                <input id="describe_working_hours" type="text" class="form-control{{ $errors->has('describe_working_hours') ? ' is-invalid' : '' }}" name="describe_working_hours" value="{{ old('describe_working_hours') }}" placeholder="Describ Working Hours">

                            @if ($errors->has('describe_working_hours'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('describe_working_hours') }}</strong>
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
