<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> {{ config('app.name', 'Laravel') }} </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Styles -->
        <link href="{{ asset('admin-assets/css/vendor.css') }}" rel="stylesheet">
        <link href="{{ asset('admin-assets/css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
        <style>
            tfoot {
                display: table-header-group;
            }
            table.dataTable tfoot th, table.dataTable tfoot td{
                padding: 10px 18px 6px 0;
            }
        </style>
        <!-- Custom Styles -->
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        
        <!-- Theme initialization -->
        {{-- <script>
            var themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
            {};
            var themeName = themeSettings.themeName || '';
            if (themeName)
            {
                document.write('<link rel="stylesheet" id="theme-style" href="http://jobnetwork.testa/admin-assets/css/app-' + themeName + '.css">');
            }
            else
            {
                document.write('<link rel="stylesheet" id="theme-style" href="http://jobnetwork.test/admin-assets/css/app.css">');
            }
        </script> --}}
    </head>
    <body>
        <div class="main-wrapper">
            <div class="app" id="app">
                <header class="header bg-white">
                    <div class="header-block header-block-collapse d-lg-none d-xl-none">
                        <button class="collapse-btn" id="sidebar-collapse-btn">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <div class="header-block header-block-search">
                        {{-- <form role="search">
                            <div class="input-container">
                                <i class="fa fa-search"></i>
                                <input type="search" placeholder="Search">
                                <div class="underline"></div>
                            </div>
                        </form> --}}
                    </div>
                    <div class="header-block header-block-buttons">
                        <h1 class="text-center">Online Jobs @if(Auth::user()->hasRole('agent')) Agent @else Admin @endif</h1>
                    </div>
                    <div class="header-block header-block-nav">
                        <ul class="nav-profile">
                            <li class="notifications new">
                                <a href="" data-toggle="dropdown">
                                    <i class="fa fa-commenting fa-2x text-danger"></i>
                                    <sup>
                                        <span class="counter text-warning">
                                            {{Auth::user()->unreadNotifications->count()}}
                                        </span>
                                    </sup>
                                </a>
                                <div class="dropdown-menu notifications-dropdown-menu">
                                    <ul class="notifications-container">
                                        @if(Auth::user()->unreadNotifications->count() > 0)
                                        @foreach (Auth::user()->unreadNotifications as $notification)
                                            <li>
                                                <a href="{{route('admin.readSingleNotification',$notification->id)}}" class="notification-item">
                                                    <div class="body-col">
                                                        <p><span class="accent">{{$notification->data['message']}}</span></p>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                        @else 
                                            <li>
                                                <a href="" class="notification-item">
                                                    <div class="body-col">
                                                        <p><span class="accent">No new Notification!!</span></p>
                                                    </div>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                    <footer>
                                        <ul>
                                            <li>
                                                <a href="{{route('admin.showAllNotification')}}"> View All </a>
                                            </li>
                                        </ul>
                                    </footer>
                                </div>
                            </li>
                            <li class="profile dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <div class="img" style="background-image: url('https://avatars3.githubusercontent.com/u/3959008?v=3&s=40')"> </div>
                                    @auth
                                    <span class="name"> {{Auth::user()->name}} </span>
                                    @endauth
                                </a>
                                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                                    @if(Auth::user()->hasRole('agent'))
                                    <a class="dropdown-item" href="{{route('agent.edit', Auth::user()->id)}}">
                                        <i class="fa fa-user icon"></i>Edit Profile </a>
                                    @endif
                                    {{-- <a class="dropdown-item" href="#">
                                        <i class="fa fa-bell icon"></i> Notifications </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fa fa-gear icon"></i> Settings </a> --}}
                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off icon"></i>{{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </header>
                <aside class="sidebar">
                    <div class="sidebar-container">
                        <div class="sidebar-header bg-white">
                            <div class="brand">
                                <img src="{{asset('images/onlinejobs-logo.png')}}" alt="">
                                {{-- <div class="logo">
                                    <span class="l l1"></span>
                                    <span class="l l2"></span>
                                    <span class="l l3"></span>
                                    <span class="l l4"></span>
                                    <span class="l l5"></span>
                                </div> Online Jobs Admin  --}}
                            </div>
                        </div>
                        <nav class="menu">
                            <ul class="sidebar-menu metismenu" id="sidebar-menu">
                                <li class="{{ ( (Route::currentRouteName() === "admin.home") ? "active" : "") }}">
                                    <a href="/admin">
                                        <i class="fa fa-home"></i> Dashboard </a>
                                </li>
                                @if(Auth::user()->hasRole('superadministrator'))
                                <li class="{{ ( (Route::currentRouteName() === "admin.employer.index") || (Route::currentRouteName() === "admin.employerApplication") || (Route::currentRouteName() === "admin.employerDemands") ? "active open" : "") }}">
                                    <a href="">
                                        <i class="fa fa-users"></i> Employers
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li class="{{ ( (Route::currentRouteName() === "admin.employer.index") ? "active" : "" ) }}">
                                            <a href="{{route('admin.employer.index')}}"> Active Employers </a>
                                        </li>
                                        <li class="{{ ( (Route::currentRouteName() === "admin.employerApplication") ? "active" : "" ) }}">
                                            <a href="{{route('admin.employerApplication')}}"> Employer Apllications </a>
                                        </li>
                                        <li class="{{ ( (Route::currentRouteName() === "admin.employerDemands") ? "active" : "" ) }}">
                                            <a href="{{route('admin.employerDemands')}}"> Employer Demands </a>
                                        </li>
                                    </ul>
                                </li>
                                
                                <li class="{{ ( (Route::currentRouteName() === "admin.agent.index") || (Route::currentRouteName() === "admin.agentApplication") || (Route::currentRouteName() === "admin.rejectedAgentApplication") ? "active open" : "") }}">
                                    <a href="">
                                        <i class="fa fa-users"></i> Agents
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li class="{{ ( (Route::currentRouteName() === "admin.agent.index") ? "active" : "") }}">
                                            <a href="{{route('admin.agent.index')}}"> Active Agents </a>
                                        </li>
                                        <li class="{{ ( (Route::currentRouteName() === "admin.agentApplication") ? "active" : "") }}">
                                            <a href="{{route('admin.agentApplication')}}"> Agent Apllications </a>
                                        </li>
                                        <li class="{{ ( (Route::currentRouteName() === "admin.rejectedAgentApplication") ? "active" : "") }}">
                                            <a href="{{route('admin.rejectedAgentApplication')}}">Pending Apllications </a>
                                        </li>
                                    </ul>
                                </li>
                                @endif
                                <li class="{{ ( (Route::currentRouteName() === "admin.worker.index") ? "active" : "") }}">
                                    <a href="{{route('admin.worker.index')}}">
                                        <i class="fa fa-pencil-square-o"></i> General Workers </a>
                                </li>
                                <li class="{{ ( (Route::currentRouteName() === "admin.maid.index") ? "active" : "") }}">
                                    <a href="{{route('admin.maid.index')}}">
                                        <i class="fa fa-pencil-square-o"></i> Domestic Maids </a>
                                </li>
                                @if(Auth::user()->hasRole('agent'))
                                <li class="{{ ( (Route::currentRouteName() === "admin.employerDemands") ? "active" : "") }}">
                                    <a href="{{route('admin.employerDemands')}}">
                                        <i class="fa fa-pencil-square-o"></i> Employer Demands </a>
                                </li>
                                <li class="{{ ( (Route::currentRouteName() === "admin.downloadFiles") ? "active" : "") }}">
                                    <a href="{{route('admin.downloadFiles')}}">
                                        <i class="fa fa-download"></i> Download Files </a>
                                </li>
                                @endif

                                @if(Auth::user()->hasRole('superadministrator'))
                                <li class="{{ ( (Route::currentRouteName() === "admin.country.index") || (Route::currentRouteName() === "admin.religion.index") || (Route::currentRouteName() === "admin.language.index") || (Route::currentRouteName() === "admin.gender.index") || (Route::currentRouteName() === "admin.maritalStatus.index") || (Route::currentRouteName() === "admin.skillLevel.index") || (Route::currentRouteName() === "admin.educationLevel.index") || (Route::currentRouteName() === "admin.downloads.index") ? "active open" : "") }}">
                                    <a href="">
                                        <i class="fa fa-users"></i> Settings
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li class="{{ ( (Route::currentRouteName() === "admin.downloads.index") ? "active" : "") }}">
                                            <a href="{{route('admin.downloads.index')}}"> Downloads </a>
                                        </li>
                                        <li class="{{ ( (Route::currentRouteName() === "admin.sector.index") ? "active" : "") }}">
                                            <a href="{{route('admin.sector.index')}}"> Sectors </a>
                                        </li>
                                        <li class="{{ ( (Route::currentRouteName() === "admin.country.index") ? "active" : "") }}">
                                            <a href="{{route('admin.country.index')}}"> Countries </a>
                                        </li>
                                        <li class="{{ ( (Route::currentRouteName() === "admin.religion.index") ? "active" : "") }}">
                                            <a href="{{route('admin.religion.index')}}"> Religions </a>
                                        </li>
                                        <li class="{{ ( (Route::currentRouteName() === "admin.language.index") ? "active" : "") }}">
                                            <a href="{{route('admin.language.index')}}"> Languages </a>
                                        </li>
                                        <li class="{{ ( (Route::currentRouteName() === "admin.gender.index") ? "active" : "") }}">
                                            <a href="{{route('admin.gender.index')}}"> Gender </a>
                                        </li>
                                        <li class="{{ ( (Route::currentRouteName() === "admin.maritalStatus.index") ? "active" : "") }}">
                                            <a href="{{route('admin.maritalStatus.index')}}"> Marital Status </a>
                                        </li>
                                        <li class="{{ ( (Route::currentRouteName() === "admin.skillLevel.index") ? "active" : "") }}">
                                            <a href="{{route('admin.skillLevel.index')}}"> Skill Level </a>
                                        </li>
                                        <li class="{{ ( (Route::currentRouteName() === "admin.skill.index") ? "active" : "") }}">
                                            <a href="{{route('admin.skill.index')}}"> Skill </a>
                                        </li>
                                        <li class="{{ ( (Route::currentRouteName() === "admin.educationLevel.index") ? "active" : "") }}">
                                            <a href="{{route('admin.educationLevel.index')}}"> Education Level </a>
                                        </li>
                                        {{-- <li>
                                            <a href="#"> Employer Apllications </a>
                                        </li> --}}
                                    </ul>
                                </li>
                                @endif
                                {{-- <li>
                                    <a href="forms.html">
                                        <i class="fa fa-pencil-square-o"></i> Forms </a>
                                </li> --}}
                                {{-- <li>
                                    <a href="">
                                        <i class="fa fa-desktop"></i> UI Elements
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="buttons.html"> Buttons </a>
                                        </li>
                                        <li>
                                            <a href="cards.html"> Cards </a>
                                        </li>
                                        <li>
                                            <a href="typography.html"> Typography </a>
                                        </li>
                                        <li>
                                            <a href="icons.html"> Icons </a>
                                        </li>
                                        <li>
                                            <a href="grid.html"> Grid </a>
                                        </li>
                                    </ul>
                                </li> --}}
                                {{-- <li>
                                    <a href="">
                                        <i class="fa fa-file-text-o"></i> Pages
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="login.html"> Login </a>
                                        </li>
                                        <li>
                                            <a href="signup.html"> Sign Up </a>
                                        </li>
                                        <li>
                                            <a href="reset.html"> Reset </a>
                                        </li>
                                        <li>
                                            <a href="error-404.html"> Error 404 App </a>
                                        </li>
                                        <li>
                                            <a href="error-404-alt.html"> Error 404 Global </a>
                                        </li>
                                        <li>
                                            <a href="error-500.html"> Error 500 App </a>
                                        </li>
                                        <li>
                                            <a href="error-500-alt.html"> Error 500 Global </a>
                                        </li>
                                    </ul>
                                </li> --}}
                                {{-- <li>
                                    <a href="">
                                        <i class="fa fa-sitemap"></i> Menu Levels
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="#"> Second Level Item
                                                <i class="fa arrow"></i>
                                            </a>
                                            <ul class="sidebar-nav">
                                                <li>
                                                    <a href="#"> Third Level Item </a>
                                                </li>
                                                <li>
                                                    <a href="#"> Third Level Item </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#"> Second Level Item </a>
                                        </li>
                                        <li>
                                            <a href="#"> Second Level Item
                                                <i class="fa arrow"></i>
                                            </a>
                                            <ul class="sidebar-nav">
                                                <li>
                                                    <a href="#"> Third Level Item </a>
                                                </li>
                                                <li>
                                                    <a href="#"> Third Level Item </a>
                                                </li>
                                                <li>
                                                    <a href="#"> Third Level Item
                                                        <i class="fa arrow"></i>
                                                    </a>
                                                    <ul class="sidebar-nav">
                                                        <li>
                                                            <a href="#"> Fourth Level Item </a>
                                                        </li>
                                                        <li>
                                                            <a href="#"> Fourth Level Item </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li> --}}
                                {{-- <li>
                                    <a href="screenful.html">
                                        <i class="fa fa-bar-chart"></i> Agile Metrics
                                        <span class="label label-screenful">by Screenful</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://github.com/modularcode/modular-admin-html">
                                        <i class="fa fa-github-alt"></i> Theme Docs </a>
                                </li> --}}
                            </ul>
                        </nav>
                    </div>
                    <footer class="sidebar-footer">
                        <ul class="sidebar-menu metismenu" id="customize-menu">
                            <li>
                                <ul>
                                    <li class="customize">
                                        <div class="customize-item">
                                            <div class="row customize-header">
                                                <div class="col-4"> </div>
                                                <div class="col-4">
                                                    <label class="title">fixed</label>
                                                </div>
                                                <div class="col-4">
                                                    <label class="title">static</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label class="title">Sidebar:</label>
                                                </div>
                                                <div class="col-4">
                                                    <label>
                                                        <input class="radio" type="radio" name="sidebarPosition" value="sidebar-fixed">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-4">
                                                    <label>
                                                        <input class="radio" type="radio" name="sidebarPosition" value="">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label class="title">Header:</label>
                                                </div>
                                                <div class="col-4">
                                                    <label>
                                                        <input class="radio" type="radio" name="headerPosition" value="header-fixed">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-4">
                                                    <label>
                                                        <input class="radio" type="radio" name="headerPosition" value="">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label class="title">Footer:</label>
                                                </div>
                                                <div class="col-4">
                                                    <label>
                                                        <input class="radio" type="radio" name="footerPosition" value="footer-fixed">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-4">
                                                    <label>
                                                        <input class="radio" type="radio" name="footerPosition" value="">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="customize-item">
                                            <ul class="customize-colors">
                                                <li>
                                                    <span class="color-item color-red" data-theme="red"></span>
                                                </li>
                                                <li>
                                                    <span class="color-item color-orange" data-theme="orange"></span>
                                                </li>
                                                <li>
                                                    <span class="color-item color-green active" data-theme=""></span>
                                                </li>
                                                <li>
                                                    <span class="color-item color-seagreen" data-theme="seagreen"></span>
                                                </li>
                                                <li>
                                                    <span class="color-item color-blue" data-theme="blue"></span>
                                                </li>
                                                <li>
                                                    <span class="color-item color-purple" data-theme="purple"></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                                <a href="">
                                    <i class="fa fa-cog"></i> Customize </a>
                            </li>
                        </ul>
                    </footer>
                </aside>
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
                <div class="mobile-menu-handle"></div>
                
                <article class="content dashboard-page">
                    @if(Session::has('message'))
                    <section>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                                    <strong>{{ Session::get('message') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @yield('content')
                </article>
                
                <footer class="footer">
                    
                    <div class="footer-block buttons">
                        
                    </div>
                    <div class="footer-block author">
                        <p>Online Jobs</p>
                    </div>
                </footer>
                <div class="modal fade" id="modal-media">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Media Library</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                            </div>
                            <div class="modal-body modal-tab-container">
                                <ul class="nav nav-tabs modal-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#gallery" data-toggle="tab" role="tab">Gallery</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#upload" data-toggle="tab" role="tab">Upload</a>
                                    </li>
                                </ul>
                                <div class="tab-content modal-tab-content">
                                    <div class="tab-pane fade" id="gallery" role="tabpanel">
                                        <div class="images-container">
                                            <div class="row"> </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade active in" id="upload" role="tabpanel">
                                        <div class="upload-container">
                                            <div id="dropzone">
                                                <form action="/" method="POST" enctype="multipart/form-data" class="dropzone needsclick dz-clickable" id="demo-upload">
                                                    <div class="dz-message-block">
                                                        <div class="dz-message needsclick"> Drop files here or click to upload. </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Insert Selected</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <div class="modal fade" id="confirm-modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">
                                    <i class="fa fa-warning"></i> Alert</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure want to do this?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </div>
        </div>
        <!-- Reference block for JS -->
        <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>
        <script src="{{asset('admin-assets/js/vendor.js')}}"></script>
        <script src="{{asset('admin-assets/js/app.js')}}"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

        @yield('javascript')
    </body>
</html>