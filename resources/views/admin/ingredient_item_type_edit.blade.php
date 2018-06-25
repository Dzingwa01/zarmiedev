@extends('layouts.admin_template')

@section('content')
	<div class="row" style="margin-top:8em;">
			<div class="col-md-8 col-md-offset-2">
					<div class="panel panel-default">
							<div class="panel-heading">Edit Ingredient Item</div>
							<div class="panel-body">
									<form class="form-horizontal" role="form" method="POST" action="{{ url('ingredient_type/update/'.$ingredient->id) }}">
											{{ csrf_field() }}
											<div class="form-group">
													<label for="name" class="col-md-4 control-label">Ingredient Name</label>
													<div class="col-md-6">
															<input id="name" type="text" class="form-control" name="type_name" value="{{$ingredient->type_name}}" required autofocus>

													</div>
											</div>
                      <div class="form-group">
													<label for="item_description" class="col-md-4 control-label">Description</label>
													<div class="col-md-6">
														<textarea id="item_description" name="description" class="form-control materialize-textarea"  required rows="4" col="5">{{$ingredient->description}}</textarea>
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
