@extends('order_processing')
@section('content')
    <div class="container-fluid" style="margin-top:5em">
        <div id="normal_tracker" class="row">
            <div id="normal_tracker" class="step-container" style="width: 100%; margin: 0 auto"></div>
        </div>
        <div class="row" id="trays_tracker">
            <div id="trays_tracker" class="step-container_trays" style="width: 100%; margin: 0 auto"></div>
        </div>
        <div class="row">
            <div class=" col-md-6 col-sm-12 card" style="margin-left: 1em;">
                <form id="ingredients_toppings_form">
                    <div id="normal_sandwiches_div">

                        <h6 style="font-weight: bolder;font-size:1.5em;" id="choice_normals"></h6>

                        <p style="color:black;font-weight:bold;">Standard Toppings - * You can select to remove</p>
                        <div class="row" style="margin-top:2em;">
                            <div id='standard_toppings'>
                                @if(count($ingredients)>0)
                                    @foreach($ingredients as $ingredient)
                                        <button class="glass" id="{{"ingr_".$ingredient->id}}"
                                                onclick="ingredient_select_remove(this)"
                                                style="font-weight:bolder;margin-left:1em;color:white;"
                                        >{{$ingredient->ingredient->name}}  </button>
                                    @endforeach
                                @endif

                            </div>
                            <div style="margin-top: 1em;" id="removed_list">

                            </div>
                            <div style="margin-top: 1em;" id="replaced_list">

                            </div>
                        </div>
                    </div>
                    <di id="trays_div" hidden>

                        <div class="row" style="margin: 1em;">
                            <h6 style="color:black;font-weight:bold;font-size: 1.5em;"><span id="tray_name"></span></h6>
                            <div class="col-sm-6">
                                <img id="tray_image" height="200px" width="300px" class="img-rounded"/>
                            </div>

                            <div class="col-sm-6">
                                <p id="tray_description" style="color:black;"></p>
                            </div>

                        </div>

                    </di>
                    <div id="combination_trays_div" hidden>
                        <div class="row" style="margin-top:2em;">
                            <button class="accordion ">Select Tray Items - 5 Max</button>

                            <div id="combination_accordion" class="panel">
                                <form id="" col="col-md-10" onsubmit="return false;">
                                    <div class="row">
                                        <div class="pull-right" style="margin-right: 2em;">
                                            <span id="combinations_counter"
                                                  style="margin-left:1em;font-weight: bolder;">5 Left</span>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top:1em;">
                                        <div id='standard_toppings'>
                                            @if(count($ingredients)>0)
                                                @foreach($ingredients as $ingredient)
                                                    <button class="glass" id="{{"comb_".$ingredient->id}}"
                                                            onclick="ingredient_select_combination_add(this)"
                                                            style="font-weight:bolder;margin-left:1em;color:white;"
                                                    >{{$ingredient->ingredient->name}}  </button>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 1em;" id="removed_list">

                    </div>
                    <div style="margin-top: 1em;" id="replaced_list"></div>


                    <div id="egg_selection_div" hidden>
                        <p style="color:black;font-weight:bold;">How do you like your eggs done?</p>
                        <p>
                            <input name="group01" class="bread" type="radio" value="Fried" id="fried"/>
                            <label for="fried">Fried</label>

                            <input name="group01" class="bread" type="radio" id="scrambled" value="Scrambled"/>
                            <label for="scrambled">Scrambled</label>
                            <input name="group01" class="bread" type="radio" id="mimosa" value="Mimosa"/>
                            <label for="mimosa">Mimosa</label>
                        </p>

                        {{--<div id="extra_toppings_div" class="row" style="margin-top:2em;" hidden>--}}
                            {{--<p style="color:black;font-weight:bold;margin-left:1em;">Extra Toppings (Paid)--}}
                            {{--<div id='extra_toppings' >--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <hr/>
                    <div id="swap_toppings_div" hidden class="row" style="margin-top:1em;">
                        <button id="replace_accordion" class="accordion">Replace <span id="swap_ingr"></span></button>
                        <div id="swap_toppings_accordion" class="panel">
                            <form id="" col="col-md-10" onsubmit="return false;">

                                <div class="row" style="margin-top:1em;">
                                    <div id="swap_ingredients">

                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div id="extra_toppings_div_2" class="row" style="margin-top:1em;">

                        <button id="extra_toppings_accordion" class="accordion ">Extra Toppings</button>

                        <div id="toppings_accordion" class="panel">
                            <form id="" col="col-md-10" onsubmit="return false;">

                                <div class="row" style="margin-top:1em;">
                                    <div id='extra_toppings'>

                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div id="drinks_div" class="row" style="margin-top:1em;">
                        <button id="accordion_drinks" class="accordion">Something to Drink</button>

                        <div id="drinks_accordion" class="panel">
                            <form id="" col="col-md-10" onsubmit="return false;">
                                <div class="row" style="margin-top:1em;">
                                    <div id='drinks_list'>
                                        @if(count($drinks)>0)
                                            @foreach($drinks as $drink)
                                                <button id="{{"drink_".$drink->id}}" class="drink_glass"
                                                        onclick="drink_select(this)"
                                                        style="margin-left:1em;color:white;"
                                                >
                                                    <i class="fa fa-beer"></i> {{$drink->name . " - ".$drink->prize}}
                                                </button>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    <div class="row" style="margin-top:2em;" hidden>
                        <div>
                            @if(count($extra_toppings)>0)
                                @foreach($extra_toppings as $topping)
                                    <button class="glass"
                                            style="font-weight:bolder;margin-left:1em;color:white;"
                                    >{{$topping->name}}  </button>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <hr/>
                    <div id="swap_toppings_div" hidden class="row" style="margin-top:1em;">
                        <button class="accordion">Swap Removed Toppings With:</button>
                        <div id="swap_toppings_accordion" class="panel">
                            <form id="" col="col-md-10" onsubmit="return false;">
                                {{--<fieldset>--}}
                                {{--<legend>Please select extra topping:</legend>--}}

                                <div class="row" style="margin-top:1em;">
                                    <div id="">
                                        @if(count($other_ingredients)>0)
                                            @foreach($other_ingredients as $ingredient)
                                                <button id='{{$ingredient->id}}' class="glass"
                                                        style="font-weight:bolder;margin-left:1em;color:white;"
                                                        onclick="ingredient_select_swap(this);">{{$ingredient->name}}  </button>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-offset-2 col-sm-2" style="margin-top:1em;">
                            <button id='ingredient_toppings_back' class="btn waves-effect waves-light">Back
                            </button>
                        </div>

                        <div class="col-sm-offset-1 col-sm-2" style="margin-top:1em;">
                            <button id='ingredient_toppings_next' class="btn waves-effect waves-light">Next
                            </button>
                        </div>
                    </div>

                    {{--</fieldset>--}}
                </form>
            </div>
            <div class="col-sm-5 card" style="margin-left:2em; ">
                <div class="row">
                    <p class="pull-right" style="font-weight: bolder;color:black;font-size:1.2em;" id="all_total_due"></p>
                    {{--<span class="pull-right">*Cart and the current item</span>--}}
                </div>
                <div class="row">
                    <div class="col s12">
                        <ul class="tabs z-depth-1">
                            <li class="tab col s6 "><a id="current_order_tab" href="#current_order" class="active"
                                                       style="color:black;text-decoration: none;">Current Order
                                    Details</a></li>
                            <li id="checkout_list" class="tab col s6"><a id="checkout_tab" class=""
                                                                    style="color:black;text-decoration: none;"
                                                                    href="#checkout_div">Review Other Orders <i
                                            class="fa fa-shopping-cart"></i><span style="color:red"
                                                                                  id="order_count"></span> </a></li>

                        </ul>
                    </div>
                    <div id="current_order" class="col s12">
                        <div id='type'></div>
                        <div id='choice'>
                        </div>
                        <div id='egg_choice_div' hidden>
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
                        <div id='item_ingredients' style="margin-top:2em;">
                            <h6><b>Your <span id="choice_id"></span> comes with following ingredients:</b></h6>

                        </div>
                        <div id='extra_toppings_cart' style="margin-top:2em;" hidden>
                            <h6><b>Extra Toppings - *Click to remove </b></h6>

                        </div>
                        <div id='drinks_cart' style="margin-top:2em;" hidden>
                            <h6><b>Something to drink - *Click to remove </b></h6>
                            <div id="selected_drinks">
                            </div>
                        </div>
                    </div>
                    <div id="checkout_div" class="col s12">

                    </div>
                </div>
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
        <div hidden>
            @if(count($other_ingredients)>0)
                @foreach($other_ingredients as $ingredient)
                    <button
                    >{{$ingredient->name}}  </button>
                @endforeach
            @endif
        </div>
    </div>
    <div id="more_orders" class="modal" style="height: 250px;">
        <div class="modal-header">
            <h5 class="modal-title">Complete Order</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="row">

                <button style="margin:1em;" class="btn remove" onclick="proceed_to_checkout()"> Proceed to Checkout
                </button>

                <button style="margin:1em;" class="btn swap"
                        onclick="add_another_order()"> Add Another Order
                </button>
            </div>
        </div>
    </div>
    <div id="extra_toppings_modal" class="modal" style="height: 400px;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h5 class="modal-title">Extra Toppings</h5>
        </div>
        <div class="modal-body">
            <form id="" col="col-md-10" onsubmit="return false">
                <fieldset>
                    <legend>Please select extra topping/s:</legend>

                    <div class="row" style="margin-top:2em;">
                        <div id='extra_toppings_list'>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-offset-2 col-sm-2" style="margin-top:1em;">
                            <button id='' class="btn waves-effect waves-light" data-dismiss="modal">Cancel</button>
                        </div>

                        <div class="col-sm-offset-1 col-sm-2" style="margin-top:1em;">
                            <button class="btn waves-effect waves-light" data-dismiss="modal">Done</button>
                        </div>
                    </div>
                </fieldset>

            </form>
        </div>
    </div>
    <div id="swap_ingredients_modal" class="modal">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h5 class="modal-title">Swap Ingredients</h5>
        </div>
        <div class="modal-body">
            <p style="color:black;font-weight: bolder">Please select ingredient you would want to swap with for: <span
                        id="swap_name"></span>
            </p>
            <form id="" col="col-md-10" onsubmit="return false;">
                <fieldset>
                    <legend>Available Swap ingredients</legend>

                    <div class="row" style="margin-top:2em;">
                        <div id='ingredients_list_swap'>

                        </div>
                    </div>

                </fieldset>

            </form>
        </div>
    </div>
    <div id="confirm_remove" class="modal" style="height: 250px;width: 500px;">
        <div class="modal-header">
            <h5 class="modal-title">Remove/Swap</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="row">

                <button style="margin:1em;" class="btn remove" data-dismiss="modal"> Remove</button>

                <button style="margin:1em;" class="btn swap" data-dismiss="modal"
                        onclick="ingredient_select_swap(this)"> Swap
                </button>
            </div>
        </div>
    </div>

    <div hidden>
        @if(count($other_ingredients)>0)
            @foreach($other_ingredients as $ingredient)
                <button>{{$ingredient->name}}  </button>
            @endforeach
        @endif
    </div>
    <style>

        #current_order_tab:after {
            content: ""
        }

        .tabs .tab a:hover, .tabs .tab a.active {
            content: ""
        }

        #checkout_tab:after {
            content: ""
        }

        .step:after {
            content: ""
        }

    </style>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        window.indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB ||
            window.msIndexedDB;

        window.IDBTransaction = window.IDBTransaction || window.webkitIDBTransaction ||
            window.msIDBTransaction;
        window.IDBKeyRange = window.IDBKeyRange ||
            window.webkitIDBKeyRange || window.msIDBKeyRange

        if (!window.indexedDB) {
            window.alert("Your browser doesn't support a critical feature required for this application, please upgrade your browser.")
        }
        sessionStorage.setItem("combination_count", 0);
        var db, db_cart;
        var db_toppings;
        var toppings_request = window.indexedDB.open("toppings_cart", 1);
        var request = window.indexedDB.open("order_cart", 2);
        var cart_request = window.indexedDB.open("complete_orders", 1);
        cart_request.onerror = function (event) {
            console.log("error: ");
        };

        cart_request.onsuccess = function (event) {
            db_cart = event.target.result;
            count_orders(db_cart);
        };
        cart_request.onupgradeneeded = function (event) {
            db_cart = event.target.result;
            var objectStore = db_cart.createObjectStore("complete_orders", {keyPath: "id", autoIncrement: true});
        }
        request.onerror = function (event) {
//            console.log("error: ", event);
        };

        request.onsuccess = function (event) {
            db = event.target.result;
            addDefault();
            readAll(db);
            readAllDrinks(db);
        };
        request.onupgradeneeded = function (event) {
            db = event.target.result;
            var transaction = event.target.transaction;
            var objectStore = db.createObjectStore("selected_ingredients", {keyPath: "id", autoIncrement: true});
            var objectStore = db.createObjectStore("selected_drinks", {keyPath: "id", autoIncrement: true});
            transaction.oncomplete = function (event) {
                addDefault();
                readAll(db);
                readAllDrinks(db);
            }
        }
        toppings_request.onerror = function (event) {
            console.log("error: ", event);
        };

        toppings_request.onsuccess = function (event) {
            db_toppings = event.target.result;
//            addDefaultToppings();
            readToppings();
        };
        toppings_request.onupgradeneeded = function (event) {
            db_toppings = event.target.result;

            var transaction = event.target.transaction;
            var objectStore_toppings = db_toppings.createObjectStore("selected_toppings", {
                keyPath: "id",
                autoIncrement: true
            });
            transaction.oncomplete = function (event) {
//                addDefaultToppings();
                readToppings();
            }
        }

        function addDefaultToppings() {
            var standard_toppings =
                    {!! $standard_toppings !!}
            for (var i = 0; i < standard_toppings.length; i++) {
                console.log(standard_toppings[i].id);
                addTopping(standard_toppings[i].id, standard_toppings[i].name, standard_toppings[i].prize, standard_toppings[i].category);
            }
        }

        function drink_select(obj) {
            var id_string = obj.id.split("_");
            var new_id = id_string[1];
            var another_new = "rep_" + new_id;
            var drinks = {!! json_encode($drinks) !!};
            let drink_name = "";
            let selected_prize = 0;
            let drink_id = "";
            let ingredient_type_id = 0;
            for (var i = 0; i < drinks.length; i++) {
                if (drinks[i].id == new_id) {
                    selected_prize = drinks[i].prize;
                    drink_id = new_id;
                    drink_name = drinks[i].name;
                }
            }
            addDrink(drink_id, drink_name, selected_prize);
        }

        function topping_select(obj) {
            $("#" + obj.id).addClass('glass_unselected').removeClass('glass');
            var id_string = obj.id.split('_');
            var id = id_string[1];
            removeTopping(id, db_toppings);
        }

        function ingredient_select_remove_newbies(obj) {
            console.log("clicked", obj);
            var actual_ingredient = 0;
            var ingredient_name = "";
            var remove_id = "";
            var swap_id = "";
            var type_id = "";
            var remove_id2 = 0;
            var ingredients = {!! $ingredients !!};
            var ingredients_others = {!! json_encode($other_ingredients) !!};
            console.log("other ingredients", ingredients_others);
            var id_string = obj.id.split('_');
            var id = id_string[1];
            var prize = 0;
            for (var i = 0; i < ingredients.length; i++) {
                if (ingredients[i].id == id) {
                    remove_id = "rem_" + id;
                    ingredient_name = ingredients[i].ingredient.name;
                    actual_ingredient = ingredients[i].id;
                    type_id = ingredients[i].ingredient.ingredient_type_id;
                    prize = ingredients[i].ingredient.prize;
                }
            }
            for (var i = 0; i < ingredients_others.length; i++) {
                if (ingredients_others[i].id == id) {
                    remove_id = "rem_" + id;
                    remove_id2 = "remm_" + id;
                    swap_id = "swaww_" + id;
                    ingredient_name = ingredients_others[i].name;
                    actual_ingredient = ingredients_others[i].id;
                    type_id = ingredients_others[i].ingredient_type_id;
                    prize = ingredients_others[i].prize;
                }
            }
            var objectStore = db.transaction(["selected_ingredients"]).objectStore("selected_ingredients");
            var req = objectStore.get(id);

            req.onsuccess = function (event) {
                if (req.result) {
                    $("#" + obj.id).addClass('glass_unselected').removeClass('glass');
                    $("#removed_list").append('<span id=' + remove_id2 + ' style="margin-left:1em" >' + ingredient_name + " removed " + '</span>');
                    $('#' + swap_id).remove();

                    removeIngredient(id);
//                    ingredient_select_swap(obj);
                    $("#swap_toppings_div").show();
                    $("#swap_ingr").empty();
                    $("#swap_ingr").append(ingredient_name);
                } else {
                    $("#" + obj.id).addClass('glass').removeClass('glass_unselected');
                    $("#" + remove_id2).remove();
                    $("#" + remove_id).remove();
                    $("#swap_toppings_div").hide();
                    addIngredient(id, ingredient_name, prize, type_id);
//                    $('#item_ingredients').append('<li id=' + swap_id + '   style="font-weight:bolder;margin-left:1em;color:black;">' + ingredient_name + '</li>');
                }

            };

        }

        function ingredient_select_combination_add(obj) {

            var actual_ingredient = 0;
            var ingredient_name = "";
            var remove_id = "";
            var type_id = "";
            var ingredients = {!! $ingredients !!};
            var id_string = obj.id.split('_');
            var id = id_string[1];
            var prize = 0;
            for (var i = 0; i < ingredients.length; i++) {
                if (ingredients[i].id == id) {
                    remove_id = "rem_" + id;
                    ingredient_name = ingredients[i].ingredient.name;
                    actual_ingredient = ingredients[i].id;
                    type_id = ingredients[i].ingredient.ingredient_type_id;
                    prize = ingredients[i].ingredient.prize;
                }
            }
            var objectStore = db.transaction(["selected_ingredients"]).objectStore("selected_ingredients");
            var req = objectStore.get(id);

            req.onsuccess = function (event) {
                if (req.result) {
                    $('#' + id).remove();
                    $("#" + obj.id).addClass('glass').removeClass('glass_unselected');
                    removeIngredient(id);
                    var choices_number = Number(sessionStorage.getItem("combination_count"));
                    choices_number -= 1;
                    var cnt = 5 - choices_number;
                    $("#combinations_counter").empty();
                    $("#combinations_counter").append(cnt + " Choices Left");
                    sessionStorage.setItem("combination_count", choices_number);
                } else {
                    var choices_number = Number(sessionStorage.getItem("combination_count"));
                    if (choices_number < 5) {
                        $("#" + obj.id).addClass('glass_unselected').removeClass('glass');
                        sessionStorage.setItem("combination_count", choices_number);
                        $('#item_ingredients').append('<li id=' + id + '   style="font-weight:bolder;margin-left:1em;color:black;">' + ingredient_name + '</li>');
                        addIngredientOg(id, ingredient_name, prize, type_id);
                        choices_number += 1;
                        var cnt = 5 - choices_number;
                        $("#combinations_counter").empty();
                        $("#combinations_counter").append(cnt + " Choices Left");
                        sessionStorage.setItem("combination_count", choices_number);
                    }
                    else {
                        alert("You can only add a maximum of 5 items");
                    }

                }

            };
        }

        function ingredient_select_remove(obj) {
            var actual_ingredient = 0;
            var ingredient_name = "";
            var remove_id = "";
            var type_id = "";
            var ingredients = {!! $ingredients !!};
            var ingredients_others = {!! json_encode($other_ingredients) !!};
            console.log("other ingredients", ingredients_others);
            var id_string = obj.id.split('_');
            var id = id_string[1];
            var prize = 0;
            for (var i = 0; i < ingredients.length; i++) {
                if (ingredients[i].id == id) {
                    remove_id = "rem_" + id;
                    ingredient_name = ingredients[i].ingredient.name;
                    actual_ingredient = ingredients[i].id;
                    type_id = ingredients[i].ingredient.ingredient_type_id;
                    prize = ingredients[i].ingredient.prize;
                }
            }
            for (var i = 0; i < ingredients_others.length; i++) {
                if (ingredients_others[i].id == id) {
                    remove_id = "rem_" + id;
                    ingredient_name = ingredients_others[i].name;
                    actual_ingredient = ingredients_others[i].id;
                    type_id = ingredients_others[i].ingredient_type_id;
                    prize = ingredients_others[i].prize;
                }
            }
            var objectStore = db.transaction(["selected_ingredients"]).objectStore("selected_ingredients");
            var req = objectStore.get(id);

            req.onsuccess = function (event) {
                if (req.result) {
                    $("#" + obj.id).addClass('glass_unselected').removeClass('glass');
                    $("#removed_list").append('<span id=' + remove_id + ' style="margin-left:1em" >' + ingredient_name + " removed " + '</span>');
                    $('#' + id).remove();
                    removeIngredient(id);
                    ingredient_select_swap(obj);
                    $("#swap_toppings_div").show();
                    $("#swap_ingr").empty();
                    $("#swap_ingr").append(ingredient_name);
                } else {
                    $("#" + obj.id).addClass('glass').removeClass('glass_unselected');
                    $("#" + remove_id).remove();
                    $("#swap_toppings_div").hide();
                    addIngredientOg(id, ingredient_name, prize, type_id);
                    $('#item_ingredients').append('<li id=' + id + '   style="font-weight:bolder;margin-left:1em;color:black;">' + ingredient_name + '</li>');
                }

            };

        }

        function optional_topping_select(obj) {
            $("#" + obj.id).addClass('glass_unselected').removeClass('glass');
            var id_string = obj.id.split('_');
            var id = id_string[1];
            var new_id = "rev_" + id;
            var standard_toppings =
                    {!! $optional_toppings !!}
                    $('#extra_toppings').empty();
            for (var i = 0; i < standard_toppings.length; i++) {
                if (standard_toppings[i].id == id) {
                    addTopping(standard_toppings[i].id, standard_toppings[i].name, standard_toppings[i].prize, standard_toppings[i].category);
                    $('#extra_toppings').append('<button id=' + new_id + ' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" onclick="optional_select_reverse(this);" >' + standard_toppings[i].name + '</button>');
                }
            }
        }

        function optional_select_reverse(obj) {
            var id_string = obj.id.split('_');
            var id = id_string[1];
            var old_id = "opt_" + id;
            $("#" + obj.id).remove();
            $("#" + old_id).addClass('glass').removeClass('glass_unselected');
            removeTopping(id, db_toppings);
        }
        function extras_select_drink_reverse(obj){
            var id_string = obj.id.split('_');
            var id = id_string[1];
            let prize = 0;
            var remove_id =".seldrink_"+id;
            var drinks = {!! json_encode($drinks) !!};
            let drink_name = "";
            let selected_prize = 0;
            let drink_id = "";
            let ingredient_type_id = 0;
            $("." + obj.id).remove();
            for (var i = 0; i < drinks.length; i++) {
                if (drinks[i].id == id) {
                    selected_prize = drinks[i].prize;
                }
            }
            console.log("selected_prizere",id);
            console.log("selected_prize",selected_prize);
            var complete_orders_due =  parseFloat(sessionStorage.getItem("complete_orders_due"))-parseFloat(selected_prize);
            var new_prize = parseFloat(sessionStorage.getItem('total_due'))-parseFloat(selected_prize);
            console.log(new_prize);
            console.log(complete_orders_due);
            sessionStorage.setItem("complete_orders_due",complete_orders_due);
            sessionStorage.setItem('total_due', new_prize);
            $("#all_total_due").empty();
            $("#all_total_due").append('Total Due: R'+complete_orders_due);
            $("#item_prize").empty();
            $('#item_prize').append('<h6> <b>Prize - </b> R ' + Number(sessionStorage.getItem('total_due')).toFixed(2) + '</h6>');;
            removeDrink(id);
        }
        function extras_select_reverse(obj) {
            var id_string = obj.id.split('_');
            var id = id_string[1];
            let prize = 0;
            $("." + obj.id).remove();

            removeTopping(id, db_toppings);
            var extra_toppings ={!! json_encode($extra_toppings) !!};
            console.log("id is", extra_toppings);
            for (var i = 0; i < extra_toppings.length; i++) {
                if (extra_toppings[i].size_name == sessionStorage.getItem('item_category')) {
                    for (var x = 0; x < extra_toppings[i].item_ingredients.length; x++) {
                        if (id == extra_toppings[i].item_ingredients[x].ingredient_id) {
                            prize = extra_toppings[i].prize;
//                            console.log("prize", prize);
                        }
                    }
                }
            }
            var complete_orders_due = Number(sessionStorage.getItem("complete_orders_due")).toFixed(2) - ((parseFloat(prize) * parseInt(sessionStorage.getItem("quantity"))).toFixed(2));
            var new_prize = parseFloat(sessionStorage.getItem('total_due')).toFixed(2) - ((parseFloat(prize) * parseInt(sessionStorage.getItem("quantity"))).toFixed(2));
            sessionStorage.setItem('total_due', new_prize);
            sessionStorage.setItem("complete_orders_due",complete_orders_due);
            $("#all_total_due").empty();
            $("#all_total_due").append('Total Due: R'+complete_orders_due.toFixed(2));
            $("#item_prize").empty();
            $('#item_prize').append('<h6> <b>Prize - </b> R ' + Number(sessionStorage.getItem('total_due')).toFixed(2) + '</h6>');
        }

        function toTitleCase(str) {
            return str.replace(/\w\S*/g, function (txt) {
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            });
        }

        function addTopping(topping_id, topping_name, topping_prize, topping_category) {
            var request = db_toppings.transaction(["selected_toppings"], "readwrite")
                .objectStore("selected_toppings")
                .add({id: topping_id.toString(), name: topping_name, prize: topping_prize, category: topping_category});

            request.onsuccess = function (event) {
                console.log("topping addedd");
            }
            request.onerror = function (event) {
                console.log("error", event);
            }
        }

        function addIngredientOg(ingredient_id, ingredient_name, ingredient_prize, ingredient_type_id) {
            var request = db.transaction(["selected_ingredients"], "readwrite")
                .objectStore("selected_ingredients")
                .add({
                    id: ingredient_id.toString(),
                    name: ingredient_name,
                    prize: ingredient_prize,
                    ingredient_type_id: ingredient_type_id.toString()
                });

            request.onsuccess = function (event) {
            }
            request.onerror = function (event) {
                console.log("error", event);
            }
        }

        function addIngredientOg2(ingredient_id, ingredient_name, ingredient_prize, ingredient_type_id) {
            var request = db.transaction(["selected_ingredients"], "readwrite")
                .objectStore("selected_ingredients")
                .add({
                    id: ingredient_id.toString(),
                    name: ingredient_name,
                    prize: ingredient_prize,
                    ingredient_type_id: ingredient_type_id.toString()
                });

            request.onsuccess = function (event) {

            }
            request.onerror = function (event) {
                console.log("error", event);
            }
        }

        function addIngredient(ingredient_id, ingredient_name, ingredient_prize, ingredient_type_id) {
            var request = db.transaction(["selected_ingredients"], "readwrite")
                .objectStore("selected_ingredients")
                .add({
                    id: ingredient_id.toString(),
                    name: ingredient_name,
                    prize: ingredient_prize,
                    ingredient_type_id: ingredient_type_id.toString()
                });

            request.onsuccess = function (event) {

                var another_new = "rep_" + ingredient_id;
                var new_id_late = "swaww_" + ingredient_id;
                $("#new_id_late").remove();
                $('#item_ingredients').append('<li id=' + new_id_late + '   style="font-weight:bolder;margin-left:1em;color:black;">' + ingredient_name + '</li>');
                $("#replaced_list").append('<span id=' + another_new + ' style="margin-left:1em" >' + ingredient_name + " added as replacement " + '</span>');
                var late_id = "ingr_" + ingredient_id;
                $("#late_id").remove();
                $("#standard_toppings").append('<button class="glass" id=' + late_id + ' onclick="ingredient_select_remove_newbies(this)" style="font-weight:bolder;margin-left:1em;color:white;">' + ingredient_name + ' </button>')
                $("#swap_toppings_div").hide();
            }
            request.onerror = function (event) {
                console.log("error", event);
            }
        }

        function addDrink(drink_id, drink_name, selected_prize) {
            var request = db.transaction(["selected_drinks"], "readwrite")
                .objectStore("selected_drinks")
                .add({
                    id: drink_id,
                    name: drink_name,
                    prize: selected_prize,
                });

            request.onsuccess = function (event) {
                $("#drinks_cart").show();
                var new_id = "seldrink_"+drink_id;
                var new_class="seldrink_"+drink_id;
                $("#selected_drinks").append('<li class='+new_class+'><b>' + drink_name + '</b>  <i id=' + new_id +' onclick="extras_select_drink_reverse(this)" class="fa fa-trash"></i></li>');
                var complete_orders_due =  parseFloat(sessionStorage.getItem("complete_orders_due"))+parseFloat(selected_prize);
                var new_prize = parseFloat(sessionStorage.getItem('total_due'))+parseFloat(selected_prize);

                sessionStorage.setItem("complete_orders_due",complete_orders_due);
                sessionStorage.setItem('total_due', new_prize);
                $("#all_total_due").empty();
                $("#all_total_due").append('Total Due: R'+complete_orders_due);
                $("#item_prize").empty();
                $('#item_prize').append('<h6> <b>Prize - </b> R ' + Number(sessionStorage.getItem('total_due')).toFixed(2) + '</h6>');
            }
            request.onerror = function (event) {
                alert("You have already added "+drink_name +" you can increase the quantity in the cart");
            }
        }

        function count_ingredients(db) {
            var objectStore = db.transaction(["selected_ingredients"], "readwrite").objectStore("selected_ingredients");
            var countRequest = objectStore.count();
            console.log("count req", countRequest);
            countRequest.onsuccess = function () {
                var count = countRequest.result;
                if (count > 0) {
                    console.log("egg choice", sessionStorage.getItem("egg_choice"));
                    if (sessionStorage.getItem("item_number_1") == 24 || sessionStorage.getItem("item_number_1") == 23) {
                        if (sessionStorage.getItem("egg_choice") == null) {
                            alert("Please select egg choice!");
                        }
                        else {
                            var link_to = sessionStorage.getItem('item_id');
                            window.location.href = '/address_selection';
                        }
                    } else {
                        var link_to = sessionStorage.getItem('item_id');
                        window.location.href = '/address_selection';
                    }

                } else {

                    alert("Please select the ingredients you want");
                }
            }
        }

        function count_orders(db_cart) {
//        console.log("carting pano");
            var objectStore = db_cart.transaction(["complete_orders"], "readwrite").objectStore("complete_orders");
            var countRequest = objectStore.count();
            console.log("count req", countRequest);
            countRequest.onsuccess = function () {
                var count = countRequest.result;
                sessionStorage.setItem("order_quantity",count);
                if (count>0) {
                    $("#cart_btn").show();
                    $("#order_count").empty();
                    $("#order_count").append('<sup style="font-weight: bolder;">' + sessionStorage.getItem("order_quantity") + '*</sup>');
                    $("#menu_items").addClass("with_cart");
                    read_all_complete_orders();
                } else {
                    $("#all_total_due").append('Total Due: R'+sessionStorage.getItem("total_due"));
                    sessionStorage.setItem("complete_orders_due",sessionStorage.getItem("total_due"));
                    $("#checkout_list").hide();
                }
            }
        }
        function readAll(db) {
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
                    if (sessionStorage.getItem("route_item_category") != 22 && sessionStorage.getItem("route_item_category") != 21) {
//                        console.log("Hitsasa",sessionStorage.getItem("route_item_category") );
                        $('#item_ingredients').append('<li id=' + cursor.value.id + '   style="font-weight:bolder;margin-left:1em;color:black;">' + cursor.value.name + '</li>');
                    }
                    cursor.continue();
                } else {
                }
            };
        }

        function readAllDrinks(db) {
            var objectStore = db.transaction(["selected_drinks"], "readwrite").objectStore("selected_drinks");
            objectStore.openCursor().onsuccess = function (event) {
                var cursor = event.target.result;
                var new_total =0;
                if (cursor) {
                    $("#drinks_cart").show();
                    var new_id = "seldrink_"+cursor.value.id;
                    var new_class="seldrink_"+cursor.value.id;
                    $("#selected_drinks").append('<li class='+new_class+'><b>' + cursor.value.name + ' </b>   <i id=' + new_id +' onclick="extras_select_drink_reverse(this)" class="fa fa-trash"></i></li>');
                     cursor.continue();
                } else {
                }
            };
        }

        function clearIngredients(db) {
            var objectStore = db.transaction(["selected_ingredients"], "readwrite").objectStore("selected_ingredients");
            var objectStoreRequest = objectStore.clear();
            objectStoreRequest.onsuccess = function (event) {
                // report the success of our request
                console.log("cleared successfully");
            };
        }
        function clearDrinks(db) {
            var objectStore = db.transaction(["selected_drinks"], "readwrite").objectStore("selected_drinks");
            var objectStoreRequest = objectStore.clear();
            objectStoreRequest.onsuccess = function (event) {
                // report the success of our request
                console.log("cleared successfully");
            };
        }
        function clearToppings(db) {
            var objectStore = db.transaction(["selected_toppings"], "readwrite").objectStore("selected_toppings");
            var objectStoreRequest = objectStore.clear();
            objectStoreRequest.onsuccess = function (event) {
                // report the success of our request
                console.log("cleared successfully");
            };
        }
        function removeTopping(topping_id, db_toppings) {
            var request = db_toppings.transaction(["selected_toppings"], "readwrite")
                .objectStore("selected_toppings")
                .delete(topping_id);

            request.onsuccess = function (event) {
                console.log("topping removed", event);
            }
            request.onerror = function (event) {
                console.log("error", event);
            }
        }
        function removeDrink(id) {
            var request = db.transaction(["selected_drinks"], "readwrite")
                .objectStore("selected_drinks")
                .delete(id);

            request.onsuccess = function (event) {
                console.log("drink removed", event);
            }
            request.onerror = function (event) {
                console.log("error", event);
            }
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
            console.log("new quantity", new_qty);
            var item_prize = Number(sessionStorage.getItem("total_due")).toFixed(2);
            var total_due_single = Number(item_prize / quantity).toFixed(2);
            var total_due = Number(new_qty * total_due_single).toFixed(2);
            sessionStorage.setItem('total_due', total_due);
            var complete_orders_due = Number(sessionStorage.getItem("complete_orders_due")).toFixed(2) - total_due_single;
            complete_orders_due+=total_due;
            sessionStorage.setItem("complete_orders_due",complete_orders_due);
            $('#item_prize').empty();
            $('#item_prize').append('<h6> <b>Prize - </b>R' + total_due + '</h6>');
            $("#all_total_due").empty();
            $("#all_total_due").append('Total Due: R'+Number(complete_orders_due).toFixed(2));
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
            var item_prize = Number(sessionStorage.getItem("total_due")).toFixed(2) / quantity;
            var total_due = Number(item_prize * new_qty).toFixed(2);
            sessionStorage.setItem('total_due', total_due);
            var complete_orders_due = Number(sessionStorage.getItem("complete_orders_due")).toFixed(2) - item_prize;
            console.log("complete orders",complete_orders_due);
            complete_orders_due+=Number(total_due);
            sessionStorage.setItem("complete_orders_due",complete_orders_due);
            $('#item_prize').empty();
            $('#item_prize').append('<h6> <b>Prize - </b>R' + total_due + '</h6>');
            $("#all_total_due").empty();
            $("#all_total_due").append('Total Due: R'+Number(complete_orders_due).toFixed(2));
        }

        function addDefault() {
            var ingredients = {!! json_encode($ingredients) !!};
            if (sessionStorage.getItem("route_item_category") != 22 && sessionStorage.getItem("route_item_category") != 21) {
                for (var i = 0; i < ingredients.length; i++) {
                    addIngredientOg2(ingredients[i].id, ingredients[i].ingredient.name, ingredients[i].ingredient.prize, ingredients[i].ingredient.ingredient_type_id);

                }
            } else {
                clearIngredients(db);
            }
        }

        function accordion_trigger() {
            var acc = document.getElementsByClassName("accordion");
            var i;

            for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function () {
                    /* Toggle between adding and removing the "active" class,
                     to highlight the button that controls the panel */
                    this.classList.toggle("active");

                    /* Toggle between hiding and showing the active panel */
                    var panel = this.nextElementSibling;
                    if (panel.style.display === "block") {
                        panel.style.display = "none";
                    } else {
                        panel.style.display = "block";
                    }
                });
            }
        }

        var item_number = sessionStorage.getItem('item_name');
        $(document).ready(function () {
            $('.tabs').tabs();

            accordion_trigger();
            if (sessionStorage.getItem("order_quantity") == null || sessionStorage.getItem("order_quantity") == undefined) {
                sessionStorage.setItem("order_quantity", 0);
            }
            var more_order = sessionStorage.getItem("more_order");

            $('.step-container').stepMaker({
                steps: ['Item Size', 'Bread Choice', 'Ingredients', 'Delivery', 'Receipt'],
                currentStep: 3
            });
            $('.step-container_trays').stepMaker({
                steps: ['Item Size', 'Ingredients', 'Delivery', 'Receipt'],
                currentStep: 2
            });
            $("#trays_tracker").hide();

            var extra_toppings ={!! json_encode($extra_toppings) !!};
            $("#choice_id").empty();
            $("#choice_id").append(sessionStorage.getItem("item_category"));
            if (sessionStorage.getItem("item_category") === "Tray") {
                $("#normal_sandwiches_div").hide();
                $("#choice_normals").hide();
                $("#extra_toppings_div_2").hide();
                $("#trays_div").show();
                $("#tray_name").empty();
                $("#tray_name").append(sessionStorage.getItem('item_name'));
                $("#tray_description").append(sessionStorage.getItem('item_description'));
                $("#tray_image").attr("src", "/" + sessionStorage.getItem('item_image'));
                $("#trays_tracker").show();
                $("#normal_tracker").hide();
//                $("#item_ingredients").append('<label>Please select 5 items</label>');
            }

            if (sessionStorage.getItem("item_number_1") == 24 || sessionStorage.getItem("item_number_1") == 23) {
                $("#egg_selection_div").show();
            }
            if (sessionStorage.getItem("route_item_category") == 22 || sessionStorage.getItem("route_item_category") == 21) {
                $("#combination_trays_div").show();
            }
            for (var i = 0; i < extra_toppings.length; i++) {
                if (extra_toppings[i].size_name == sessionStorage.getItem('item_category')) {
                    $("#extra_toppings").append(' <button id=' + extra_toppings[i].id + ' class="glass" onclick="extra_toppings_select(this)" style="font-weight:bolder;margin-left:1em;color:white;">' + extra_toppings[i].name + '</button>');
                }
            }
            if (sessionStorage.getItem("prev_swap_choice") == "no") {
                $("#extra_toppings_div").hide();
                $("#no").prop("checked", true);
            }
            else if (sessionStorage.getItem("prev_swap_choice") == "yes") {
                $("#extra_toppings_div").show();
                $("#yes").prop("checked", true);
            }

            $('input:radio').click(function () {
                var swap_choice = $(this).val();
                console.log('swap_choice', swap_choice);
                if (swap_choice == "yes") {
                    sessionStorage.setItem("prev_swap_choice", "yes");
                    $("#extra_toppings_div").show();
                } else if (swap_choice == "no") {
                    $("#extra_toppings_div").hide();
                    sessionStorage.setItem("prev_swap_choice", "no");
                }
                else if (swap_choice == "swap_no") {
                    $("#swap_ingredients_div").hide();
                    sessionStorage.setItem("prev_swap_choice_2", "no");
                }
                else if (swap_choice == "swap_yes") {
                    $("#swap_ingredients_div").show();
                    sessionStorage.setItem("prev_swap_choice_2", "yes");
                } else {
                    $("#egg_choice_div").show();
                    $("#egg_choice_div").empty();
                    $("#egg_choice_div").append('<p /> <b>Eggs should be:</b>' + swap_choice + '</p>');
                    sessionStorage.setItem("egg_choice", swap_choice);
                }
            });
            var qty = sessionStorage.getItem('quantity');
            if (qty == 1) {
                $("#decrease_el").hide();
            }
            $("#choice_normals").append(sessionStorage.getItem('item_name'));
            $('#choice').append('<h6><b>Choice - </b>' + toTitleCase(sessionStorage.getItem('item_name')) + '</h6>');
            $('#type').append('<h6> <b>Type - </b>' + sessionStorage.getItem('item_category') + '</h6>');
            $('#item_bread').append('<h6><b>Bread Choice - </b>' + sessionStorage.getItem('bread_type') + ' - ' + sessionStorage.getItem('selected_toast') + '</h6>');
            $('#item_prize').append('<h6> <b>Prize - </b> R ' + Number(sessionStorage.getItem('total_due')).toFixed(2) + '</h6>');
            $('#item_amount').append('<h6>' + sessionStorage.getItem('quantity') + '</h6>');

            $("#ingredients_toppings_form").on('submit', function (e) {
                e.preventDefault();
            });
            $('#ingredient_toppings_next').on('click', function (e) {
                $("#more_orders").modal();
            });
            $("#ingredient_toppings_back").on('click', function () {
                clearDrinks(db)
                clearToppings(db_toppings);
                window.history.back();
            });

        });

        function proceed_to_checkout() {
            sessionStorage.setItem("more_order", "more_order");
//            sessionStorage.setItem("order_quantity", 1);
            add_order_for_checkout();
            var count = count_ingredients(db);
        }

        function add_another_order() {
            var count = Number(sessionStorage.getItem("order_quantity")) + 1;
            var ingredients = [];
            var toppings = [];
            var drinks = [];
            var objectStore = db.transaction(["selected_ingredients"], "readwrite").objectStore("selected_ingredients");
            objectStore.openCursor().onsuccess = function (event) {
                var toppingsStore = db_toppings.transaction(["selected_toppings"], "readwrite").objectStore("selected_toppings");

                var cursor = event.target.result;
                if (cursor) {
                    ingredients.push(cursor.value);
                    cursor.continue();
                }else{
                    toppingsStore.openCursor().onsuccess = function (toppings_event) {
                        var cursor_1 = toppings_event.target.result;
                        if (cursor_1) {
                            toppings.push(cursor_1.value);
                            cursor_1.continue();
                        }else{
                            var drinksStore = db.transaction(["selected_drinks"], "readwrite").objectStore("selected_drinks");
                            drinksStore.openCursor().onsuccess = function (drinks_event) {
                                var cursor_2 = drinks_event.target.result;
                                if (cursor_2) {
                                    drinks.push(cursor_2.value);
                                    cursor_2.continue();
                                }
                                else{
                                    var order = {order_item_number:count.toString(),item_name:sessionStorage.getItem('item_name'),item_category: sessionStorage.getItem('item_category'),
                                        bread_type:sessionStorage.getItem('bread_type') ,toast_type:sessionStorage.getItem('selected_toast'),
                                        quantity:sessionStorage.getItem('quantity'),prize:Number(sessionStorage.getItem('total_due')).toFixed(2),
                                        ingredients:ingredients,toppings:toppings,drinks:drinks};
                                    var request_complete = db_cart.transaction(["complete_orders"], "readwrite")
                                        .objectStore("complete_orders")
                                        .add(order);
                                    request_complete.onsuccess = function (event) {
                                        sessionStorage.setItem("more_order", "more_order");
                                        window.location.href = '/order_display';
                                    }
                                    request_complete.onerror = function (event) {
                                        console.log("error", event);
                                    }
                                }
                            };

                        }

                    };
                }

            };

        }
        function add_order_for_checkout() {
            var count = Number(sessionStorage.getItem("order_quantity")) + 1;
            var ingredients = [];
            var toppings = [];
            var drinks = [];
//            sessionStorage.setItem("order_quantity", count);
            var objectStore = db.transaction(["selected_ingredients"], "readwrite").objectStore("selected_ingredients");
            objectStore.openCursor().onsuccess = function (event) {
                var toppingsStore = db_toppings.transaction(["selected_toppings"], "readwrite").objectStore("selected_toppings");

                var cursor = event.target.result;
                if (cursor) {
                    ingredients.push(cursor.value);
                    cursor.continue();
                }else{

                    toppingsStore.openCursor().onsuccess = function (toppings_event) {
                        var cursor_1 = toppings_event.target.result;
                        if (cursor_1) {
                            toppings.push(cursor_1.value);
                            cursor_1.continue();
                        }else{
                            var drinksStore = db.transaction(["selected_drinks"], "readwrite").objectStore("selected_drinks");
                            drinksStore.openCursor().onsuccess = function (drinks_event) {
                                var cursor_2 = drinks_event.target.result;
                                if (cursor_2) {
                                    drinks.push(cursor_2.value);
                                    cursor_2.continue();
                                }
                                else{
                                    var order = {order_item_number:count.toString(),item_name:sessionStorage.getItem('item_name'),item_category: sessionStorage.getItem('item_category'),
                                        bread_type:sessionStorage.getItem('bread_type') ,toast_type:sessionStorage.getItem('selected_toast'),
                                        quantity:sessionStorage.getItem('quantity'),prize:Number(sessionStorage.getItem('total_due')).toFixed(2),
                                        ingredients:ingredients,toppings:toppings,drinks:drinks};
                                    var request_complete = db_cart.transaction(["complete_orders"], "readwrite")
                                        .objectStore("complete_orders")
                                        .add(order);
                                    request_complete.onsuccess = function (event) {
//                                        sessionStorage.setItem("more_order", "more_order");
//                                        window.location.href = '/order_display';
                                    }
                                    request_complete.onerror = function (event) {
                                        console.log("error", event);
                                    }
                                }
                            };

                        }

                    };

                }

            };

        }
        function read_all_complete_orders(){
            var objectStore = db_cart.transaction(["complete_orders"], "readwrite").objectStore("complete_orders");
            var total_cost = 0;
            objectStore.openCursor().onsuccess = function (event) {
                var cursor = event.target.result;
                if (cursor) {
                    var with_order = "ord_"+cursor.value.id;
                    total_cost+=Number(cursor.value.prize);
                    $("#checkout_div").append('<div id='+cursor.value.id+' class="card"><b>'+cursor.value.quantity+' X '+cursor.value.item_name+' - ' +cursor.value.item_category+ '<br>'+cursor.value.bread_type+' - '+cursor.value.toast_type+'</b><i id='+with_order+' onclick="remove_order(this)"  class="fa fa-trash" style="float:right" style="color:red"></i><br/><b>Cost: </b>R'+cursor.value.prize+'</div>');
                    console.log("ingredients",cursor.value.ingredients);
                    var ingredients_string ="";
                    var toppings_string ="";
                    var drinks_string ="";
                    if(cursor.value.ingredients.length>0){
                        for(var i=0;i<cursor.value.ingredients.length;i++){
                            console.log(cursor.value.ingredients[i]);
                            ingredients_string = ingredients_string+"; "+cursor.value.ingredients[i].name;
                        }
                        $("#"+cursor.value.id).append('<br/><b>Ingredients: </b>'+ingredients_string+'<br/>');

                    }
                    if(cursor.value.toppings.length>0){
                        for(var i=0;i<cursor.value.toppings.length;i++){
                            toppings_string = toppings_string+"; "+cursor.value.toppings[i].name;
                        }
                        $("#"+cursor.value.id).append('<br/><b>Extra Toppings: </b>'+toppings_string+'<br/>');
                    }
                    if(cursor.value.drinks.length>0){
                        for(var i=0;i<cursor.value.drinks.length;i++){
                            drinks_string = drinks_string+"; "+cursor.value.drinks[i].name;
                        }
                        $("#"+cursor.value.id).append('<br/><b>Drinks: </b>'+drinks_string+'<br/>');
                    }

                    cursor.continue();
                } else {
                    $("#all_total_due").empty();
                      total_cost += Number(sessionStorage.getItem("total_due"));
                    sessionStorage.setItem("complete_orders_due",total_cost);
                    $("#all_total_due").append('Total Due: R'+total_cost.toFixed(2));
                }
            };
        }
        function calculate_cart(){
            var objectStore = db_cart.transaction(["complete_orders"], "readwrite").objectStore("complete_orders");
            var total_cost = 0;
            objectStore.openCursor().onsuccess = function (event) {
                var cursor = event.target.result;
                if (cursor) {
                    var with_order = "ord_"+cursor.value.id;
                    total_cost+=Number(cursor.value.prize);
                    cursor.continue();
                } else {
                    $("#all_total_due").empty();
//                    total_cost += Number(sessionStorage.getItem("total_due"));
                    sessionStorage.setItem("total_cost",total_cost);
                    $("#all_total_due").append('Total Due: R'+total_cost.toFixed(2));
                }
            };
        }
        function remove_order(obj){
            var id_string = obj.id;
            var id_array = id_string.split("_");
            var id = id_array[1];

            var request = db_cart.transaction(["complete_orders"], "readwrite")
                .objectStore("complete_orders")
                .delete(Number(id));

            request.onsuccess = function (event) {
                $("#"+id).remove();
                var count = Number(sessionStorage.getItem("order_quantity"))-1;
                sessionStorage.setItem("order_quantity",count);
                $("#order_count").empty();
                $("#order_count").append('<sup style="font-weight: bolder;">' + sessionStorage.getItem("order_quantity") + '*</sup>');
                calculate_cart();
                if(count==0){
                    $("#checkout_list").hide();
                }
            }
            request.onerror = function (event) {
                console.log("error", event);
            }
//            alert(id);
        }
        function extra_toppings_select(obj) {
            var extra_toppings ={!! json_encode($extra_toppings) !!};
            var ingredients = {!!json_encode($all_ingredients) !!};
            console.log("exra toppings",extra_toppings);
            $("#extra_toppings_list").empty();
            for (var i = 0; i < extra_toppings.length; i++) {
                if (extra_toppings[i].id == obj.id&&sessionStorage.getItem("item_size_id")==extra_toppings[i].item_size_id) {
                    for (var x = 0; x < extra_toppings[i].item_ingredients.length; x++) {
//                        console.log(extra_toppings[i].item_ingredients[x].ingredient_id);
                        for (var y = 0; y < ingredients.length; y++) {
                            if (ingredients[y].id == extra_toppings[i].item_ingredients[x].ingredient_id&&extra_toppings[i].size_name) {
                                $("#extra_toppings_list").append(' <button id=' + 'ext_' + ingredients[y].id + ' class="glass" onclick="extra_toppings_selected(this)" style="font-weight:bolder;margin-left:1em;color:white;">' + ingredients[y].name + ' - ' + Number(extra_toppings[i].prize).toFixed(2) + '</button>');
                            }
                        }
                    }
                }
            }
            $("#extra_toppings_modal").modal();
        }

        function readToppings() {
            var objectStore = db_toppings.transaction(["selected_toppings"], "readwrite").objectStore("selected_toppings");
            objectStore.openCursor().onsuccess = function (event) {
                var cursor = event.target.result;
                if (cursor) {
                    var extra_topps = "extratops_"+cursor.value.id;
                    $("." + extra_topps).remove();

                    $('#extra_toppings_cart').append('<li class=' + extra_topps + ' style="font-weight:bolder;margin-left:1em;color:black;">' + cursor.value.name + '<i id=' + extra_topps+' onclick="extras_select_reverse(this)" class="fa fa-trash"></i></li>');

//                    $('#extra_toppings_cart').append('<li id=' + cursor.value.id + ' style="font-weight:bolder;margin-left:1em;color:black;">' + cursor.value.name + '</li>');

                    cursor.continue();
                }
            };
        }

        function extra_toppings_selected(obj) {
            $("#" + obj.id).addClass('glass_unselected').removeClass('glass');
            var id_string = obj.id.split('_');
            var id = id_string[1];
            $("#extra_toppings_cart").show();
            var new_id = "";

            let prize = 0;
            var standard_toppings =
                    {!! json_encode($all_ingredients) !!}
            var extra_toppings ={!! json_encode($extra_toppings) !!};
//            console.log("extra_toppings", extra_toppings);
//            console.log("standard_toppings", standard_toppings);
            for (var i = 0; i < extra_toppings.length; i++) {
                if (extra_toppings[i].size_name == sessionStorage.getItem('item_category')) {
                    for (var x = 0; x < extra_toppings[i].item_ingredients.length; x++) {
                        if (id == extra_toppings[i].item_ingredients[x].ingredient_id) {
                            prize = extra_toppings[i].prize;
                        }
                    }
                }
            }

            for (var i = 0; i < standard_toppings.length; i++) {
                if (standard_toppings[i].id == id) {
                    addTopping(standard_toppings[i].id, standard_toppings[i].name, prize, standard_toppings[i].category);
                    var complete_orders_due = Number(sessionStorage.getItem("complete_orders_due"))+ (prize * parseInt(sessionStorage.getItem("quantity")));
                    sessionStorage.setItem("complete_orders_due",complete_orders_due);
                    var new_prize = Number(sessionStorage.getItem('total_due')) + (prize * parseInt(sessionStorage.getItem("quantity")));
                    sessionStorage.setItem('total_due', new_prize);
                    $("#all_total_due").empty();
                    $("#all_total_due").append('Total Due: R'+Number(complete_orders_due).toFixed(2));
                    $("#item_prize").empty();
                    new_id = "extratops_"+id;
                    $('#item_prize').append('<h6> <b>Prize - </b> R ' + Number(sessionStorage.getItem('total_due')).toFixed(2) + '</h6>');
                    $('#extra_toppings_cart').append('<li class=' + new_id + ' style="font-weight:bolder;margin-left:1em;color:black;">' + standard_toppings[i].name + '<i id=' + new_id+' onclick="extras_select_reverse(this)" class="fa fa-trash"></i></li>');
//                    $('#replaced_list').append('<span id='+another_new+'>'+standard_toppings[i].name+' replaced</span>');
                }
            }
        }

        function ingredient_select_swap(obj) {
            var ingredients = {!! $ingredients !!};
            var id_string = obj.id.split("_");
            var new_id = id_string[1];
            let selected_name = '';
            let selected_prize = 0;
            let ingredient_type_id = 0;
            console.log(ingredients);
            let ingredient_id = 0;
            for (var i = 0; i < ingredients.length; i++) {
                if (ingredients[i].id == new_id) {
                    selected_name = ingredients[i].ingredient.name;
                    selected_prize = ingredients[i].ingredient.prize;
                    ingredient_type_id = ingredients[i].ingredient.ingredient_type_id;
                    ingredient_id = ingredients[i].ingredient.id;
                }
            }

            $('#swap_ingredients').empty();
            var ingredients_others = {!! json_encode($other_ingredients) !!};
            for (var i = 0; i < ingredients_others.length; i++) {
                if (ingredients_others[i].ingredient_type_id == ingredient_type_id && ingredient_id != ingredients_others[i].id) {
                    var exists = false;
                    for (var x = 0; x < ingredients.length; x++) {
                        if (ingredients[x].ingredient.id == ingredients_others[i].id) {
                            console.log("hit");
                            exists = true;
                        }
                    }
                    if (!exists) {
                        var new_id = 'swap_' + ingredients_others[i].id;
                        $('#' + new_id).remove();
                        $('#swap_ingredients').append(' <button id=' + new_id + ' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" onclick="ingredient_select_swapped(this)">' + ingredients_others[i].name + '</button>');

                    }
                }
            }
            if($('#swap_ingredients').is(':empty')){
                $('#swap_ingredients').append('<label>No Available Swap Option</label>');
            }
        }

        function ingredient_select_swapped(obj) {
            var id_string = obj.id.split("_");
            var new_id = id_string[1];
            var another_new = "rep_" + new_id;
            var ingredients = {!! $ingredients !!};
            let ingredient_type = 0;
            let selected_prize = 0;
            let ingredient_name = "";
            let ingredient_type_id = 0;
            for (var i = 0; i < ingredients.length; i++) {
                if (ingredients[i].id == new_id) {
                    selected_prize = ingredients[i].ingredient.prize;
                    ingredient_type = ingredients[i].ingredient.ingredient_type_id;
                    ingredient_name = ingredients[i].ingredient.name;
                }
            }

            var ingredients_others = {!! json_encode($other_ingredients) !!};
            for (var i = 0; i < ingredients_others.length; i++) {
                if (ingredients_others[i].id == new_id) {
                    selected_prize = ingredients_others[i].prize;
                    ingredient_type = ingredients_others[i].ingredient_type_id;
                    ingredient_name = ingredients_others[i].name;
                }
            }
            addIngredient(new_id, ingredient_name, selected_prize, ingredient_type);

        }

        function ingredient_select(obj) {
            var ingredients = {!! $ingredients !!};
            for (var i = 0; i < ingredients.length; i++) {
                if (ingredients[i].ingredient.id == obj.id) {
                    $('#' + obj.id).remove();
                    addIngredient(obj.id, ingredients[i].ingredient.name, ingredients[i].ingredient.prize, ingredients[i].ingredient.ingredient_type_id);
                    $('#item_ingredients').append('<button id=' + obj.id + ' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" onclick="ingredient_select_reverse(this);" >' + ingredients[i].ingredient.name + '</button>');
                }
            }
            var ingredients_others = {!! json_encode($other_ingredients) !!};
            console.log(ingredients_others);
            for (var i = 0; i < ingredients_others.length; i++) {
                if (ingredients_others[i].id == obj.id) {
                    $('#item_ingredients').append(' <button id=' + ingredients_others[i].id + ' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" onclick="ingredient_select_reverse(this)">' + ingredients_others[i].name + '</button>');
                }
            }
        }

        function ingredient_select_reverse(obj) {
            $('#ingredients_list_swap').empty();
            $('.swap').attr('id', obj.id);
            var ingredients = {!! $ingredients !!};

            let selected_id = 0;
            for (var i = 0; i < ingredients.length; i++) {
                if (obj.id == ingredients[i].id) {
                    selected_id = ingredients[i].ingredient.ingredient_type_id;
                }
            }
            var ingredients_others = {!! json_encode($other_ingredients) !!};
            for (var i = 0; i < ingredients_others.length; i++) {
                if (ingredients_others[i].ingredient_type_id == selected_id) {
                    $('#ingredients_list_swap').append(' <button id=' + ingredients_others[i].id + ' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" data-dismiss="modal" onclick="ingredient_select(this)">' + ingredients_others[i].name + '</button>');
                }
            }
            $("#confirm_remove").modal();
            $("#" + obj.id).addClass('glass_unselected').removeClass('glass');
            removeIngredient(obj.id);
            return false;
        }

        function ingredient_select_reverse_swap(obj, id) {
            $("#swap_ingredients").modal("hide");
            var ingredients_others = {!! json_encode($other_ingredients) !!};
            console.log("others", ingredients_others);
            $('#item_swap_ingredients').empty();
            let selected_name = '';
            let selected_prize = 0;
            let ingredient_type_id = 0;
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
            addIngredient(id.toString(), selected_name, selected_prize, ingredient_type_id);
            $('#item_ingredients').append('<button id=' + id + ' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" onclick="ingredient_select_reverse(this);" >' + selected_name + '</button>');
        }
    </script>
@endsection