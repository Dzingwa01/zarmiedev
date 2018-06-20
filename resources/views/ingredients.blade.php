
@extends('layouts.admin_template')
@section('content')

  <div class="container-fluid" style="margin-top:10em;">
    <div class="row">
      <div class="col m3">
        <a id="add_menu" class="btn"  data-toggle="modal" data-target="#add_ingredient_popup"  ><i class="material-icons">add</i>Add Ingredient</a>
      </br>
    </br>
    </div>
  <div class="col m9">
    <table class="table table-bordered" id="menu-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Prize</th>
          <th>Created At</th>
        <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
</div>

<div id="add_ingredient_popup" class="modal" role="dialog">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title center">Add Ingredient Item</h4>
  </div>
  <div class="modal-body">
    <form class="col s12" role="form" method="POST" action="{{ route('add_ingredient') }}">
          {{ csrf_field() }}
      <div class="row">
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
          <input id="item_prize" name="item_prize" placeholder="Item Prize" type="number" step="0.01" class="validate" required>
          <label for="item_prize">Prize</label>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary"><i class="material-icons left">add</i>
                Save
            </button>
        </div>
        <div>
          {{-- <a class="btn" style="margin-left:12em!important;"   onclick="add_category()"> Save</a> --}}
        </div>
      </div>
    </form>
  </div>

</div>
<script>
$(document).ready(function(){
  for(i=0;i<4;i++){
    $('select').material_select();
  }
    $('select').material_select();
  $("#add_category").on('click',function(){

    $("#add_category_popup").modal('show');
  });
  $("#add_menu").on('click',function(){

    $("#add_menu_popup").modal('show');
  });
});
function add_category(){
  alert('Coming Soon');
}
</script>
<script>

$(function() {
  $('#menu-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{route('ingredient_items')}}',
    columns: [
      { data: 'name', name: 'name' },
      { data: 'description', name: 'description' },
      { data: 'prize', name: 'prize' },
      { data: 'created_at', name: 'created_at' },
      {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });
});
</script>
@endsection
