@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-dark">
        <div class="col-12">
            <h4 class="text-center text-white pb-3 pt-4"><span class="mr-3">Personal</span> <span class="mr-3 text-muted">Education</span> 
                @if(request('type')== 'pro')
                <span class="mr-3 text-muted">Experience</span>
                @endif
            </h4>
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card auth-form mb-5">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="role" value="professional">
                        <input type="hidden" name="type" value="{{request('type')}}">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-right">{{ __('Name ') }}<span class="text-danger">*</span></label>
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
                            <label for="email" class="col-sm-4 col-form-label text-right">{{ __('Email ') }}<span class="text-danger">*</span></label>
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
                            <label for="phone" class="col-sm-4 col-form-label text-right">{{ __('Mobile Number ') }}<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="Mobile Number" required>

                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="country" class="col-sm-4 col-form-label text-right">{{ __('Country ') }}<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select name="country" id="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" required>
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
                        <div class="form-group row">
                            <label for="qualification" class="col-sm-4 col-form-label text-right">{{ __('Highest Qualification ') }}<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control{{ $errors->has('qualification') ? ' is-invalid' : '' }}" name="qualification" id="qualification">
                                    <option value="">--Select Qualification--</option>
                                    @foreach ($qualifications as $qualification)
                                        <option value="{{$qualification->name}}">{{$qualification->name}}</option>
                                    @endforeach
                                </select>

                            @if ($errors->has('qualification'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('qualification') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="subject" class="col-sm-4 col-form-label text-right">{{ __('Field of Study ') }}<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                {{-- <input id="subject" type="text" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject[]" value="{{ $qualification->subject }}" placeholder="Field of Study" required> --}}
                                <select class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" id="subject">
                                    <option value="">--Select Field of Study--</option>
                                    @foreach ($field_of_studys as $study)
                                        <option value="{{$study->name}}">{{$study->name}}</option>
                                    @endforeach
                                </select>
                            @if ($errors->has('subject'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-4 col-form-label text-right">{{ __('Password ') }}<span class="text-danger">*</span></label>
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
                            <label for="password-confirm" class="col-sm-4 col-form-label text-right">{{ __('Confirm Password ') }}<span class="text-danger">*</span></label>

                            <div class="col-sm-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="resume_file" class="col-sm-4 col-form-label text-right">{{ __('Upload Resume') }}</label>
                            <div class="col-sm-8">
                                <input id="resume_file" type="file" class="form-control-file{{ $errors->has('resume_file') ? ' is-invalid' : '' }}" name="resume_file" value="{{ old('resume_file') }}">
                                <p class="text-danger">Supported file format pdf, doc or docx. Maximum file size: 1MB</p>
                            @if ($errors->has('resume_file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('resume_file') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-1 ml-auto">
                                <input id="agreement" class="form-control checkbox" type="checkbox" name="agreement" checked required>
                            </div>
                            <label for="agreement" class="col-sm-8">I have read and agree to the<a href=""> Terms and Conditions</a> governing the use of onlinejobs.my</label>
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
