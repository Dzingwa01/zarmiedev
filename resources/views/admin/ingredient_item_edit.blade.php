@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')

    <div class="container-fluid box box-success">
        <div class="row">

            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h5>Edit Ingredient</h5>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('manage_ingredients') }}"> Back</a>
                    </div>
                </div>
            </div>
            <form class="form-horizontal" role="form" method="POST"
                  action="{{ url('ingredient/update/'.$ingredient->id) }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name" class="col-md-4 control-label">Ingredient Name</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name"
                               value="{{$ingredient->name}}" required autofocus>

                    </div>
                </div>
                <div class="form-group">
                    <label for="item_description" class="col-md-4 control-label">Ingredient Description</label>
                    <div class="col-md-6">
                                <textarea id="item_description" name="description"
                                          class="form-control materialize-textarea" value="" required rows="4"
                                          col="5">{{$ingredient->description}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-md-4 control-label">Ingredient Prize</label>
                    <div class="col-md-6">
                        <input id="prize" type="text" class="form-control" name="prize"
                               value="{{$ingredient->prize}}" required autofocus>

                    </div>
                </div>
                <div class="form-group">
                    <label for="ingredient_type_id" class="col-md-4 control-label">Ingredient Type</label>
                    <div class="col-md-6">
                        <select id="ingredient_type_id" name="ingredient_type_id"  required>
                            <option value="">**Please select a ingredient type**</option>
                            @foreach($item_types as $item_type)
                                <option {{($item_type->id==$ingredient->ingredient_type_id)?"selected":""}} value="{{$item_type->id}}">{!!$item_type->type_name!!}</option>
                            @endforeach
                        </select>
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
    @push('custom-scripts')
        {{--<script src="https://code.jquery.com/jquery-3.3.1.min.js"--}}
        {{--integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="--}}
        {{--crossorigin="anonymous"></script>--}}
        <link href="/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <script src="/js/materialize.js"></script>
        <script src="/js/init.js"></script>
        <script>
            $(document).ready(function () {
                $('#ingredient_type_id').material_select();
            });
        </script>
    @endpush
@endsection
