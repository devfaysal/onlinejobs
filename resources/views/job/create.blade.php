@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-dark">
        <div class="col-12">
            <h4 class="text-center text-white pb-3 pt-4"><a class="btn btn-info" href="{{route('employer.show')}}">Back</a> Post Job </h4>
        </div>
    </div>
</div>
<!----------Start Multi Step Form Design---------->
<div class="tab-banner">
    <span class="step">Vacancies Details</span>
    <span class="step">Contact Details</span>
    <span class="step">Candidates Requirement & Facilities</span>
    <span class="step">Academic Qualifications & Skills</span>
</div>
<div class="tab-section">
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card auth-form mb-5">
                <div class="card-body">
                    <form method="POST" id="job_post" action="{{ route('job.store') }}">
                        @csrf
                    <div class="tab">
                        <div class="form-group dis-cls">
                            <label for="title" class="col-sm-4 col-form-label text-right">{{ __('Title *') }}</label>
                            <div class="col-sm-8">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" placeholder="Title" required>

                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="company" class="col-sm-4 col-form-label text-right">{{ __('Company *') }}</label>
                            <div class="col-sm-8">
                                <input id="company" type="text" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company" value="{{ old('company') }}" placeholder="Company" required>

                            @if ($errors->has('company'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('company') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="description" class="col-sm-4 col-form-label text-right">{{ __('Job Description *') }}</label>
                            <div class="col-sm-8">
                                <textarea name="description" id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" cols="30" rows="10" required>{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="location" class="col-sm-4 col-form-label text-right">{{ __('Location *') }}</label>
                            <div class="col-sm-8">
                                <input id="location" type="text" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" name="location" value="{{ old('location') }}" placeholder="Location" required>

                            @if ($errors->has('location'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('location') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="salary_range_1" class="col-sm-4 col-form-label text-right">{{ __('Salary Range *') }}</label>
                            <div class="col-sm-8">
                                <input id="salary_range_1" type="text" class="form-control{{ $errors->has('salary_range_1') ? ' is-invalid' : '' }}" name="salary_range_1" value="{{ old('salary_range_1') }}" placeholder="Salary Range" required>

                            @if ($errors->has('salary_range_1'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('salary_range_1') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="salary_range_2" class="col-sm-4 col-form-label text-right">{{ __('Salary Range *') }}</label>
                            <div class="col-sm-8">
                                <input id="salary_range_2" type="text" class="form-control{{ $errors->has('salary_range_1') ? ' is-invalid' : '' }}" name="salary_range_2" value="{{ old('salary_range_2') }}" placeholder="Salary Range" required>

                            @if ($errors->has('salary_range_1'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('salary_range_2') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="vacancy" class="col-sm-4 col-form-label text-right">{{ __('Vacancy *') }}</label>
                            <div class="col-sm-8">
                                <input id="vacancy" type="text" class="form-control{{ $errors->has('vacancy') ? ' is-invalid' : '' }}" name="vacancy" value="{{ old('vacancy') }}" placeholder="Vacancy" required>

                            @if ($errors->has('vacancy'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('vacancy') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="nature" class="col-sm-4 col-form-label text-right">{{ __('Nature *') }}</label>
                            <div class="col-sm-8">
                                <input id="nature" type="text" class="form-control{{ $errors->has('nature') ? ' is-invalid' : '' }}" name="nature" value="{{ old('nature') }}" placeholder="Nature" required>

                            @if ($errors->has('nature'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nature') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        
                        {{-- <div class="form-group dis-cls">
                            <div class="col-sm-1 ml-auto">
                                <input id="agreement" class="form-control checkbox" type="checkbox" name="agreement" checked required>
                            </div>
                            <label for="agreement" class="col-sm-8">I have read and agree to the<a href="">Terms and Conditions</a> governing the use of onlinejobs.my</label>
                        </div> --}}
                    </div>
                    <div class="tab">
                        <div class="form-group mb-0">
                            Page 2
                        </div>
                    </div>
                    <div class="tab">
                        <div class="form-group mb-0">
                            Page 3
                        </div>
                    </div>
                    <div class="tab">
                        <div class="form-group mb-0">
                            Page 4
                        </div>
                    </div>
                        <div style="overflow:auto;">
                            <div style="float:right;">
                                <button class="prev-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                <button class="primary-btn" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('script')
    <!---------Start for Multi Step form---------->
    <script type="text/javascript">
        $(document).ready(function() {  
    
            // Random Alert shown for the fun of it
            function randomAlert() {
                var min = 5,
                    max = 20;
                var rand = Math.floor(Math.random() * (max - min + 1) + min); //Generate Random number between 5 - 20
                // post time in a <span> tag in the Alert
                $("#time").html('Next alert in ' + rand + ' seconds');
                $('#timed-alert').fadeIn(500).delay(3000).fadeOut(500);
                setTimeout(randomAlert, rand * 1000);
            };
            randomAlert();
        });

        $('.btn').click(function(event) {
            event.preventDefault();
            var target = $(this).data('target');
            // console.log('#'+target);
            $('#click-alert').html('data-target= ' + target).fadeIn(50).delay(3000).fadeOut(1000);
            
        });


        // Multi-Step Form
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the crurrent tab

        function showTab(n) {
          // This function will display the specified tab of the form...
          var x = document.getElementsByClassName("tab");
          x[n].style.display = "block";
          //... and fix the Previous/Next buttons:
          if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
          } else {
            document.getElementById("prevBtn").style.display = "inline";
          }
          if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Post Job";
          } else {
            document.getElementById("nextBtn").innerHTML = "Next";
          }
          //... and run a function that will display the correct step indicator:
          fixStepIndicator(n)
        }

        function nextPrev(n) {
          // This function will figure out which tab to display
          var x = document.getElementsByClassName("tab");
          // Exit the function if any field in the current tab is invalid:
          // if (n == 1 && !validateForm()) return false;
          // Hide the current tab:
          x[currentTab].style.display = "none";
          // Increase or decrease the current tab by 1:
          currentTab = currentTab + n;
          // if you have reached the end of the form...
          if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("job_post").submit();
            return false;
          }
          // Otherwise, display the correct tab:
          showTab(currentTab);
        }

        function validateForm() {
          // This function deals with validation of the form fields
          var x, y, i, valid = true;
          x = document.getElementsByClassName("tab");
          y = x[currentTab].getElementsByTagName("input");
          // A loop that checks every input field in the current tab:
          for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false
              valid = false;
            }
          }
          // If the valid status is true, mark the step as finished and valid:
          if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
          }
          return valid; // return the valid status
        }

        function fixStepIndicator(n) {
          // This function removes the "active" class of all steps...
          var i, x = document.getElementsByClassName("step");
          for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
          }
          //... and adds the "active" class on the current step:
          x[n].className += " active";
        }
    </script>
    <!---------End for Multi Step form---------->
@endsection