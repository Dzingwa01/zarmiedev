@extends('layouts.admin_template')

@section('content')
	<div class="row" style="margin-top:8em;">
			<div class="col-md-8 col-md-offset-2">
					<div class="panel panel-default">
							<div class="panel-heading">Edit Menu Item</div>
							<div class="panel-body">
									<form class="form-horizontal" role="form" method="POST" action="{{ url('menu/update/'.$menu_item->id) }}">
											{{ csrf_field() }}
											<div class="form-group">
													<label for="item_number" class="col-md-4 control-label">Item Number</label>
													<div class="col-md-6">
															<input id="item_number" type="text" class="form-control" name="item_number" value="{{$menu_item->item_number}}" required autofocus>

													</div>
											</div>
											<div class="form-group">
													<label for="name" class="col-md-4 control-label">Item Name</label>
													<div class="col-md-6">
															<input id="name" type="text" class="form-control" name="name" value="{{$menu_item->name}}" required autofocus>

													</div>
											</div>
                      <div class="form-group">
													<label for="item_description" class="col-md-4 control-label">Item Description</label>
													<div class="col-md-6">
														<textarea id="item_description" name="description" class="form-control materialize-textarea" value="" required rows="4" col="5">{{$menu_item->description}}</textarea>
													</div>
											</div>
                      <div class="form-group">
                        <label for="item_category" class="col-md-4 control-label">Item Category</label>
                        <div class="col-md-6">
                          <select id="item_category" name="item_category" required>
                            <option value="">**Please select item category**</option>
                            @foreach($item_categories as $item_category)
                              <option >{!!$item_category->category_name!!}</option>
                            @endforeach
                          </select>
                        </div>
                       </div>
                      <div class="form-group">
                        <label for="item_size" class="col-md-4 control-label">Item Size</label>
                        <div class="col-md-6">
                          <select id="item_size" name="item_size" required>
                            <option value="">**Please select item size**</option>
                            @foreach($item_sizes as $item_size)
                              <option {{($item_size->id==$menu_item->item_size_id)?"selected":""}} value="{{$item_size->id}}">{{$item_size->size_name}}</option>
                            @endforeach
                          </select>
                        </div>
                       </div>
                       <div class="form-group">
                           <label for="name" class="col-md-4 control-label">Item Prize</label>
                           <div class="col-md-6">
                               <input id="prize" type="text" class="form-control" name="prize" value="{{$menu_item->prize}}" required autofocus>

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
