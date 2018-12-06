@extends('layouts.app')

@section('content')
		
<section class="banner">
		<div class="banner-overlay"></div>
		@include('layouts.topbar')
				<!--  banner body and search   -->
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
												<div class="col-sm-6 col-md-5 col-lg-6 ">
													<div class="whitebg text-center banner_equal">
															<p style="line-height: 20px;"> Looking for General Worker or Domestic Maid?</p>
															<a class="btn btn-warning  btn-large btn-block" href="{{route('register')}}"> Quick Registration  </a>
															<hr class="hr-text" data-content="or">
															<h5><a href="#"> Upload Demand Letter </a> </h5>
															<p class="small_TxT2"> Max 2 MB, doc, docx, rtf, pdf </p> 
															<p>Our team will contact you.</p>
													</div>
												</div>
												<div class="col-sm-6 col-md-5 col-lg-6">
													<div class="whitebg align-middle banner_equal row align-items-center">
														<h6 style="text-align: justify;">Hiring Packages are available. Choose the best suited for you.</h6>
														<h5 class="col text-center banner_uppercase" style="font-size: 16px; font-weight: 700;"><a href="#"> View the Packages </a> </h5>
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
									<div class="whitebg">
											<img alt="prestar" src="images/companies/prestar.jpg" class="img-fluid">
											<img alt="hovid" src="images/companies/hovid.jpg" class="img-fluid">
											<img alt="masteel" src="images/companies/masteel.jpg" class="img-fluid">
											<img alt="nestle" src="images/companies/nestle.jpg" class="img-fluid">
											<img alt="litrak" src="images/companies/litrak.jpg" class="img-fluid">
											<img alt="caring pharmacy" src="images/companies/caring-pharmacy.jpg" class="img-fluid">
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

													<img src="images/companies/gadang-holdings.jpg" class="img-fluid adsImg">
													<img src="images/companies/pinehill-pacific.jpg" class="img-fluid adsImg">
													<img src="images/companies/greenpacket.jpg" class="img-fluid adsImg">
													<img src="images/companies/zelan-berhad.jpg" class="img-fluid adsImg">
													<img src="images/companies/tasco.jpg" class="img-fluid adsImg">
													<img src="images/companies/yoong-onn.jpg" class="img-fluid adsImg">
													<img src="images/companies/kpj-berhad.jpg" class="img-fluid adsImg">
													<img src="images/companies/top-glove.jpg" class="img-fluid adsImg">
													<img src="images/companies/boustead.jpg" class="img-fluid adsImg">
													<img src="images/companies/shin-yang.jpg" class="img-fluid adsImg">
													<img src="images/companies/samchem-holdings.jpg" class="img-fluid adsImg">
													<img src="images/companies/ancom-berhad.jpg" class="img-fluid adsImg">
													<img src="images/companies/hexza.jpg" class="img-fluid adsImg">
													<img src="images/companies/magni-tech.jpg" class="img-fluid adsImg">
													<img src="images/companies/supermax.jpg" class="img-fluid adsImg">
													<img src="images/companies/kpj-berhad.jpg" class="img-fluid adsImg">
													<img src="images/companies/top-glove.jpg" class="img-fluid adsImg">
													<img src="images/companies/boustead.jpg" class="img-fluid adsImg">
													<img src="images/companies/shin-yang.jpg" class="img-fluid adsImg">
													<img src="images/companies/industronics.jpg" class="img-fluid adsImg">
													<img src="images/companies/excel-force.jpg" class="img-fluid adsImg">
													<img src="images/companies/mitrajaya.jpg" class="img-fluid adsImg">
													<img src="images/companies/gadang-holdings.jpg" class="img-fluid adsImg">
													<img src="images/companies/pinehill-pacific.jpg" class="img-fluid adsImg">
													<img src="images/companies/mesiniaga.jpg" class="img-fluid adsImg">
													<img src="images/companies/boustead.jpg" class="img-fluid adsImg">
													<img src="images/companies/ancom-berhad.jpg" class="img-fluid adsImg">
													<img src="images/companies/hexza.jpg" class="img-fluid adsImg">
													<img src="images/companies/magni-tech.jpg" class="img-fluid adsImg">
													<img src="images/companies/permaju.jpg" class="img-fluid adsImg">
											</div>

											<!-- <div class="whitebg">
													<img src="images/media/61.gif" class="img-fluid adsImg">
											</div> -->
										</div>

											<div class="col-md-9 col-sm-9">
													<div class="whitebg">
														<p class="titleContent"> Best Places to Work </p> 
															
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
									<ul class="list_pad">
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
									<ul class="">
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
								<p class="whitebg"> Onlinejobs JobSpeak </p>
									<hr/> 
									<p class="whitebg smallertxt">
										A monthly Job Index that provides insight into hiring trends in your city, job function and industry. <br/> 
									
									
									</p>
									<div class="padding_bottom pad_10"><a href=""> View the latest edition  </a> </div> 
							</div>

							<div class="whitetab mar_top smallertxt">
								<p class="pad_10"> Premium Designations </p>
									<hr/> 
									<ul class="list-unstyled pad_10">
										<li><a   href="" target="_blank">CEO Jobs</a></li>
										<li><a   href="cfo-jobs" target="_blank">CFO Jobs</a></li>
										<li><a   href="chief-marketing-officer-jobs" target="_blank">CMO Jobs</a></li>
										<li><a  href="coo-jobs" target="_blank">COO Jobs</a></li>
										<li><a title="Chief Technology Officer Jobs" href="chief-technology-officer-jobs" target="_blank">CTO Jobs</a></li>
										<li><a  href="director-finance-jobs" target="_blank">Director Finance Jobs</a></li>
										<li><a  href="vp-hr-jobs" target="_blank">VP HR Jobs</a></li>
										<li><a title="Vice President Engineering Jobs" href="vp-engineering-jobs" target="_blank">VP Engineering Jobs</a></li>
										<li><a href="vp-marketing-jobs" target="_blank">VP Marketing Jobs</a></li>
										<li><a title="Vice President Sales Jobs" href="vp-sales-jobs" target="_blank">VP Sales Jobs</a></li>
										<li><a  href="vice-president-business-development-jobs" target="_blank">VP Business Development Jobs</a></li>
										<li><a  href="vice-president-sales-marketing-jobs" target="_blank">VP Sales &amp; Marketing Jobs</a></li>
										<li><a  href="vp-finance-jobs" target="_blank">VP Finance Jobs</a></li>
										<li><a  href="vp-operations-jobs" target="_blank">VP Operations Jobs</a></li>
										<li><a  href="marketing-head-jobs" target="_blank">Marketing Head Jobs</a></li>
										<li><a  href="sales-head-jobs" target="_blank">Sales Head Jobs</a></li>
										<li><a  href="it-head-jobs" target="_blank">IT Head Jobs</a></li>
										<li><a  href="hr-head-jobs" target="_blank">HR Head Jobs</a></li>
										<li><a title="Digital Marketing Head Jobs" href="digital-marketing-head-jobs" target="_blank">Digital Marketing Head Jobs</a></li>
										<li><a href="engineering-manager-jobs" target="_blank">Engineering Manager Jobs</a></li>
										<li><a   href="marketing-manager-jobs" target="_blank">Marketing Manager Jobs</a></li>
										<li><a   href="brand-manager-jobs" target="_blank">Brand Manager Jobs</a></li>
										<li><a   href="product-manager-jobs" target="_blank">Product Manager Jobs</a></li>
										<li><a  href="data-scientist-jobs" target="_blank">Data Scientist Jobs</a></li>
										<li><a   href="business-analyst-jobs" target="_blank">Business Analyst Jobs</a></li>
									</ul>
									<div class="padding_bottom"> <a   href="top-jobs-by-designations" class="pad_10">View all Designations</a> </div>
							</div>

							<div class="whitetab mar_top smallertxt">
								<p class="pad_10"> Premium Designations </p>
									<hr/> 
									<ul class="list-unstyled pad_10">
										<li> <a href=""> Graphic Designer Jobs </a> </li>
										<li> <a href="">Engineering Jobs </a> </li>
										<li> <a href=""> Mainframe Jobs </a> </li>
										<li> <a href=""> Legal Jobs </a> </li>
										<li> <a href="">IT Jobs </a> </li>
										<li> <a href=""> R&D Jobs </a> </li>
										<li> <a href=""> Government Jobs </a> </li>
										<li> <a href=""> PSU Jobs </a> </li>
										<li> <a href=""> Oil and Gas Jobs </a> </li>
										<li> <a href=""> Pharma Jobs </a> </li>
										<li> <a href="">Telecom Jobs </a> </li>
										<li> <a href=""> Media Jobs </a> </li>
										<li> <a href=""> Automobile Jobs</a> </li>
										
									</ul>
									<div class="padding_bottom"><a   href="top-jobs-by-designations" class="pad_10">View all categories </a> </div>
							</div>

							<div class="whitetab mar_top smallertxt">
								<p class="pad_10"> Jobs by location </p>
									<hr/> 
									<ul class="list-unstyled pad_10">
										<li> <a href=""> Jobs in Delhi </a> </li>
										<li> <a href=""> Jobs in Mumbai </a> </li>
										<li> <a href=""> Jobs in Chennai </a> </li>
										<li> <a href=""> Jobs in Gurgaon </a> </li>
										<li> <a href="">Jobs in Noida </a> </li>
										<li> <a href=""> Jobs in Kolkata </a> </li>
										<li> <a href=""> Jobs in Hyderabad </a> </li>
										<li> <a href=""> Jobs in Pune </a> </li>
										<li> <a href=""> Jobs in Bangalore </a> </li>
										<li> <a href=""> Jobs in Ahmedabad </a> </li>
										
									</ul>
									<div class="padding_bottom"><div class="padding_bottom"> <a   href="top-jobs-by-designations" class="pad_10">View all Locations </a> </div>
							</div>


						</div>
				</div>
		</div>  
		</section>
 
@endsection
