@extends('adminlte::layouts.app')

@section('htmlheader_title')
  {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
  <div class="container-fluid box box-success">
    @if (session('status'))
      <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('status') }}
      </div>
    @elseif(session('error'))
      <div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('error') }}
      </div>
    @endif
    <div class="row">
      <div class="col m3">
        <a id="add_menu" class="btn" style="margin-top: 1em;" data-toggle="modal" data-target="#add_ingredient_popup"  ><i class="material-icons">add</i>Add Ingredient Type</a>
      </br>
    </br>
    </div>
  <div class="col m12">
    <table class="table table-bordered" id="menu-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
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
    <h4 class="modal-title center">Add Ingredient Item Type</h4>
  </div>
  <div class="modal-body">
    <form class="col s12" role="form" method="POST" action="{{ route('add_ingredient_type') }}">
          {{ csrf_field() }}
      <div class="row">
        <div class="input-field col s6 offset-m2">
          <input placeholder="Item Name" id="item_name" name="item_name" type="text" class="validate" required>
          <label for="item_name">Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 offset-m2">
          <textarea id="item_description" name="item_description" placeholder="Enter item description" class="materialize-textarea"></textarea>
          <label for="item_description">Description</label>
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
  @push('custom-scripts')
    <link href="/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8"
            src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
<script>
$(document).ready(function(){


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

$(function() {
  $('#menu-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{route('ingredient_item_types')}}',
    columns: [
      { data: 'type_name', name: 'type_name' },
      { data: 'description', name: 'description' },
      { data: 'created_at', name: 'created_at' },
      {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });
    $('select').material_select();
    $(".alert").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
    });
});
</script>

  @endpush
@endsection
