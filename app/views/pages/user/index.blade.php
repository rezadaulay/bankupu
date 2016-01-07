@section('head_code')
@stop
@section('page_breadcrumb')
	<li class="active">User List</li>
@stop

@section('content')
	<div class="box">	
		{{ Form::open(['class'=>'table-index' , 'action' => ['UserController@destroy','1'], 'method' => 'delete']) }}
		<h3 class="box-title">Daftar Nasabah</h3><br>
		<div class="box-body table-responsive kamga">
			<table class="table table-bordered table-hover ">
				<thead>
					<tr>
						<th>Nama</th>
						<th>No.Rek</th>
						<th>Jenis Kelamin</th>
						<th>Tgl.Lahir</th>
						<th>No.Ktp</th>
						<th>Npwp</th>
						<th>Email</th>
						<th>Tgl.Daftar</th>
						<th>Saldo</th>
						<th style="width: 68px"></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($content_list as $content)
						<tr>
							<td>{{$content->first_name}}</td>
							<td>{{$content->no_rek}}</td>
							<td>{{$content->kelamin}}</td>
							<td>{{$content->tanggal_lahir}}</td>
							<td>{{$content->no_ktp}}</td>
							<td>{{ $content->npwp === '' ? '-' : $content->npwp }}</td>
							<td>{{$content->email}}</td>
							<td>{{date('Y-m-d' , strtotime($content->created_at))}}</td>
							<td>{{$content->balance}}</td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-default btn-sm btn-flat dropdown-toggle" data-toggle="dropdown">
										Action <span class="caret"></span>
									</button>
									<ul class="dropdown-menu dropdown-menu-right" role="menu">
										<li><a href="{{action('UserController@edit', $content->id)}}">Edit</a></li>
										<input checkbox_{{$content->id}} type="checkbox" class="simple hide"  name="id[]" id="id" value="{{$content->id}}" childcheckbox>
										<li class="divider"></li>
										<li><a setindex="1" href="{{$content->id}}">Hapus</a></li>
									</ul>
								</div>
							</td>
						</tr>
					@endforeach
			</table>
		</div>
		<div class="box-footer clearfix pull-right">
				<div class="pull-left hide">
					 <div class="form-group">
						<input type="hidden" name="indexaction" id="indexaction" value="1" >
					</div>
				</div>
				<div class="pull-left">&nbsp;
					<button type="submit" class="btn btn-primary hide">Submit</button>
				</div>
			{{$content_list->links()}}
		</div>
			{{ Form::close() }}
	</div>
@stop
@section('foot_code')
@stop