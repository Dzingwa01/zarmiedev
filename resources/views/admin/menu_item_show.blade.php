@extends('adminlte::layouts.app')

@section('htmlheader_title')
  {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
  <div class="container-fluid box box-success">
    <div class="row">
      <div class="col-lg-12">
        <div class="pull-left">
          <h5> Menu Item Details</h5>
        </div>
        <div class="pull-right">
          <a class="btn btn-primary" href="{{ route('manage_menus') }}"> Back</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Name:</strong>
          {{ $menu_item->name }}
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Description:</strong>
          {{ $menu_item->description }}
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Category:</strong>
          @foreach($categories as $category)
            {{($category->id==$menu_item->category_id)?$category->category_name:""}}
          @endforeach

        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Item Size:</strong>
          @foreach($item_sizes as $item_size)
            {{($item_size->id==$menu_item->item_size_id)?$item_size->size_name:""}}
          @endforeach
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>Item Price:</strong>
          {{$menu_item->prize}}
        </div>
      </div>
      <hr/>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <h5>Ingredients:</h5><br/>
        @foreach ($item_ingredients as $key => $item_ingredient)
          @foreach($ingredients as $ingredient)
            @if($ingredient->id==$item_ingredient->ingredient_id)
           <button class="glass">{!!$ingredient->name!!}</button>
            @endif
            @endforeach
        @endforeach
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
