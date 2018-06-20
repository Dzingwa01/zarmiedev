@extends('order_processing')
@section('content')
 <div class="container">
        @foreach ($categories as $category)
          <div class="col-md-12 col-sm-12 col-xs-12" >
            <div style="margin:auto;width:50%;">
              <center>
                <img title='{{$category->category_name}}' src='{{$category->picture_url}}' style = "align:center; margin-top:2em; important; width: 300px;height:62px"/>
              </center>
            </div>
            <table id="{{$category->id}}" class="table table-hover table-sm table-striped">
              <thead>
                <tr><th>Item Number</th><th>Name</th><th>Sandwich</th><th>Medium Sub</th><th>Large Sub</th><th>Wrap</th></tr>
              </thead>
              <tbody>
              </tbody>
            </table>

          </div>
        @endforeach
      </div>

@endsection