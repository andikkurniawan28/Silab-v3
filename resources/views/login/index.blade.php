<!DOCTYPE html>
<html lang="en">
<head>
	<title>{{ env('APP_NAME') }}</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/png" href="/admin_template/img/QC.png"/>
	<link rel="stylesheet" type="text/css" href="/login_template/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/login_template/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/login_template/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="/login_template/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="/login_template/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="/login_template/css/util.css">
	<link rel="stylesheet" type="text/css" href="/login_template/css/main.css">
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="/admin_template/img/QC.png" alt="Logo QC">
				</div>

				<form class="login100-form validate-form" method="POST" action="{{ route('login_process') }}">

					<span class="login100-form-title">
						Login
					</span>

                    @if($message = Session::get('error'))
                        @include('components.alert', ['message'=>$message, 'color'=>'danger'])
                    @endif

                    @if($message = Session::get('success'))
                        @include('components.alert', ['message'=>$message, 'color'=>'danger'])
                    @endif

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        @csrf
						<input class="input100" type="text" name="username" placeholder="Masukkan username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Masukkan Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-key" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>

                    <div class="text-center p-t-136">
                        {{-- <a class="txt2" href="{{ route('register') }}">
                            Daftar disini
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a> --}}
                    </div>

                </form>

			</div>
		</div>
	</div>

	<script src="/login_template/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="/login_template/vendor/bootstrap/js/popper.js"></script>
	<script src="/login_template/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="/login_template/vendor/select2/select2.min.js"></script>
	<script src="/login_template/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script src="/login_template/js/main.js"></script>

</body>
</html>
