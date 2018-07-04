@extends('order_processing')
@section('content')
    <div class="container" style="margin-top:8em">

        <div class="row">

            <div class="col-sm-8">
                <h5>Complete your order - Login to complete</h5>
                <form id="order_completion" col="col-md-10" role="form" method="POST">
                    <input id="_token" name="_token" value="{{ csrf_token() }}" hidden>
                    <div class="row">
                        <p class="col-md-6" style="color:black">
                            <label for="contact_number">Phone Number</label>
                            <input id='contact_number' type='tel' placeholder="Enter your phone number" required>
                        </p>
                        {{--<p id="email_address_div" class="col-md-6" style="color:black">--}}
                        {{--<label for="email_address" >Email</label>--}}
                        {{--<input id='email_address' type='email'  disabled required>--}}
                        {{--</p>--}}
                        <input id='email' type='email'  hidden required>
                    </div>
                    <div class="row">
                        <p id="name_p" class="col-md-6" style="color:black">
                            <label for="password">Password</label>
                            <input id='password' type='password' placeholder="Enter your account password" required>
                        </p>
                        {{--<p id="surname_p" class="col-md-6" style="color:black">--}}
                        {{--<label for="last_name" >Last Name</label>--}}
                        {{--<input id='last_name' type='text'  placeholder="Enter your last name" required>--}}

                        {{--</p>--}}
                    </div>
                    <div class="row" style="margin-top:2em;" style="color:black">
                        <div class="col-sm-offset-2 col-sm-2" style="margin-top:1em;">
                            <button id='complete_back' class="btn waves-effect waves-light">Back</button>
                        </div>
                        <div class="col-sm-offset-1 col-sm-2" style="margin-top:1em;">
                            <button id='complete' class="btn waves-effect waves-light">Submit</button>
                        </div>
                    </div>

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
                        <div id='item_ingredients'></div>
                        <div id='address_div'></div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div id="new_account" class="modal">

        <!-- Modal content-->
        {{--<div class="modal-content">--}}
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create Account</h4>
        </div>
        <div class="modal-body">
            <p style="color:black;">You currently do not have an account with zarmie. Please complete the form below</p>
            <form id="order_completion_form" col="col-md-10">
                <fieldset>
                    <legend>Enter Account Registration details</legend>
                    <div class="row">
                        <p class="col-md-6" style="color:black">
                            <label for="phone_number">Phone Number</label>
                            <input id='phone_number' type='tel' placeholder="Enter your phone number" required>
                        </p>
                        <p id="email_address_div" class="col-md-6" style="color:black">
                            <label for="email_address_dialog">Email</label>
                            <input id='email_address_dialog' type='email' required>
                        </p>

                    </div>
                    <div class="row">
                        <p id="name_p" class="col-md-6" style="color:black">
                            <label for="first_name_dialog">First Name</label>
                            <input id='first_name_dialog' type='text' placeholder="Enter your first name" required>

                        </p>
                        <p id="surname_p" class="col-md-6" style="color:black">
                            <label for="last_name_dialog">Last Name</label>
                            <input id='last_name_dialog' type='text' placeholder="Enter your last name" required>

                        </p>
                    </div>
                    <div class="row">
                        <p id="address" class="col-md-6" style="color:black">
                            <label for="address_dialog">Address</label>
                            <textarea id='address_dialog' class="materialize-textarea"></textarea>

                        </p>

                    </div>
                    <div class="row" style="margin-top:2em;" style="color:black">
                        <div class="col-sm-offset-2 col-sm-2" style="margin-top:1em;">
                            <button id='cancel' class="btn waves-effect waves-light" data-dismiss="modal">Cancel
                            </button>
                        </div>
                        <div class="col-sm-offset-1 col-sm-2" style="margin-top:1em;">
                            <button id='register_new_account' class="btn waves-effect waves-light">Submit</button>
                        </div>
                    </div>
                </fieldset>

            </form>
        </div>
        {{--<div class="modal-footer">--}}
        {{--<div class="col-sm-offset-2 col-sm-2" style="margin-top:1em;">--}}
        {{--<button type="button" class="btn waves-effect waves-light" data-dismiss="modal">Cancel</button>--}}
        {{--</div>--}}
        {{--<div class="col-sm-offset-1 col-sm-2" style="margin-top:1em;">--}}
        {{--<button id='complete' class="btn waves-effect waves-light">Submit</button>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}

    </div>
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
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
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
            console.log("error: ");
        };

        request.onsuccess = function (event) {
            db = request.result;
            console.log("success: " + db);
        };
        request.onupgradeneeded = function (event) {
            var db = event.target.result;
            var objectStore = db.createObjectStore("selected_ingredients", {keyPath: "id"});
        }

        function clearIngredients() {
            var objectStore = db.transaction(["selected_ingredients"], "readwrite").objectStore("selected_ingredients");
            var objectStoreRequest = objectStore.clear();
            objectStoreRequest.onsuccess = function (event) {
                // report the success of our request
                console.log("cleared successfully");
            };
        }
        function readAll() {

            var objectStore = db.transaction(["selected_ingredients"], "readwrite").objectStore("selected_ingredients");

            objectStore.openCursor().onsuccess = function (event) {
                var cursor = event.target.result;
                var ingredients = {!! $ingredients !!};

                if (cursor) {
                    for (var i = 0; i < ingredients.length; i++) {
                        if (ingredients[i].ingredient_id == cursor.value.id) {
                            $("#" + cursor.value.id).remove();
                            $('#item_ingredients').append('<button id=' + cursor.value.id + ' class="glass" style="font-weight:bolder;margin-left:1em;color:white;">' + cursor.value.name + '</button>');
                            break;
                        }
                    }
                    cursor.continue();
                } else {
//                      alert("No more entries!");
                }
            };
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
        $(document).ready(function () {

            var qty = sessionStorage.getItem('quantity');
            if (qty == 1) {
                $("#decrease_el").hide();
            }
            $('#item_ingredients').append('<h6><b>Ingredients</b></h6>');
            $('#choice').append('<h6><b>Choice - </b>' + sessionStorage.getItem('item_name') + '</h6>');
            $('#type').append('<h6> <b>Type - </b>' + sessionStorage.getItem('item_category') + '</h6>');
            $('#item_bread').append('<h6><b>Bread Choice - </b>' + sessionStorage.getItem('bread_type') + ' - ' + sessionStorage.getItem('selected_toast') + '</h6>');
            $('#item_prize').append('<h6> <b>Prize - </b> R ' + Number(sessionStorage.getItem('total_due')).toFixed(2) + '</h6>');
            $('#item_amount').append('<h6>' + sessionStorage.getItem('quantity') + '</h6>');
            $('#address_div').append('<h6> <b>Address </b><br/>' + sessionStorage.getItem('delivery_address') + '</h6>');
            readAll();
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
                        $("#new_account").modal()
                    }

                });
            });

            $("#order_completion").on('submit', function (e) {
                e.preventDefault();

                var formData = new FormData();
                formData.append('_token', $("#_token").val());
                formData.append('phone_number', $("#contact_number").val());
                formData.append('email', $("#email").val());
                formData.append('remember','yes');
                formData.append('password', $("#password").val());
                formData.append('item_name', sessionStorage.getItem('item_name'));
                formData.append('item_category', sessionStorage.getItem('item_category'));
                formData.append('bread_type', sessionStorage.getItem('bread_type') + ' - ' + sessionStorage.getItem('selected_toast'));
                formData.append('prize', Number(sessionStorage.getItem('total_due')).toFixed(2));
                formData.append('quantity', sessionStorage.getItem('quantity'));
                formData.append('address', sessionStorage.getItem('delivery_address'));
                console.log("sending",formData);
                var count = 0;
                $(".glass").each(function (idx, obj) {
                    count += 1;
                    formData.append('ingredients_array[]', obj.id);
                });

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
                    window.location.href ="/";
                    },
                    error: function (response) {
                        console.log("error", response);
                        alert(response.status);
                    }
                });

            });
            $("#complete_back").on('click', function (e) {
                e.preventDefault();
                var link_to = sessionStorage.getItem('item_id');
                window.location.href = '/address_selection/' + link_to;
                {{--window.location.href = "{{'/address_selection'}}";--}}
            });
        });

    </script>
    <script type="text/javascript" async="async" defer="defer" data-cfasync="false"
            src="https://mylivechat.com/chatinline.aspx?hccid=10733251"></script>
@endsection