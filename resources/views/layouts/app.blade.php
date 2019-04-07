<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:200,300,400,400i,700,700i" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        /*body{
            padding-top: 45px;
        }*/
        tfoot {
            display: table-header-group;
        }
        table.dataTable tfoot th, table.dataTable tfoot td{
            padding: 10px 18px 6px 0;
        }
        .dataTables_filter{
            display: none;
        }
        .my_datatable tr td:nth-child(1){
            display: none;
        }
        .my_datatable tr th:nth-child(1){
            display: none;
        }
    </style>
    <!-- Custom Styles -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!---Multi Search----->
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet" />

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="{{route('home')}}"> <img src="{{asset('images/onlinejobs-logo.png')}}" class="img-fluid"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Jobs
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @guest
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('login')}}">Register Now</a>
                            @endguest
                            <a class="dropdown-item" href="/job?q=location&c=Malaysia">Jobs by Location</a>
                            <a class="dropdown-item" href="/job?q=skill">Jobs by Skill</a>
                            <a class="dropdown-item" href="/job?q=designation">Jobs by Designation</a>
                            <a class="dropdown-item" href="/job?q=category">Jobs by Category</a>
                            <a class="dropdown-item" href="{{route('job.index')}}">Browse All Jobs</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ ( (Route::currentRouteName() === "agent.create") ? "active" : "") }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Consultants
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @guest
                            <a class="dropdown-item {{ ( (Route::currentRouteName() === "agent.create") ? "active" : "") }}" href="{{route('login')}}">Register Now</a>
                            <div class="dropdown-divider"></div>
                            @endguest
                            <a class="dropdown-item" href="#">Status View</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Employers
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @guest
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('login')}}">Register Now</a>
                            @endguest
                            <a class="dropdown-item" href="#">Browse all companies</a>
                            <a class="dropdown-item" href="#">Employer by location</a>
                            <a class="dropdown-item" href="#">Company review</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ ( (Route::currentRouteName() === "agent.create") ? "active" : "") }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Services
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link {{ ( (Route::currentRouteName() === "workers") || (Route::currentRouteName() === "workers.search") ? "active" : "") }}" href="{{route('workers')}}">General Workers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ ( (Route::currentRouteName() === "maids") || (Route::currentRouteName() === "maids.search") ? "active" : "") }}" href="{{route('maids')}}">Domestic Maids</a>
                    </li>
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Notifications
                            <sup>
                                <span class="counter text-danger">
                                    {{Auth::user()->unreadNotifications->count()}}
                                </span>
                            </sup>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->unreadNotifications->count() > 0)
                                @foreach (Auth::user()->unreadNotifications as $notification)
                                    <a class="dropdown-item" href="{{route('admin.readSingleNotification',$notification->id)}}">
                                        {{$notification->data['message']}}
                                    </a>
                                @endforeach
                            @else 
                                <a href="" class="dropdown-item">
                                    <div class="body-col">
                                        <p><span class="accent">No new Notification!!</span></p>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link " href="#">Notifications</a>
                    </li>
                    @endauth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Packages
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    @guest                               
                    <li class="nav-item">
                        {{-- <a class="nav-link" data-toggle="modal" data-target="#loginModal" href="#"> Login </a>  --}}
                        <a class="nav-link" href="{{route('login')}}"> Login / Register </a> 
                    </li>
                    @endguest
                    @auth
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welcome
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item">Logged in as {{Auth::user()->name}}</a>
                            @if(Auth::user()->hasRole('employer'))
                            <a class="dropdown-item" href="{{route('employer.show')}}">Employers Area</a>
                            <a class="dropdown-item" href="{{route('employer.public', Auth::user()->public_id)}}">View Information</a>
                            <a class="dropdown-item" href="{{route('employer.edit', Auth::user()->id)}}">Edit Information</a>
                            @endif
                            @if(Auth::user()->hasRole(['maid', 'worker']) )
                                <a class="dropdown-item" href="{{route('profile.index')}}">Profile</a>
                            @endif
                            @if(Auth::user()->hasRole('agent') )
                                <a class="dropdown-item" href="{{route('agent.index')}}">Dashboard</a>
                            @endif
                            @if(Auth::user()->hasRole('superadministrator') )
                                <a class="dropdown-item" href="{{route('admin.home')}}">Dashboard</a>
                            @endif
                            @if(Auth::user()->hasRole('professional') )
                                <a class="dropdown-item" href="{{route('professional.profile')}}">Profile</a>
                            @endif
                            @if(Auth::user()->hasRole('retired') )
                                <a class="dropdown-item" href="{{route('retiredPersonnel.profile')}}">Profile</a>
                            @endif

                            <a class="dropdown-item" href="{{route('changePassword')}}">Change Password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>{{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            </form>
                        </div>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <main>
        @if(Session::has('message'))
        <div class="container">
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
        </div>
        @endif
        @yield('content')
    </main>

    <section class="footer_top hidefromprint">
    <div class="container">
      <div class="row">
          <div class="col-md-3 col-sm-6">
            <h6>  Information </h6>
                <ul class="list-unstyled">
                 
                  <li> <a href=""  >About Us</a> </li>
                  <li> <a href="">Terms &amp; Conditions</a> </li>
                  <li> <a href="" >Privacy Policy</a> </li>
                  <li> <a href="" >Careers with Us</a> </li>
                  <li> <a href="" >Sitemap</a> </li>
                  <li> <a href="">Contact Us</a> </li>
                  <li> <a href="">FAQs</a> </li>
                  <li> <a href="" >Summons / Notices</a> </li>
                  <li> <a href="">Grievances</a> </li>
                  <li> <a href="">Fraud Alert</a> </li>
                </ul>
          </div>

          <div class="col-md-3 col-sm-6">
            <h6>  Job seekers </h6>
                <ul class="list-unstyled">
                 
                  <li> <a href=""  >About Us</a> </li>
                  <li> <a href="">Terms &amp; Conditions</a> </li>
                  <li> <a href="" >Privacy Policy</a> </li>
                  <li> <a href="" >Careers with Us</a> </li>
                  <li> <a href="" >Sitemap</a> </li>
                  <li> <a href="">Contact Us</a> </li>
                  <li> <a href="">FAQs</a> </li>
                  <li> <a href="" >Summons / Notices</a> </li>
                  <li> <a href="">Grievances</a> </li>
                  <li> <a href="">Fraud Alert</a> </li>
                </ul>

                 <h6> fast  forward  </h6>
                <ul class="list-unstyled">
                 
                  <li> <a href=""  >About Us</a> </li>
                  <li> <a href="">Terms &amp; Conditions</a> </li>
                  <li> <a href="" >Privacy Policy</a> </li>
                  <li> <a href="" >Careers with Us</a> </li>
                  <li> <a href="" >Sitemap</a> </li>
                </ul> 

          </div>

          <div class="col-md-3 col-sm-6">
            <h6>  Brows Jobs  </h6>
                <ul class="list-unstyled">
                 
                  <li> <a href=""  >About Us</a> </li>
                  <li> <a href="">Terms &amp; Conditions</a> </li>
                  <li> <a href="" >Privacy Policy</a> </li>
                  <li> <a href="" >Careers with Us</a> </li>
                  <li> <a href="" >Sitemap</a> </li>
                  <li> <a href="">Contact Us</a> </li>
                  <li> <a href="">FAQs</a> </li>
                  <li> <a href="" >Summons / Notices</a> </li>
                  <li> <a href="">Grievances</a> </li>
                  <li> <a href="">Fraud Alert</a> </li>
                </ul>
          </div>

          <div class="col-md-3 col-sm-6">
            <h6>  Employers  </h6>
                <ul class="list-unstyled">
                 
                  <li> <a href=""  >About Us</a> </li>
                  <li> <a href="">Terms &amp; Conditions</a> </li>
                  <li> <a href="" >Privacy Policy</a> </li>
                  <li> <a href="" >Careers with Us</a> </li>
                  <li> <a href="" >Sitemap</a> </li>
                  <li> <a href="">Contact Us</a> </li>
                  
                </ul>
                    <section class="social-icons">
                      <p class="hide">Follow Us</p>
                      <a href="fb" data-original-title="Facebook" data-placement="top" data-toggle="tooltip" class="btn-social facebook" target="_blank"><span class="fa fa-facebook"></span></a> 
                      <a href="twitter" data-original-title="Twitter" data-placement="top" data-toggle="tooltip" class="btn-social twitter" target="_blank"><span class="fa fa-twitter"></span></a> 
                      <a href="googleplus" data-original-title="Google+" data-placement="top" data-toggle="tooltip" class="btn-social google-plus" target="_blank"><span class="fa fa-google-plus"></span></a> 
                      <a href="pinterest" data-original-title="Pinterest" data-placement="top" data-toggle="tooltip" class="btn-social instagram" target="_blank"><span class="fa fa-pinterest"></span></a> 
                      <a href="youtube" data-original-title="Youtube" data-placement="top" data-toggle="tooltip" class="btn-social youtube" target="_blank"><span class="fa fa-youtube"></span></a>        
                   </section>

                <h6>  Ambiton box   </h6>
                <ul class="list-unstyled">
                 
                  <li> <a href=""  >About Us</a> </li>
                  <li> <a href="">Terms &amp; Conditions</a> </li>
                  <li> <a href="" >Privacy Policy</a> </li>
                  <li> <a href="" >Careers with Us</a> </li>
                  <li> <a href="" >Sitemap</a> </li>
                  <li> <a href="">Contact Us</a> </li>
                  
                </ul>
          </div>
      </div>
    </div>
    </section>
    <section class="footer_bottom hidefromprint"> 
        <div class="container tex-center">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center"> All rights reserved @ 2019 </div> 
                </div>
            </div>
        </div>
    </section>

    <a href="#" class="scrollup">Scroll</a>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>


    <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
    <!-- WayPoints JS -->
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <!-- Counter UP JS -->
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <!---Multi Search----->
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript">

        $(".js-search-tags").select2({
            tags: true,
          placeholder: "Skills, Designations, Companies"
        });

        $(".js-location-tags").select2({
            tags: true,
          placeholder: "Location/Locality"
        });

    </script>
    <!----Toggle Home page search popup
    <script type="text/javascript">

      $(function() {
      $("#clicksearch").on("click", function(e) {
        $("#search_card").toggleClass("wide");
      });
      $(document).on("click", function(e) {
        if ($(e.target).is("#search_card, #clicksearch") === false) {
          $("#search_card").removeClass("wide");
        }
      });
    });

    </script>
    ---->

    <script type="text/javascript">
      /*----------------------------
      START - Counter Up JS activation
      ------------------------------ */
      $('.counter').counterUp({
          delay: 10,
          time: 1000

      });
    </script>
    @yield('script')
</body>
</html>