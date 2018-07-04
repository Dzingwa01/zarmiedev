@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
    <div class="container-fluid box box-success">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h5>Menu Category Details</h5>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('manage_category_menus') }}"> Back</a>
                </div>
            </div>
        </div>
<form class="col s12" method='post' enctype="multipart/form-data">
    <input type="hidden" name="_token" value={{csrf_token()}} >
    <div class="row">
        <div class="input-field col s6 offset-m2">
            <input placeholder="Category Name" id="category_name" name="category_name" type="text" value="{{$categories->category_name}}"
                   class="validate" required>
            <label for="first_name">Category</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6 offset-m2">
            <input id="category_description" name="category_description" placeholder="Category Description" value="{{$categories->description}}"
                   type="text" class="validate" required>
            <label for="category_description">Description</label>
        </div>
    </div>
    <div class="row">
        <div class="col s6 offset-m2">
            <label  for="category_image">Category Image</label>
        </div>
    </div>
    <div class="row">
        <div class="col s6 offset-m2">
            <img id="cat_image" src="{{URL::asset($categories->picture_url)}}" class="img-responsive"/>
        </div>
    </div>

</form>
    </div>
    @push('custom-scripts')
    <link href="/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    {{--<script src="https://code.jquery.com/jquery-3.3.1.min.js"--}}
    {{--integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="--}}
    {{--crossorigin="anonymous"></script>--}}
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8"
            src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
    <script src="/js/materialize.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.js"></script>
    <script src="/js/init.js"></script>
    @endpush
    @endsection