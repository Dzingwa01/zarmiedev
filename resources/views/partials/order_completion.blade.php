@extends('order_processing')
@section('content')
    <div class="container-fluid" style="margin-top:1em">
        <div id="normal_tracker" class="row">
            <div id="normal_tracker" class="step-container" style="width: 450px; margin: 0 auto"></div>
        </div>
        <div class="row" id="trays_tracker">
            <div id="trays_tracker" class="step-container_trays" style="width: 450px; margin: 0 auto"></div>
        </div>
        <div class="row">
            <div class="col m7 card" style="margin-left: 2em;">
                <h5>Complete your order - Login to complete</h5>
                <form id="order_completion" role="form" method="POST">
                    <input id="_token" name="_token" value="{{ csrf_token() }}" hidden>
                    <div class="row">
                        <div class="input-field col m6">
                            <label for="contact_number" class="active">Phone Number</label>
                            <input id='contact_number' type='tel' required class="validate">
                        </div>
                        <input id='email' type='email' hidden required>

                        <div class="input-field col m6">
                            <label class="active" for="password">Password</label>
                            <input id='password' type='password'  required>
                        </div>
                    </div>
                    <div class="row" style="margin-top:1em;" >
                        <div class="col offset-m1 col m10" style="margin-bottom:1em;">

                            <button id='complete_back' class="btn waves-effect waves-light "><i class="material-icons">arrow_back</i> Back</button>

                            <button id='complete' class="btn waves-effect waves-light pull-right">Submit <i class="material-icons">send</i></button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col m4 card" style="margin-left: 1em;">
                <p ><span style="color:black;font-weight:bolder;font-size: 1.2em;">Order Details <i
                                class="fa fa-shopping-cart"></i></span><span style="color:black;margin-left: 8px;font-weight: bolder"
                                                                             id="order_count"></span> <span  style="font-weight: bolder;margin-left:2em;color:black;font-size:1.2em;"
                                                                                                             id="all_total_due"></span></p>
                <form style="height: 400px;overflow-y: scroll;">
                    <div id='checkout_div'>

                    </div>

                </form>
            </div>
        </div>
    </div>
    <div id="new_account" class="modal">
        <!-- Modal content-->
        {{--<div class="modal-content">--}}
        <div class="modal-header">
            <button type="button" class="close" onclick="dismiss()">&times;</button>
            <h5 class="modal-title">Create Account</h5>
        </div>
        <div class="modal-body">
            <p style="color:black;">You currently do not have an account with zarmie. Please complete the form below</p>
            <form id="order_completion_form" col="col-md-10" role="form" method="POST">
                <input id="_token" name="_token" value="{{ csrf_token() }}" hidden>
                <fieldset>
                    <legend>Enter Account Registration details</legend>
                    <div class="row">
                        <p id="name_p" class="col-md-6" style="color:black">
                            <label for="phone_number" class="active">Phone Number</label>
                            <input id='phone_number_dialog' type='tel' required>
                        </p>

                        <div class="input-field col s6">
                            <label for="email_address_dialog" class="active">Email</label>
                            <input id='email_address_dialog' type='email' required>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <label for="first_name_dialog" class="active">First Name</label>
                            <input id='first_name_dialog' type='text' required>

                        </div>
                        <div class="input-field col s6">
                            <label for="last_name_dialog" class="active">Last Name</label>
                            <input id='last_name_dialog' type='text' required>

                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <label class="active" for="password">Password</label>
                            <input id='password_dialog' type='password'
                                   required>
                        </div>
                            <div class="input-field col s6">
                            <label for="confirm_password" >Confirm Password</label>
                            <input id='confirm_password' type='password'
                                   required>
                        </div>
                    </div>
                    <div class="row">
                        <p id="address" class="col-md-6" style="color:black">
                            <label for="address_dialog">Address</label>
                            <textarea id='address_dialog' class="materialize-textarea"></textarea>
                        </p>

                    </div>
                    <div class="row" style="margin-top:2em;" >
                        <div class="col offset-s2 col s2" style="margin-bottom:1em;">
                            <button id='cancel' class="btn waves-effect waves-light" onclick="dismiss()">Cancel
                            </button>
                        </div>
                        <div class="col offset-s2 col s2" style="margin-bottom:1em;">
                            <button id='register_new_account' class="btn waves-effect waves-light">Submit</button>
                        </div>
                    </div>
                </fieldset>

            </form>
        </div>

    </div>
    <style>
        .active:after {
            content: ""
        }

        label:after {
            content: ""
        }
        .sidenav-overlay{z-index:99;}
    </style>

    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
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
        var cart_request = window.indexedDB.open("complete_orders", 1);
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
        var toppings_request = window.indexedDB.open("toppings_cart", 1);
        var request = window.indexedDB.open("order_cart", 2);
        request.onerror = function (event) {
            console.log("error: ");
        };
        request.onsuccess = function (event) {
            db = request.result;
//            readAll();
        };
        request.onupgradeneeded = function (event) {
            var db = event.target.result;
            var objectStore = db.createObjectStore("selected_ingredients", {keyPath: "id"});
//            readAll();
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
//                readToppings();
            }
        }
function dismiss() {
    $('.modal').hide();
}
        function readToppings() {
            var objectStore = db_toppings.transaction(["selected_toppings"], "readwrite").objectStore("selected_toppings");
            objectStore.openCursor().onsuccess = function (event) {
                var cursor = event.target.result;
                if (cursor) {
                    $("#" + cursor.value.id).remove();
                    $('#extra_toppings_cart').append('<button id=' + cursor.value.id + '  class="glass" style="font-weight:bolder;margin-left:1em;color:white;">' + cursor.value.name + '</button>');

                    cursor.continue();
                }
            };
        }

        function readAll() {
            var objectStore = db.transaction(["selected_ingredients"], "readwrite").objectStore("selected_ingredients");
            objectStore.openCursor().onsuccess = function (event) {
                var cursor = event.target.result;
                var ingredients = {!! $ingredients !!};
                console.log("cursor", cursor);
                console.log("ingred", ingredients);
                if (cursor) {
                    $("#" + cursor.value.id).remove();
                    $('#item_ingredients').append('<button id=' + cursor.value.id + '  class="glass" style="font-weight:bolder;margin-left:1em;color:white;">' + cursor.value.name + '</button>');

                    cursor.continue();
                }
            };
        }

        function clearIngredients() {
            var objectStore = db.transaction(["selected_ingredients"], "readwrite").objectStore("selected_ingredients");
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
        function read_all_complete_orders() {
            var objectStore = db_cart.transaction(["complete_orders"], "readwrite").objectStore("complete_orders");
            var total_cost = 0;
            objectStore.openCursor().onsuccess = function (event) {
                var cursor = event.target.result;
                if (cursor) {
                    var with_order = "ord_" + cursor.value.id;
                    total_cost += Number(cursor.value.prize);
                    $("#checkout_div").append('<div id=' + cursor.value.id + ' class="card"><b>' + cursor.value.quantity + ' X ' + cursor.value.item_name + ' - ' + cursor.value.item_category + '<br>' + cursor.value.bread_type + ' - ' + cursor.value.toast_type + '</b><i id=' + with_order + ' onclick="remove_order(this)"  class="fa fa-trash" style="float:right" style="color:red"></i><br/><b>Cost: </b>R' + cursor.value.prize + '</div>');
                    console.log("ingredients", cursor.value.ingredients);
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
//                      total_cost += Number(sessionStorage.getItem("total_due"));
                    console.log("total cost", total_cost);
                    $("#all_total_due").append('Total Due: R' + total_cost.toFixed(2));
                }
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
//                    total_cost += Number(sessionStorage.getItem("total_due"));
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
                    formData.append('phone_number', $("#contact_number").val());
                    formData.append('email', $("#email").val());
                    formData.append('remember', 'yes');
                    formData.append('password', $("#password").val());
                    formData.append('address', sessionStorage.getItem('delivery_address'));
                    formData.append('delivery_or_collect',sessionStorage.getItem('delivery_collect'));
                    if(sessionStorage.getItem('delivery_collect')=="Delivery"){
                        formData.append('delivery_collect_time',sessionStorage.getItem('delivery_time'));
                    }else{
                        formData.append('delivery_collect_time',sessionStorage.getItem('collect_time'));
                    }
                    formData.append('total_cost',sessionStorage.getItem('total_cost'));
                    formData.append('special_instructions',sessionStorage.getItem('instructions'));
                    formData.append("orders",JSON.stringify(orders_array));
                    console.log("sending", formData);

                    $.ajax({
                        url: "{{ route('place_order') }}",
                        processData: false,
                        contentType: false,
                        data: formData,
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function (response, a, b) {
                            console.log("success", response);
                            alert(response.status);
                            clearIngredients();
                            clearCompleteOrders();
                            clearToppings();
                            clearDrinks();
                            window.location.href = "/";
                        },
                        error: function (response) {
                            console.log("error", response);
                            alert(response.status);
                        }
                    });
                }
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
        function read_all_complete_orders_for_submission_new() {
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
                    formData.append('phone_number', $("#phone_number_dialog").val());
                    formData.append('email', $("#email_address_dialog").val());
                    formData.append('password', $("#password_dialog").val());
                    formData.append('first_name', $("#first_name_dialog").val());
                    formData.append('last_name', $("#last_name_dialog").val());
                    formData.append('address', $("#address_dialog").val());
                    formData.append('delivery_or_collect',sessionStorage.getItem('delivery_collect'));
                    if(sessionStorage.getItem('delivery_collect')=="Delivery"){
                        formData.append('delivery_collect_time',sessionStorage.getItem('delivery_time'));
                    }else{
                        formData.append('delivery_collect_time',sessionStorage.getItem('collect_time'));
                    }
                    formData.append('total_cost',sessionStorage.getItem('total_cost'));
                    formData.append('special_instructions',sessionStorage.getItem('instructions'));
                    formData.append("orders",JSON.stringify(orders_array));
                    console.log("sending", formData);

                    $.ajax({
                        url: "{{ route('place_order_new_registration') }}",
                        processData: false,
                        contentType: false,
                        data: formData,
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function (response, a, b) {
                            console.log("success", response);
                            alert(response.status);
                            clearIngredients();
                            clearCompleteOrders();
                            clearToppings();
                            clearDrinks();
                            window.location.href = "/";
                        },
                        error: function (response) {
                            console.log("error", response);
                            alert(response.status);
                        }
                    });
                }
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
        $(document).ready(function () {
            $('.step-container').stepMaker({
                steps: ['Item Size', 'Bread Choice', 'Ingredients', 'Delivery', 'Receipt'],
                currentStep: 5
            });
            $('.step-container_trays').stepMaker({
                steps: ['Item Size', 'Ingredients', 'Delivery', 'Receipt'],
                currentStep: 4
            });
            $(".dropdown-trigger_cus").dropdown();
            $(".dropdown-trigger_cus2").dropdown();
            $('.sidenav').sidenav();
            $("#trays_tracker").hide();
            $("#choice_id").append(sessionStorage.getItem("item_category"));
            if (sessionStorage.getItem("item_category") === "Tray") {
                $("#trays_tracker").show();
                $("#normal_tracker").hide();
            }
            var qty = sessionStorage.getItem('quantity');
            if (qty == 1) {
                $("#decrease_el").hide();
            }
            read_all_complete_orders();
            $('#contact_number').on('blur', function () {
                $.get("/get_user_by_phone/" + $('#contact_number').val(), function (data, status) {
//                console.log("data",data);
                    if (data.user) {
//                    $('#name_p').show();
//                    $('#surname_p').show();
//                    $('#email_address_div').show();
//                        $("#first_name").val(data.user.name);
//                        $("#last_name").val(data.user.surname);
                        $("#email").val(data.user.email);

                    }
                    else {
                        $('#address_dialog').val(sessionStorage.getItem("delivery_address"));
                        $("#phone_number_dialog").val($("#contact_number").val());
                        $("#new_account").show()
                    }

                });
            });
            $("#order_completion_form").on('submit', function (e) {
                e.preventDefault();
                if ($("#password_dialog").val() !== $("#confirm_password").val()) {
                    alert("Passwords do not match");
                }
                else {
                    var formData = new FormData();
                    read_all_complete_orders_for_submission_new();
                }

            });
            $("#order_completion").on('submit', function (e) {
                e.preventDefault();
                read_all_complete_orders_for_submission();


            });
            $("#complete_back").on('click', function (e) {
                e.preventDefault();
                var link_to = sessionStorage.getItem('item_id');
                window.history.back();
                {{--window.location.href = "{{'/address_selection'}}";--}}
            });
        });

    </script>
    {{--<script type="text/javascript" async="async" defer="defer" data-cfasync="false"--}}
            {{--src="https://mylivechat.com/chatinline.aspx?hccid=10733251"></script>--}}
@endsection