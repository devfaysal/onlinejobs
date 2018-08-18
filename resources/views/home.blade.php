@extends('layouts.app')

@section('content')
    <!--banner starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="padding: 0px;">
                @include('layouts.slider')
            </div>
        </div>
    </div>
    <!--banner-ends-->

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="content-left clearfix">
                        <div class="content-left-head clearfix">
                            <h1><span> Hot </span>jobs arround you</h1>
                        </div>
                        <div class="content-left-bottom clearfix">
                            <img src="{{asset('images/content-leftimg.png')}}">
                            <div class="content-left-bottom-1st">
                                <h2>Job Title</h2>
                                <span>Functional Area</span>
                                <p>SB Web Technology stands with you as a professional web partner to boost your business in
                                    the internet world with all efforts, dedicated ....</p>
                                <a href="#"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Full time</a>
                                <a href="#"><span class="glyphicon glyphicon-map-marker location" aria-hidden="true"></span> Location</a>
                            </div><!--/.content-left-bottom-1st-->
                        </div><!--/.content-left-bottom clearfix-->
                        <!--Adv Horizontal Sample-->
                        <div class="adv-hr-wrapper">
                            <img src="{{asset('images/advhr.jpg')}}" />
                        </div><!--/.adv-hr-wrapper-->
                                
                        <!--Tabs for category-->
                        <div class="tabs-section">
                            <div class="content-left-head clearfix">
                                <h1><span> Best Place </span>to work</h1>
                            </div><!--/.content-left-head clearfix-->
                            <ul class="cat-menu">
                                <li>
                                    <a href="#" class="active">All</a>
                                </li>
                                <li>
                                    <a href="#">Services</a>
                                </li>
                                <li>
                                    <a href="#">Information Tech</a>
                                </li>
                                <li>
                                    <a href="#">Media</a>
                                </li>
                            </ul><!--/.cat-menu-->
                            <div class="cat-contents">
                                <!-- <h3>Services</h3> -->
                                <div class="cat-section-wrap">
                                    <div class="lists-wrapp">
                                        <h4 class="title">Agriculture</h4>
                                        <a href="#">Calsoft Labs, An Alten Company</a>
                                        <a href="#">CGI</a>
                                        <a href="#">Cibersites India Private Limited</a>
                                        <a href="#">Clover Infotech</a>
                                        <a href="#">CME India Technology And Support Services Pvt Ltd</a>
                                        <a href="#">DBS Asia Hub 2</a>
                                        <a href="#">DST Worldwide Services India Pvt. Ltd.</a>
                                        <a href="#">Espire Infolabs</a>
                                        <a href="#">GlobalEdge Software</a>
                                        <a href="#">Harman Connected Services Corporation India Pvt. Ltd</a>
                                        <a href="#">Headstrong</a>
                                        <a href="#">Hitachi Consulting</a>
                                        <a href="#">HTC GLOBAL SERVICES</a>
                                    </div><!--/.lists-wrapp-->
                                    <div class="lists-wrapp">
                                        <h4 class="title">Business Finance</h4>
                                        <a href="#">Calsoft Labs, An Alten Company</a>
                                        <a href="#">CGI</a>
                                        <a href="#">Cibersites India Private Limited</a>
                                        <a href="#">Clover Infotech</a>
                                        <a href="#">CME India Technology And Support Services Pvt Ltd</a>
                                        <a href="#">DBS Asia Hub 2</a>
                                        <a href="#">DST Worldwide Services India Pvt. Ltd.</a>
                                        <a href="#">Espire Infolabs</a>
                                        <a href="#">GlobalEdge Software</a>
                                        <a href="#">Harman Connected Services Corporation India Pvt. Ltd</a>
                                        <a href="#">Headstrong</a>
                                        <a href="#">Hitachi Consulting</a>
                                        <a href="#">HTC GLOBAL SERVICES</a>
                                    </div><!--/.lists-wrapp-->
                                    <div class="lists-wrapp">
                                        <h4 class="title">Food Services</h4>
                                        <a href="#">Calsoft Labs, An Alten Company</a>
                                        <a href="#">CGI</a>
                                        <a href="#">Cibersites India Private Limited</a>
                                        <a href="#">Clover Infotech</a>
                                        <a href="#">CME India Technology And Support Services Pvt Ltd</a>
                                        <a href="#">DBS Asia Hub 2</a>
                                        <a href="#">DST Worldwide Services India Pvt. Ltd.</a>
                                        <a href="#">Espire Infolabs</a>
                                        <a href="#">GlobalEdge Software</a>
                                        <a href="#">Harman Connected Services Corporation India Pvt. Ltd</a>
                                        <a href="#">Headstrong</a>
                                        <a href="#">Hitachi Consulting</a>
                                        <a href="#">HTC GLOBAL SERVICES</a>
                                    </div><!--/.lists-wrapp-->
                                    <div class="lists-wrapp">
                                        <h4 class="title">Insurance</h4>
                                        <a href="#">Calsoft Labs, An Alten Company</a>
                                        <a href="#">CGI</a>
                                        <a href="#">Cibersites India Private Limited</a>
                                        <a href="#">Clover Infotech</a>
                                        <a href="#">CME India Technology And Support Services Pvt Ltd</a>
                                        <a href="#">DBS Asia Hub 2</a>
                                        <a href="#">DST Worldwide Services India Pvt. Ltd.</a>
                                        <a href="#">Espire Infolabs</a>
                                        <a href="#">GlobalEdge Software</a>
                                        <a href="#">Harman Connected Services Corporation India Pvt. Ltd</a>
                                        <a href="#">Headstrong</a>
                                        <a href="#">Hitachi Consulting</a>
                                        <a href="#">HTC GLOBAL SERVICES</a>
                                    </div><!--/.lists-wrapp-->
                                    <div class="lists-wrapp">
                                        <h4 class="title">Legal</h4>
                                        <a href="#">Calsoft Labs, An Alten Company</a>
                                        <a href="#">CGI</a>
                                        <a href="#">Cibersites India Private Limited</a>
                                        <a href="#">Clover Infotech</a>
                                        <a href="#">CME India Technology And Support Services Pvt Ltd</a>
                                        <a href="#">DBS Asia Hub 2</a>
                                        <a href="#">DST Worldwide Services India Pvt. Ltd.</a>
                                        <a href="#">Espire Infolabs</a>
                                        <a href="#">GlobalEdge Software</a>
                                        <a href="#">Harman Connected Services Corporation India Pvt. Ltd</a>
                                        <a href="#">Headstrong</a>
                                        <a href="#">Hitachi Consulting</a>
                                        <a href="#">HTC GLOBAL SERVICES</a>
                                    </div><!--/.lists-wrapp-->
                                    <div class="lists-wrapp">
                                        <h4 class="title">Oil & Gas</h4>
                                        <a href="#">Calsoft Labs, An Alten Company</a>
                                        <a href="#">CGI</a>
                                        <a href="#">Cibersites India Private Limited</a>
                                        <a href="#">Clover Infotech</a>
                                        <a href="#">CME India Technology And Support Services Pvt Ltd</a>
                                        <a href="#">DBS Asia Hub 2</a>
                                        <a href="#">DST Worldwide Services India Pvt. Ltd.</a>
                                        <a href="#">Espire Infolabs</a>
                                        <a href="#">GlobalEdge Software</a>
                                        <a href="#">Harman Connected Services Corporation India Pvt. Ltd</a>
                                        <a href="#">Headstrong</a>
                                        <a href="#">Hitachi Consulting</a>
                                        <a href="#">HTC GLOBAL SERVICES</a>
                                    </div><!--/.lists-wrapp-->
                                </div><!--/.cat-section-wrap-->
                            </div><!--/.content-left clearfix-->
                        </div><!--/.tabs-section-->
                    </div>
                </div><!--/.col-md-9-->
                <div class="col-md-3">
                    @include('layouts.sidebar')
                </div><!--/.col-md-3-->
            </div><!--/.row-->
        </div><!--/.container-->
    </div><!--/.content-->
@endsection
