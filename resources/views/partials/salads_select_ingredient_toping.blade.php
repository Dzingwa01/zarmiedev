@extends('order_processing')
@section('content')
    <div class="container-fluid" style="margin-top:5em">
        <div class="row">
            <div class="step-container_salads" style="width: 100%; margin: 0 auto"></div>
        </div>
        {{--<a id="cart_btn" hidden  class=" btn pull-right" onclick="show_cart()" style="margin-top:1em; margin-right:1em;">CHECKOUT<i class="fa fa-shopping-cart" ></i> </a>--}}

        <div class="row">
            <center>
                <h5 style="font-weight: bolder;" id="choice_2"></h5>
            </center>
            <div class="col-md-6 col-sm-12 card" style="margin-left: 1em;" >
                <div class="row" >
                    <h6 style="color:black;font-weight:bold;font-size: 1.5em;"><span id="salad_name"></span></h6>
                    <div class="col-sm-4">
                        <img id="salad_image" height="200px" width="300px" class="img-responsive img-rounded"/>
                    </div>
                    <div class="col-sm-8">
                        <p style="color:black;font-weight:bold;">Standard Ingredients
                        <form id="ingredients_toppings_form" col="col-md-12">
                            <div class="row" style="margin-top:1em;">
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
                            </div>
                            <div id="swap_ingredients_div" hidden>
                                <div id="swap_ingredients">
                                    @if(count($other_ingredients)>0)
                                        @foreach($other_ingredients as $ingredient)
                                            <button id='{{$ingredient->id}}' class="glass"
                                                    style="font-weight:bolder;margin-left:1em;color:white;"
                                                    onclick="ingredient_select_swap(this);">{{$ingredient->name}}  </button>
                                        @endforeach
                                    @endif
                                </div>

                            </div>
                            {{--</fieldset>--}}
                        </form>
                        <p style="font-weight: bold;color:black;" id="no_pasta_message" hidden></p>
                    </div>

                </div>
                <div class="row" id="pasta_div">
                    <p style="color:black;">You can substitute standard toppings for pasta.Lettuce, Tomato and Cucumber will be removed.</p>
                    <button id="replace_ingredients_with_pasta" class="btn" onclick="swap_pasta()">Swap With Pasta</button>
                    <button id="replace_pasta_swap" class="btn" onclick="replace_pasta()">Reverse Pasta Swap</button>
                </div>
                <div class="row">
                    <div class="col-sm-offset-2 col-sm-2" style="margin-top:1em;">
                        <button id='ingredient_toppings_back' class="btn waves-effect waves-light">Back</button>
                    </div>

                    <div class="col-sm-offset-1 col-sm-2" style="margin-top:1em;">
                        <button id='ingredient_toppings_next' class="btn waves-effect waves-light">Next
                        </button>
                    </div>
                </div>
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
                            <h6><b>Something to drink </b></h6>
                            <div id="selected_drinks">
                            </div>
                        </div>
                    </div>
                    <div id="checkout_div" class="col s12"></div>
                </div>
            </div>
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
    <div id="extra_toppings_modal" class="modal">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h5 class="modal-title">Extra Toppings</h5>
        </div>
        <div class="modal-body">

            <form id="" col="col-md-10" onsubmit="return false;">
                <fieldset>
                    <legend>Please select extra topping:</legend>

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
        var db, db_cart;
        var db_toppings;
        var toppings_request = window.indexedDB.open("toppings_cart", 1);
         var request = window.indexedDB.open("order_cart",2);
        var cart_request = window.indexedDB.open("complete_orders",1);
        cart_request.onerror = function (event) {
            console.log("error: ");
        };

        cart_request.onsuccess = function (event) {
            db_cart = cart_request.result;
            count_orders(db_cart);
        };
        cart_request.onupgradeneeded = function (event) {
            db_cart = event.target.result;
            var objectStore = db_cart.createObjectStore("complete_orders", {keyPath: "id", autoIncrement: true});
        }
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
        toppings_request.onerror = function (event) {
            console.log("error: ", event);
        };

        toppings_request.onsuccess = function (event) {
            db_toppings = event.target.result;
//            addDefaultToppings();
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
                    $("#all_total_due").append('Total Due: R'+Number(sessionStorage.getItem("total_due")).toFixed(2));
                    $("#checkout_list").hide();
                }
            }
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
                    total_cost += Number(sessionStorage.getItem("total_due"));
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
        function addDefaultToppings() {
            var standard_toppings =
                    {!! $standard_toppings !!}
            for (var i = 0; i < standard_toppings.length; i++) {
                console.log(standard_toppings[i].id);
                addTopping(standard_toppings[i].id, standard_toppings[i].name, standard_toppings[i].prize, standard_toppings[i].category);
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
        function topping_select(obj) {
            $("#" + obj.id).addClass('glass_unselected').removeClass('glass');
            var id_string = obj.id.split('_');
            var id = id_string[1];
            removeTopping(id, db_toppings);
        }
        function replace_pasta(){
            $("#pasta").remove();
            var actual_ingredient = 0;
            var ingredient_name = "";
            var remove_id ="";
            var type_id = "";
            var prize = 0;
            var ingredients = {!! $ingredients !!};
            for (var i = 0; i < ingredients.length; i++) {
                if (ingredients[i].ingredient.name == "Lettuce"||ingredients[i].ingredient.name == "Tomato"||ingredients[i].ingredient.name == "Cucumber") {
                    remove_id = "rem_" + ingredients[i].ingredient.id;
                    var id = ingredients[i].ingredient.id;
                    ingredient_name = ingredients[i].ingredient.name;
                    actual_ingredient = ingredients[i].id;
                    type_id = ingredients[i].ingredient.ingredient_type_id;
                    prize = ingredients[i].ingredient.prize;
                    $("#ingr_" + actual_ingredient).addClass('glass').removeClass('glass_unselected');
                    $("#"+remove_id).remove();
                    $("#"+actual_ingredient).remove();
                    addIngredient(actual_ingredient, ingredient_name,prize, type_id);
                    $('#item_ingredients').append('<li id=' + actual_ingredient + '   style="font-weight:bolder;margin-left:1em;color:black;">' + ingredient_name + '</li>');

                }
            }
            $("#replace_ingredients_with_pasta").show();
            $("#replace_pasta_swap").hide();
            $("#removed_list").append('<span id="pasta" style="margin-left:1em" >Pasta Removed<br/></span>');

        }
        function swap_pasta(){
            $("#pasta").remove();
            var actual_ingredient = 0;
            var ingredient_name = "";
            var remove_id ="";
            var type_id = "";
            var prize = 0;
            var ingredients = {!! $ingredients !!};
            for (var i = 0; i < ingredients.length; i++) {
                if (ingredients[i].ingredient.name == "Lettuce"||ingredients[i].ingredient.name == "Tomato"||ingredients[i].ingredient.name == "Cucumber") {
                    remove_id = "rem_" + ingredients[i].ingredient.id;
                    var id = ingredients[i].ingredient.id;
                    ingredient_name = ingredients[i].ingredient.name;
                    actual_ingredient = ingredients[i].id;
                    type_id = ingredients[i].ingredient.ingredient_type_id;
                    prize = ingredients[i].ingredient.prize;
                    $("#ingr_" + actual_ingredient).addClass('glass_unselected').removeClass('glass');
                    $("#removed_list").append('<span id=' + remove_id + ' style="margin-left:1em" >' + ingredient_name +" removed " + '</span>');
                    $('#' + actual_ingredient).remove();
                            removeIngredient(actual_ingredient);
                }
            }
            $("#removed_list").append('<span id="pasta" style="margin-left:1em" ><br/>Pasta Added</span>');
            $("#replace_pasta_swap").show();
            $("#replace_ingredients_with_pasta").hide();
        }
        function ingredient_select_pasta(obj){


        }
        function ingredient_select_remove(obj){
            var actual_ingredient = 0;
            var ingredient_name = "";
            var remove_id ="";
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

            req.onsuccess= function(event){
                if(req.result){
                    $("#" + obj.id).addClass('glass_unselected').removeClass('glass');
                    $("#removed_list").append('<span id=' + remove_id + ' style="margin-left:1em" >' + ingredient_name +" removed " + '</span>');
                    $('#' + id).remove();
                    removeIngredient(id);
                }else{
                    $("#" + obj.id).addClass('glass').removeClass('glass_unselected');
                    $("#"+remove_id).remove();
                    addIngredient(id, ingredient_name,prize, type_id);
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

        function extras_select_reverse(obj) {
            var id_string = obj.id.split('_');
            var id = id_string[1];
            let prize = 0;
            $("#" + obj.id).remove();
//            $("#" + old_id).addClass('glass').removeClass('glass_unselected');
            removeTopping(id, db_toppings);
            var extra_toppings ={!! json_encode($extra_toppings) !!};
            console.log("id is", extra_toppings);
            for (var i = 0; i < extra_toppings.length; i++) {
                if (extra_toppings[i].size_name == sessionStorage.getItem('item_category')) {
                    for (var x = 0; x < extra_toppings[i].item_ingredients.length; x++) {
                        if (id == extra_toppings[i].item_ingredients[x].ingredient_id) {
                            prize = extra_toppings[i].prize;
                            console.log("prize", prize);
                        }
                    }
                }
            }
            var new_prize = Number(sessionStorage.getItem('total_due')) - prize;
            sessionStorage.setItem('total_due', new_prize);
            $("#item_prize").empty();
            $('#item_prize').append('<h6> <b>Prize - </b> R ' + Number(sessionStorage.getItem('total_due')).toFixed(2) + '</h6>');

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
                console.log("ingredient addedd");
            }
            request.onerror = function (event) {
                console.log("error", event);
            }
        }

        function count_ingredients(db) {
            var objectStore = db.transaction(["selected_ingredients"], "readwrite").objectStore("selected_ingredients");
            var countRequest = objectStore.count();
            console.log("count req", countRequest);
            countRequest.onsuccess = function () {
                var count = countRequest.result;
                if (count > 0) {
                    var link_to = sessionStorage.getItem('item_id');
                    window.location.href = '/address_selection/' + link_to;
                } else {
                    alert("Please select the ingredients you want");
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
                    $('#item_ingredients').append('<li id=' + cursor.value.id + '   style="font-weight:bolder;margin-left:1em;color:black;">' + cursor.value.name + '</li>');
                    cursor.continue();
                } else {
                }
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

        function removeIngredient(ingredient_id) {
            var request = db.transaction(["selected_ingredients"], "readwrite")
                .objectStore("selected_ingredients")
                .delete(ingredient_id.toString());

            request.onsuccess = function (event) {
                console.log("ingredient removed", event);
                console.log(ingredient_id);

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
            console.log(sessionStorage.getItem("complete_orders_due"));
            var complete_orders_due = Number(sessionStorage.getItem("complete_orders_due")).toFixed(2) - item_prize;

            complete_orders_due+=Number(total_due);
            console.log("compp",complete_orders_due);
            sessionStorage.setItem("complete_orders_due",complete_orders_due);
            $('#item_prize').empty();
            $('#item_prize').append('<h6> <b>Prize - </b>R' + total_due + '</h6>');
            $("#all_total_due").empty();
            $("#all_total_due").append('Total Due: R'+Number(complete_orders_due).toFixed(2));
        }

        function addDefault() {
            var ingredients = {!! json_encode($ingredients) !!};
            console.log("ingredients", ingredients);
            for (var i = 0; i < ingredients.length; i++) {
                addIngredient(ingredients[i].id, ingredients[i].ingredient.name, ingredients[i].ingredient.prize, ingredients[i].ingredient.ingredient_type_id);
//                    $('#item_ingredients').append('<button id=' + ingredients[i].id + ' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" onclick="ingredient_select_reverse(this);" >' + ingredients[i].ingredient.name + '</button>');
            }
        }
        function toTitleCase(str) {
            return str.replace(/\w\S*/g, function (txt) {
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            });
        }
        var item_number = sessionStorage.getItem('item_name');
        $(document).ready(function () {
            $('.tabs').tabs();
            accordion_trigger();
//            $("#replace_ingredients_with_pasta").hide();
            $('.step-container_salads').stepMaker({
                steps: ['Salad Size', 'Ingredients', 'Delivery','Receipt'],
                currentStep: 2
            });
            $("#replace_pasta_swap").hide();
            if (sessionStorage.getItem("order_quantity") == null || sessionStorage.getItem("order_quantity") == undefined) {
                sessionStorage.setItem("order_quantity", 0);
            }
            if(sessionStorage.getItem("item_number_1")=="S6"||sessionStorage.getItem("item_number_1")=="S7"){
                $("#pasta_div").hide();
                $("#no_pasta_message").empty();
                $("#no_pasta_message").show();
                $("#no_pasta_message").append("No available swap options for this salad");
            }
//            var more_order = sessionStorage.getItem("more_order");
//
//            if(more_order!=null&&more_order!=undefined&&more_order!="null"){
////                $("#cart_btn").show();
//                $("#order_count").empty();
//                $("#order_count").append('<sup style="font-weight: bolder;">'+sessionStorage.getItem("order_quantity")+'*</sup>');
////                $("#menu_items").addClass("with_cart");
//                read_all_complete_orders();
//            }else{
//                $("#cart_btn").hide();
//                $("#checkout_list").hide();
//            }
            var extra_toppings ={!! json_encode($extra_toppings) !!};
            $("#choice_id").empty();
            $("#choice_2").empty();
            $("#choice_id").append(sessionStorage.getItem("item_category"));
            $("#salad_image").attr('src','/'+sessionStorage.getItem("item_image"));
            $("#salad_description").append(sessionStorage.getItem("item_description"));
            $('#salad_name').append(sessionStorage.getItem('item_name') + " - " +sessionStorage.getItem("item_category") );
            for (var i = 0; i < extra_toppings.length; i++) {
                if (extra_toppings[i].size_name == sessionStorage.getItem('item_category')) {
                    $("#extra_toppings").append(' <button id=' + extra_toppings[i].id + ' class="glass" onclick="extra_toppings_select(this)" style="font-weight:bolder;margin-left:1em;color:white;">' + extra_toppings[i].name + '</button>');
                }
            }
            if (sessionStorage.getItem("prev_swap_choice") == "no") {
                $("#extra_toppings_div").hide();
                $("#no").prop("checked", true);
            }
            else if(sessionStorage.getItem("prev_swap_choice") == "yes") {
                $("#extra_toppings_div").show();
                $("#yes").prop("checked", true);
            }

            $('input:radio').click(function () {
                var swap_choice = $(this).val();
                console.log('swap_choice',swap_choice);
                if (swap_choice == "yes") {
                    sessionStorage.setItem("prev_swap_choice", "yes");
                    $("#extra_toppings_div").show();
                } else if(swap_choice == "no") {
                    $("#extra_toppings_div").hide();
                    sessionStorage.setItem("prev_swap_choice", "no");
                }
                else if(swap_choice == "swap_no") {
                    $("#swap_ingredients_div").hide();
                    sessionStorage.setItem("prev_swap_choice_2", "no");
                }
                else if(swap_choice == "swap_yes") {
                    $("#swap_ingredients_div").show();
                    sessionStorage.setItem("prev_swap_choice_2", "yes");
                }
            });
            var qty = sessionStorage.getItem('quantity');
            if (qty == 1) {
                $("#decrease_el").hide();
            }

            $('#choice').append('<h6><b>Choice - </b>' + toTitleCase(sessionStorage.getItem('item_name')) + '</h6>');
            $('#type').append('<h6> <b>Type - </b>' + sessionStorage.getItem('item_category') + '</h6>');
//            $('#item_bread').append('<h6><b>Bread Choice - </b>' + sessionStorage.getItem('bread_type') + ' - ' + sessionStorage.getItem('selected_toast') + '</h6>');
            $('#item_prize').append('<h6> <b>Prize - </b> R ' + Number(sessionStorage.getItem('total_due')).toFixed(2) + '</h6>');
            $('#item_amount').append('<h6>' + sessionStorage.getItem('quantity') + '</h6>');

            $("#ingredients_toppings_form").on('submit', function (e) {
                e.preventDefault();
            });
            $('#ingredient_toppings_next').on('click', function (e) {
//                var count = count_ingredients(db);
                $("#more_orders").modal();
            });
            $("#ingredient_toppings_back").on('click', function () {
                window.history.back();
            });

        });
        function proceed_to_checkout() {
            sessionStorage.setItem("more_order", null);
            sessionStorage.setItem("order_quantity", 1);
            var count = count_ingredients(db);
        }

        function add_another_order() {
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
        function extra_toppings_select(obj) {
            var extra_toppings ={!! json_encode($extra_toppings) !!};
            var ingredients = {!!json_encode($all_ingredients) !!};
            $("#extra_toppings_list").empty();
            for (var i = 0; i < extra_toppings.length; i++) {
                if (extra_toppings[i].id == obj.id) {
                    for (var x = 0; x < extra_toppings[i].item_ingredients.length; x++) {
//                        console.log(extra_toppings[i].item_ingredients[x].ingredient_id);
                        for (var y = 0; y < ingredients.length; y++) {
                            if (ingredients[y].id == extra_toppings[i].item_ingredients[x].ingredient_id) {
                                $("#extra_toppings_list").append(' <button id=' + 'ext_' + ingredients[y].id + ' class="glass" onclick="extra_toppings_selected(this)" style="font-weight:bolder;margin-left:1em;color:white;">' + ingredients[y].name + '</button>');
                            }
                        }
                    }
                }
            }
            $("#extra_toppings_modal").modal();
        }

        function extra_toppings_selected(obj) {
            $("#" + obj.id).addClass('glass_unselected').removeClass('glass');
            var id_string = obj.id.split('_');
            var id = id_string[1];
            console.log("prize", id);

            var new_id = "rev_" + id;
            let prize = 0;
            var extra_toppings ={!! json_encode($extra_toppings) !!};
//            console.log(extra_toppings);
            for (var i = 0; i < extra_toppings.length; i++) {
                if (extra_toppings[i].size_name == sessionStorage.getItem('item_category')) {
                    for (var x = 0; x < extra_toppings[i].item_ingredients.length; x++) {
                        if (id == extra_toppings[i].item_ingredients[x].ingredient_id) {
                            prize = extra_toppings[i].prize;
//                            console.log("prize",prize);
                        }
                    }
                }
            }
            var standard_toppings =
                    {!! json_encode($all_ingredients) !!}
            for (var i = 0; i < standard_toppings.length; i++) {
                if (standard_toppings[i].id == id) {
                    addTopping(standard_toppings[i].id, standard_toppings[i].name, standard_toppings[i].prize, standard_toppings[i].category);
                    var new_prize = Number(sessionStorage.getItem('total_due')) + prize;
                    sessionStorage.setItem('total_due', new_prize);
                    $("#item_prize").empty();
                    $('#item_prize').append('<h6> <b>Prize - </b> R ' + Number(sessionStorage.getItem('total_due')).toFixed(2) + '</h6>');
                    $('#extra_toppings_cart').append('<button id=' + new_id + ' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" onclick="extras_select_reverse(this);" >' + standard_toppings[i].name + '</button>');
                }
            }
        }

        function ingredient_select_swap(obj) {

            var ingredients = {!! $ingredients !!};
            console.log("ingredients", obj);

            let selected_name = '';
            let selected_prize = 0;
            let ingredient_type_id = 0;
            for (var i = 0; i < ingredients.length; i++) {
                if (ingredients[i].ingredient.ingredient_id == obj.id) {
                    $("#swap_name").empty();
                    $("#swap_name").append('<b>' + ingredients[i].ingredient.name + '</b>');
                    selected_name = ingredients[i].ingredient.name;
                    selected_prize = ingredients[i].ingredient.prize;
                    ingredient_type_id = ingredients[i].ingredient.ingredient_type_id;
                }
            }
            $('#ingredients_list_swap').empty();
            var objectStore = db.transaction(["selected_ingredients"], "readwrite").objectStore("selected_ingredients");
            objectStore.openCursor().onsuccess = function (event) {
                var cursor = event.target.result;
                if (cursor) {
                    let var_string = cursor.value.id + ',' + obj.id;
                    if (cursor.value.ingredient_type_id == ingredient_type_id) {
                        $('#ingredients_list_swap').append('<button id=' + cursor.value.id + ' onclick="ingredient_select_reverse_swap(' + var_string + ');"  class="glass" style="font-weight:bolder;margin-left:1em;color:white;">' + cursor.value.name + '</button>');
                        if (cursor.value.prize < selected_prize) {
                            console.log("item prize", sessionStorage.getItem("item_prize"));
                            console.log("selected_prize", selected_prize);
                            console.log("selected_cursor", cursor.value.prize);
                            var cur_prize = sessionStorage.getItem("item_prize");
                            cur_prize += Number(selected_prize) - cursor.value.prize;
                            sessionStorage.setItem("item_prize", cur_prize);
                        }
                    }
                    cursor.continue();
                } else {
                }
            };
            $("#swap_ingredients_modal").modal();
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