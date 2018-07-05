@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
    <div class="container-fluid box box-success">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h5>Topping Details</h5>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('manage_toppings') }}"> Back</a>
                </div>
            </div>
        </div>
        <form class="col s12" method='post' enctype="multipart/form-data" action="{{ url('topping/update/'.$topping->id) }}">
            <input type="hidden" name="_token" value={{csrf_token()}} >
            <div class="row">
                <div class="input-field col s6 offset-m2">
                    <input placeholder="Category Name" id="name" name="name" type="text" value="{{$topping->name}}"
                           class="validate" required>
                    <label for="first_name">Category</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 offset-m2">
                    <input id="description" name="description" placeholder="Category Description" value="{{$topping->description}}"
                           type="text" class="validate" required>
                    <label for="category_description">Description</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 offset-m2">
                    <input id="prize" name="prize" placeholder="Topping Prize" type="number" step="0.01" value="{{$topping->prize}}"
                           class="validate" required>
                    <label for="prize">Prize</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6 offset-m2">
                    <select id="category" name="category" required>
                        <option value="">**Please select topping category**</option>
                        <option value="standard" {{$topping->category =='standard'?'selected':'' }}>Standard - Free</option>
                        <option value="optional" {{$topping->category =='optional'?'selected':'' }}>Optional - Paid</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 offset-m2">
                <input class="btn" type='submit' style="margin-left:12em!important;" value='Update'>
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
    <script>
        $(document).ready(function(){
            $('select').material_select();
        });
    </script>
    @endpush
@endsection