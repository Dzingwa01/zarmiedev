@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
    <div class="container-fluid box box-success">
        <div class="row">
            <div class="pull-left">
                <h5>Edit Drink</h5>
            </div>
            <div class="pull-right" style="margin-top:1em;">
                <a class="btn btn-primary" href="{{ route('drinks.index') }}"> Back</a>
            </div>
        </div>
        <div class="row">
            <form class="col s12" role="form" enctype="multipart/form-data" method="POST"
                  action="{{ url('/drinks/update/'.$drink->id) }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="input-field col s6 offset-m2">
                        <input placeholder="Drink Name" id="name" name="name" type="text" class="validate"
                               value="{{$drink->name}}"
                               required>
                        <label for="name">Name</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6 offset-m2">
                        <select id="category_id" name="category_id">
                            <option value="">**Please select drink category**</option>
                            @foreach($categories as $category)
                                <option {{$category->id==$drink->category_id?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row" id="">
                    <div class="input-field col s6 offset-m2">
                        <input id="prize" name="prize" placeholder="Drink Prize" type="number" step="0.01"
                               value="{{$drink->prize}}"
                               class="validate" required>
                        <label for="prize">Drink Prize</label>
                    </div>
                </div>
                <div class="row" id="">
                    <div class="input-field col s6 offset-m2">
                        <input id="size" name="size" placeholder="Drink Size" type="number" step="0.01"
                               value="{{$drink->size}}"
                               class="validate" required>
                        <label for="size">Drink Size</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s6 offset-m2">
                        <label for="category_image">Drink Image</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s6 offset-m2">
                        <img id="cat_image" src="{{URL::asset($drink->image_url)}}" class="img-responsive"/>
                    </div>
                </div>
                <div class="row">

                    <div class="input-field col s6 offset-m2">

                        <input id="picture" name="picture" type="file" class="validate" onchange="preview_file()"
                               accept="image/*" >
                        <!-- <label for="category_image">Image</label> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary"><i class="material-icons left">add</i>
                            Save
                        </button>
                    </div>
                    <div>
                        {{-- <a class="btn" style="margin-left:12em!important;"   onclick="add_category()"> Save</a> --}}
                    </div>
                </div>
            </form>
        </div>

    </div>
    @endsection
    @push('custom-scripts')
    {{--<script src="https://code.jquery.com/jquery-3.3.1.min.js"--}}
    {{--integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="--}}
    {{--crossorigin="anonymous"></script>--}}
    <script src="/js/materialize.js"></script>
    <script src="/js/init.js"></script>
    <link href="/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.js"></script>
<script>
    function preview_file(){
        var preview = document.getElementById("cat_image"); //selects the query named img
        var file    = document.querySelector('input[type=file]').files[0]; //sames as here
        var reader  = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file); //reads the data as a URL
        } else {
            preview.src = "";
        }
    }
</script>
    @endpush