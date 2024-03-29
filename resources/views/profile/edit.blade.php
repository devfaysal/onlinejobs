@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(Session::has('message'))
        <div class="col-md-12">
            <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('message') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
        <div class="col-md-8 col-md-offset-2">
            <div class="card mt-4 mb-4">
                <div class="card-header">
                    <h3 class="text-center mt-2">
                        <a href="/admin" class="btn btn-danger pull-left">Back</a>
                        Edit Information
                    </h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-md-12 pt-5" id="General-Info">
                                <h3 class="">General Information</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ __('Name *') }}</label>
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $profile->name }}" placeholder="Name" required>
        
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_of_birth">{{ __('Date of Birth *') }}</label>
                                    <input id="date_of_birth" type="date" class="form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" name="date_of_birth" min="1900-01-01" max="2200-01-01" value="{{ $profile->date_of_birth ? \Carbon\Carbon::parse($profile->date_of_birth)->format('Y-m-d') : ''}}" placeholder="Date of Birth" required>
        
                                    @if ($errors->has('date_of_birth'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('date_of_birth') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">{{ __('Address *') }}</label>
                                    <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $profile->address }}" placeholder="Address" required>
        
                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="district">{{ __('District') }}</label>
                                    <input id="district" type="text" class="form-control{{ $errors->has('district') ? ' is-invalid' : '' }}" name="district" value="{{ $profile->district }}" placeholder="District">
        
                                    @if ($errors->has('district'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('district') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">{{ __('City *') }}</label>
                                    <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ $profile->city }}" placeholder="City" required>
        
                                    @if ($errors->has('city'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="state">{{ __('State/Proviace *') }}</label>
                                    <input id="state" type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" value="{{ $profile->state }}" placeholder="State/Proviace" required>
        
                                    @if ($errors->has('state'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nationality">{{ __('Nationality *') }}</label>
                                    <select name="nationality" id="nationality" class="form-control{{ $errors->has('nationality') ? ' is-invalid' : '' }}" required>
                                        <option value="">--Select Nationality--</option>
                                        @foreach ($nationalitys as $nationality)
                                            <option value="{{$nationality->id}}" {{$nationality->id == $profile->nationality ? 'selected':''}}>{{$nationality->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">{{ __('Gender *') }}</label>
                                    <select name="gender" id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" required>
                                        <option value="">--Select Gender--</option>
                                        @foreach ($genders as $gender)
                                            <option value="{{$gender->id}}" {{$gender->id == $profile->gender ? 'selected':''}}>{{$gender->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="marital_status">{{ __('Marital Status') }}</label>
                                    <select name="marital_status" id="marital_status" class="form-control{{ $errors->has('marital_status') ? ' is-invalid' : '' }}">
                                        <option value="">--Select Marital Status--</option>
                                        @foreach ($marital_statuses as $marital_status)
                                            <option value="{{$marital_status->id}}" {{$marital_status->id == $profile->marital_status ? 'selected':''}}>{{$marital_status->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('marital_status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('marital_status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="children">{{ __('Children') }}</label>
                                    <input id="children" type="children" class="form-control{{ $errors->has('children') ? ' is-invalid' : '' }}" name="children" value="{{ $profile->children }}" placeholder="Children">
        
                                    @if ($errors->has('children'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('children') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="siblings">{{ __('Siblings') }}</label>
                                    <input id="siblings" type="siblings" class="form-control{{ $errors->has('siblings') ? ' is-invalid' : '' }}" name="siblings" value="{{ $profile->siblings }}" placeholder="Siblings">
        
                                    @if ($errors->has('siblings'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('siblings') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="religion">{{ __('Religion') }}</label>
                                    <select name="religion" id="religion" class="form-control{{ $errors->has('religion') ? ' is-invalid' : '' }}" >
                                        <option value="">--Select Religion--</option>
                                        @foreach ($religions as $religion)
                                            <option value="{{$religion->id}}" {{$religion->id == $profile->religion ? 'selected':''}}>{{$religion->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('religion'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('religion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="height">{{ __('Height (CM)') }}</label>
                                    <input id="height" type="text" class="form-control{{ $errors->has('height') ? ' is-invalid' : '' }}" name="height" value="{{ $profile->height }}" placeholder="Height">
        
                                    @if ($errors->has('height'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('height') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="weight">{{ __('Weight (Pound)') }}</label>
                                    <input id="weight" type="text" class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" name="weight" value="{{ $profile->weight }}" placeholder="Weight">
        
                                    @if ($errors->has('weight'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('weight') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ __('E-Mail ID') }}</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $profile->email }}" placeholder="E-Mail">
        
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">{{ __('Contact No. *') }}</label>
                                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $profile->phone }}" placeholder="Phone" required>
        
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="father_name">{{ __('Father Name') }}</label>
                                    <input id="father_name" type="text" class="form-control{{ $errors->has('father_name') ? ' is-invalid' : '' }}" name="father_name" value="{{ $profile->father_name }}" placeholder="Father Name">
        
                                    @if ($errors->has('father_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('father_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mother_name">{{ __('Mother Name') }}</label>
                                    <input id="mother_name" type="text" class="form-control{{ $errors->has('mother_name') ? ' is-invalid' : '' }}" name="mother_name" value="{{ $profile->mother_name }}" placeholder="Mother Name">
        
                                    @if ($errors->has('mother_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mother_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="father_contact_number">{{ __('Father Contact No') }}</label>
                                    <input id="father_contact_number" type="text" class="form-control{{ $errors->has('father_contact_number') ? ' is-invalid' : '' }}" name="father_contact_number" value="{{ $profile->father_contact_number }}" placeholder="Father Contact No">
        
                                    @if ($errors->has('father_contact_number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('father_contact_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                @if ( $profile->user->hasRole('worker') )
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sector">{{ __('Sector') }}</label>
                                            <select name="sector" id="sector" class="form-control{{ $errors->has('sector') ? ' is-invalid' : '' }}" >
                                                <option value="">--Select Sector--</option>
                                                @foreach ($sectors as $sector)
                                                    @if($profile->sector())
                                                        <option value="{{$sector->id}}" {{$sector->id == $profile->sector()->id ? 'selected':''}}>{{$sector->name}}</option>
                                                    @else
                                                        <option value="{{$sector->id}}">{{$sector->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if ($errors->has('sector'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('sector') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sub_sector">{{ __('Sub Sector') }}</label>
                                            <select name="sub_sector" id="sub_sector" class="form-control{{ $errors->has('sub_sector') ? ' is-invalid' : '' }}" >
                                                <option value="">--Select Sub Sector--</option>
                                                @if($profile->sector())
                                                    @foreach ($profile->sector()->sub_sectors as $sub_sector)
                                                        @if($profile->sub_sector())
                                                            <option value="{{$sub_sector->id}}" {{$sub_sector->id == $profile->sub_sector()->id ? 'selected':''}}>{{$sub_sector->name}}</option>
                                                        @else
                                                            <option value="{{$sub_sector->id}}">{{$sub_sector->name}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('sub_sector'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('sub_sector') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-12 pt-5 page-section" id="Images">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="">Images</h3>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">{{ __('Half Image') }}</label>
                                            <input onchange="previewFile('#image_preview', '#image')" id="image" type="file" class="form-control-file{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image">
                                            <p class="text-danger">Supported file format JPG, PNG. Maximum file size: 1MB</p>
                                            <img id="image_preview" style="width: 100px;" src="{{$profile->image != '' ? asset('storage/'.$profile->image) :  asset('images/dummy.jpg')}}" class="img-thumbnail" height="">
                
                                            @if ($errors->has('image'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="full_image">{{ __('Full Image') }}</label>
                                            <input onchange="previewFile('#full_image_preview','#full_image')" id="full_image" type="file" class="form-control-file{{ $errors->has('full_image') ? ' is-invalid' : '' }}" name="full_image">
                                            <p class="text-danger">Supported file format JPG, PNG. Maximum file size: 1MB</p>
                                            <img id="full_image_preview" style="width: 100px;" src="{{$profile->full_image != '' ? asset('storage/'.$profile->full_image) :  asset('images/avatar_full.jpg')}}" class="img-thumbnail" height="">
                
                                            @if ($errors->has('full_image'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('full_image') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 pt-5 page-section" id="Emergency-Contact">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="">Emergency Contact</h3>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emergency_contact_name">{{ __('Emergency Contact Name *') }}</label>
                                            <input id="emergency_contact_name" type="text" class="form-control{{ $errors->has('emergency_contact_name') ? ' is-invalid' : '' }}" name="emergency_contact_name" value="{{ $profile->emergency_contact_name }}" placeholder="Emergency Contact Name" required>
                
                                            @if ($errors->has('emergency_contact_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('emergency_contact_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emergency_contact_relationship">{{ __('Relationship *') }}</label>
                                            <input id="emergency_contact_relationship" type="text" class="form-control{{ $errors->has('emergency_contact_relationship') ? ' is-invalid' : '' }}" name="emergency_contact_relationship" value="{{ $profile->emergency_contact_relationship }}" placeholder="Relationship" required>
                
                                            @if ($errors->has('emergency_contact_relationship'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('emergency_contact_relationshipe') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emergency_contact_phone">{{ __('Phone No. *') }}</label>
                                            <input id="emergency_contact_phone" type="text" class="form-control{{ $errors->has('emergency_contact_phone') ? ' is-invalid' : '' }}" name="emergency_contact_phone" value="{{ $profile->emergency_contact_phone }}" placeholder="Telephone No." required>
                
                                            @if ($errors->has('emergency_contact_phone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('emergency_contact_phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emergency_contact_address">{{ __('Address *') }}</label>
                                            <input id="emergency_contact_address" type="text" class="form-control{{ $errors->has('emergency_contact_address') ? ' is-invalid' : '' }}" name="emergency_contact_address" value="{{ $profile->emergency_contact_address }}" placeholder="Address" required>
                
                                            @if ($errors->has('emergency_contact_address'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('emergency_contact_address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 pt-5 page-section" id="Passport-Details">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="">Passport Details</h3>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="passport_number">{{ __('Passport Number *') }}</label>
                                            <input id="passport_number" type="text" class="form-control{{ $errors->has('passport_number') ? ' is-invalid' : '' }}" name="passport_number" value="{{ $profile->passport_number }}" placeholder="Passport Number" required>
                
                                            @if ($errors->has('passport_number'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('passport_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="passport_issue_date">{{ __('Passport Issue Date *') }}</label>
                                            <input id="passport_issue_date" type="date" class="form-control{{ $errors->has('passport_issue_date') ? ' is-invalid' : '' }}" name="passport_issue_date" min="1900-01-01" max="2200-01-01" value="{{ $profile->passport_issue_date ? \Carbon\Carbon::parse($profile->passport_issue_date)->format('Y-m-d') : ''}}" placeholder="Passport Issue Date" required>
                
                                            @if ($errors->has('passport_issue_date'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('passport_issue_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="passport_issue_place">{{ __('Passport Issue Place *') }}</label>
                                            <input id="passport_issue_place" type="text" class="form-control{{ $errors->has('passport_issue_place') ? ' is-invalid' : '' }}" name="passport_issue_place" value="{{ $profile->passport_issue_place }}" placeholder="Passport Issue Place" required>
                
                                            @if ($errors->has('passport_issue_place'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('passport_issue_place') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="passport_expire_date">{{ __('Passport Expire Date *') }}</label>
                                            <input id="passport_expire_date" type="date" class="form-control{{ $errors->has('passport_expire_date') ? ' is-invalid' : '' }}" name="passport_expire_date" min="1900-01-01" max="2200-01-01" value="{{ $profile->passport_expire_date ? \Carbon\Carbon::parse($profile->passport_expire_date)->format('Y-m-d') : ''}}" placeholder="Passport Expire Date" required>
                
                                            @if ($errors->has('passport_expire_date'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('passport_expire_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="passport_file">{{ __('Passport File') }}</label>
                                            <input id="passport_file" type="file" class="form-control-file{{ $errors->has('passport_file') ? ' is-invalid' : '' }}" name="passport_file" value="{{ $profile->passport_file }}" placeholder="Passport File">
                                            @if($profile->passport_file)
                                                <a class="btn btn-sm btn-secondary mt-2" target="_blank" href="{{asset('storage/'.$profile->passport_file)}}">View Passport File</a>
                                            @endif
                                            <p class="text-danger">Supported file format PDF, JPG and PNG. Maximum file size: 1MB</p>
                                            @if ($errors->has('passport_file'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('passport_file') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 pt-5 page-section" id="Other-Files">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="">Other Files</h3>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="medical_certificate">{{ __('Medical Certificate') }}</label>
                                            <input id="medical_certificate" type="file" class="form-control-file{{ $errors->has('medical_certificate') ? ' is-invalid' : '' }}" name="medical_certificate" value="{{ $profile->medical_certificate }}" placeholder="Medical Certificate">
                                            @if($profile->medical_certificate)
                                                <a class="btn btn-sm btn-secondary mt-2" target="_blank" href="{{asset('storage/'.$profile->medical_certificate)}}">View Medical Certificate</a>
                                            @endif
                                            <p class="text-danger">Supported file format PDF, JPG and PNG. Maximum file size: 1MB</p>
                                            @if ($errors->has('medical_certificate'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('medical_certificate') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="immigration_security_clearence">{{ __('Immigration Security Clearence') }}</label>
                                            <input id="immigration_security_clearence" type="file" class="form-control-file{{ $errors->has('immigration_security_clearence') ? ' is-invalid' : '' }}" name="immigration_security_clearence" value="{{ $profile->immigration_security_clearence }}" placeholder="Immigration Security Clearence">
                                            @if($profile->immigration_security_clearence)
                                                <a class="btn btn-sm btn-secondary mt-2" target="_blank" href="{{asset('storage/'.$profile->immigration_security_clearence)}}">View Immigration Security Clearence</a>
                                            @endif
                                            <p class="text-danger">Supported file format PDF, JPG and PNG. Maximum file size: 1MB</p>
                                            @if ($errors->has('immigration_security_clearence'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('immigration_security_clearence') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 pt-5 page-section" id="Languages">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="">Languages</h3>
                                    </div>
                                    @if($language_set)
                                    @foreach($skills as $skill)
                                        @if ( $skill->for == $skill_for && $skill->type == 'Language')
                                            <div class="col-md-6">
                                                <div class="form-group" style="display:flex;">
                                                    @php
                                                        if(isset($language_set[$skill->slug])){
                                                            $checked = $language_set[$skill->slug] == 'Yes'?  'checked': '';
                                                        }else{
                                                            $checked = '';
                                                        }
                                                    @endphp
                                                    <input style="height:30px;width:30px;" type="checkbox" id="" name="{{ $skill->slug }}" {{$checked}} value="Yes">
                                                    <label style="padding-top: 3px;padding-left: 5px;" for="able_to_cook">{{ $skill->name }}</label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 pt-5 page-section" id="Skills">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="">Skills</h3>
                                    </div>
                                    @if($skill_set)
                                    @foreach($skills as $skill)
                                        @if ( $skill->for == $skill_for && $skill->type == 'Skill')
                                            <div class="col-md-6">
                                                <div class="form-group" style="display:flex;">
                                                    @php
                                                        if(isset($skill_set[$skill->slug])){
                                                            $checked = $skill_set[$skill->slug] == 'Yes'?  'checked': '';
                                                        }else{
                                                            $checked = '';
                                                        }
                                                    @endphp
                                                    <input style="height:30px;width:30px;" type="checkbox" id="" name="{{ $skill->slug }}" {{$checked}} value="Yes">
                                                    <label style="padding-top: 3px;padding-left: 5px;" for="able_to_cook">{{ $skill->name }}</label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    @endif
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="other_skills">{{ __('Other Skills (Seperate with Comma)') }}</label>
                                            <input id="other_skills" type="text" class="form-control{{ $errors->has('other_skills') ? ' is-invalid' : '' }}" name="other_skills" value="{{ $profile->other_skills }}" placeholder="Other Skills">
                
                                            @if ($errors->has('other_skills'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('other_skills') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 pt-5 page-section" id="Experience">
                                <h3 class="">Experience</h3>
                                @foreach ($user->experiences as $experience)
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="div_id_1_employer_name" class="form-group">
                                            <label for="id_1_employer_name">{{ __('Employer Name') }}</label>
                                            <input id="id_1_employer_name" type="text" class="form-control" name="employer_name[]" placeholder="Employers Name" value="{{$experience->employer_name}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="div_id_1_employer_country" class="form-group">
                                            <label for="id_1_employer_country">{{ __('Employer Country') }}</label>
                                            <select name="country[]" id="id_1_employer_country" class="form-control">
                                                <option value="">--Select Country--</option>
                                                @foreach ($nationalitys as $nationality)
                                                    <option value="{{$nationality->id}}" {{$nationality->id == $experience->country ? 'selected':''}}>{{$nationality->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="div_id_1_from_date" class="form-group">
                                            <label for="id_1_from_date">{{ __('From Date') }}</label>
                                            <input id="id_1_from_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" value="{{$experience->from_date ? \Carbon\Carbon::parse($experience->from_date)->format('Y-m-d') : ''}}" name="from_date[]">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="div_id_1_to_date" class="form-group">
                                            <label for="id_1_to_date">{{ __('To Date') }}</label>
                                            <input id="id_1_to_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" value="{{$experience->to_date ? \Carbon\Carbon::parse($experience->to_date)->format('Y-m-d') : ''}}" name="to_date[]">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="div_id_1_remark" class="form-group">
                                            <label for="id_1_remark">{{ __('Remark') }}</label>
                                            <input id="id_1_remark" type="text" class="form-control" name="remark[]" value="{{$experience->remark}}" placeholder="Remark">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr class="mt-4 mb-4"/>
                                    </div>
                                </div>
                                @endforeach
                                <div id="czContainer">
                                    <div id="first">
                                        <div class="recordset">
                                            <div class="fieldRow clearfix">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div id="div_id_1_employer_name" class="form-group">
                                                            <label for="id_1_employer_name">{{ __('Employer Name') }}</label>
                                                            <input id="id_1_employer_name" type="text" class="form-control" name="employer_name[]" placeholder="Employers Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div id="div_id_1_employer_country" class="form-group">
                                                            <label for="id_1_employer_country">{{ __('Employer Country') }}</label>
                                                            <select name="country[]" id="id_1_employer_country" class="form-control">
                                                                <option value="">--Select Country--</option>
                                                                @foreach ($nationalitys as $nationality)
                                                                    <option value="{{$nationality->id}}" {{$nationality->id == old('nationality') ? 'selected':''}}>{{$nationality->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div id="div_id_1_from_date" class="form-group">
                                                            <label for="id_1_from_date">{{ __('From Date') }}</label>
                                                            <input id="id_1_from_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" name="from_date[]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div id="div_id_1_to_date" class="form-group">
                                                            <label for="id_1_to_date">{{ __('To Date') }}</label>
                                                            <input id="id_1_to_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" name="to_date[]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div id="div_id_1_remark" class="form-group">
                                                            <label for="id_1_remark">{{ __('Remark') }}</label>
                                                            <input id="id_1_remark" type="text" class="form-control" name="remark[]" placeholder="Remark">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr class="mt-4 mb-4"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 pb-5 pt-5 page-section" id="Education">
                                <h3 class="">Education</h3>
                                @foreach ($user->educations as $education)
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="div_id_1_education_level" class="form-group">
                                            <label for="id_1_education_level">{{ __('Education Level') }}</label>
                                            <select name="education_level[]" id="id_1_education_level" class="form-control">
                                                <option value="">--Select Education Level--</option>
                                                @foreach ($education_levels as $education_level)
                                                    <option value="{{$education_level->id}}" {{$education_level->id == $education->education_level ? 'selected':''}}>{{$education_level->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="div_id_1_education_remark" class="form-group">
                                            <label for="id_1_education_remark">{{ __('Education Remark') }}</label>
                                            <input id="id_1_education_remark" type="text" class="form-control" name="education_remark[]" value="{{$education->education_remark}}" placeholder="Education Remark">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr class="mt-4 mb-4"/>
                                    </div>
                                </div>
                                @endforeach
                                <div id="czContainerEducation">
                                    <div id="first">
                                        <div class="recordset">
                                            <div class="fieldRow clearfix">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div id="div_id_1_education_level" class="form-group">
                                                            <label for="id_1_education_level">{{ __('Education Level') }}</label>
                                                            {{-- <input id="id_1_education_level" type="text" class="form-control" name="education_level[]" placeholder="Education Level"> --}}
                                                            <select name="education_level[]" id="id_1_education_level" class="form-control">
                                                                <option value="">--Select Education Level--</option>
                                                                @foreach ($education_levels as $education_level)
                                                                    <option value="{{$education_level->id}}" {{$education_level->id == old('nationality') ? 'selected':''}}>{{$education_level->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div id="div_id_1_education_remark" class="form-group">
                                                            <label for="id_1_education_remark">{{ __('Education Remark') }}</label>
                                                            <input id="id_1_education_remark" type="text" class="form-control" name="education_remark[]" placeholder="Education Remark">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr class="mt-4 mb-4"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 pt-5">
                                <div class="form-group mb-0 text-center">
                                    <button type="submit" class="btn btn-success btn-block">
                                        {{ __('Save Information') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="bottom-menu" style="position:fixed; bottom:0;text-align: center;width: 100%;z-index: 2;padding: 10px 0 5px 0;background: #fff;">
        <a class="btn btn-success btn-danger btn-sm mb-1" href="#General-Info">General Info</a>
        <a class="btn btn-success btn-sm mb-1" href="#Images">Images</a>
        <a class="btn btn-success btn-sm mb-1" href="#Emergency-Contact">Emergency Contact</a>
        <a class="btn btn-success btn-sm mb-1" href="#Passport-Details">Passport Details</a>
        <a class="btn btn-success btn-sm mb-1" href="#Other-Files">Other Files</a>
        <a class="btn btn-success btn-sm mb-1" href="#Languages">Languages</a>
        <a class="btn btn-success btn-sm mb-1" href="#Skills">Skills</a>
        <a class="btn btn-success btn-sm mb-1" href="#Experience">Experience</a>
        <a class="btn btn-success btn-sm mb-1" href="#Education">Education</a>
    </div>
@endsection
@section('script')
    <script>
        $(window).scroll(function() {
        var scrollDistance = $(window).scrollTop();

        // Assign active class to nav links while scolling
        $('.page-section').each(function(i) {
                if ($(this).position().top <= scrollDistance+250) {
                        $('.bottom-menu a.btn-danger').removeClass('btn-danger');
                        $('.bottom-menu a').eq(i).addClass('btn-danger');
                }
        });
    }).scroll();
    </script>
    <script>
        function previewFile(preview, source) {
            var preview = document.querySelector(preview);
            var file    = document.querySelector(source).files[0];
            var reader  = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
            console.log(preview.src);
        }
    </script>
    <script>
    (function ($, undefined) {
    $.fn.czMore = function (options) {

        //Set defauls for the control
        var defaults = {
            max: 5,
            min: 0,
            onLoad: null,
            onAdd: null,
            onDelete: null,
            styleOverride: false,
        };
        //Update unset options with defaults if needed
        var options = $.extend(defaults, options);
        $(this).bind("onAdd", function (event, data) {
            options.onAdd.call(event, data);
        });
        $(this).bind("onLoad", function (event, data) {
            options.onLoad.call(event, data);
        });
        $(this).bind("onDelete", function (event, data) {
            options.onDelete.call(event, data);
        });
        //Executing functionality on all selected elements
        return this.each(function () {
            var obj = $(this);
            var i = obj.children(".recordset").length;
            var divPlus = '<div id="btnPlus" class="btnPlus"/>';
            var count = '<input id="' + this.id + '_czMore_txtCount" name="' + this.id + '_czMore_txtCount" type="hidden" value="0" size="5" />';

            obj.before(count);
            var recordset = obj.children("#first");
            obj.after(divPlus);
            var set = recordset.children(".recordset").children().first();
            var btnPlus = obj.siblings("#btnPlus");

            if(!options.styleOverride) {
              btnPlus.css({
                  'border': '0px',
                  'background-image': 'url("/images/add.png")',
                  'background-position': 'center center',
                  'background-repeat': 'no-repeat',
                  'height': '25px',
                  'width': '25px',
                  'cursor': 'pointer',
              });
            }

            if (recordset.length) {
                obj.siblings("#btnPlus").click(function () {
                    var i = obj.children(".recordset").length;
                    var item = recordset.clone().html();
                    i++;
                    item = item.replace(/\[([0-9]\d{0})\]/g, "[" + i + "]");
                    item = item.replace(/\_([0-9]\d{0})\_/g, "_" + i + "_");
                    //$(element).html(item);
                    //item = $(item).children().first();
                    //item = $(item).parent();

                    obj.append(item);
                    loadMinus(obj.children().last());
                    minusClick(obj.children().last());
                    if (options.onAdd != null) {
                        obj.trigger("onAdd", i);
                    }

                    obj.siblings("input[name$='czMore_txtCount']").val(i);
                    return false;
                });
                recordset.remove();
                for (var j = 0; j <= i; j++) {
                    loadMinus(obj.children()[j]);
                    minusClick(obj.children()[j]);
                    if (options.onAdd != null) {
                        obj.trigger("onAdd", j);
                    }
                }

                if (options.onLoad != null) {
                    obj.trigger("onLoad", i);
                }
                //obj.bind("onAdd", function (event, data) {
                //If you had passed anything in your trigger function, you can grab it using the second parameter in the callback function.
                //});
            }

            function resetNumbering() {
                $(obj).children(".recordset").each(function (index, element) {
                   $(element).find('input:text, input:password, input:file, select, textarea').each(function(){
                        old_name = this.name;
                        new_name = old_name.replace(/\_([0-9]\d{0})\_/g, "_" + (index + 1) + "_");
                        this.id = this.name = new_name;
                        //alert(this.name);
                    });
                    index++
                    minusClick(element);
                });
            }

            function loadMinus(recordset) {
                var divMinus = '<div id="btnMinus" class="btnMinus" />';
                $(recordset).children().first().before(divMinus);
                var btnMinus = $(recordset).children("#btnMinus");
                if(!options.styleOverride) {
                  btnMinus.css({
                      'float': 'right',
                      'border': '0px',
                      'background-image': 'url("/images/remove.png")',
                      'background-position': 'center center',
                      'background-repeat': 'no-repeat',
                      'height': '25px',
                      'width': '25px',
                      'cursor': 'poitnter',
                  });
              }
            }

            function minusClick(recordset) {
                $(recordset).children("#btnMinus").click(function () {
                    var i = obj.children(".recordset").length;
                    var id = $(recordset).attr("data-id")
                    $(recordset).remove();
                    resetNumbering();
                    obj.siblings("input[name$='czMore_txtCount']").val(obj.children(".recordset").length);
                    i--;
                    if (options.onDelete != null) {
                        if (id != null)
                            obj.trigger("onDelete", id);
                    }
                });
            }
        });
    };
})(jQuery);

    </script>
    <script>
        $('#sector').on('change', function() {
            //console.log( this.value );
            $('#sub_sector').empty()
            $.ajax({
                url: '/admin/getSubsectors/'+this.value,
                success: data => {
                    x =  data.sub_sectors;
                    if(x.length < 1){
                        $('#sub_sector').append('<option value="">--No Sub Sector for this sector--</option>')
                    }else{
                        $('#sub_sector').append('<option value="">--Select Sub Sector--</option>');
                    }
                    
                    data.sub_sectors.forEach(sub_sector =>
                        $('#sub_sector').append('<option value="'+sub_sector.id + '">' + sub_sector.name + '</option>')
                    )
                }
            })
        });
    </script>
    <script type="text/javascript">
        //One-to-many relationship plugin by Yasir O. Atabani. Copyrights Reserved.
        $("#czContainer").czMore();
        $("#czContainerEducation").czMore();
    </script>
@endsection