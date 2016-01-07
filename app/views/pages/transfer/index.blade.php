@section('head_code')
@stop
@section('page_breadcrumb')
	<li class="active">User List</li>
@stop

@section('content')
	<div class="box">	
		<h3 class="box-title">Histori Transfer Antar Nasabah</h3><br>
		<div class="box-body table-responsive kamga">
			<table class="table table-bordered table-hover ">
				<thead>
					<tr>
						<th>Waktu Transaksi</th>
						<th>Rekening Asal</th>
						<th>Rekening Tujuan</th>
						<th>Jumlah</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($content_list as $content)
						<tr>
							<td>{{$content->created_at}}</td>
							<td>{{$users->find($content->from_user)->first_name}}</td>
							<td>{{$users->find($content->to_user)->first_name}}</td>
							<td>{{$content->amount}}</td>
					@endforeach
			</table>
		</div>
		<div class="box-footer clearfix pull-right">
			{{$content_list->links()}}
		</div>
	</div>
@stop
@section('foot_code')
@stop