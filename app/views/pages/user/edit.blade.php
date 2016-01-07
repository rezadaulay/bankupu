@section('head_code')
@stop

@section('content')
	{{ Form::open(['action' => array('UserController@update',$detail->id),'method' => 'patch','role'=>'form','files'=>true,'max-image-size'=>Config::get('user.upload_image_size')]) }}
	<!-- left column -->
	<div class="col-md-12">
		
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Ubah Data Nasabah</h3>
			</div><!-- /.box-header -->
			<!-- form start -->
				<div class="box-body">
					<div class="form-group">
						<label>Nama Lengkap <strong>*</strong></label>
						<input type="text" name="first_name" id="first_name" value="{{$detail->first_name}}" class="form-control" placeholder="Nama Lengkap ..." required/>
					</div>
					<div class="form-group">
						<label>Jenis Kelamin : <b class="text-red" >{{$errors->first('sex')}}</b></label>
						<div class="radio">
							<label>
								<input type="radio" name="sex" id="sex" value="man" @if($detail->sex == 'man') checked @endif required >
								Pria
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="sex" id="sex" value="woman" @if($detail->sex == 'woman') checked @endif required >
								Wanita
							</label>
						</div>
					</div>
					<div class="form-group">
						<label>Tanggal Lahir <strong>*</strong></label>
						<input type="text" name="tanggal_lahir" id="tanggal_lahir" value="{{$detail->tanggal_lahir}}" class="form-control datepicker" placeholder="Tanggal Lahir ..." required/>
					</div>
					<div class="form-group">
						<label>No.Ktp <strong>*</strong></label>
						<input type="text" name="no_ktp" id="no_ktp" value="{{$detail->no_ktp}}" class="form-control" placeholder="No.Ktp ..." required/>
					</div>
					<div class="form-group">
						<label>Npwp</label>
						<input type="text" name="npwp" id="npwp" value="{{$detail->npwp}}" class="form-control" placeholder="Npwp ..."/>
					</div>
					<div class="form-group">
						<label>No.Rekening <strong>*</strong></label>
						<input type="text" name="no_rek" id="no_rek" value="{{$detail->no_rek}}" class="form-control" placeholder="No.Rekening ..." required/>
					</div>
					<div class="form-group">
						<label>Saldo <strong>*</strong></label>
						<input type="text" value="{{$detail->balance}}" class="form-control" readonly />
					</div>
					<div class="form-group">
						<label>Email <strong>*</strong></label>
						<input type="email" name="email" id="email" value="{{$detail->email}}" class="form-control" placeholder="Email ..." required/>
					</div>
					<p class="pull-right"><strong>* ( Wajib Diisi )</strong></p>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
		</div>
	</div> 
	{{ Form::close() }}
@stop
@section('foot_code')
@stop