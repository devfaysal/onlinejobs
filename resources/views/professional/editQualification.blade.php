@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-dark">
        <div class="col-12">
            <h4 class="text-center text-white pb-3 pt-4"><span class="mr-3 text-muted">Personal</span> <span class="mr-3">Education</span><span class="mr-3 text-muted">Experience</span></h4>
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card auth-form mb-5">
                <div class="card-body">
                    <form method="POST" action="{{ route('qualification.update', $user->id) }}">
                        @csrf
                        @method('PATCH')
                        @if(count($user->qualifications)>0)
                            @foreach ($user->qualifications as $qualification)
                            <div class="col-md-11">
                                <div class="form-group row">
                                    <label for="university" class="col-sm-4 col-form-label text-right">{{ __('Institute/University *') }}</label>
                                    <div class="col-sm-8">
                                        <input id="university" type="text" class="form-control{{ $errors->has('university') ? ' is-invalid' : '' }}" name="university[]" value="{{ $qualification->university }}" placeholder="Institute/University" required>
        
                                    @if ($errors->has('university'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('university') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="passing_year" class="col-sm-4 col-form-label text-right">{{ __('Graduation Date *') }}</label>
                                    <div class="col-sm-8">
                                        <input id="passing_year" type="number" min="1900" class="form-control{{ $errors->has('passing_year') ? ' is-invalid' : '' }}" name="passing_year[]" value="{{ $qualification->passing_year }}" placeholder="Graduation Date" required>
        
                                    @if ($errors->has('passing_year'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('passing_year') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="qualification" class="col-sm-4 col-form-label text-right">{{ __('Qualification *') }}</label>
                                    <div class="col-sm-8">
                                        <input id="qualification" type="text" class="form-control{{ $errors->has('qualification') ? ' is-invalid' : '' }}" name="qualification[]" value="{{ $qualification->qualification }}" placeholder="Qualification" required>
        
                                    @if ($errors->has('qualification'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('qualification') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="subject" class="col-sm-4 col-form-label text-right">{{ __('Field of Study *') }}</label>
                                    <div class="col-sm-8">
                                        <input id="subject" type="text" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject[]" value="{{ $qualification->subject }}" placeholder="Field of Study" required>
        
                                    @if ($errors->has('subject'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="specialization" class="col-sm-4 col-form-label text-right">{{ __('Specialization *') }}</label>
                                    <div class="col-sm-8">
                                        <input id="specialization" type="text" class="form-control{{ $errors->has('specialization') ? ' is-invalid' : '' }}" name="specialization[]" value="{{ $qualification->specialization }}" placeholder="Specialization" required>
        
                                    @if ($errors->has('specialization'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('specialization') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr class="mt-4 mb-4"/>
                            </div>
                            @endforeach
                        @else
                        <div class="col-md-11">
                            <div class="form-group row">
                                <label for="university" class="col-sm-4 col-form-label text-right">{{ __('Institute/University *') }}</label>
                                <div class="col-sm-8">
                                    <input id="university" type="text" class="form-control{{ $errors->has('university') ? ' is-invalid' : '' }}" name="university[]" value="{{ old('university') }}" placeholder="Institute/University" required>
    
                                @if ($errors->has('university'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('university') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="passing_year" class="col-sm-4 col-form-label text-right">{{ __('Graduation Date *') }}</label>
                                <div class="col-sm-8">
                                    <input id="passing_year" type="number" min="1900" class="form-control{{ $errors->has('passing_year') ? ' is-invalid' : '' }}" name="passing_year[]" value="{{ old('passing_year') }}" placeholder="Graduation Date" required>
    
                                @if ($errors->has('passing_year'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('passing_year') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="qualification" class="col-sm-4 col-form-label text-right">{{ __('Qualification *') }}</label>
                                <div class="col-sm-8">
                                    <input id="qualification" type="text" class="form-control{{ $errors->has('qualification') ? ' is-invalid' : '' }}" name="qualification[]" value="{{ old('qualification') }}" placeholder="Qualification" required>
    
                                @if ($errors->has('qualification'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('qualification') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="subject" class="col-sm-4 col-form-label text-right">{{ __('Field of Study *') }}</label>
                                <div class="col-sm-8">
                                    <input id="subject" type="text" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject[]" value="{{ old('subject') }}" placeholder="Field of Study" required>
    
                                @if ($errors->has('subject'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="specialization" class="col-sm-4 col-form-label text-right">{{ __('Specialization *') }}</label>
                                <div class="col-sm-8">
                                    <input id="specialization" type="text" class="form-control{{ $errors->has('specialization') ? ' is-invalid' : '' }}" name="specialization[]" value="{{ old('specialization') }}" placeholder="Specialization" required>
    
                                @if ($errors->has('specialization'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('specialization') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr class="mt-4 mb-4"/>
                        </div>
                        @endif
                        
                        <div id="czContainerEducation">
                            <div id="first">
                                <div class="recordset">
                                    <div class="fieldRow clearfix">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label for="university" class="col-sm-4 col-form-label text-right">{{ __('Institute/University *') }}</label>
                                                    <div class="col-sm-8">
                                                        <input id="university" type="text" class="form-control{{ $errors->has('university') ? ' is-invalid' : '' }}" name="university[]" value="{{ old('university') }}" placeholder="Institute/University" required>
                        
                                                    @if ($errors->has('university'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('university') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="passing_year" class="col-sm-4 col-form-label text-right">{{ __('Graduation Date *') }}</label>
                                                    <div class="col-sm-8">
                                                        <input id="passing_year" type="number" min="1900" class="form-control{{ $errors->has('passing_year') ? ' is-invalid' : '' }}" name="passing_year[]" value="{{ old('passing_year') }}" placeholder="Graduation Date" required>
                        
                                                    @if ($errors->has('passing_year'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('passing_year') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="qualification" class="col-sm-4 col-form-label text-right">{{ __('Qualification *') }}</label>
                                                    <div class="col-sm-8">
                                                        <input id="qualification" type="text" class="form-control{{ $errors->has('qualification') ? ' is-invalid' : '' }}" name="qualification[]" value="{{ old('qualification') }}" placeholder="Qualification" required>
                        
                                                    @if ($errors->has('qualification'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('qualification') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="subject" class="col-sm-4 col-form-label text-right">{{ __('Field of Study *') }}</label>
                                                    <div class="col-sm-8">
                                                        <input id="subject" type="text" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject[]" value="{{ old('subject') }}" placeholder="Field of Study" required>
                        
                                                    @if ($errors->has('subject'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('subject') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="specialization" class="col-sm-4 col-form-label text-right">{{ __('Specialization *') }}</label>
                                                    <div class="col-sm-8">
                                                        <input id="specialization" type="text" class="form-control{{ $errors->has('specialization') ? ' is-invalid' : '' }}" name="specialization[]" value="{{ old('specialization') }}" placeholder="Specialization" required>
                        
                                                    @if ($errors->has('specialization'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('specialization') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
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
                        <div class="form-group mb-0 mt-3">
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
@section('script')
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
            var divPlus = '<div id="btnPlus" class="btnPlus">Add more education</div>';
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
                  //'background-position': 'center center',
                  'background-repeat': 'no-repeat',
                  'height': '25px',
                  'padding-left': '25px',
                  'cursor': 'pointer',
                  'margin-left': '220px'
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
    <script type="text/javascript">
        //One-to-many relationship plugin by Yasir O. Atabani. Copyrights Reserved.
        $("#czContainer").czMore();
        $("#czContainerEducation").czMore();
    </script>
@endsection