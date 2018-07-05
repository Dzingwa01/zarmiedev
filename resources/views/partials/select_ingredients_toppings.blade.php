@extends('order_processing')
@section('content')
    <div class="container" style="margin-top:8em">

        <div class="row">

            <div class="col-sm-8">
                <form id="ingredients_toppings_form" col="col-md-12">
                    <fieldset>
                        <legend>Ingredients</legend>
                        {{--<p style="color:black;font-weight:bold;">Available Item ingredients - * Please select the ones--}}
                            {{--you want</p>--}}
                        {{--<div class="row" style="margin-top:2em;">--}}
                            {{--<div id='ingredients_list'>--}}

                            {{--</div>--}}
                        {{--</div>--}}
                        <p style="color:black;font-weight:bold;">Default Toppings(Free) - * Please remove the ones you don't want
                        <div class="row" style="margin-top:2em;">
                            <div id='standard_toppings'>
                                @if(count($standard_toppings)>0)
                                    @foreach($standard_toppings as $topping)
                                        <button id='{{'to_'.$topping->id}}' class="glass"
                                                style="font-weight:bolder;margin-left:1em;color:white;"
                                                onclick="ingredient_select_swap(this);">{{$topping->name}}  </button>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <p style="color:black;font-weight:bold;">Extra Toppings (Paid) - * Please select your choice - if any
                        <div class="row" style="margin-top:2em;">
                            <div id='optional_toppings'>
                                @if(count($optional_toppings)>0)
                                    @foreach($optional_toppings as $topping)
                                        <button id='{{'opt_'.$topping->id}}' class="glass"
                                                style="font-weight:bolder;margin-left:1em;color:white;"
                                                onclick="ingredient_select_swap(this);">{{$topping->name}}  </button>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <hr/>
                        <p style="color:black;font-weight:bold;">Do you want to swap ingredients?</p>
                        <p>
                            <input name="group01" class="bread" type="radio" value="no" id="no" checked/>
                            <label for="no">No</label>
                        </p>
                        <p>
                            <input name="group01" class="bread" type="radio" id="yes" value="yes"/>
                            <label for="yes">Yes</label>
                        </p>
                        <div id="select_swap">
                            <p style="color:black;font-weight:bold;">Select swap ingredients</p>
                            <div class="row" style="margin-top:2em;">
                                <div id='ingredients_list_swap'>
                                    @if(count($other_ingredients)>0)
                                        @foreach($other_ingredients as $ingredient)
                                            <button id='{{$ingredient->id}}' class="glass"
                                                    style="font-weight:bolder;margin-left:1em;color:white;"
                                                    onclick="ingredient_select_swap(this);">{{$ingredient->name}}  </button>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-sm-offset-2 col-sm-2" style="margin-top:1em;">
                                <button id='ingredient_toppings_back' class="btn waves-effect waves-light">Back</button>
                            </div>

                            <div class="col-sm-offset-1 col-sm-2" style="margin-top:1em;">
                                <button id='ingredient_toppings_next' class="btn waves-effect waves-light">Next</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="col-sm-4">
                <form>
                    <fieldset>
                        <legend>Order Cart</legend>
                        <div id='type'></div>
                        <div id='choice'>
                        </div>
                        <div id='item_bread'>
                        </div>
                        <div>
                            <h6 id="quantiy_header"><b>Quantity</b><a style="margin-left:1em;"><i
                                            onclick="increase_quantity()" class="fa fa-plus"></i> </a> <a
                                        id="decrease_el" style="margin-left:1em;"><i onclick="decrease_quantity()"
                                                                                     class="fa fa-minus"></i> </a></h6>
                            <div id="item_amount">

                            </div>
                        </div>
                        <div id='item_prize'></div>
                        <div id='item_ingredients'>
                            <h6><b>Ingredients - *You can select to remove</b></h6>

                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
        <div hidden>
            @if(count($ingredients)>0)
                @foreach($ingredients as $ingredient)
                    <button
                            style="font-weight:bolder;margin-left:1em;color:white;"
                            >{{$ingredient->ingredient->name}}  </button>
                @endforeach
            @endif
        </div>
    </div>
    <div id="swap_ingredients" class="modal">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Swap Ingredients</h4>
        </div>
        <div class="modal-body">
            <p style="color:black;">Please select ingredient you would want to swap with: <span id="swap_name"></span>
            </p>
            <form id="order_completion_form" col="col-md-10">
                <fieldset>
                    <legend>Current Ingredients</legend>
                    <div id="item_swap_ingredients" class="row">

                    </div>

                </fieldset>

            </form>
        </div>


    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        window.indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB ||
            window.msIndexedDB;

        window.IDBTransaction = window.IDBTransaction || window.webkitIDBTransaction ||
            window.msIDBTransaction;
        window.IDBKeyRange = window.IDBKeyRange ||
            window.webkitIDBKeyRange || window.msIDBKeyRange

        if (!window.indexedDB) {
            window.alert("Your browser doesn't support a stable version of IndexedDB.")
        }
        var db;
        var request = window.indexedDB.open("order_cart", 1);
        request.onerror = function (event) {
            console.log("error: ", event);
        };

        request.onsuccess = function (event) {
            db = event.target.result;
            addDefault();
            readAll(db);
        };
        request.onupgradeneeded = function (event) {
            db = event.target.result;
            var transaction = event.target.transaction;
            var objectStore = db.createObjectStore("selected_ingredients", {keyPath: "id", autoIncrement: true});
            transaction.oncomplete = function (event) {
                addDefault();
                readAll(db);
            }
        }

        function addIngredient(ingredient_id, ingredient_name, ingredient_prize,ingredient_type_id) {
            var request = db.transaction(["selected_ingredients"], "readwrite")
                .objectStore("selected_ingredients")
                .add({id: ingredient_id, name: ingredient_name, prize: ingredient_prize,ingredient_type_id:ingredient_type_id.toString()});

            request.onsuccess = function (event) {
                console.log("ingredient addedd");
            }
            request.onerror = function (event) {
                console.log("error", event);
            }
        }
        function count_ingredients(db){
            var objectStore = db.transaction(["selected_ingredients"], "readwrite").objectStore("selected_ingredients");
            var countRequest = objectStore.count();
            console.log("count req",countRequest);
            countRequest.onsuccess = function(){
               var count = countRequest.result;
                if(count>0){
                    var link_to = sessionStorage.getItem('item_id');
                    window.location.href = '/address_selection/' + link_to;
                }else{
                    alert("Please select the ingredients you want");
                }
            }
        }
        function readAll(db) {
//           console.log("rading all");
            var objectStore = db.transaction(["selected_ingredients"], "readwrite").objectStore("selected_ingredients");
            objectStore.openCursor().onsuccess = function (event) {
                var cursor = event.target.result;
                var ingredients = {!! $ingredients !!};
                if (cursor) {
                    for (var i = 0; i < ingredients.length; i++) {
                        if (ingredients[i].ingredient.id == cursor.value.id) {
                            $("#" + cursor.value.id).remove();
                        }
                    }
                    $('#item_ingredients').append('<button id=' + cursor.value.id + ' onclick="ingredient_select_reverse(this);"  class="glass" style="font-weight:bolder;margin-left:1em;color:white;">' + cursor.value.name + '</button>');
                    cursor.continue();
                } else {
                }
            };
        }
        function removeIngredient(ingredient_id) {
            var request = db.transaction(["selected_ingredients"], "readwrite")
                .objectStore("selected_ingredients")
                .delete(ingredient_id);

            request.onsuccess = function (event) {
                console.log("ingredient removed", event);
            }
            request.onerror = function (event) {
                console.log("error", event);
            }
        }
        function decrease_quantity() {
            $('#item_amount').empty();
            var quantity = sessionStorage.getItem('quantity');
            var new_qty = Number(quantity) - 1;
            if (new_qty > 1) {
                $("#decrease_el").show();
            }
            else {
                $("#decrease_el").hide();
            }

            $('#item_amount').append('<h6> <b>' + new_qty + '</h6>');
            sessionStorage.setItem('quantity', new_qty);
            var item_prize = Number(sessionStorage.getItem("item_category_price")).toFixed(2);
            var total_due = Number(item_prize * new_qty).toFixed(2);
            sessionStorage.setItem('total_due', total_due);
            $('#item_prize').empty();
            $('#item_prize').append('<h6> <b>Prize - </b>R' + total_due + '</h6>');
        }
        function increase_quantity() {
            $('#item_amount').empty();
            var quantity = sessionStorage.getItem('quantity');
            var new_qty = Number(quantity) + 1;
            if (new_qty > 1) {
                $("#decrease_el").show();
            }
            else {
                $("#decrease_el").hide();
            }

            $('#item_amount').append('<h6> <b>' + new_qty + '</h6>');
            sessionStorage.setItem('quantity', new_qty);
            var item_prize = Number(sessionStorage.getItem("item_category_price")).toFixed(2);
            var total_due = Number(item_prize * new_qty).toFixed(2);
            sessionStorage.setItem('total_due', total_due);
            $('#item_prize').empty();
            $('#item_prize').append('<h6> <b>Prize - </b>R' + total_due + '</h6>');
        }
        function addDefault(){
            var ingredients = {!! json_encode($ingredients) !!};
            console.log("ingredients",ingredients);
            for (var i = 0; i < ingredients.length; i++) {
                    addIngredient(ingredients[i].id, ingredients[i].ingredient.name, ingredients[i].ingredient.prize,ingredients[i].ingredient.ingredient_type_id);
//                    $('#item_ingredients').append('<button id=' + ingredients[i].id + ' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" onclick="ingredient_select_reverse(this);" >' + ingredients[i].ingredient.name + '</button>');
            }
        }
        var item_number = sessionStorage.getItem('item_name');
        $(document).ready(function () {
            if(sessionStorage.getItem("prev_swap_choice")=="no"){
                $("#select_swap").hide();
                $("#no").prop("checked",true);
            }
            else{
                $("#select_swap").show();
                $("#yes").prop("checked",true);
            }

            $('input:radio').click(function () {
                var swap_choice = $(this).val();
                if (swap_choice == "yes") {
                    sessionStorage.setItem("prev_swap_choice","yes");
                    $("#select_swap").show();
                } else {
                    $("#select_swap").hide();
                    sessionStorage.setItem("prev_swap_choice","no");
                }
            });
            var qty = sessionStorage.getItem('quantity');
            if (qty == 1) {
                $("#decrease_el").hide();
            }

            $('#choice').append('<h6><b>Choice - </b>' + sessionStorage.getItem('item_name') + '</h6>');
            $('#type').append('<h6> <b>Type - </b>' + sessionStorage.getItem('item_category') + '</h6>');
            $('#item_bread').append('<h6><b>Bread Choice - </b>' + sessionStorage.getItem('bread_type') + ' - ' + sessionStorage.getItem('selected_toast') + '</h6>');
            $('#item_prize').append('<h6> <b>Prize - </b> R ' + Number(sessionStorage.getItem('total_due')).toFixed(2) + '</h6>');
            $('#item_amount').append('<h6>' + sessionStorage.getItem('quantity') + '</h6>');

            $("#ingredients_toppings_form").on('submit', function (e) {
                e.preventDefault();
            });
            $('#ingredient_toppings_next').on('click', function (e) {

                var count = count_ingredients(db);


                {{--window.location.href = "{{'/address_selection'}}"; --}}
            });
            $("#ingredient_toppings_back").on('click', function () {
                window.location.href = "{{'/process_order'}}";
            });

        });
        function ingredient_select_swap(obj) {

            var ingredients = {!! $ingredients !!};
            console.log("ingredients",ingredients);
            $("#swap_ingredients").modal();
            var ingredients_others = {!! json_encode($other_ingredients) !!};
            let selected_name = '';
            let selected_prize = 0;
            let ingredient_type_id = 0;
            for (var i = 0; i < ingredients_others.length; i++) {
                if (ingredients_others[i].id == obj.id) {
                    $("#swap_name").empty();
                    $("#swap_name").append('<b>' + ingredients_others[i].name + '</b>');
                    selected_name = ingredients_others[i].name;
                    selected_prize = ingredients_others[i].prize;
                    ingredient_type_id = ingredients_others[i].ingredient_type_id;
                }
            }
            $('#item_swap_ingredients').empty();
            var objectStore = db.transaction(["selected_ingredients"], "readwrite").objectStore("selected_ingredients");
            objectStore.openCursor().onsuccess = function (event) {
                var cursor = event.target.result;
                if (cursor) {
                    let var_string = cursor.value.id + ',' + obj.id;
                   if(cursor.value.ingredient_type_id==ingredient_type_id){
                       $('#item_swap_ingredients').append('<button id=' + cursor.value.id + ' onclick="ingredient_select_reverse_swap(' + var_string + ');"  class="glass" style="font-weight:bolder;margin-left:1em;color:white;">' + cursor.value.name + '</button>');
                       if(cursor.value.prize<selected_prize){
                           console.log("item prize",sessionStorage.getItem("item_prize"));
                           console.log("selected_prize",selected_prize);
                           console.log("selected_cursor",cursor.value.prize);
                           var cur_prize = sessionStorage.getItem("item_prize");
                           cur_prize += Number(selected_prize)-cursor.value.prize;
                           sessionStorage.setItem("item_prize",cur_prize);
                       }
                   }
                    cursor.continue();
                } else {
                }
            };
        }
        function ingredient_select(obj) {
            var ingredients = {!! $ingredients !!};
            for (var i = 0; i < ingredients.length; i++) {
                if (ingredients[i].ingredient.id == obj.id) {
                    $('#' + obj.id).remove();
                    addIngredient(obj.id, ingredients[i].ingredient.name, ingredients[i].ingredient.prize,ingredients[i].ingredient.ingredient_type_id);
                    $('#item_ingredients').append('<button id=' + obj.id + ' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" onclick="ingredient_select_reverse(this);" >' + ingredients[i].ingredient.name + '</button>');
                }
            }
        }

        function ingredient_select_reverse(obj) {
            console.log("Check", obj.id);
//            $("#swap_ingredients").modal();
            var ingredients = {!! $ingredients !!};
            for (var i = 0; i < ingredients.length; i++) {
                if (ingredients[i].ingredient.id == obj.id) {
                    $('#' + obj.id).remove();
                    removeIngredient(obj.id);
                    $('#ingredients_list').append('<button id=' + obj.id + ' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" onclick="ingredient_select_reverse(this);" >' + ingredients[i].ingredient.name + '</button>');
                }
            }
            var ingredients_others = {!! json_encode($other_ingredients) !!};
            for (var i = 0; i < ingredients_others.length; i++) {
                if (ingredients_others[i].id == obj.id) {
                    console.log("Hitting", obj);
                    $('#' + obj.id).remove();
                    removeIngredient(obj.id);
                }
            }
        }
        function ingredient_select_reverse_swap(obj, id) {
            $("#swap_ingredients").modal("hide");
            var ingredients_others = {!! json_encode($other_ingredients) !!};
            console.log("others",ingredients_others);
            $('#item_swap_ingredients').empty();
            let selected_name = '';
            let selected_prize = 0;
            let ingredient_type_id =0;
            for (var i = 0; i < ingredients_others.length; i++) {
                if (ingredients_others[i].id == id) {
                    selected_name = ingredients_others[i].name;
                    selected_prize = ingredients_others[i].prize;
                    ingredient_type_id = ingredients_others[i].ingredient_type_id;
                }
            }
            for (var i = 0; i < ingredients_others.length; i++) {
                if (ingredients_others[i].id == obj) {
                    $('#' + obj).remove();
                    removeIngredient(obj);
                }
            }
            var ingredients = {!! $ingredients !!};
            for (var i = 0; i < ingredients.length; i++) {
                if (ingredients[i].ingredient.id == obj) {
                    $('#' + obj).remove();
                    removeIngredient(obj);
                    $('#ingredients_list').append('<button id=' + obj + ' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" onclick="ingredient_select(this);" >' + ingredients[i].ingredient.name + '</button>');
                }
            }
            addIngredient(id.toString(), selected_name, selected_prize,ingredient_type_id);
            $('#item_ingredients').append('<button id=' + id + ' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" onclick="ingredient_select_reverse(this);" >' + selected_name + '</button>');
        }
    </script>
@endsection