@extends('layouts.app')

@section('content')
	<div class="w-4/6 m-auto shadow-lg border">
		<div class="p-3 bg-gray-200 border-2 text-center">Login</div>

		<div class="p-3">
			<form method="POST" action="{{ route('login') }}">
				@csrf

				<div class="pb-3 flex">
					<label class="w-2/6 mt-2 text-right">Email</label>

					<div class="col-md-6">
						<input id="email" type="email"
							class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
							name="email" value="{{ old('email') }}" required autofocus
						>

						@if ($errors->has('email'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="pb-3 flex">
					<label class="w-2/6 mt-2 text-right">Password</label>

					<div class="col-md-6">
						<input id="password" type="password"
							class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
							name="password" required
						>

						@if ($errors->has('password'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="pb-3 flex">
					<div class="m-auto">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="remember"
									class="form-checkbox border-2"
									{{ old('remember') ? 'checked' : '' }}
								> Remember me</label>
						</div>
					</div>
				</div>

				<div>
					<div class="flex">
						<div class="m-auto">
							<button type="submit" class="p-2 px-3 border-2 rounded ">
								{{ __('Login') }}
							</button>

							<a class="btn btn-link" href="{{ route('password.request') }}">
								{{ __('Forgot Your Password?') }}
							</a>

						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection
