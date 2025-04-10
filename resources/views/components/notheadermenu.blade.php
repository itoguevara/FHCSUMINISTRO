
@php

	use App\Helpers\UtilsHelper;
	use App\Helpers\YearHelper;
	use Illuminate\Support\Facades\Auth;
	$ippc =  getIp();
	$username = get_current_user();
    $host = gethostbyaddr($ippc);
	$userpc =$host.chr(92).$username.'@GASYSTEM.COM';
	
	// dump(' Usuario : '.$request->nickname);
	// $user = User::where('nickname', $request->nickname)->first();
	//dd();

@endphp
<div id="header-wrapper">
	<div class="container">
		<!-- Header -->
			<header id="header">
				<div class="inner">
					<!-- Logo -->
					 <a href="home">
						<img class="imglogo" src="Back/images/LogoAAWeb.png" alt="" />
					</a>
					<div class="usuarioheader" >
						<label>Usuario:</label>
						<input type="text" id="usuariopc" name="usuariopc" Value = "{{ $userpc  }} "  readonly maxlength="100" size="40">
						{{-- Si hay un error tendremos el mensaje --}}
						@if ($errors->has('name'))
							{{ $errors->first('name') }}
						@endif
					</div>
					<div  class="createuser">
						<a href="#">Crear Usuario</a>
					</div>

					<div class="passwordheader">
						<label>Contraseña:</label>
						<input type="password" name="password" maxlength="10" size="8">
						@if ($errors->has('password'))
						{{ $errors->first('password') }}
						@endif
					</div>
					<div >
						<form method = "POST" action="{{ route('login') }}">
						@csrf
							<button type="submit" class="loginbtnheader" >
								<span style="color:#f3f6f7" >Login</span>
							</button>
						</form>
					</div>
				</div>
			</header>
	</div>
</div>