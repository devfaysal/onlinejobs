<section class="banner" style="min-height: 220px;">

        @include('layouts.topbar')

        <!--  banner body and search   -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-3 text-primary text-uppercase text-center" style="border-bottom: 1px solid;">
                        @if (Route::currentRouteName() == 'maids' || Route::currentRouteName() == 'maids.search')
                            Domestic Maids
                            <span class="pull-right"><small style="font-size: 14px;">Registered:</small> <span class="counter">{{$total_maids}}</span></span>
                        @elseif(Route::currentRouteName() == 'workers' || Route::currentRouteName() == 'workers.search')
                            General Workers
                            <span class="pull-right"><small style="font-size: 14px;">Registered:</small> <span class="counter">{{$total_workers}}</span></span>
                        @endif
                    </h1>
                </div>
                <div class="col-md-12">
                    <div class="banner_tranparent">
                        <form method="POST" action="{{route($page.'.search')}}">
                            @csrf
                            <div class="form-row justify-content-center">
                                <div class="col-3">
                                    <label class="sr-only" for="religion">Religion</label>
                                    <select name="religion" id="religion" class="form-control">
                                        <option value="">-- Religion --</option>
                                        @foreach ($religions as $religion)
                                            <option value="{{$religion->id}}" @if(isset($request->religion) && $request->religion==$religion->id){{"selected"}} @endif >{{$religion->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label class="sr-only" for="age_term">Age</label>
                                    <select name="age_term" id="age_term" class="form-control" style="width: 49%; display: inline;">
                                        <option value="<" @if(isset($request->age_term) && $request->age_term=="<"){{"selected"}} @endif >Age ></option>
                                        <option value="=" @if(isset($request->age_term) && $request->age_term=="="){{"selected"}} @endif >Age =</option>
                                        <option value=">" @if(isset($request->age_term) && $request->age_term==">"){{"selected"}} @endif >Age <</option>
                                    </select>
                                    <input type="text" class="form-control" name="age_value" value="@if(isset($request->age_value)){{old('age_value', $request->age_value)}}@endif" style="width: 49%; display: inline;">
                                </div>
                                <div class="col-3">
                                    <label class="sr-only" for="nationality">Nationality</label>
                                    <select name="nationality" id="nationality" class="form-control">
                                        <option value="">-- Nationality --</option>
                                        @foreach ($nationalitys as $nationality)
                                            <option value="{{$nationality->id}}" @if(isset($request->nationality) && $request->nationality==$nationality->id){{"selected"}} @endif >{{$nationality->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                <button type="submit" class="btn btn-primary text-capitalize btn-block">Search {{$page}}</button>
                                </div>
                            </div>
                        </form>
                    </div><!--  banner trand end   -->
                </div>
            </div><!--  /.row  -->
        </div><!--  /.container  -->
    </section>