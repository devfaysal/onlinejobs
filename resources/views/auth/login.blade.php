@extends('layouts.app')

@section('content')
<div class="logbanner" style="min-height: 350px;background:url(/images/loginpage.png) no-repeat fixed;">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-4 col-md-offset-4">
				<div class="card mt-4 mb-4 padding_tb">
					<div class="card-header no_bg"><h2>{{ __('New Registration?') }}</h2></div>

					<div class="card-body signu">
						<div class="form-group" style="max-width: 180px; margin: auto;">
							<label class="container">
							  <input type="radio" name="radio" onclick="setSignUpLink(this)" value="{{route('employer.register')}}">
							  <span class="checkmark"></span>Employer
							</label>
							<label class="container">
							  <input type="radio" name="radio" onclick="setSignUpLink(this)" value="{{route('agent.create')}}">
							  <span class="checkmark"></span>Business Partner
							</label>
							<label class="container">
							  <input type="radio" name="radio" onclick="setSignUpLink(this)" value="{{route('professional.index')}}">
							  <span class="checkmark"></span>Job Seeker
							</label>
							<label class="container">
							  <input type="radio" name="radio" onclick="setSignUpLink(this)" value="{{route('retiredPersonnel.create')}}">
							  <span class="checkmark"></span>Retired personnel
							</label>
						</div>
						<a id="signupLink" href="#" class="btn reg_btn btn-success btn-block">
							Sign up
						</a>
						
					</div>
				</div>
			</div>
			<div class="col-md-4 col-md-offset-4">
				<div class="card mt-4 mb-4">
					<div class="card-header"><h2>{{ __('Login') }}</h2></div>

					<div class="card-body logsec">
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
								<button type="submit" class="btn logsec_btn btn-success btn-block">
									{{ __('Sign in') }}
								</button>

								<a class="btn btn-link" href="{{ route('password.request') }}">
									{{ __('Forgot Your Password?') }}
								</a>
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
	<script>
		function setSignUpLink(val){
			console.log(val.value);
			
			button = document.querySelector('#signupLink');
			
			button.href = val.value;
		}
	</script>
@endsection
