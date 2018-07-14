@extends('order_processing')
@section('content')
    <div class="container-fluid" style="margin-top:5em">
        <div class="row">
            <div class="step-container_salads" style="width: 100%; margin: 0 auto"></div>
        </div>
        <div class="row">
            <center>
                <h5 style="font-weight: bolder;" id="choice_2"></h5>
            </center>
            <div class="col-sm-7 card" style="margin-left: 2em;" >
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
                    </div>

                </div>
                <div class="row">
                    <p style="color:black;">You can substitute standard toppings for pasta.Lettuce, Tomato and Cucumber will be removed.</p>
                    <button class="accordion ">Swap  Options</button>

                    <div id="pasta_accordion" class="panel">
                        <form id="" col="col-md-10" onsubmit="return false;">
                            <div class="row" style="margin-top:1em;">
                                <div id='pasta_list'>

                                    <button class="btn">Swap For Pasta</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-offset-2 col-sm-2" style="margin-top:1em;">
                        <button id='ingredient_toppings_back' class="btn waves-effect waves-light">Back</button>
                    </div>

                    <div class="col-sm-offset-1 col-sm-2" style="margin-top:1em;">
                        <button id='ingredient_toppings_next' class="btn waves-effect waves-light">Next</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 card" style="margin-left: 2em;">
                <form onsubmit="return false;">
                    {{--<fieldset>--}}
                    <h6 style="color:black;font-weight:bold;font-size: 1.5em;">Order Cart <i class="fa fa-shopping-cart"></i> </h6>
                        <div id='type'></div>
                        <div id='choice'>
                        </div>
                        {{--<div id='item_bread'>--}}
                        {{--</div>--}}
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
                        {{--<div id='extra_toppings_cart' style="margin-top:2em;">--}}
                            {{--<h6><b>Extra Toppings - *Click to remove </b></h6>--}}

                        {{--</div>--}}

                    {{--</fieldset>--}}
                </form>
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
        var db_toppings;
        var toppings_request = window.indexedDB.open("toppings_cart", 1);
         var request = window.indexedDB.open("order_cart",2);
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
            var item_prize = Number(sessionStorage.getItem("total_due")).toFixed(2);
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
            var item_prize = Number(sessionStorage.getItem("total_due")).toFixed(2);
            var total_due = Number(item_prize * new_qty).toFixed(2);
            sessionStorage.setItem('total_due', total_due);
            $('#item_prize').empty();
            $('#item_prize').append('<h6> <b>Prize - </b>R' + total_due + '</h6>');
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
            accordion_trigger();
            $('.step-container_salads').stepMaker({
                steps: ['Salad Size', 'Ingredients', 'Delivery Info','Receipt'],
                currentStep: 2
            });
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
                var count = count_ingredients(db);
            });
            $("#ingredient_toppings_back").on('click', function () {
                window.history.back();
            });

        });

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