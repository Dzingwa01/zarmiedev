@extends('layouts.admin_template')

@section('content')
	<div class="row" style="margin-top:8em;">
			<div class="col-md-8 col-md-offset-2">
					<div class="panel panel-default">
							<div class="panel-heading">Edit Ingredient Item</div>
							<div class="panel-body">
									<form class="form-horizontal" role="form" method="POST" action="{{ url('ingredient/update/'.$ingredient->id) }}">
											{{ csrf_field() }}
											<div class="form-group">
													<label for="name" class="col-md-4 control-label">Ingredient Name</label>
													<div class="col-md-6">
															<input id="name" type="text" class="form-control" name="name" value="{{$ingredient->name}}" required autofocus>

													</div>
											</div>
                      <div class="form-group">
													<label for="item_description" class="col-md-4 control-label">Ingredient Description</label>
													<div class="col-md-6">
														<textarea id="item_description" name="description" class="form-control materialize-textarea" value="" required rows="4" col="5">{{$ingredient->description}}</textarea>
													</div>
											</div>

                       <div class="form-group">
                           <label for="name" class="col-md-4 control-label">Ingredient Prize</label>
                           <div class="col-md-6">
                               <input id="prize" type="text" class="form-control" name="prize" value="{{$ingredient->prize}}" required autofocus>

                           </div>
                       </div>
											 <div class="row">
								         <div class="input-field col s6 offset-m4">
								           <select id="ingredient_type_id" name="ingredient_type_id" required>
								             <option value="">**Please select a ingredient type**</option>
								             @foreach($item_types as $item_type)
															 <option {{($item_type->id==$ingredient->ingredient_type_id)?"selected":""}} value="{{$item_type->id}}">{!!$item_type->type_name!!}</option>
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
