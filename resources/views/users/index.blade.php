@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
	<div class="container-fluid box box-success">
		<div class="row">
		<div class="col m3" style="margin-top:1em;">
			<a href="" class="btn"><i class="material-icons">add</i>Add User</a></li>
		</div>
		<div class="col m12">
			<table class="table table-bordered" id="users-table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Physical Address</th>
						<th>Role</th>
						<th>Verified</th>
						<th>Updated At</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
	</div>
	@push('custom-scripts')
		{{--<script src="https://code.jquery.com/jquery-3.3.1.min.js"--}}
		{{--integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="--}}
		{{--crossorigin="anonymous"></script>--}}
		<link href="/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8"
				src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
		<script src="/js/materialize.js"></script>
		<script src="/js/init.js"></script>
	<script>

	$(function() {
		$('#users-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{{route('users_info')}}',
			buttons: [
					{
							text: 'My button',
							action: function ( e, dt, node, config ) {
									alert( 'Button activated' );
							}
					}
			],
			columns: [
				{ data: 'name', name: 'name' },
				{ data: 'email', name: 'email' },
				{ data: 'phone_number', name: 'phone_number' },
				{ data: 'physical_address', name: 'physical_address' },
				{ data: 'display_name', name: 'display_name' },
				{ data: 'verified', name: 'verified' },
				{ data: 'created_at', name: 'created_at' },
				{data: 'action', name: 'action', orderable: false, searchable: false}

			]
		});
		$('select').material_select();
	});

	</script>
	@endpush
@endsection
