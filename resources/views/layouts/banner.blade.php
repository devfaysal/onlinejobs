<section class="banner">
        <div class="top_bar">
            <div class="container">
                <div class="row">
                    <nav class="nav nav-pills nav-fill">
                        <a class="nav-item nav-link" href="#">All jobs</a>
                        <a class="nav-item nav-link" href="#">IIT/IIM Jobs</a>
                        <a class="nav-item nav-link" href="#">Govt. Jobs</a>
                        <a class="nav-item nav-link" href="#">International jobs</a>
                        <a class="nav-item nav-link" href="#">Walk in jobs </a>
                    </nav>
                </div><!--  /.row  -->
            </div><!--  /.container  -->
        </div><!--  /.top_bar  -->

        <!--  banner body and search   -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-3 text-primary text-capitalize text-center">
                        @if (Route::currentRouteName() == 'maids' || Route::currentRouteName() == 'maids.search')
                            Domestic Maids
                        @elseif(Route::currentRouteName() == 'workers' || Route::currentRouteName() == 'workers.search')
                            General Workers
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
                                        <option value="">--Religion--</option>
                                        @foreach ($religions as $religion)
                                            <option value="{{$religion->id}}">{{$religion->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label class="sr-only" for="native_language">Language</label>
                                    <select name="native_language" id="native_language" class="form-control">
                                        <option value="">--Language--</option>
                                        @foreach ($languages as $language)
                                            <option value="{{$language->id}}" >{{$language->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label class="sr-only" for="nationality">Nationality</label>
                                    <select name="nationality" id="nationality" class="form-control">
                                        <option value="">--Nationality--</option>
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