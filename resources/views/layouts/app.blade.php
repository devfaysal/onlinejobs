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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow">
        <div class="container">
            <a class="navbar-brand" href="{{route('home')}}"> <img src="{{asset('images/onlinejobs-logo.png')}}" class="img-fluid"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Jobs <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Employer
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('agent.create')}}">Agent Registration</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Organizations
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('maids')}}">Domestic Maids</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('workers')}}">General Workers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Employers Area</a>
                    </li>
                    
                </ul>
                <ul class="navbar-nav ml-auto">
                    @guest                               
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#loginModal" href="#"> Login </a> 
                    </li>
                    @endguest
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welcome
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Logged in as {{Auth::user()->name}}</a>

                            @if(Auth::user()->hasRole(['maid', 'worker']) )
                                <a class="dropdown-item" href="{{route('profile.index')}}">Profile</a>
                            @endif
                            @if(Auth::user()->hasRole('agent') )
                                <a class="dropdown-item" href="{{route('agent.index')}}">Profile</a>
                            @endif

                            <a class="dropdown-item" href="#">Change Password</a>
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
                <!-- Login Modal -->
                <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content tex-center">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="exampleModalLongTitle"> Login </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center iim">
                                <div class="row justify-content-md-center">
                                    <div class="col-md-8">
                                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-mail Address" required>
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                    
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    
                                                    <label class="form-check-label" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                                </div>
                                            </div>
                    
                                            <div class="form-group mb-0 text-center">
                                                <button type="submit" class="btn btn-warning btn-block">
                                                    {{ __('Login') }}
                                                </button>
                    
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            </div>
                                            <div class="newuser text-center"><i class="fa fa-user" aria-hidden="true"></i> New User? <a href="{{route('register')}}">Register Here</a></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--  /.modal-dialog modal-dialog-centered  -->
                </div><!--  /.modal fade  -->
                <!-- /.Login Modal -->
            </div>
        </div>
    </nav>

    <main>
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

    <section class="footer_middle tex-center hidefromprint"> 
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12">
                    Partner Sites 
                    <div id="blogCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#blogCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#blogCarousel" data-slide-to="1"></li>
                        </ol>
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-md-3">
                                        <a href="#">
                                            <img src="{{asset('images/slider/1.jpg')}}" alt="Image">
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="#">
                                            <img src="{{asset('images/slider/2.jpg')}}" alt="Image"  >
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="#">
                                            <img src="{{asset('images/slider/3.jpg')}}" alt="Image"  >
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="#">
                                            <img src="{{asset('images/slider/4.jpg')}}" alt="Image" >
                                        </a>
                                    </div>
                                </div>
                                <!--.row-->
                            </div>
                            <!--.item-->
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-3">
                                        <a href="#">
                                            <img src="{{asset('images/slider/5.jpg')}}" alt="Image"  >
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="#">
                                            <img src="{{asset('images/slider/6.jpg')}}" alt="Image"  >
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="#">
                                            <img src="{{asset('images/slider/7.jpg')}}" alt="Image"  >
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="#">
                                            <img src="{{asset('images/slider/8.jpg')}}" alt="Image" >
                                        </a>
                                    </div>
                                </div>
                                <!--.row-->
                            </div>
                            <!--.item-->
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-3">
                                        <a href="#">
                                            <img src="{{asset('images/slider/9.jpg')}}" alt="Image" >
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="#">
                                            <img src="{{asset('images/slider/10.jpg')}}" alt="Image" >
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="#">
                                            <img src="{{asset('images/slider/11.jpg')}}" alt="Image" >
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="#">
                                            <img src="{{asset('images/slider/12.jpg')}}" alt="Image" >
                                        </a>
                                    </div>
                                </div>
                                <!--.row-->
                            </div>
                            <!--.item-->
                        </div>
                        <!--.carousel-inner-->
                    </div>
                    <!--.Carousel-->
                </div>
            </div>
        </div>
    </section>
    <section class="footer_bottom hidefromprint"> 
        <div class="container tex-center">
            <div class="row">
                <div class="col-md-12">
                    <div align="center"> All rights reserved @ 2018 </div> 
                </div>
            </div>
        </div>
    </section>

    <a href="#" class="scrollup">Scroll</a>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    @yield('script')
</body>
</html>