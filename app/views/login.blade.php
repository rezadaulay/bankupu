<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="shortcut icon" href="{{asset('assets/favicons/favicon.ico')}}" type="image/x-icon" />
		<link rel="apple-touch-icon" href="{{asset('assets/favicons/apple-touch-icon.png')}}" />
		<link rel="apple-touch-icon" sizes="57x57" href="{{asset('assets/favicons/apple-touch-icon-57x57.png')}}" />
		<link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/favicons/apple-touch-icon-72x72.png')}}" />
		<link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/favicons/apple-touch-icon-76x76.png')}}" />
		<link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/favicons/apple-touch-icon-114x114.png')}}" />
		<link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/favicons/apple-touch-icon-120x120.png')}}" />
		<link rel="apple-touch-icon" sizes="144x144" href="{{asset('assets/favicons/apple-touch-icon-144x144.png')}}" />
		<link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/favicons/apple-touch-icon-152x152.png')}}" />
		<link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/favicons/apple-touch-icon-180x180.png')}}" />
        <title>Bank PU - Login</title>
		{{ HTML::style('assets/bootstrap/css/bootstrap.min.css') }}
		{{ HTML::style('assets/bootstrap/css/login-style.css') }}
		{{ HTML::style('assets/font-awesome/css/font-awesome.min.css') }}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
	<div class="container">

		{{ Form::open(array('action' => ['SessionController@index'],'class' => 'form-signin')) }}
			<img src="{{asset('assets/favicons/apple-touch-icon-120x120.png')}}" class="img-responsive logo" />
			<h1>ADMIN AREA</h1>
			<p class="form-signin-heading">Silahkan Login</p>
			@if (Session::has('error_msg'))
				<div class="alert alert-danger alert-dismissable">
					<i class="fa fa-ban"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<b>Error !</b> {{Session::get('error_msg')}}
				</div>
			@endif
			@if (Session::has('login_errors'))
				<div class="alert alert-danger alert-dismissable">
					<i class="fa fa-ban"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<b>Error !</b> {{Session::get('login_errors')}}
				</div>
			@else
				<div class="alert alert-danger alert-dismissable">
					<i class="fa fa-ban"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<b>Error !</b> Isi Email & Password
				</div>
			@endif
			
			<label for="inputEmail" class="sr-only">Email</label>
			<input type="email" name="username" autocomplete="off"  class="form-control" placeholder="E-Mail" autofocus required/>
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" name="password" autocomplete="off"  class="form-control" placeholder="Password" required />
			<button class="btn btn-lg btn-primary btn-block" type="submit">Masuk</button>
			<p class="help-block upu-help" style="color:#000;text-align:center;">User : admin@bankupu.com<br>Password  : 12345</p>
		{{ Form::close() }}

	</div>
	<footer class="footer">
      <div class="container">
        <p class="text-muted">Tugas Mata Kuliah Sistem Terdistribusi</p>
      </div>
    </footer>
		{{ HTML::script('assets/jquery/js/jquery.min.js') }}
		{{ HTML::script('assets/bootstrap/js/bootstrap.min.js') }}
    </body>
</html>