@extends('layouts.admin_template')

@section('content')
	<div class="row" style="margin-top:8em;">
			<div class="col-md-8 col-md-offset-2">
					<div class="panel panel-default">
							<div class="panel-heading">Edit User</div>
							<div class="panel-body">
									<form class="form-horizontal" role="form" method="POST" action="{{ url('user/update/'.$user->id) }}">
											{{ csrf_field() }}
											<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
													<label for="name" class="col-md-4 control-label">Name</label>
													<div class="col-md-6">
															<input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required autofocus>

															@if ($errors->has('name'))
																	<span class="help-block">
																			<strong>{{ $errors->first('name') }}</strong>
																	</span>
															@endif
													</div>
											</div>

											<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
													<label for="email" class="col-md-4 control-label">E-Mail Address</label>

													<div class="col-md-6">
															<input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" required>

															@if ($errors->has('email'))
																	<span class="help-block">
																			<strong>{{ $errors->first('email') }}</strong>
																	</span>
															@endif
													</div>
											</div>
											<div class="form-group">
													<label for="phone_number" class="col-md-4 control-label">Phone Number</label>

													<div class="col-md-6">
															<input id="phone_number" type="tel" class="form-control" name="phone_number" value="{{$user->phone_number}}" required>
													</div>
											</div>

											<div class="form-group">
													<label for="physical_address" class="col-md-4 control-label">Physical Address</label>
													<div class="col-md-6">
														<textarea id="physical_address" name="physical_address" class="form-control materialize-textarea" value="" required rows="4" col="5">{{$user->physical_address}}</textarea>
													</div>
											</div>
											<div class="form-group">
												<label for="user_role" class="col-md-4 control-label">User Role</label>
												<div class="col-md-6">
								          <select id="role" name="user_role" required>
								            <option value="">**Please select a role**</option>
								            @foreach($users_roles as $user_role)
								              <option {{($user_role->id==$role->role_id)?"selected":""}} value="{{$user_role->id}}">{{$user_role->name}}</option>
								            @endforeach
								          </select>
								        </div>
											 </div>
											<div class="form-group">
													<div class="col-md-6 col-md-offset-4">
															<button type="submit" class="btn btn-primary">
																	Update
															</button>
													</div>
											</div>
									</form>
							</div>
					</div>
			</div>
	</div>
@endsection
