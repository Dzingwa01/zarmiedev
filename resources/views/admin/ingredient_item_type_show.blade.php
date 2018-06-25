@extends('layouts.admin_template')

@section('content')
  <div class="container" style="margin-top:8em;">
    <div class="row">
      <div class="col-lg-12 margin-tb">
        <div class="pull-left">
          <h5> Ingredient Type Details</h5>
        </div>
        <div class="pull-right">
          <a class="btn btn-primary" href="{{ route('ingredient_type_home') }}"> Back</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Name:</strong>
          {{ $ingredient_item->type_name }}
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Description:</strong>
          {{ $ingredient_item->description }}
        </div>
      </div>

    </div>
  </div>
@endsection
