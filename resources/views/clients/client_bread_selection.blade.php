@extends('client_processing')

@section('content')
    <div class="container-fluid" style="margin-top:5em;margin-bottom: 5em;">
        <div id="normal_steps" class="row">
            <div class="step-container" style="width: 100%; margin: 0 auto"></div>
        </div>
        {{--<a id="cart_btn" hidden  class=" btn pull-right" onclick="show_cart()" style="margin-top:1em; margin-right:1em;">CHECKOUT<i class="fa fa-shopping-cart" ></i><span style="color:red" id="order_count"></span> </a>--}}

        <div id="normal_sandwiches" style="margin-bottom: 4em;">
            <div class="row">
                <center>
                    <h5 style="font-weight: bolder;" id="choice"></h5>
                </center>
                {{--<button class="btn pull-right" onclick="goBack()"><i class="fa fa-arrow-left"></i> Back</button>--}}
            </div>
            <div class="row" id="with_sandwiches">
                <div class="row">

                    <div id='sandwich' onclick="bread_selection(this)" class="col-sm-5  tile">
                        <h5 style="margin-top:2em;">Sandwich </h5>
                        <div id='sandwich_price'></div>
                    </div>
                    <div id='mediumsub' onclick="bread_selection(this)" class="col-sm-5 tile">
                        <h5 style="margin-top:2em;">Medium Sub - 15cm </h5>
                        <div id='medium_price'></div>
                    </div>
                </div>
                <div class="row">
                    <div id='largesub' onclick="bread_selection(this)" class="col-sm-5 tile">
                        <h5 style="margin-top:2em;">Large - 22cm </h5>
                        <div id='large_price'></div>
                    </div>
                    <div id='wrap' onclick="bread_selection(this)" class="col-sm-5 tile">
                        <h5 style="margin-top:2em;">Wrap</h5>
                        <div id='wrap_price'></div>
                    </div>
                </div>
            </div>

            <div class="row" hidden id="without_sandwiches">

                <div class="row">
                    <div id='mediumsub' onclick="bread_selection(this)" class="col-sm-5 tile">
                        <h5 style="margin-top:2em;">Medium Sub - 15cm </h5>
                        <div id='medium_price_sandwiches'></div>
                    </div>

                    <div id='largesub' onclick="bread_selection(this)" class="col-sm-5 tile">
                        <h5 style="margin-top:2em;">Large - 22cm </h5>
                        <div id='large_price_sandwiches'></div>
                    </div>
                </div>
                <div class="row">
                    <div id='wrap' onclick="bread_selection(this)" class="col-sm-5 tile">
                        <h5 style="margin-top:2em;">Wrap</h5>
                        <div id='wrap_price_sandwiches'></div>
                    </div>
                </div>
            </div>
        </div>


        <div id="salads_div" style="margin-bottom: 4em;margin-left: 1em;">
            <div class="row">
                <div class="step-container_salads" style="width: 100%; margin: 0 auto"></div>
            </div>
            <div class="row">
                <center>
                    <h5 style="font-weight: bolder;" id="choice_salads"></h5>
                </center>
                {{--<button class="btn pull-right" onclick="goBack()"><i class="fa fa-arrow-left"></i> Back</button>--}}
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <img id="salad_image" width="300px" height="250px" class="img-responsive img-rounded" />
                </div>
                <div class="col-sm-9">
                    <p style="color:black;">Party Salads are available on request. You can substitue standard for pasta with any of our salads.</p>
                    <table>
                        <thead>
                        <th>Standard</th><th>Optional</th><th>Dressing</th>
                        </thead>
                        <tr><td>@foreach($ingredients as $ingr)
                                    @foreach($all_ingredients as $ingr_2)
                                        @if($ingr->ingredient_id==$ingr_2->id)
                                            <span>{{$ingr_2->name. " , "}}</span>
                                        @endif
                                    @endforeach
                                @endforeach</td><td>Onions & green peppers</td><td>CHEF'S DRESSING, CREAMY YOGURT & MUSTARD DRESSING, SEAFOOD DRESSING</td></tr>
                    </table>
                    {{--<p id="salads_ingredients_list" style="color:black;">Your salad will come with the following ingredients:</p>--}}
                    {{----}}
                </div>

            </div>
            <div class="row" style="margin-left: 1em;">
                <center>
                    <label style="text-align: center">Select Salad Serving Size </label>
                </center>
            </div>
            <div class="row">

                <div id='mediumsub' onclick="bread_selection(this)" class="col-sm-5 tile">
                    <h5 style="margin-top:2em;">Medium Salad - 500g </h5>
                    <div id='medium_price_salads'></div>
                </div>
                <div id='largesub' onclick="bread_selection(this)" class="col-sm-5 tile">
                    <h5 style="margin-top:2em;">Large Salad - 750g</h5>
                    <div id='large_price_salads'></div>
                </div>
            </div>

        </div>
        <div id="trays_div" style="margin-bottom: 4em;margin-left: 4em;">
            <div class="row">
                <center>
                    <h5 style="font-weight: bolder;" id="choice"></h5>
                </center>
                {{--<button class="btn pull-right" onclick="goBack()"><i class="fa fa-arrow-left"></i> Back</button>--}}
            </div>
            <div id='sandwich' onclick="bread_selection(this)" class="col-sm-offset-4 col-sm-4 tile">
                <h5 id="choice_name" style="margin-top:2em;"> </h5>
                <div id='sandwich_price_trays'></div>
            </div>
        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
            <?php $menu_items = json_encode($menu_items);?>
        var item_number = sessionStorage.getItem('item_number_1');
        window.indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB ||
            window.msIndexedDB;

        window.IDBTransaction = window.IDBTransaction || window.webkitIDBTransaction ||
            window.msIDBTransaction;
        window.IDBKeyRange = window.IDBKeyRange ||
            window.webkitIDBKeyRange || window.msIDBKeyRange

        if (!window.indexedDB) {
            window.alert("Your browser doesn't support a critical feature required for this application, please upgrade your browser.")
        }
        var db,db_cart;
        var db_toppings;

        var toppings_request = window.indexedDB.open("toppings_cart", 1);
        var request = window.indexedDB.open("order_cart",2);
        request.onerror = function (event) {
            console.log("error: ");
        };

        request.onsuccess = function (event) {
            db = request.result;
            clearIngredients(db);
        };
        request.onupgradeneeded = function (event) {
            var db = event.target.result;
            var objectStore = db.createObjectStore("selected_ingredients", {keyPath: "id"});
            clearIngredients(db);
//     readAll(db);
        }
        toppings_request.onerror = function (event) {
            console.log("error: ", event);
        };

        toppings_request.onsuccess = function (event) {
            db_toppings = event.target.result;
            clearToppings(db_toppings);
        };
        toppings_request.onupgradeneeded = function (event) {
            db_toppings = event.target.result;

            var transaction = event.target.transaction;
            var objectStore_toppings = db_toppings.createObjectStore("selected_toppings", {
                keyPath: "id",
                autoIncrement: true
            });
            transaction.oncomplete = function (event) {
                clearToppings(db_toppings);
            }
        }
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
        };
        function count_orders(db_cart) {
//        console.log("carting pano");
            var objectStore = db_cart.transaction(["complete_orders"], "readwrite").objectStore("complete_orders");
            var countRequest = objectStore.count();
            console.log("count req", countRequest);
            countRequest.onsuccess = function () {
                var count = countRequest.result;
                console.log("Count", count);
                sessionStorage.setItem("order_quantity",count);
                $("#order_count").append('<sup style="font-weight: bolder;">'+sessionStorage.getItem("order_quantity")+'*</sup>');
            }
        }
        function goBack(){
            window.history.back();
        }

        function clearIngredients(db) {
            var objectStore = db.transaction(["selected_ingredients"], "readwrite").objectStore("selected_ingredients");
            var objectStoreRequest = objectStore.clear();
            objectStoreRequest.onsuccess = function (event) {
                // report the success of our request
                console.log("cleared successfully");
            };
        }
        function clearToppings(db_toppings) {
            var objectStore = db_toppings.transaction(["selected_toppings"], "readwrite").objectStore("selected_toppings");
            var objectStoreRequest = objectStore.clear();
            objectStoreRequest.onsuccess = function (event) {
                // report the success of our request
                console.log("toppings cleared successfully");
            };
        }

        $(document).ready(function () {
            var menu_items = {!!$menu_items!!};
            console.log("menut items",menu_items);
            $('.step-container').stepMaker({
                steps: ['Item Size', 'Ingredients', 'Delivery','Receipt'],
                currentStep: 1
            });
            $('.step-container_salads').stepMaker({
                steps: ['Salad Size', 'Ingredients', 'Delivery','Receipt'],
                currentStep: 1
            });
            $("#salad_image").attr("src","/"+sessionStorage.getItem("item_image"));
            $.each(menu_items, function (idx, obj) {
//            console.log("check obj",obj);
                if (item_number == obj.item_number) {
                    var name_cur = obj.item_name;
                    var item_category = obj.item_category;
                    sessionStorage.setItem("route_item_category",item_category);
                    sessionStorage.setItem('item_name', name_cur);
                    $('#choice').append(sessionStorage.getItem('item_name'));
                    $('#choice_name').empty();
                    $('#choice_name').append(sessionStorage.getItem('item_name').toLowerCase());

                    $('.prizes').remove();
                    if (item_category == 7) {
                        $('#choice_salads').append(sessionStorage.getItem('item_name'));
                        $('#normal_sandwiches').hide();
                        $("#trays_div").hide();
                        $("#normal_steps").hide();
                        $("#salad_steps").show();
                        $('#medium_price_salads').append('<h5 class="prizes"> R' + (obj.mediumsub).toFixed(2) + '</h5>');
                        $('#large_price_salads').append('<h5 class="prizes"> R' + (obj.largesub).toFixed(2) + '</h5>');

                    } else if (item_category >= 18 && item_category <= 22) {
                        $('#sandwich_price_trays').append('<h5 class="prizes"> R' + (obj.sandwich).toFixed(2) + '</h5>');
                        $('#normal_sandwiches').hide();
                        $("#salads_div").hide();
                    }
                    else {
                        $("#trays_div").hide();
                        $("#salads_div").hide();
                        if(sessionStorage.getItem("item_number_1")==27||sessionStorage.getItem("item_number_1")==28){
//                            $('#sandwich_price').append('<h5 class="prizes"> R' + (obj.sandwich).toFixed(2) + '</h5>');
                            $("#with_sandwiches").hide();
                            $("#without_sandwiches").show();
                            $('#medium_price_sandwiches').append('<h5 class="prizes"> R' + (obj.mediumsub).toFixed(2) + '</h5>');
                            $('#large_price_sandwiches').append('<h5 class="prizes"> R' + (obj.largesub).toFixed(2) + '</h5>');
                            $('#wrap_price_sandwiches').append('<h5 class="prizes"> R' + (obj.wrap).toFixed(2) + '</h5>');
                        }else{
                            $('#sandwich_price').append('<h5 class="prizes"> R' + (obj.sandwich).toFixed(2) + '</h5>');
                            $('#medium_price').append('<h5 class="prizes"> R' + (obj.mediumsub).toFixed(2) + '</h5>');
                            $('#large_price').append('<h5 class="prizes"> R' + (obj.largesub).toFixed(2) + '</h5>');
                            $('#wrap_price').append('<h5 class="prizes"> R' + (obj.wrap).toFixed(2) + '</h5>');
                        }
                    }
                }
            });
        });
        function bread_selection(obj) {
            var menu_items = {!!$menu_items!!};
            var menu_items_1 = {!!$menu_items_1!!};
            var cur_id = obj.id;
            var item_number = sessionStorage.getItem('item_number_1');
            $.each(menu_items, function (idx, obj) {
//                console.log(obj);
                if (sessionStorage.getItem('item_number_1') == obj.item_number) {
                    if (cur_id == 'sandwich') {
                        $.each(menu_items_1, function (idx, obj) {
                            if (item_number == obj.item_number && obj.item_size_id == '1') {
                                sessionStorage.setItem('item_category_price', obj.prize);
                                sessionStorage.setItem('item_category', 'Sandwich');
                                sessionStorage.setItem('item_id', obj.id);
                                sessionStorage.setItem('item_size_id',1);
                            }
                        });
                    }
                }
                else if (cur_id == 'mediumsub') {
                    $.each(menu_items_1, function (idx, obj) {
                        if (item_number == obj.item_number && obj.item_size_id == '2') {

                            if(sessionStorage.getItem("route_item_category")==7){
                                sessionStorage.setItem("quantity",1);
                                sessionStorage.setItem('item_category_price', obj.prize);
                                sessionStorage.setItem('total_due', obj.prize);
                                sessionStorage.setItem('item_category', 'Medium Salad');
                            }else{
                                sessionStorage.setItem('item_category_price', obj.prize);
                                sessionStorage.setItem('item_category', 'Medium Sub');
                                sessionStorage.setItem('item_size_id',2);
                            }
                            sessionStorage.setItem('item_id', obj.id);
                        }

                    });
                }
                else if (cur_id == 'largesub') {
                    $.each(menu_items_1, function (idx, obj) {
                        if (item_number == obj.item_number && obj.item_size_id == '3') {

                            if(sessionStorage.getItem("route_item_category")==7){
                                sessionStorage.setItem('item_category_price', obj.prize);
                                sessionStorage.setItem('total_due', obj.prize);
                                sessionStorage.setItem("quantity",1);
                                sessionStorage.setItem('item_category', 'Large Salad');
                            }else {
                                sessionStorage.setItem('item_category_price', obj.prize);
                                sessionStorage.setItem('item_category', 'Large Sub');
                                sessionStorage.setItem('item_size_id',3);
                            }
                            sessionStorage.setItem("bread_type","");
                            sessionStorage.setItem('item_id', obj.id);
                        }

                    });
                }
                else if (cur_id == 'wrap') {
                    $.each(menu_items_1, function (idx, obj) {
                        if (item_number == obj.item_number && obj.item_size_id == '4') {
                            sessionStorage.setItem('item_category_price', obj.prize);
                            sessionStorage.setItem('total_due', obj.prize);
                            sessionStorage.setItem('item_category', 'Wrap');
                            sessionStorage.setItem('item_id', obj.id);
                            sessionStorage.setItem('quantity', 1);
                            sessionStorage.setItem('selected_toast',"No Toast");
                            sessionStorage.setItem("bread_type","White Bread");
                            sessionStorage.setItem('item_size_id',4);

                        }
                    });

                }
            });
            if(sessionStorage.getItem("route_item_category")==7){
                var link_to = sessionStorage.getItem('item_id');
                sessionStorage.setItem("complete_orders_due",sessionStorage.getItem("total_due"));
                window.location.href = '/select_ingredients_toppings_salads_client/'+link_to;
            }else if(sessionStorage.getItem('item_category')=="Wrap"){
                var link_to = sessionStorage.getItem('item_id');
                window.location.href = '/select_ingredients_toppings_client/'+link_to;
            }
            else {
                var link_to = sessionStorage.getItem('item_id');
                window.location.href = '/client_process_order/'+link_to;
            }

        }

    </script>

@endsection