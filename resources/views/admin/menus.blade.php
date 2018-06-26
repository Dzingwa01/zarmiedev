@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
    <div class="container-fluid box box-success">
        @if (session('status'))
            <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('status') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col m3">
                <a id="add_menu" style="margin-top: 1em;" class="btn" data-toggle="modal" data-target="#add_menu_popup"><i
                            class="fa fa-plus"></i>Add Menu Item</a><br/>
            </div>
            <br>
        </div>
        <div class="row">

            <div class="col m12">
                <table class="table table-bordered" id="menu-table">
                    <thead>
                    <tr>
                        <th>Item Number</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Size</th>
                        <th>Prize</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div id="add_category_popup" class="modal" role="dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title center">Add Menu Category</h4>
        </div>
        <div class="modal-body">
            <form class="col s12" method='post' enctype="multipart/form-data" action='/save_category'>
                <input type="hidden" name="_token" value={{csrf_token()}} >
                <div class="row">
                    <div class="input-field col s6 offset-m2">
                        <input placeholder="Category Name" id="category_name" name="category_name" type="text"
                               class="validate" required>
                        <label for="first_name">Category</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 offset-m2">
                        <input id="category_description" name="category_description" placeholder="Category Description"
                               type="text" class="validate" required>
                        <label for="category_description">Description</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 offset-m2">
                        <label>Category Image</label>
                        <input id="category_image" name="category_image" type="file" class="validate" required>
                        <!-- <label for="category_image">Image</label> -->
                    </div>
                </div>
                <div>
                    <input class="btn" type='submit' style="margin-left:12em!important;" value='Save'>
                </div>
            </form>
        </div>

    </div>
    <div id="add_menu_popup" class="modal" role="dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title center">Add Menu Item</h4>
        </div>
        <div class="modal-body">
            <form id='add_menu_item' class="col s12" role="form" method="POST">
                <meta name="_token" content="{{ csrf_token() }}">
                <div class="row">
                    <div class="input-field col s6 offset-m2">
                        <input placeholder="Item Name" id="item_number" name="item_number" type="text" class="validate"
                               required>
                        <label for="item_number">Item Number</label>
                    </div>
                    <div class="input-field col s6 offset-m2">
                        <input placeholder="Item Name" id="item_name" name="item_name" type="text" class="validate"
                               required>
                        <label for="item_name">Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 offset-m2">
                        <textarea id="item_description" name="item_description" placeholder="Enter item description"
                                  class="materialize-textarea" required></textarea>
                        <label for="item_description">Description</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6 offset-m2">
                        <input id="sandwich_prize" name="item_prize" placeholder="Item Prize" type="number" step="0.01"
                               class="validate" required>
                        <label for="sandwich_prize">Sandwich Prize</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6 offset-m2">
                        <input id="medium_sub" name="item_prize" placeholder="Item Prize" type="number" step="0.01"
                               class="validate" required>
                        <label for="medium_sub">Medium Sub Prize</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6 offset-m2">
                        <input id="large_sub_prize" name="item_prize" placeholder="Item Prize" type="number" step="0.01"
                               class="validate" required>
                        <label for="large_sub_prize">Large Sub Prize</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6 offset-m2">
                        <input id="wrap_prize" name="item_prize" placeholder="Item Prize" type="number" step="0.01"
                               class="validate" required>
                        <label for="wrap_prize">Wrap Prize</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6 offset-m2">
                        <select id="item_category" name="item_category" required>
                            <option value="">**Please select a category**</option>
                            @foreach($menu_categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr/>
                <h5>Ingredients</h5>
                <div class="row">

                    <div class="input-field col s4">
                        <div id="ingredients_div" class="input-field"><select id="ingredients" name="'ingredients'"
                                                                              onchange="select_ingredient()">
                                <option value="">**Please select an ingredient**</option>
                            </select></div>
                    </div>
                    <div id='ingredients_list' class="col s8">

                    </div>
                </div>

                <hr/>
                <div class="row">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary"><i class="material-icons left">add</i>
                            Save
                        </button>
                    </div>
                    <div>

                    </div>
                </div>
            </form>
        </div>

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
    <script src="js/materialize.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.js"></script>
    <script src="js/init.js"></script>
    <script>
        $(document).ready(function () {
            $('select').material_select();
            $("#add_category").on('click', function () {

                $("#add_category_popup").modal('show');
            });
            $("#add_menu").on('click', function () {

                $("#add_menu_popup").modal('show');
            });
            $(".alert").fadeTo(2000, 500).slideUp(500, function(){
                $(".alert").slideUp(500);
            });
            $.get("/get_ingredients", function (data) {
                console.log("Check me");
                var id_local = "#ingredients";
                var results = data.ingredients;
                console.log("results", data);
                $.each(results, function (idx, obj) {
                    $(id_local).append("<option value=" + obj.id + ">" + obj.name + "</option>");
                });
                $('select').material_select();
                $(id_local).trigger('contentChanged');
                $(id_local).on('contentChanged', function () {
                    $(this).material_select();
                });

            });

            $('#add_menu_item').submit(function (e) {
                e.preventDefault();
                var ingredient_ids = '';
                var formData = new FormData();
                formData.append('item_number', $('#item_number').val());
                formData.append('item_name', $('#item_name').val());
                formData.append('description', $('#item_description').val());
                formData.append('category_id', $('#item_category').val());
                formData.append('_token', $('input[name="_token"]').val());
                formData.append('sandwich_prize',$('#sandwich_prize').val());
                formData.append('medium_sub',$('#medium_sub').val());
                formData.append('large_sub_prize',$('#large_sub_prize').val());
                formData.append('wrap_prize',$('#wrap_prize').val());
                var count = 0;
                $(".ingr").each(function (idx, obj) {
                    count += 1;
                    formData.append('ingredients_array[]', obj.id);
                });
                $.ajax({
                    url: "{{ route('add_menu_item') }}",
                    processData: false,
                    contentType: false,
                    data: formData,
                    type: 'post',

                    success: function (response, a, b) {
                         console.log("success",response);
//                        $("#add_menu_popup").modal('hide');
                        window.location.reload();
                    },
                    error: function (response) {
                        console.log("error",response);
                        window.location.reload();
//                        $("#add_menu_popup").modal('hide');
                    }
                });
            });
        });

        function add_category() {

        }

        function select_ingredient() {
            var selected_ingredient = $('#ingredients').val();
            var selected_ingredient_text = $("#ingredients option:selected").text();
            var html_string = '<div id="' + selected_ingredient + '"  class="col s3 well" style="margin-left:1em;"><p id="' + selected_ingredient + '" class="ingr" style="font-weight:bolder;" ><span id="' + selected_ingredient + '" class="material-icons close" style="cursor:pointer;" onclick="remove_ingredient(this)">close</span>' + selected_ingredient_text + '</p></div>';
            $('#ingredients_list').append(html_string);


        }

        function remove_ingredient(obj) {
            $('#' + obj.id).remove();
        }
    </script>
    <script>

        $(function () {
            $('#menu-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('menu_items')}}',
                columns: [
                    {data: 'item_number', name: 'item_number'},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'category_name', name: 'category_name'},
                    {data: 'size_name', name: 'size_name'},
                    {data: 'prize', name: 'prize'},
                    {data: 'created_at', name: 'menu_item.created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
//                $('select[name="menu-table_length"]').css("display","inline");
        });
    </script>
    @endpush
@endsection
