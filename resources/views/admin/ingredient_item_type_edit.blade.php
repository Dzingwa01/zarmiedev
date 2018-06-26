@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')

    <div class="container-fluid box box-success">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h5>Edit Ingredient Type</h5>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('ingredient_type_home') }}"> Back</a>
                </div>
            </div>
        </div>
        <form class="form-horizontal" role="form" method="POST"
              action="{{ url('ingredient_type/update/'.$ingredient->id) }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Ingredient Name</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="type_name"
                           value="{{$ingredient->type_name}}" required autofocus>

                </div>
            </div>
            <div class="form-group">
                <label for="item_description" class="col-md-4 control-label">Description</label>
                <div class="col-md-6">
                    <textarea id="item_description" name="description" class="form-control materialize-textarea"
                              required rows="4" col="5">{{$ingredient->description}}</textarea>
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
    @push('custom-scripts')
    {{--<script src="https://code.jquery.com/jquery-3.3.1.min.js"--}}
    {{--integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="--}}
    {{--crossorigin="anonymous"></script>--}}
    <script src="/js/materialize.js"></script>
    <script src="/js/init.js"></script>
    <link href="/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    @endpush
@endsection
