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
                                            <option value="{{$religion->id}}">{{$religion->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label class="sr-only" for="native_language">Language</label>
                                    <select name="native_language" id="native_language" class="form-control">
                                        <option value="">-- Language --</option>
                                        @foreach ($languages as $language)
                                            <option value="{{$language->id}}" >{{$language->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label class="sr-only" for="nationality">Nationality</label>
                                    <select name="nationality" id="nationality" class="form-control">
                                        <option value="">-- Nationality --</option>
                                        @foreach ($nationalitys as $nationality)
                                            <option value="{{$nationality->id}}" >{{$nationality->name}}</option>
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