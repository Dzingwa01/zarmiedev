@extends('order_processing')
@section('content')
<div class="container" style="margin-top:8em">

    <div class="row" >

        <div class="col-sm-8">
            <h5>Enter Your Personal Information</h5>
            <form id="order_completion_form" col="col-md-10">
                <div class="row">
                <p class="col-md-6" style="color:black">
                    <label for="phone_number" >Phone Number</label>
                    <input id='phone_number' type='tel'  placeholder="Enter your phone number" required>
                </p>
                    <p id="email_address_div" class="col-md-6" style="color:black">
                        <label for="email_address" >Email</label>
                        <input id='email_address' type='email'  disabled required>
                    </p>

                </div>
                <div class="row">
                    <p id="name_p" class="col-md-6" style="color:black">
                        <label  for="first_name" >First Name</label>
                        <input  id='first_name' type='text'  placeholder="Enter your first name" required>

                    </p>
                    <p id="surname_p" class="col-md-6" style="color:black">
                        <label for="last_name" >Last Name</label>
                        <input id='last_name' type='text'  placeholder="Enter your last name" required>

                    </p>
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
                    <div id ='choice'>
                    </div>
                    <div id ='item_bread'>
                    </div>
                    <div id ='item_amount'>
                    </div>
                    <div id ='item_prize'></div>
                    <div id ='item_ingredients'></div>
                    <div id ='address_div'></div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<div id="new_account" class="modal" >

        <!-- Modal content-->
        {{--<div class="modal-content">--}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create Account</h4>
            </div>
            <div class="modal-body">
                <p style="color:black;">You currently do not have an account with zarmie. Please complete the form below</p>
                <form id="order_completion_form" col="col-md-10">
                    <fieldset><legend>Enter Account Registration details</legend>
                    <div class="row">
                        <p class="col-md-6" style="color:black">
                            <label for="phone_number" >Phone Number</label>
                            <input id='phone_number' type='tel'  placeholder="Enter your phone number" required>
                        </p>
                        <p id="email_address_div" class="col-md-6" style="color:black">
                            <label for="email_address_dialog" >Email</label>
                            <input id='email_address_dialog' type='email'  required>
                        </p>

                    </div>
                    <div class="row">
                        <p id="name_p" class="col-md-6" style="color:black">
                            <label  for="first_name_dialog" >First Name</label>
                            <input  id='first_name_dialog' type='text'  placeholder="Enter your first name" required>

                        </p>
                        <p id="surname_p" class="col-md-6" style="color:black">
                            <label for="last_name_dialog" >Last Name</label>
                            <input id='last_name_dialog' type='text'  placeholder="Enter your last name" required>

                        </p>
                    </div>
                        <div class="row">
                            <p id="address" class="col-md-6" style="color:black">
                                <label  for="address_dialog" >Address</label>
                                <textarea  id='address_dialog' class="materialize-textarea"></textarea>

                            </p>

                        </div>
                    <div class="row" style="margin-top:2em;" style="color:black">
                        <div class="col-sm-offset-2 col-sm-2" style="margin-top:1em;">
                            <button id='' class="btn waves-effect waves-light">Cancel</button>
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
        border: 1px solid!important;
        border-radius: 2px 0 0 2px!important;
        box-sizing: border-box!important;
        -moz-box-sizing: border-box!important;
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
    input[type=text]{
        background-color:white;
    }
    .modal{
        z-index: 20;
    }
    .modal-backdrop{
        z-index: 10;
    }​
     #address {
         background-color: #fff!important;
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
    request.onerror = function(event) {
        console.log("error: ");
    };

    request.onsuccess = function(event) {
        db = request.result;
        console.log("success: "+ db);
    };
    request.onupgradeneeded = function(event) {
        var db = event.target.result;
        var objectStore = db.createObjectStore("selected_ingredients", {keyPath: "id"});
    }

    function readAll() {
        var objectStore = db.transaction(["selected_ingredients"],"readwrite").objectStore("selected_ingredients");

        objectStore.openCursor().onsuccess = function(event) {
            var cursor = event.target.result;
            console.log("cursor",cursor);
            if (cursor) {
                $('#item_ingredients').append('<button id='+cursor.value.id+' class="glass" style="font-weight:bolder;margin-left:1em;color:white;">'+cursor.value.name+'</button>');
                cursor.continue();
            } else {
            }
        };
    }
    $(document).ready(function(){
//        $('#name_p').hide();
//        $('#surname_p').hide();
//        $('#email_address_div').hide();
        $('#choice').append('<h6><b>Choice - </b>'+sessionStorage.getItem('item_name')+'</h6>');
        $('#type').append('<h6> <b>Type - </b>'+sessionStorage.getItem('item_category')+'</h6>');
        $('#item_bread').append('<h6><b>Bread Choice - </b>'+sessionStorage.getItem('bread_type') + ' - ' +sessionStorage.getItem('selected_toast') + '</h6>');
        $('#item_prize').append('<h6> <b>Prize - </b> R '+Number(sessionStorage.getItem('total_due')).toFixed(2)+'</h6>');
        $('#item_amount').append('<h6> <b>Quantity - </b>'+sessionStorage.getItem('quantity')+'</h6>');
        $('#address_div').append('<h6> <b>Address </b><br/>'+sessionStorage.getItem('delivery_address')+'</h6>');
        readAll();
        $('#phone_number').on('blur',function(){
            $.get("/get_user_by_phone/"+$('#phone_number').val(),function(data,status){
//                console.log("data",data);
                if(data.user){
//                    $('#name_p').show();
//                    $('#surname_p').show();
//                    $('#email_address_div').show();
                    $("#first_name").val(data.user.name);
                    $("#last_name").val(data.user.surname);
                    $("#email_address").val(data.user.email);

                }
                else{
                    $('#address_dialog').val(sessionStorage.getItem("delivery_address"));
                    $("#new_account").modal()
                }

            });
        });

        $("#address_form").on('submit',function(e){
            e.preventDefault();
            sessionStorage.setItem("delivery_address",$("#address").val());
            window.location.href = "{{'/order_completion'}}";
            console.log("submisison comes here",$("#address").val());

        });
        $("#complete_back").on('click',function(e){
            e.preventDefault();
            window.location.href = "{{'/address_selection'}}";
        });
    });

</script>
<script type="text/javascript" async="async" defer="defer" data-cfasync="false" src="https://mylivechat.com/chatinline.aspx?hccid=10733251"></script>
@endsection