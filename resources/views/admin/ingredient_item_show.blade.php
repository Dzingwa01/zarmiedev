@extends('layouts.admin_template')

@section('content')
  <div class="container" style="margin-top:8em;">
    <div class="row">
      <div class="col-lg-12 margin-tb">
        <div class="pull-left">
          <h5> Ingredient Item Details</h5>
        </div>
        <div class="pull-right">
          <a class="btn btn-primary" href="{{ route('manage_ingredients') }}"> Back</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Name:</strong>
          {{ $ingredient_item->name }}
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Description:</strong>
          {{ $ingredient_item->description }}
        </div>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Ingredient Price:</strong>
          {{$ingredient_item->prize}}
        </div>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Ingredient Item Name:</strong>
          {{$ingredient_item->type_name}}
        </div>
      </div>
    </div>
  </div>
@endsection
