@extends('client_processing')
@section('content')
    <?php $user_address = \Illuminate\Support\Facades\Auth::user()->physical_address; ?>
    <div class="container-fluid" >
        {{--<a id="cart_btn" hidden  class=" btn pull-right" onclick="show_cart()" style="margin-top:1em; margin-right:1em;">CHECKOUT<i class="fa fa-shopping-cart" ></i><span style="color:red" id="order_count"></span> </a>--}}
        <div id="normal_tracker" class="row" style="margin-top:1em">
            <div id="normal_tracker" class="step-container" style="width: 450px; margin: 0 auto"></div>
        </div>
        <div class="row">
            <input hidden id="hidden_address" value="{{$user_address}}">
            <div class="col m7 s12 card">
                <div id="delivery_collect">
                    <p style="color:black;font-weight: bolder;font-size: 1.2em;">Delivery or Pickup</p>
                    <div class="row" style="margin-bottom: 0px;">
                        <div class="col s6">
                            <p>
                                <label for="collect">
                                <input name="group01" class="bread" value="Collect" type="radio"
                                       id="collect"/>
                              <span> Collect</span></label>
                                <label for="delivery">
                                <input name="group01" class="bread" type="radio" id="delivery" checked
                                       value="Delivery"/>
                             <span>Delivery</span> </label>
                            </p>
                        </div>
                        <div class="col s6">
                            <p>
                                <label for="for_now">
                                <input name="group02" class="bread" value="for_now" type="radio" checked
                                       id="for_now"/>
                               <span> For Now</span></label>
                                <label for="for_later">
                                <input name="group02" class="bread" type="radio" id="for_later"
                                       value="for_later"/>
                              <span>Specify Time</span></label>
                            </p>
                        </div>
                    </div>
                    <div id="time_div" hidden class="row" style="margin-bottom: 0px;">
                        <div class="input-field col s6" >
                            <input id="delivery_pick_up_time" type="text" class="validate">
                            <label class="active" for="delivery_pick_up_time">Time</label>
                        </div>
                    </div>
                    <div class="row">
                        <p>
                            <label for="usual_address">
                            <input name="group021" class="bread" value="usual_address" type="radio" checked
                                   id="usual_address"/>
                          <span>{{\Illuminate\Support\Facades\Auth::user()->physical_address}}</span> </label>
                        </p>
                        <p>
                            <label for="new_address">
                            <input name="group021" class="bread" type="radio" id="new_address"
                                   value="New Address"/>
                          <span>  Another Address</span></label>
                        </p>
                    </div>
                </div>
                <div id="address_div" hidden style="margin-top:0.5em;" class="row">
                    {{--<h5>Enter Address for delivery</h5>--}}
                    <div class="col s8">
                        <form id="address_form">
                            <div class="row">
                                <input id='address' type='text' placeholder="Enter your address" required>
                            </div>
                            <div class="row" style="margin-top:1em;">
                                <div id="map_canvas"></div>
                            </div>
                        </form>
                    </div>

                </div>
                <div id="delivery_instructions_div">
                <div  class="input-field col s6">
                    <textarea id="delivery_instructions" class="materialize-textarea"></textarea>
                    <label for="delivery_instructions">Any Special Instructions - *eg ask for John</label>
                </div>
                </div>
                <div  class="row" style="margin-bottom: 0px;">
                    <div id="collect_instructions_div" class="input-field col s6">
                        <textarea id="collect_instructions" class="materialize-textarea"></textarea>
                        <label for="collect_instructions">Any Special Instructions - *eg ask for John</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-offset-2 col-sm-2" style="margin-top:1em;">
                        <button id='address_back' class="btn waves-effect waves-light">Back</button>
                    </div>
                    <div class="col-sm-offset-1 col-sm-2" style="margin-top:1em;">
                        <button id='address_next' class="btn waves-effect waves-light">Submit Order</button>
                    </div>
                </div>
            </div>

            <div class="col m4 s12 card" style="margin-left:2em;">
                <p><span style="color:black;font-weight:bolder;font-size: 1.2em;">Order Details <i
                                class="fa fa-shopping-cart"></i></span><span
                            style="color:black;margin-left: 8px;font-weight: bolder"
                            id="order_count"></span> <span
                            style="font-weight: bolder;margin-left:2em;color:black;font-size:1.2em;"
                            id="all_total_due"></span></p>
                <form style="height: 400px;overflow-y: scroll;">
                    <div id='checkout_div'>

                    </div>

                </form>
            </div>

        </div>

        <form id="" col="col-md-10" role="form" method="POST">
            <input id="_token" name="_token" value="{{ csrf_token() }}" hidden>
        </form>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/js/materialize.js"></script>
    <script src="/js/init.js"></script>
    <script src="/js/jquery-step-maker.js"></script>
        <style>
            #map_canvas {
                height: 250px;
                /*width: 300px;*/
                margin: 0px;
                padding: 0px
            }

            .controls {
                border: 1px solid !important;
                border-radius: 2px 0 0 2px !important;
                box-sizing: border-box !important;
                -moz-box-sizing: border-box !important;
                height: 32px;
                outline: none;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            }

            .pac-container {
                background-color: #fff;
                z-index: 20;
                position: fixed;
                display: inline-block;
                float: left;
            }

            input[type=text] {
                background-color: white;
            }

            .modal {
                z-index: 20;
            }

            .modal-backdrop {
                z-index: 10;
            }

            ​
            #address {
                background-color: #fff !important;
                font-family: Roboto;
                font-size: 15px;
                font-weight: 300;

                padding: 0 11px 0 13px;
                text-overflow: ellipsis;

            }

            #address:focus {
                border-color: #4d90fe;
            }

            /*.pac-container {
            font-family: Roboto;
            }*/

            #type-selector {
                color: #fff;
                background-color: #4d90fe;
                padding: 5px 11px 0px 11px;
            }

            #type-selector label {
                /*font-family: Roboto;*/
                font-size: 13px;
                font-weight: 300;
            }

        </style>
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
                console.log("error: ");
            };
            request.onsuccess = function (event) {
                db = request.result;
                readAll();
            };
            request.onupgradeneeded = function (event) {
                var db = event.target.result;
                var objectStore = db.createObjectStore("selected_ingredients", {keyPath: "id"});
                readAll();
            }
            toppings_request.onerror = function (event) {
                console.log("error: ", event);
            };

            toppings_request.onsuccess = function (event) {
                db_toppings = event.target.result;
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
                    readToppings();
                }
            }

            function readToppings() {
                var objectStore = db_toppings.transaction(["selected_toppings"], "readwrite").objectStore("selected_toppings");
                objectStore.openCursor().onsuccess = function (event) {
                    var cursor = event.target.result;
                    if (cursor) {
                        $("#" + cursor.value.id).remove();
                        $('#extra_toppings_cart').append('<li id=' + cursor.value.id + ' style="font-weight:bolder;margin-left:1em;color:black;">' + cursor.value.name + '</li>');

                        cursor.continue();
                    }
                };
            }

            function readAll() {
                var objectStore = db.transaction(["selected_ingredients"], "readwrite").objectStore("selected_ingredients");
                objectStore.openCursor().onsuccess = function (event) {
                    var cursor = event.target.result;
                    {{--var ingredients = {!! $ingredients !!};--}}

                    if (cursor) {
                        $("#" + cursor.value.id).remove();
                        $('#item_ingredients').append('<li id=' + cursor.value.id + '   style="font-weight:bolder;margin-left:1em;color:black;">' + cursor.value.name + '</li>');
                        cursor.continue();
                    }
                };
            }

            function read_all_complete_orders() {
                var objectStore = db_cart.transaction(["complete_orders"], "readwrite").objectStore("complete_orders");
                var total_cost = 0;
                objectStore.openCursor().onsuccess = function (event) {
                    var cursor = event.target.result;
                    if (cursor) {
                        var with_order = "ord_" + cursor.value.id;
                        total_cost += Number(cursor.value.prize);
                        $("#checkout_div").append('<div id=' + cursor.value.id + ' class="card"><b>' + cursor.value.quantity + ' X ' + cursor.value.item_name + ' - ' + cursor.value.item_category + '<br>' + cursor.value.bread_type + ' - ' + cursor.value.toast_type + '</b><i id=' + with_order + ' onclick="remove_order(this)"  class="fa fa-trash" style="float:right" style="color:red"></i><br/><b>Cost: </b>R' + cursor.value.prize + '</div>');
//                        console.log("ingredients", cursor.value.ingredients);
                        var ingredients_string = "";
                        var toppings_string = "";
                        var drinks_string = "";
                        if (cursor.value.ingredients.length > 0) {
                            for (var i = 0; i < cursor.value.ingredients.length; i++) {
                                console.log(cursor.value.ingredients[i]);
                                ingredients_string = ingredients_string + "; " + cursor.value.ingredients[i].name;
                            }
                            $("#" + cursor.value.id).append('<br/><b>Ingredients: </b>' + ingredients_string + '<br/>');

                        }
                        if (cursor.value.toppings.length > 0) {
                            for (var i = 0; i < cursor.value.toppings.length; i++) {
                                toppings_string = toppings_string + "; " + cursor.value.toppings[i].name;
                            }
                            $("#" + cursor.value.id).append('<br/><b>Extra Toppings: </b>' + toppings_string + '<br/>');
                        }
                        if (cursor.value.drinks.length > 0) {
                            for (var i = 0; i < cursor.value.drinks.length; i++) {
                                drinks_string = drinks_string + "; " + cursor.value.drinks[i].name;
                            }
                            $("#" + cursor.value.id).append('<br/><b>Drinks: </b>' + drinks_string + '<br/>');
                        }

                        cursor.continue();
                    } else {
                        $("#all_total_due").empty();
                        sessionStorage.setItem('total_cost',total_cost.toFixed(2));
                        $("#all_total_due").append('Total Due: R' + total_cost.toFixed(2));
                    }
                };
            }
            function read_all_complete_orders_for_submission() {
                var objectStore = db_cart.transaction(["complete_orders"], "readwrite").objectStore("complete_orders");
                var total_cost = 0;
                var orders_array = [];
                objectStore.openCursor().onsuccess = function (event) {
                    var cursor = event.target.result;
                    if (cursor) {
                        orders_array.push(cursor.value);
                        cursor.continue();
                    } else {
                        console.log("cursot obj",orders_array);
                        var formData = new FormData();
                        formData.append('_token', $("#_token").val());
                        formData.append('address', sessionStorage.getItem('delivery_address'));
                        formData.append('delivery_or_collect',sessionStorage.getItem('delivery_collect'));
                        if(sessionStorage.getItem('delivery_collect')=="Delivery"){
                            formData.append('delivery_collect_time',sessionStorage.getItem('delivery_time'));
                            sessionStorage.setItem("delivery_time_sub",sessionStorage.getItem('delivery_time'));
                        }else{
                            formData.append('delivery_collect_time',sessionStorage.getItem('collect_time'));
                            sessionStorage.setItem("delivery_time_sub",sessionStorage.getItem('collect_time'));
                        }

                        formData.append('total_cost',sessionStorage.getItem('total_cost'));
                        formData.append('special_instructions',sessionStorage.getItem('instructions'));
                        formData.append("orders",JSON.stringify(orders_array));
                        $.ajax({
                            url: "{{ route('place_order_client') }}",
                            processData: false,
                            contentType: false,
                            data: formData,
                            type: 'post',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },

                            success: function (response, a, b) {
                                console.log("success here", response);
                                alert(response.status);
                                publishOrderToPusher(response.orders,response);
                                console.log("Check orders",response.orders);

                            },
                            error: function (response) {
                                console.log("error", response);
                                alert(response.status);
                            }
                        });
                    }
                };
            }

            function publishOrderToPusher(orders,status){
                for(let i=0;i<orders.length;i++){
                    let cur_order = orders[i];

                    var formData = new FormData();
                    formData.append('event_type',"New Order");
                    formData.append('_token', $("#_token").val());
                    formData.append('name',cur_order.user.name);
                    formData.append('surname',cur_order.user.surname);
                    formData.append('address',cur_order.address);
                    formData.append('phone_number',cur_order.phone_number);

                    formData.append('item_name',cur_order.item_name);
                    formData.append('item_category',cur_order.item_category);
                    formData.append('prize',cur_order.prize);
                    formData.append('toast_type',cur_order.toast_type);
                    formData.append('bread_type',cur_order.bread_type);
                    formData.append('delivery_or_collect',sessionStorage.getItem('delivery_collect'));
                    formData.append('extra_instructions',sessionStorage.getItem('instructions'));
                    formData.append('delivery_time',sessionStorage.getItem('delivery_time_sub'));
                    let temp_ingrs = [];
                    for(let x=0;x<cur_order.order_ingredients.length;x++){
                        temp_ingrs.push(cur_order.order_ingredients[x].name);
                    }
                    formData.append('ingredients',temp_ingrs);
                    let temp_toppings = [];
                    for(let x=0;x<cur_order.toppings.length;x++){
                        temp_toppings.push(cur_order.toppings[x].name);
                    }
                    formData.append('toppings',temp_toppings);

                    let temp_drinks = [];
                    for(let x=0;x<cur_order.drinks.length;x++){
                        temp_drinks.push(cur_order.drinks[x].name);
                    }

                    formData.append('drinks',temp_drinks);

                    formData.append('quantity',cur_order.quantity);
                    formData.append('order_date',cur_order.created_at);
                    formData.append('id',cur_order.id);
                    $.ajax({
                        url: "/chat_server.php",
                        processData: false,
                        contentType: false,
                        data: formData,
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function (response, a, b) {
                            alert("Order submitted successfully to the kitchen, Thank you. We will keep you updated as we process your order!");
                            clearIngredients();
                            clearCompleteOrders();
                            clearToppings();
                            clearDrinks();
                            window.location.href = "/home";

                        },
                        error: function (response) {
                            console.log("error", response);
                            alert(response.status);
                        }
                    });
                }

            }

            function clearIngredients() {
                var objectStore = db.transaction(["selected_ingredients"], "readwrite").objectStore("selected_ingredients");
                var objectStoreRequest = objectStore.clear();
                objectStoreRequest.onsuccess = function (event) {
                    // report the success of our request
                    console.log("cleared successfully");
                };
            }
            function clearDrinks() {
                var objectStore = db.transaction(["selected_drinks"], "readwrite").objectStore("selected_drinks");
                var objectStoreRequest = objectStore.clear();
                objectStoreRequest.onsuccess = function (event) {
                    // report the success of our request
                    console.log("cleared successfully");
                };
            }
            function clearToppings() {
                var objectStore = db_toppings.transaction(["selected_toppings"], "readwrite").objectStore("selected_toppings");
                var objectStoreRequest = objectStore.clear();
                objectStoreRequest.onsuccess = function (event) {
                    // report the success of our request
                    console.log("toppings cleared successfully");
                };
            }
            function clearCompleteOrders(){
                var objectStore = db_cart.transaction(["complete_orders"], "readwrite").objectStore("complete_orders");
                var objectStoreRequest = objectStore.clear();
                objectStoreRequest.onsuccess = function (event) {
                    // report the success of our request
                    console.log("toppings cleared successfully");
                };
            }
            function calculate_cart() {
                var objectStore = db_cart.transaction(["complete_orders"], "readwrite").objectStore("complete_orders");
                var total_cost = 0;
                objectStore.openCursor().onsuccess = function (event) {
                    var cursor = event.target.result;
                    if (cursor) {
                        var with_order = "ord_" + cursor.value.id;
                        total_cost += Number(cursor.value.prize);
                        cursor.continue();
                    } else {
                        $("#all_total_due").empty();
//                        total_cost += Number(sessionStorage.getItem("total_due"));
                        sessionStorage.setItem("total_cost",total_cost);
                        $("#all_total_due").append('Total Due: R' + total_cost.toFixed(2));
                    }
                };
            }

            function remove_order(obj) {
                var id_string = obj.id;
                var id_array = id_string.split("_");
                var id = id_array[1];

                var request = db_cart.transaction(["complete_orders"], "readwrite")
                    .objectStore("complete_orders")
                    .delete(Number(id));

                request.onsuccess = function (event) {
                    $("#" + id).remove();
                    var count = Number(sessionStorage.getItem("order_quantity")) - 1;
                    sessionStorage.setItem("order_quantity", count);
                    $("#order_count").empty();
                    $("#order_count").append('<sup style="font-weight: bolder;">' + sessionStorage.getItem("order_quantity") + '*</sup>');
                    calculate_cart();
                    if (count == 0) {
                        $("#checkout_list").hide();
                    }
                }
                request.onerror = function (event) {
                    console.log("error", event);
                }
//            alert(id);
            }

            function count_orders(db_cart) {
//        console.log("carting pano");
                var objectStore = db_cart.transaction(["complete_orders"], "readwrite").objectStore("complete_orders");
                var countRequest = objectStore.count();
                console.log("count req", countRequest);
                countRequest.onsuccess = function () {
                    var count = countRequest.result;

                    sessionStorage.setItem("order_quantity", count);
                    if (count > 0) {
                        $("#order_count").empty();
                        $("#order_count").append('<sup style="font-weight: bolder;">' + sessionStorage.getItem("order_quantity") + '*</sup>');
                    }

                }
            }

            $(document).ready(function () {
                sessionStorage.setItem("delivery_collect","Delivery");
                sessionStorage.setItem("new_address_select","no");
                $("#collect_instructions_div").hide();

                var curDate = new Date();
                var cur_time = curDate.getHours() + ":" +curDate.getMinutes();
                $('#delivery_pick_up_time').val(cur_time);
                $("#delivery_pick_up_time").timepicker();
                M.updateTextFields();
                var user_address =  $('#hidden_address').val();
                sessionStorage.setItem("delivery_address",user_address);
                var qty = sessionStorage.getItem('quantity');
                sessionStorage.setItem("delivery_collect_time","for_now");
                if(sessionStorage.getItem("delivery_collect")=="Delivery"){
                    $("#delivery").attr("checked",true);
//                    $("#address_div").show();
                }else if(sessionStorage.getItem("delivery_collect")=="Collect"){
                    $("#collect").attr("checked",true);
                    $("#address_div").hide();
                }
                if (qty == 1) {
                    $("#decrease_el").hide();
                }
                $('.step-container').stepMaker({
                    steps: ['Item Size', 'Bread Choice', 'Ingredients', 'Delivery', 'Receipt'],
                    currentStep: 4
                });
                $('input:radio').click(function () {
                    var delivery_or_collect = $(this).val();
                    if (delivery_or_collect == "Delivery") {
                        $("#address_div").show();
                        $("#delivery_instructions_div").show();
                        $("#collect_instructions_div").hide();
                        sessionStorage.setItem("delivery_collect", "Delivery");
                    } else if(delivery_or_collect =="Collect"){
                        $("#address_div").hide();
                        $("#delivery_instructions_div").hide();
                        $("#collect_instructions_div").show();
                        sessionStorage.setItem("delivery_collect", "Collect");
                    }else if(delivery_or_collect=="for_later"){
                        sessionStorage.setItem("delivery_collect_time", "for_later");
                        $("#time_div").show();
                    }
                    else if(delivery_or_collect=="for_now"){
                        sessionStorage.setItem("delivery_collect_time", "for_now");
                        $("#time_div").hide();
                    }else if(delivery_or_collect =="New Address"){
                        $("#address_div").show();
                        sessionStorage.setItem("new_address_select","yes");
                    }else if(delivery_or_collect =="usual_address"){
                        $("#address_div").hide();
                        sessionStorage.setItem("new_address_select","no");
                    }
                });
                read_all_complete_orders();

                $("#address_next").on('click', function (e) {
//                e.preventDefault();
//                alert(sessionStorage.getItem("delivery_collect"));
                    if (sessionStorage.getItem("delivery_collect") == "Delivery") {
                        var addressValue;
                        if(sessionStorage.getItem("new_address_select")=="no"){
                            addressValue = sessionStorage.getItem("delivery_address");
                        }else{
                            addressValue = $("#address").val();
                        }
                        console.log("address",addressValue);
                        if (addressValue) {
//                            sessionStorage.setItem("delivery_address", $("#address").val());
                            if(sessionStorage.getItem("delivery_collect_time")=="for_later"&&$("#delivery_pick_up_time").val()){
                                sessionStorage.setItem("delivery_time", $("#delivery_pick_up_time").val());
                                sessionStorage.setItem("instructions",$("#delivery_instructions").val());
//                                window.location.href = '/order_completion';
                                read_all_complete_orders_for_submission();
                            }else if(!$("#delivery_pick_up_time").val()&&sessionStorage.getItem("delivery_collect_time")=="for_later"){
                                alert("Please enter time of  delivery");
                            }else if(sessionStorage.getItem("delivery_collect_time")=="for_now"){
                                sessionStorage.setItem("instructions",$("#delivery_instructions").val());
//                                window.location.href = '/order_completion';
                                sessionStorage.setItem("delivery_time", "For Now");
                                read_all_complete_orders_for_submission();
                            }

                        } else if (!$("#address").val()) {
                            alert("Please enter your address");
                        }
                    } else if (sessionStorage.getItem("delivery_collect") == "Collect") {
                        if ($("#delivery_pick_up_time").val()&&sessionStorage.getItem("delivery_collect_time")=="for_later") {
                            sessionStorage.setItem("delivery_time", $("#delivery_pick_up_time").val());
                            sessionStorage.setItem("instructions",$("#collect_instructions").val());
                            read_all_complete_orders_for_submission();
                        }else if(sessionStorage.getItem("delivery_collect_time")=="for_now"){
                            sessionStorage.setItem("instructions",$("#delivery_instructions").val());
                            sessionStorage.setItem("delivery_time", "For Now");
                            read_all_complete_orders_for_submission();
                        }
                        else {
                            alert("Please Enter the time of pickup");
                        }
                    }
                });
                $("#address_back").on('click', function (e) {
                    e.preventDefault();
                    var link_to = sessionStorage.getItem('item_id');
                    window.history.back();
                });
            });
            var latitude = 0;
            var longitude = 0;
            var map;
            var infowindow;

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(initAutocomplete);
                } else {
                    $.notify('Geolocation is not supported by this browser', {
                        type: "danger",
                        align: "center",
                        verticalAlign: "middle",
                        animation: true,
                        animationType: "drop"
                    });
                    // alert("Geolocation is not supported by this browser.");
                }
            }

            function initAutocomplete(position) {
                latitude = position.coords.latitude;
                longitude = position.coords.longitude;

                map = new google.maps.Map(document.getElementById('map_canvas'), {
                    center: {lat: latitude, lng: longitude},
                    zoom: 15,
                    mapTypeId: 'roadmap'
                });

                infowindow = new google.maps.InfoWindow();
                var service = new google.maps.places.PlacesService(map);
                service.nearbySearch({
                    location: {lat: latitude, lng: longitude},
                    radius: 5
                }, callback);
                // Create the search box and link it to the UI element.
                var input = document.getElementById('address');
                var searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                // Bias the SearchBox results towards current map's viewport.
                map.addListener('bounds_changed', function () {
                    searchBox.setBounds(map.getBounds());
                });

                var markers = [];
                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.
                searchBox.addListener('places_changed', function () {
                    var places = searchBox.getPlaces();

                    if (places.length == 0) {
                        return;
                    }

                    // Clear out the old markers.
                    markers.forEach(function (marker) {
                        marker.setMap(null);
                    });
                    markers = [];

                    // For each place, get the icon, name and location.
                    var bounds = new google.maps.LatLngBounds();
                    places.forEach(function (place) {
                        if (!place.geometry) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        var icon = {
                            url: place.icon,
                            size: new google.maps.Size(71, 71),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(25, 25)
                        };

                        // Create a marker for each place.
                        markers.push(new google.maps.Marker({
                            map: map,
                            icon: icon,
                            title: place.name,
                            position: place.geometry.location
                        }));

                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                    });
                    map.fitBounds(bounds);
                });
            }

            function callback(results, status) {
                console.log("creating marker", results);
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    for (var i = 0; i < results.length; i++) {
                        createMarker(results[i]);
//             var latLang=result[i].getPosition();
//             console.log("latlang",latLang);
                        // map.setCenter();
                    }
                }
            }

            function createMarker(place) {
                var placeLoc = place.geometry.location;
                var marker = new google.maps.Marker({
                    map: map,
                    position: place.geometry.location
                });

                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.setContent(place.name);
                    infowindow.open(map, this);
                });
            }

            $('#order_popup_dialog').on("shown.bs.modal", function () {
                google.maps.event.trigger(map, "resize");
            });
        </script>
        {{--<script type="text/javascript" async="async" defer="defer" data-cfasync="false"--}}
                {{--src="https://mylivechat.com/chatinline.aspx?hccid=10733251"></script>--}}
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4VCOsDzZ-3fqwWrxmWWgoPNlXcpvpPvE&libraries=places&callback=getLocation"
                async defer></script>
@endsection