@extends('order_processing')

@section('content')
    <div class="container" style="margin-top:8em;margin-bottom: 8em;">
        <center>
            <h5 id="choice"></h5>
        </center>
        <div id="normal_sandwiches" style="margin-bottom: 4em;">
            <div class="row">

                <div id='sandwich' onclick="bread_selection(this)" class="col-sm-5 tile">
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

        <div id="salads_div" style="margin-bottom: 4em;">
            <div id='mediumsub' onclick="bread_selection(this)" class="col-sm-5 tile">
                <h5 style="margin-top:2em;">Medium Salad </h5>
                <div id='medium_price_salads'></div>
            </div>
            <div id='largesub' onclick="bread_selection(this)" class="col-sm-5 tile">
                <h5 style="margin-top:2em;">Large Salad</h5>
                <div id='large_price_salads'></div>
            </div>
        </div>
        <div id="trays_div" style="margin-bottom: 4em;">
            <div id='sandwich' onclick="bread_selection(this)" class="col-sm-offset-4 col-sm-4 tile">
                <h5 id="choice_name" style="margin-top:2em;"> </h5>
                <div id='sandwich_price_trays'></div>
            </div>
        </div>

    </div>
    </div>



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
            window.alert("Your browser doesn't support a stable version of IndexedDB.")
        }
        var db;
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
//            console.log("menu_items", menu_items);
//            console.log("item_number", item_number);
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
                        $('#normal_sandwiches').hide();
                        $("#trays_div").hide();
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
                        $('#sandwich_price').append('<h5 class="prizes"> R' + (obj.sandwich).toFixed(2) + '</h5>');
                        $('#medium_price').append('<h5 class="prizes"> R' + (obj.mediumsub).toFixed(2) + '</h5>');
                        $('#large_price').append('<h5 class="prizes"> R' + (obj.largesub).toFixed(2) + '</h5>');
                        $('#wrap_price').append('<h5 class="prizes"> R' + (obj.wrap).toFixed(2) + '</h5>');
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

                        }
                    });

                }
            });
            if(sessionStorage.getItem("route_item_category")==7){
                var link_to = sessionStorage.getItem('item_id');
                window.location.href = '/select_ingredients_toppings_salads/'+link_to;
            }else if(sessionStorage.getItem('item_category')=="Wrap"){
                var link_to = sessionStorage.getItem('item_id');
                window.location.href = '/select_ingredients_toppings/'+link_to;
            }
            else {
                var link_to = sessionStorage.getItem('item_id');
                window.location.href = '/process_order/'+link_to;
            }

        }

    </script>

@endsection