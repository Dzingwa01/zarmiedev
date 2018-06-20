
@extends('layouts.admin_template')
@section('content')

  <div class="container-fluid" style="margin-top:10em;">
    <div class="row">
      <div class="col m3">
        <a id="add_menu" class="btn"  data-toggle="modal" data-target="#add_menu_popup"  ><i class="material-icons">add</i>Add Menu Item4</a>
      </br>
    </br>
    <a id="add_category" class="btn"  data-toggle="modal" data-target="#add_category_popup"><i class="material-icons">add</i>Add Category</a>
  </br>
</br>
<a  class="btn"  href="{{route('manage_ingredients')}}"><i class="material-icons">add</i>Ingredients</a>

</div>
<div class="col m9">
  <table class="table table-bordered" id="menu-table">
    <thead>
      <tr>
        <th>Item Number</th>
        <th>Name</th>
        <th>Description</th>
        <th>Category</th>
        <th>Size</th>
        <th>Prize</th>
        <th>Created At</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
</div>
</div>
</div>
<div id="add_category_popup" class="modal" role="dialog">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title center">Add Menu Categoryg</h4>
  </div>
  <div class="modal-body">
    <form class="col s12" method='post' enctype="multipart/form-data" action='/save_category'>
      <input type="hidden" name="_token" value={{csrf_token()}} >
      <div class="row">
        <div class="input-field col s6 offset-m2">
          <input placeholder="Category Name" id="category_name" name="category_name" type="text" class="validate" required>
          <label for="first_name">Category</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 offset-m2">
          <input id="category_description" name="category_description" placeholder="Category Description"  type="text" class="validate" required>
          <label for="category_description">Description</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 offset-m2">
          <label>Category Image</label>
          <input id="category_image" name="category_image" type="file" class="validate" required>
          <!-- <label for="category_image">Image</label> -->
        </div>
      </div>
      <div>
        <input class="btn" type='submit' style="margin-left:12em!important;" value='Save'>
      </div>
    </form>
  </div>

</div>
<div id="add_menu_popup" class="modal" role="dialog">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title center">Add Menu Item4</h4>
  </div>
  <div class="modal-body">
    <form class="col s12" role="form" method="POST" action="{{ route('add_menu_item') }}">
      {{ csrf_field() }}
      <div class="row">
        <div class="input-field col s6 offset-m2">
          <input placeholder="Item Name" id="item_number" name="item_number" type="text" class="validate" required>
          <label for="item_number">Item Number3</label>
        </div>
        <div class="input-field col s6 offset-m2">
          <input placeholder="Item Name" id="item_name" name="item_name" type="text" class="validate" required>
          <label for="item_name">Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 offset-m2">
          <textarea id="item_description" name="item_description" placeholder="Enter item description" class="materialize-textarea" required></textarea>
          <label for="item_description">Description</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 offset-m2">
          <select id="item_size" name="item_size" required>
            <option value="">**Please select a size**</option>
            @foreach($item_sizes as $size)
              <option value="{{$size->id}}">{{$size->size_name}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 offset-m2">
          <select id="item_category" name="item_category" required>
            <option value="">**Please select a category**</option>
            @foreach($menu_categories as $category)
              <option value="{{$category->id}}">{{$category->category_name}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 offset-m2">
          <input id="item_prize" name="item_prize" placeholder="Item Prize" type="number" step="0.01" class="validate" required>
          <label for="item_prize">Prize</label>
        </div>
      </div>
        <hr/>
                        <h5>Ingredients</h5>
											 <div class="row">
											    
											    	<div class="input-field col s4">
											    	    <i class="medium material-icons" style="cursor:pointer;" onclick="show_ingredients_select()">add</i>
												    	<div id="ingredients_div" class="input-field" ><select id="ingredients" name="'ingredients'" onchange="select_ingredient()" ><option value="" >**Please select an ingredient**</option></select></div>
												</div>
											     <div id='ingredients_list' class="col s7">
                                             
                                               </div>
											 </div>
										
											
											 <hr/>
      <div class="row">
        <div class="col-md-6 col-md-offset-4">
          <button type="submit" class="btn btn-primary"><i class="material-icons left">add</i>
            Saveer
          </button>
        </div>
        <div>
          
        </div>
      </div>
    </form>
  </div>

</div>
<script>
$(document).ready(function(){
  $('select').material_select();
  $("#add_category").on('click',function(){

    $("#add_category_popup").modal('show');
  });
  $("#add_menu").on('click',function(){

    $("#add_menu_popup").modal('show');
  });
 
  	  	$.post("/get_ingredients.php",function(data){
							var id_local="#ingredients";
							var results = JSON.parse(data);
							$.each(results, function (idx, obj) {
								$(id_local).append("<option value="+obj.id+">"+obj.name+"</option>");
							});
							$('select').material_select();
							$(id_local).trigger('contentChanged');
							$(id_local).on('contentChanged', function () {
								$(this).material_select();
							});
						
					});
});
function add_category(){

}
</script>
<script>

$(function() {
  $('#menu-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{route('menu_items')}}',
    columns: [
      { data: 'item_number', name: 'item_number' },
      { data: 'name', name: 'name' },
      { data: 'description', name: 'description' },
      { data: 'category_name', name: 'category_name' },
      { data: 'size_name', name: 'size_name' },
      { data: 'prize', name: 'prize' },
      { data: 'created_at', name: 'menu_item.created_at' },
      {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });
});
</script>
@endsection
