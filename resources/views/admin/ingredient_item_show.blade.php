@extends('adminlte::layouts.app')

@section('htmlheader_title')
  {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
  <div class="container-fluid box box-success">

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
          <strong>Sandwich Price:</strong>
          {{$ingredient_item->prize}}
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Medium Sub Price:</strong>
          {{$ingredient_item->medium_prize}}
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Large Sub Price:</strong>
          {{$ingredient_item->large_prize}}
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Wrap Price:</strong>
          {{$ingredient_item->wrap_prize}}
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Ingredient Type Name:</strong>
         {{$item_types->type_name}}

        </div>
      </div>
    </div>
  </div>
  @push('custom-scripts')
  {{--<script src="https://code.jquery.com/jquery-3.3.1.min.js"--}}
  {{--integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="--}}
  {{--crossorigin="anonymous"></script>--}}
  <script src="/js/materialize.js"></script>
  <script src="/js/init.js"></script>
  <link href="/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  @endpush
@endsection
