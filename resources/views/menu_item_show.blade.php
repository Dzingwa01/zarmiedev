@extends('layouts.admin_template')

@section('content')
  <div class="container" style="margin-top:8em;">
    <div class="row">
      <div class="col-lg-12 margin-tb">
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
          {!!$item_ingredient->name!!}
        @endforeach
      </div>
    </div>
  </div>
@endsection
