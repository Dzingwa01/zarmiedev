@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')

    <div class="container-fluid box box-success">
        <h4>Edit Menu Item</h4>
        <form id='update_menu_item' class="form-horizontal" method="POST">
            <meta name="_token" content="{{ csrf_token() }}">
            <input id="item_id" value='{{$menu_item->id}}' hidden/>
            <div class="form-group">
                <label for="item_number" class="col-md-4 control-label">Item Number</label>
                <div class="col-md-6">
                    <input id="item_number" type="text" class="form-control" name="item_number"
                           value="{{$menu_item->item_number}}" required>

                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Item Name</label>
                <div class="col-md-6">
                    <input id="item_name" type="text" class="form-control" name="item_name"
                           value="{{$menu_item->name}}" required autofocus>

                </div>
            </div>
            <div class="form-group">
                <label for="item_description" class="col-md-4 control-label">Item Description</label>
                <div class="col-md-6">
                                <textarea id="item_description" name="description"
                                          class="form-control materialize-textarea" value="" required rows="4"
                                          col="5">{{$menu_item->description}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="item_category" class="col-md-4 control-label">Item Category</label>
                <div class="col-md-6">
                    <select id="item_category" name="item_category" required>
                        <option value="">**Please select item category**</option>
                        @foreach($item_categories as $item_category)
                            <option {{($item_category->id==$menu_item->category_id)?"selected":""}} value="{{$item_category->id}}">{!!$item_category->category_name!!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="sandwich_prize" class="col-md-4 control-label">Sandwich Prize</label>
                <div class="col-md-6">
                    @foreach($other_items as $other_item)
                        @if($other_item->item_size_id==1)
                            <input id="sandwich_prize" type="number" step='0.10' class="form-control"
                                   name="sandwich_prize" value="{{$other_item->prize}}" required autofocus>
                        @endif
                    @endforeach

                </div>
            </div>

            <div class="form-group">
                <label for="medium_sub" class="col-md-4 control-label">Medium Sub Prize</label>
                <div class="col-md-6">
                    @foreach($other_items as $other_item)
                        @if($other_item->item_size_id==2)
                            <input id="medium_sub" type="number" step='0.10' class="form-control"
                                   name="medium_sub" value="{{$other_item->prize}}" required autofocus>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label for="large_sub_prize" class="col-md-4 control-label">Large Sub Prize</label>
                <div class="col-md-6">
                    @foreach($other_items as $other_item)
                        @if($other_item->item_size_id==3)
                            <input id="large_sub_prize" type="number" step='0.10' class="form-control"
                                   name="large_sub_prize" value="{{$other_item->prize}}" required autofocus>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label for="wrap_prize" class="col-md-4 control-label">Wrap Prize</label>
                <div class="col-md-6">
                    @foreach($other_items as $other_item)
                        @if($other_item->item_size_id==4)
                            <input id="wrap_prize" type="number" step='0.10' class="form-control"
                                   name="wrap_prize" value="{{$other_item->prize}}" required autofocus>
                        @endif
                    @endforeach
                </div>
            </div>
            <hr/>
            <h5>Current Ingredients</h5>
            <div class="row">
                <div class="input-field col s4">
                    <i class="medium material-icons" style="cursor:pointer;"
                       onclick="show_ingredients_select()">add</i>
                    <div id="ingredients_div" class="input-field" hidden><select id="ingredients"
                                                                                 name="'ingredients'"
                                                                                 onchange="select_ingredient()">
                            <option value="">**Please select an ingredient**</option>
                        </select></div>
                </div>
                <div id='ingredients_list' class="col s7">
                    @foreach($ingredients as $ingredient)
                        <div id='{{$ingredient->id}}' class='col s3 well' style="margin-left:1em;"><p
                                    id='{{$ingredient->ingredient_id}}' class="ingr"
                                    style="font-weight:bolder;"><span id='{{$ingredient->id}}'
                                                                      class="material-icons close"
                                                                      style="cursor:pointer;"
                                                                      onclick="remove_ingredient(this)">close</span>{{$ingredient->ingredient->name}}
                            </p></div>
                    @endforeach
                </div>
            </div>


            <hr/>
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
        <link href="/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.js"></script>
        <script src="/js/materialize.js"></script>
        <script src="/js/init.js"></script>
    <script>
        $(document).ready(function () {
            $('select').material_select();
            $.get("/get_ingredients", function (data) {
                var id_local = "#ingredients";
                var results = data.ingredients;
                $.each(results, function (idx, obj) {
                    $(id_local).append("<option value=" + obj.id + ">" + obj.name + "</option>");
                });
                $('select').material_select();
                $(id_local).trigger('contentChanged');
                $(id_local).on('contentChanged', function () {
                    $(this).material_select();
                });

            });
            $('#update_menu_item').submit(function (e) {
                e.preventDefault();
                var ingredient_ids = '';
                var formData = new FormData();
                formData.append('item_number', $('#item_number').val());
                formData.append('item_id', $('#item_id').val());
                formData.append('item_name', $('#item_name').val());
                formData.append('item_number', $('#item_number').val());
                formData.append('item_description', $('#item_description').val());
                formData.append('item_category', $('#item_category').val());
                formData.append('wrap_prize', $('#wrap_prize').val());
                formData.append('large_sub_prize', $('#large_sub_prize').val());
                formData.append('medium_sub_prize', $('#medium_sub').val());
                formData.append('sandwich_prize', $('#sandwich_prize').val());
                formData.append('item_size', $('#item_size').val());
                formData.append('_token', $('input[name="_token"]').val());
                var count = 0;
                $(".ingr").each(function (idx, obj) {
                    count += 1;
                    formData.append('ingredients_array[]', obj.id);
                });
                $.ajax({
                    url: '{{ url('/menu/update/'.$menu_item->id) }}',
                    processData: false,
                    contentType: false,
                    data: formData,
                    type: 'post',
                    success: function (response, a, b) {
                        console.log(response);
                        $.notify('Menu Item saved successfully', {
                            type: "success",
                            align: "center",
                            verticalAlign: "middle",
                            animation: true,
                            animationType: "drop"
                        });
                        window.location.href = '/menus';
                    },
                    error: function (response) {
                        console.log(response);
                        $.notify('You can not save menu item without ingredients', {
                            type: "danger",
                            align: "center",
                            verticalAlign: "middle",
                            animation: true,
                            animationType: "drop"
                        });
                    }
                }).always(function () {

                });
            });
        });

        function show_ingredients_select() {
            $('#ingredients_div').show();

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
    @endpush
@endsection
