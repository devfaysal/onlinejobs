@extends('layouts.app')

@section('content')

<section class="banner">
		@include('layouts.topbar')
				<!--  banner body and search   -->
				
				<div id="search_card" class="hide_search_card">
				    <span class="close"></span>
				    <div class="container">
				    	<div class="srcJob">Search Jobs</div>
				    	<div class="srcInput">
							<form method="GET" action="{{route('job.search')}}">
							
				    		<div class="qsbfield">
								
				    			<div class="suggest">
									<input class="js-search-tags form-control" name="title" type="text">
							        {{-- <select class="js-search-tags form-control" multiple="multiple">
							          <option>orange</option>
							          <option>white</option>
							          <option>purple</option>
							        </select> --}}
					    		</div>
				    			<div class="suggest_location">
									{{-- <input class="js-search-tags form-control" type="text" name="location" placeholder="Location"> --}}
							        <select class="js-location-tags form-control" name="location" placeholder="123">
							          <option value="">Location</option>
							          <option value="Malaysia">Malaysia</option>
							          <option value="Bangladesh">Bangladesh</option>
							          <option value="India">India</option>
							        </select>
					    		</div>
					    		<div class="singleDD">
					    			<select name="experience" class="form-control">
                                    	<option value="">Experience</option>
                                        <option value="1">0 Year</option>
                                        <option value="2">1</option>
                                        <option value="3">2</option>
                                        <option value="3">3</option>
                                        <option value="3">4</option>
                                        <option value="3">5</option>
                                        <option value="3">6</option>
                                    </select>
					    		</div>
					    		<div class="singleDD no-border">
					    			<select name="salary" class="form-control">
                                    	<option value="">Salary</option>
                                        <option value="100000">100,000</option>
                                        <option value="50000">50,000</option>
                                        <option value="40000">40,000</option>
                                        <option value="30000">30,000</option>
                                        <option value="20000">20,000</option>
                                    </select>
					    		</div>
					    	</div>
					    	<button class="qsbSrch blueBtn" type="submit">Search</button>
						</form>
						</div>
				    </div>
				</div>

				<div class="container">
						<div class="row">
								<div class="col-sm-6 col-md-5 col-lg-6">
									<div class="banner_tranparent">
										<div class="input-group mb-3 form-search-outer">
											<input type="text" class="form-control search-jobs" placeholder="Search Jobs" aria-label="Recipient's username" aria-describedby="basic-addon2">
											<div class="input-group-append">
												<button class="btn btn-primary btn-search" type="button">Search</button>
											</div>
										</div>
										<div class="input-group mb-3 ext-form">
											<input type="text" class="form-control" placeholder="Skills/designation " aria-label="Recipient's username" aria-describedby="basic-addon2">
											<div class="input-group-append">
													<button class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Location</button>
													<div class="dropdown-menu">
															<a class="dropdown-item" href="#">Delhi</a>
															<a class="dropdown-item" href="#">Mumbai </a>
															<a class="dropdown-item" href="#">Hyderabad </a>
															<a class="dropdown-item" href="#">Pune </a>
													</div>
													</div>

													<div class="input-group-append">
													<button class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Experience </button>
													<div class="dropdown-menu">
															<a class="dropdown-item" href="#">1 Year  </a>
															<a class="dropdown-item" href="#">2 Year</a>
															<a class="dropdown-item" href="#">3 Year</a>
															<a class="dropdown-item" href="#">4 Year</a>
													</div>
													</div>

													<div class="input-group-append">
													<button class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sallary </button>
													<div class="dropdown-menu">
															<a class="dropdown-item" href="#">< 1 lac </a>
															<a class="dropdown-item" href="#">2</a>
															<a class="dropdown-item" href="#">3</a>
															<a class="dropdown-item" href="#">4</a>
													</div>
													</div>
											<div class="input-group-append">
													<button class="btn btn-primary" type="button">Search </button>
											</div>
										</div>
									</div><!--  banner trand end   -->
								</div>
								<div class="col-sm-6 col-md-5 col-lg-6">
								<div class="banner_tranparent">
										<div class="row">
												<div class="col-sm-6 col-md-5 col-lg-6 banner-left">
													<div class="whitebg text-center banner_equal">
														<p> Looking for General Worker<br>or Domestic Maid?</p>
														<a class="btn btn-warning  btn-large btn-block" href="{{route('login')}}"> Quick Registration  </a>
														<hr class="hr-text" data-content="or">
														<h5><a href="#"> Upload Demand Letter </a> </h5>
														<p class="small_TxT2"> Max 2 MB, doc, docx, rtf, pdf </p> 
														<p>Our team will contact you.</p>
													</div>
												</div>
												<div class="col-sm-6 col-md-5 col-lg-6 banner-right">
													<div class="whitebg align-middle banner_equal row align-items-center">
														<h6>Hiring Packages are available. Choose the best suited for you.</h6>
														<h5><a href="#"> View the Packages </a> </h5>
													</div>
												</div>
										</div> 
										</div><!--  row end    -->
								</div><!--  banner trans end  -->
						</div><!--  /.row  -->
				</div><!--  /.container  -->
		</section>

		<section class="maincontent">
				<div class="container">
				<div class="row">
						<div class="col-sm-12 col-md-9 col-lg-9">
									<div class="whitebg promo-1">
											<img alt="prestar" src="images/companies/prestar.jpg" class="img-fluid">
											<img alt="hovid" src="images/companies/hovid.jpg" class="img-fluid">
											<img alt="masteel" src="images/companies/masteel.jpg" class="img-fluid">
											<img alt="nestle" src="images/companies/nestle.jpg" class="img-fluid">
											<img alt="litrak" src="images/companies/litrak.jpg" class="img-fluid">
									</div>

									<div class="row">
										<div class="col-sm-12 col-md-3 text-center">
											<div class="whitebg">
													<img src="images/companies/supermax.jpg" class="img-fluid adsImg">
													<img src="images/companies/kpj-berhad.jpg" class="img-fluid adsImg">
													<img src="images/companies/top-glove.jpg" class="img-fluid adsImg">
													<img src="images/companies/boustead.jpg" class="img-fluid adsImg">
													<img src="images/companies/shin-yang.jpg" class="img-fluid adsImg">
													<img src="images/companies/industronics.jpg" class="img-fluid adsImg">
													<img src="images/companies/excel-force.jpg" class="img-fluid adsImg">
													<img src="images/companies/mycron-steel.jpg" class="img-fluid adsImg">
													<img src="images/companies/mitrajaya.jpg" class="img-fluid adsImg">
													<img src="images/companies/gadang-holdings.jpg" class="img-fluid adsImg">
													<img src="images/companies/pinehill-pacific.jpg" class="img-fluid adsImg">
													<img src="images/companies/mesiniaga.jpg" class="img-fluid adsImg">
													<img src="images/companies/pantech-group.jpg" class="img-fluid adsImg">
													<img src="images/companies/datasonic.jpg" class="img-fluid adsImg">
													<img src="images/companies/greenpacket.jpg" class="img-fluid adsImg">
													<img src="images/companies/zelan-berhad.jpg" class="img-fluid adsImg">
													<img src="images/companies/tasco.jpg" class="img-fluid adsImg">
													<img src="images/companies/yoong-onn.jpg" class="img-fluid adsImg">
													<img src="images/companies/toyo-ink.jpg" class="img-fluid adsImg">
													<img src="images/companies/samchem-holdings.jpg" class="img-fluid adsImg">
													<img src="images/companies/ancom-berhad.jpg" class="img-fluid adsImg">
													<img src="images/companies/hexza.jpg" class="img-fluid adsImg">
													<img src="images/companies/magni-tech.jpg" class="img-fluid adsImg">
													<img src="images/companies/permaju.jpg" class="img-fluid adsImg">
													<img src="images/media/30.gif" class="img-fluid adsImg">
											</div>

											<!-- <div class="whitebg">
													<img src="images/media/61.gif" class="img-fluid adsImg">
											</div> -->
										</div>

											<div class="col-md-9 col-sm-9">
													<div class="whitebg">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <img style="width:100%" src="images/home/1st-Picture.jpg" alt="">
                                                                <p class="mt-3 text-center text-danger">POWERING THE WORLD OF WORK WITH OUR ONLINE RECRUITING EXPERTISE</p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <p class="border-after text-uppercase text-primary "><span class="font-size-3">W</span>ho We Are</p>
                                                                <p>Online Jobs Is A Global Recruiting and Work Placement Consultant For JobSeeks and JobsProvider.</p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p class="border-after text-uppercase text-primary mb-1"><span class="font-size-3">M</span>ission, values and purpose</p>
                                                                <p>We want to be the world’s leading specialist online recruitment consultancy and Welfare protection provider for Jobseeks and Employer.  We provide online CV on local and foreign workers to carter local and global demand</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <img class="mt-3" style="width:100%; height: 90%;" src="images/home/2nd-Picture.jpg" alt="">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <p class="text-danger text-center font-italic font-size-2">“Placing the right talents to the right jobs at the right companies”</p>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <img style="width:100%" src="images/home/3rd-Picture.jpg" alt="">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <p class="mt-2">Online Jobs is committed to providing you with the best-in-class research, tailored recruitment solutions, methodology, tools and services to your HR leadership team what they need to operate efficiently.</p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <img class="mt-3" style="width:100%; height: 90%;" src="images/home/4th-Picture.jpg" alt="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="border-after text-uppercase text-primary mb-1"><span class="font-size-3">O</span>ur Advantages </p>
                                                                <p>At Online Jobs we dedicated ourselves to our clients to meet their needs in the best possible way we can. We understand that identifying the best solution and talent for your company is no easy task and will take precious time and effort that is why we are here to help you with our professional services through our Asia pacific network and expertise.</p>
                                                            </div>
                                                        </div>
													</div>
												<div class="whitetab">
												<nav>
                                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-allsector" role="tab" aria-controls="nav-home" aria-selected="true">All sectors </a>
                                                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-it" role="tab" aria-controls="nav-profile" aria-selected="false">Information technology </a>
                                                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-manufacture" role="tab" aria-controls="nav-contact" aria-selected="false">Manufacturing </a>
                                                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-services" role="tab" aria-controls="nav-contact" aria-selected="false">Services </a>
                                                    </div>
												</nav>

		<div class="tab-content" id="nav-tabContent">
	<div class="tab-pane fade show active" id="nav-allsector" role="tabpanel" aria-labelledby="nav-home-tab"> 
		 <article class="gray_link">
				
				<h5> Informaton technoligy </h5> 
					
					<h6> LatentView Analytics Pvt Ltd.</h6>
					<ul class="list-unstyled">  
						<li><a href="">  Analytics </a></li>
					</ul>

					 <h6>ChipDsg/Semicond. </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Einfochips Ltd </a></li>
						<li><a href=""> IntelMaxim Integrated </a></li>
						<li><a href=""> Maxim Integrated </a></li>
						<li><a href=""> Micron </a></li>
						<li><a href=""> SYNAPSE DESIGN </a></li>
						<li><a href=""> XILINX </a></li>
					</ul>

					<h6> Cloud computing </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Secure - 24 IT Services Pvt Ltd </a></li>
					</ul>

					<h6> Engineering Services </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Secure - 24 IT Services Pvt Ltd </a></li>
					</ul>

					<h6>ChipDsg/Semicond. </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Einfochips Ltd </a></li>
						<li><a href=""> IntelMaxim Integrated </a></li>
						<li><a href=""> Maxim Integrated </a></li>
						<li><a href=""> Micron </a></li>
						<li><a href=""> SYNAPSE DESIGN </a></li>
						<li><a href=""> XILINX </a></li>
					</ul>

					<h6> LatentView Analytics Pvt Ltd.</h6>
					<ul class="list-unstyled">  
						<li><a href="">  Analytics </a></li>
					</ul>

					 <h6>ChipDsg/Semicond. </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Einfochips Ltd </a></li>
						<li><a href=""> IntelMaxim Integrated </a></li>
						<li><a href=""> Maxim Integrated </a></li>
						<li><a href=""> Micron </a></li>
						<li><a href=""> SYNAPSE DESIGN </a></li>
						<li><a href=""> XILINX </a></li>
					</ul>

					<h6> Cloud computing </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Secure - 24 IT Services Pvt Ltd </a></li>
					</ul>

					<h6> Engineering Services </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Secure - 24 IT Services Pvt Ltd </a></li>
					</ul>

					<h6>ChipDsg/Semicond. </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Einfochips Ltd </a></li>
						<li><a href=""> IntelMaxim Integrated </a></li>
						<li><a href=""> Maxim Integrated </a></li>
						<li><a href=""> Micron </a></li>
						<li><a href=""> SYNAPSE DESIGN </a></li>
						<li><a href=""> XILINX </a></li>
					</ul>

					<h6> LatentView Analytics Pvt Ltd.</h6>
					<ul class="list-unstyled">  
						<li><a href="">  Analytics </a></li>
					</ul>

					 <h6>ChipDsg/Semicond. </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Einfochips Ltd </a></li>
						<li><a href=""> IntelMaxim Integrated </a></li>
						<li><a href=""> Maxim Integrated </a></li>
						<li><a href=""> Micron </a></li>
						<li><a href=""> SYNAPSE DESIGN </a></li>
						<li><a href=""> XILINX </a></li>
					</ul>

					<h6> Cloud computing </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Secure - 24 IT Services Pvt Ltd </a></li>
					</ul>

					<h6> Engineering Services </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Secure - 24 IT Services Pvt Ltd </a></li>
					</ul>

					<h6>ChipDsg/Semicond. </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Einfochips Ltd </a></li>
						<li><a href=""> IntelMaxim Integrated </a></li>
						<li><a href=""> Maxim Integrated </a></li>
						<li><a href=""> Micron </a></li>
						<li><a href=""> SYNAPSE DESIGN </a></li>
						<li><a href=""> XILINX </a></li>
					</ul>


					<h6> LatentView Analytics Pvt Ltd.</h6>
					<ul class="list-unstyled">  
						<li><a href="">  Analytics </a></li>
					</ul>

					 <h6>ChipDsg/Semicond. </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Einfochips Ltd </a></li>
						<li><a href=""> IntelMaxim Integrated </a></li>
						<li><a href=""> Maxim Integrated </a></li>
						<li><a href=""> Micron </a></li>
						<li><a href=""> SYNAPSE DESIGN </a></li>
						<li><a href=""> XILINX </a></li>
					</ul>

					<h6> Cloud computing </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Secure - 24 IT Services Pvt Ltd </a></li>
					</ul>

					<h6> Engineering Services </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Secure - 24 IT Services Pvt Ltd </a></li>
					</ul>

					<h6>ChipDsg/Semicond. </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Einfochips Ltd </a></li>
						<li><a href=""> IntelMaxim Integrated </a></li>
						<li><a href=""> Maxim Integrated </a></li>
						<li><a href=""> Micron </a></li>
						<li><a href=""> SYNAPSE DESIGN </a></li>
						<li><a href=""> XILINX </a></li>
					</ul>

					<h6> LatentView Analytics Pvt Ltd.</h6>
					<ul class="list-unstyled">  
						<li><a href="">  Analytics </a></li>
					</ul>

					 <h6>ChipDsg/Semicond. </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Einfochips Ltd </a></li>
						<li><a href=""> IntelMaxim Integrated </a></li>
						<li><a href=""> Maxim Integrated </a></li>
						<li><a href=""> Micron </a></li>
						<li><a href=""> SYNAPSE DESIGN </a></li>
						<li><a href=""> XILINX </a></li>
					</ul>

					<h6> Cloud computing </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Secure - 24 IT Services Pvt Ltd </a></li>
					</ul>

					<h6> Engineering Services </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Secure - 24 IT Services Pvt Ltd </a></li>
					</ul>

					<h6>ChipDsg/Semicond. </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Einfochips Ltd </a></li>
						<li><a href=""> IntelMaxim Integrated </a></li>
						<li><a href=""> Maxim Integrated </a></li>
						<li><a href=""> Micron </a></li>
						<li><a href=""> SYNAPSE DESIGN </a></li>
						<li><a href=""> XILINX </a></li>
					</ul>

					<h6> LatentView Analytics Pvt Ltd.</h6>
					<ul class="list-unstyled">  
						<li><a href="">  Analytics </a></li>
					</ul>

					 <h6>ChipDsg/Semicond. </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Einfochips Ltd </a></li>
						<li><a href=""> IntelMaxim Integrated </a></li>
						<li><a href=""> Maxim Integrated </a></li>
						<li><a href=""> Micron </a></li>
						<li><a href=""> SYNAPSE DESIGN </a></li>
						<li><a href=""> XILINX </a></li>
					</ul>

					<h6> Cloud computing </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Secure - 24 IT Services Pvt Ltd </a></li>
					</ul>

					<h6> Engineering Services </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Secure - 24 IT Services Pvt Ltd </a></li>
					</ul>

					<h6>ChipDsg/Semicond. </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Einfochips Ltd </a></li>
						<li><a href=""> IntelMaxim Integrated </a></li>
						<li><a href=""> Maxim Integrated </a></li>
						<li><a href=""> Micron </a></li>
						<li><a href=""> SYNAPSE DESIGN </a></li>
						<li><a href=""> XILINX </a></li>
					</ul>

					<h6> LatentView Analytics Pvt Ltd.</h6>
					<ul class="list-unstyled">  
						<li><a href="">  Analytics </a></li>
					</ul>

					 <h6>ChipDsg/Semicond. </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Einfochips Ltd </a></li>
						<li><a href=""> IntelMaxim Integrated </a></li>
						<li><a href=""> Maxim Integrated </a></li>
						<li><a href=""> Micron </a></li>
						<li><a href=""> SYNAPSE DESIGN </a></li>
						<li><a href=""> XILINX </a></li>
					</ul>

					<h6> Cloud computing </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Secure - 24 IT Services Pvt Ltd </a></li>
					</ul>

					<h6> Engineering Services </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Secure - 24 IT Services Pvt Ltd </a></li>
					</ul>

					<h6>ChipDsg/Semicond. </h6>
					<ul class="list-unstyled">  
						<li><a href="">  Einfochips Ltd </a></li>
						<li><a href=""> IntelMaxim Integrated </a></li>
						<li><a href=""> Maxim Integrated </a></li>
						<li><a href=""> Micron </a></li>
						<li><a href=""> SYNAPSE DESIGN </a></li>
						<li><a href=""> XILINX </a></li>
					</ul>

				</article>
		</div> <!-- tabl end -->
		<div class="tab-pane fade" id="nav-it" role="tabpanel" aria-labelledby="nav-profile-tab">2222 </div>
		<div class="tab-pane fade" id="nav-manufacture" role="tabpanel" aria-labelledby="nav-contact-tab">333 </div>
		<div class="tab-pane fade" id="nav-services" role="tabpanel" aria-labelledby="nav-contact-tab">333 </div>
		</div>
		</div> 
											</div>
									</div>

						</div> <!-- left ccolum end -->
						<div class="col-sm-12 col-md-3">
							<div class="whitebg text-center">
								<p> Get best matched jobs on your email. No registration needed </p>
										<a class="btn btn-primary  btn-large btn-block">Create a job alert ! </a>
							</div>

							<div class="whitetab mar_top smallertxt">
								<img src="images/onlinejobs-logo.png" class="img-fluid pad_10"> <hr/> 
									<ul class="list_pad ">
											<li><a href=""> Onlinejobs Resume Score - Free </a>
		Get your FREE resume feedback report and know the improvement areas in your resume within 30 seconds</li>
											<li> <a href=""> Reach out to more recruiters </a>
		Become a Featured Applicant on Onlinejobs and Increase your profile views by up to 3 times. Know More.</li> 
									</ul>
									<hr/> 
									<p class="whitebg smallertxt">
										Call 1800-3010-5557 now! (Toll-Free) for JobSeeker services
									</p>
							</div>

							<div class="whitebg text-center">
								<p> Search all current and upcoming walk-in jobs </p>
										<a class="btn btn-primary  btn-large btn-block">Search walk in jobs  </a>
							</div>

							<div class="whitebg">
								<img src="images/onlinejobs-logo.png" class="img-fluid">
								<p class="text-center"> Salary trends in over 3500 Companies </p>
										<a class="btn btn-primary  btn-large btn-block"> View sallaries  </a>
							</div>

							<div class="whitebg">
								<img src="images/onlinejobs-logo.png" class="img-fluid">
								<p class="text-center"> 500+ courses to help you get better jobs </p>
										<a class="btn btn-primary  btn-large btn-block"> Explore courses  </a>
										<hr/>
										<p class="smallertxt">Call 1800-103-4702 now! (Toll-Free) </p> 
							</div>

							<div class="whitebg">
								
								<p class="text-center smallertxt"> Connect to recruiters directly. More than 50,000 Recruiter across Industries </p>
										<a class="btn btn-primary  btn-large btn-block"> View recruiters   </a>
										
							</div>

							 <div class="whitetab mar_top smallertxt">
								<p class="whitebg"> Services for Recruiters </p>
									<hr/> 
									<ul class="custom-list">
											<li><a href="">Onlinejobs Employer Zone </a>
		End your hunt for the perfect employee </li>
											<li> <a href=""> Search CVs for Free now </a> 
		Find the right candidate</li> 
											<li> <a href=""> Onlinejobs Job Posting Services and Resume Database Access </a>
		Call 1800-102-2558 for Employer products </li> 
											<li> <a href=""> Campus Hiring Solutions </a>
		Optimize your Fresher Hiring </li> 
									</ul>
									<hr/> 
									<p class="whitebg smallertxt">
										Call 1800-3010-5557 now! (Toll-Free) for JobSeeker services
									</p>
							</div>

							<div class="whitetab mar_top smallertxt">
								<p class="pad_10"> Onlinejobs JobSpeak </p>
							</div>

							<div class="whitetab mar_top smallertxt">
								<p class="pad_10"> Premium Designations </p>
							</div>

							<div class="whitetab mar_top smallertxt">
								<p class="pad_10"> Premium Designations </p>
							</div>

							<div class="whitetab mar_top smallertxt">
								<p class="pad_10"> Jobs by location </p>
							</div>

						</div>
				</div>
		</div>  
		</section>
 
@endsection
@section('script')
	<script>
		$("#search_card .close").click(function() {
                $('#search_card').addClass('hide_search_card')
		});
		$(".search-jobs").click(function() {
                $('#search_card').removeClass('hide_search_card');
		});
	</Script>
@endsection