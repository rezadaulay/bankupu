<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bank PU | {{{ isset($title) ? $title : 'Home Page' }}}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		
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
		
		{{ HTML::style('assets/bootstrap/css/bootstrap.min.css') }}
		{{ HTML::style('assets/datepicker/css/bootstrap-datepicker.min.css') }}
		{{ HTML::style('assets/selectpicker/css/bootstrap-select.min.css') }}
		{{ HTML::style('assets/bootstrap/css/page-style.css') }}
		{{ HTML::style('assets/font-awesome/css/font-awesome.min.css') }}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
		@yield('head_code', '')
    </head>
    <body>
	<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{url('')}}">Bank PU</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Nasabah <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{action('UserController@create')}}">Tambah Nasabah</a></li>
                <li><a href="{{action('UserController@index')}}">Daftar Nasabah</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Setor <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{action('BalanceController@create')}}">Setor Dana Nasabah</a></li>
                <li><a href="{{action('BalanceController@index')}}">Histori Setoran Dana Nasabah</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Transfer <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{action('TransferController@create')}}">Transfer Antar Nasabah</a></li>
                <li><a href="{{action('TransferController@index')}}">Histori Transfer Antar Nasabah</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{URL::route('logout')}}">Keluar</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				@if(Session::has('error_msg'))
				<div class="box-body">
					<div class="alert alert-danger alert-dismissable">
						<i class="fa fa-ban"></i>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<b>Error !</b> {{Session::get('error_msg')}}
					</div>
				</div>
				@endif
				@if(Session::has('success_msg'))
					<div class="box-body">
						<div class="alert alert-success alert-dismissable">
							<i class="fa fa-check"></i>
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<b>Sukses !</b> {{Session::get('success_msg')}}
						</div>
					</div>
				@endif
				@if (count($errors) > 0)
					<div class="box-body">
						<div class="alert alert-danger">
							<strong>Whoops!</strong> Terdapat beberapa masalah data yang diinput.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					</div>
				@endif
		   </div>
		</div>
				@yield('content', '')
	</div>
	
	<footer class="footer">
      <div class="container">
        <p class="text-muted">Tugas Mata Kuliah Sistem Terdistribusi</p>
      </div>
    </footer>
	<div id="confirm" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
			<h4 class="modal-title">Kamu Yakin ?</h4>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
			<button type="button" class="btn btn-primary" id="modalyes">Yes</button>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div>
	<div id="alert" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
			<h4 class="modal-title"></h4>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div>
	
		{{ HTML::script('assets/jquery/js/jquery.min.js') }}
		{{ HTML::script('assets/bootstrap/js/bootstrap.min.js') }}
		{{ HTML::script('assets/datepicker/js/bootstrap-datepicker.min.js') }}
		{{ HTML::script('assets/selectpicker/js/bootstrap-select.min.js') }}
		{{ HTML::script('assets/bootstrap/js/page-script.js') }}
	@yield('foot_code', '')
    </body>
</html>
