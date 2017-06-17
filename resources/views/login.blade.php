@include('webbase.header')

<div id="container">
	<div class="error">{{ $ErrorMsg }}</div>
	<form class="form-signin" role="form" method="POST" action="/login">
		<h2 class="form-signin-heading">{{ $txt['Site'] }}</h2>
		<label for="inputEmail" class="sr-only">{{ $txt['account_input'] }}</label>
		<input type="email" id="inputEmail" class="form-control" placeholder="{{ $txt['account_input'] }}" name="email" required autofocus>
		<label for="inputPassword" class="sr-only">{{ $txt['password_input'] }}</label>
		<input type="password" id="inputPassword" class="form-control" placeholder="{{ $txt['password_input'] }}" name="pwd" required>				
		<div id="Verify">
			<div><input type="text" id="VerifyCode" class="form-control" placeholder="{{ $txt['verify_input'] }}" name="verify" required></div>
			<div class="verify_code">
				@foreach($Verifycode_img as $row)
				<img src="{{ URL::asset('_images') }}/{{ $row }}.png" alt="" width="50">
				@endforeach	
			</div>
			<div><input type="button" value="{{ $txt['refresh_verify_code'] }}" class="refresh_verify_code btn btn-primary"></div>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">{{ $txt['login'] }}</button>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</div>

@include('webbase.footer')