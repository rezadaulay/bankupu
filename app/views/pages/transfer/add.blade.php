@section('head_code')
@stop

@section('content')
	{{ Form::open(['action' => 'TransferController@store','role'=>'form','files'=>true,'max-image-size'=>Config::get('user.upload_image_size')]) }}
	<!-- left column -->
	<div class="col-md-12">
		
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Transfer Antar Nasabah</h3>
			</div><!-- /.box-header -->
			<!-- form start -->
				<div class="box-body">
					<div class="form-group">
						<label>Rekening Asal <strong>*</strong></label>
						<select class="form-control selectpicker" name="from_user" id="from_user" data-live-search="true" required>
							<option value="" @if( Form::old('from_user') == '') selected @endif >Pilih Satu Nasabah</option>
							@foreach($users  as $user)
								<option data-balance="{{$user->balance}}" value="{{$user->id}}" @if(Form::old('from_user') == $user->id || Form::old('from_user') == $user->id) selected @endif >{{$user->no_rek}} a/n: {{$user->first_name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Rekening Tujuan <strong>*</strong></label>
						<select class="form-control selectpicker" name="to_user" id="to_user" data-live-search="true" required>
							<option value="" @if( Form::old('to_user') == '') selected @endif >Pilih Satu Nasabah</option>
							@foreach($users  as $user)
								<option value="{{$user->id}}" @if(Form::old('to_user') == $user->id || Form::old('to_user') == $user->id) selected @endif >{{$user->no_rek}} a/n: {{$user->first_name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Jumlah Transfer <strong>*</strong></label>
						<input type="number" name="amount" id="transfer-amount" value="{{Form::old('amount')}}" class="form-control" placeholder="Jumlah Transfer ..." required min="1" />
						<p class="help-block hide upu-help" style="color:#F90606;">Maksimal Dana Yang Dapat Ditransfer : <strong>1230000</strong></p>
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