@section('head_code')
@stop

@section('content')
	{{ Form::open(['action' => 'UserController@store','role'=>'form','files'=>true,'max-image-size'=>Config::get('user.upload_image_size')]) }}
	<!-- left column -->
	<div class="col-md-12">
		
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Tambah Nasabah</h3>
			</div><!-- /.box-header -->
			<!-- form start -->
				<div class="box-body">
					<div class="form-group">
						<label>Nama Lengkap <strong>*</strong></label>
						<input type="text" name="first_name" id="first_name" value="{{Form::old('first_name')}}" class="form-control" placeholder="Nama Lengkap ..." required/>
					</div>
					<div class="form-group">
						<label>Jenis Kelamin <strong>*</strong></label>
						<div class="radio">
							<label>
								<input type="radio" name="sex" id="sex" value="man" @if(!Form::old('sex') || Form::old('sex') == 'man') checked @endif required >
								Pria
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="sex" id="sex" value="woman" @if(Form::old('sex') == 'man') checked @endif required >
								Wanita
							</label>
						</div>
					</div>
					<div class="form-group">
						<label>Tanggal Lahir <strong>*</strong></label>
						<input type="text" name="tanggal_lahir" id="tanggal_lahir" value="{{Form::old('tanggal_lahir')}}" class="form-control datepicker" placeholder="Tanggal Lahir ..." required/>
					</div>
					<div class="form-group">
						<label>No.Ktp <strong>*</strong></label>
						<input type="text" name="no_ktp" id="no_ktp" value="{{Form::old('no_ktp')}}" class="form-control" placeholder="No.Ktp ..." required/>
					</div>
					<div class="form-group">
						<label>Npwp</label>
						<input type="text" name="npwp" id="npwp" value="{{Form::old('npwp')}}" class="form-control" placeholder="Npwp ..."/>
					</div>
					<div class="form-group">
						<label>No.Rekening <strong>*</strong></label>
						<input type="text" name="no_rek" id="no_rek" value="{{Form::old('no_rek')}}" class="form-control" placeholder="No.Rekening ..." required/>
					</div>
					<div class="form-group">
						<label>Email <strong>*</strong></label>
						<input type="email" name="email" id="email" value="{{Form::old('email')}}" class="form-control" placeholder="Email ..." required/>
					</div>
					<input type="hidden" name="usergroup_id" id="usergroup_id" value="2"/>
					<input type="hidden" name="activated" id="activated" value="1"/>
					<p class="pull-right"><strong>* ( Wajib Diisi )</strong></p>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</div>
		</div>
	{{ Form::close() }}
@stop
@section('foot_code')
@stop