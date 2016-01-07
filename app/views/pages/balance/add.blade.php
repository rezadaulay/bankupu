@section('head_code')
@stop

@section('content')
	{{ Form::open(['action' => 'BalanceController@store','role'=>'form','files'=>true,'max-image-size'=>Config::get('user.upload_image_size')]) }}
	<!-- left column -->
	<div class="col-md-12">
		
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Setor Dana Nasabah</h3>
			</div><!-- /.box-header -->
			<!-- form start -->
				<div class="box-body">
					<div class="form-group">
						<label>Rekening Nasabah <strong>*</strong></label>
						<select class="form-control selectpicker" name="user_id" id="user_id" data-live-search="true" required>
							<option value="" @if( Form::old('user_id') == '') selected @endif >Pilih Satu Nasabah</option>
							@foreach($users  as $user)
								<option value="{{$user->id}}" @if(Form::old('user_id') == $user->id || Form::old('user_id') == $user->id) selected @endif >{{$user->no_rek}} a/n: {{$user->first_name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Jumlah Setoran <strong>*</strong></label>
						<input type="number" name="amount" id="amount" value="{{Form::old('amount')}}" class="form-control" placeholder="Jumlah Setoran ..." required/>
					</div>
					
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