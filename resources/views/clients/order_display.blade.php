@extends('client_processing')
@section('content')

    {{--<div class="step-container" style="width: 700px; margin: 0 auto"></div>--}}
    <a id="cart_btn" hidden  class=" btn pull-right" onclick="show_cart()" style="margin-top:1em; margin-right:1em;">CHECKOUT<i class="fa fa-shopping-cart" ></i><span style="color:red" id="order_count"></span> </a>


        <div id='menu_items' class="row" style="">
            @foreach ($categories as $category)
                <center>
                    <h5>{{$category->category_name}}</h5>
                </center>
                <table id="{{$category->id}}" class=" table table-hover table-sm table-striped card" >
                    @if($category->id==18||$category->id==19||$category->id==22||$category->id==21||$category->id==20)
                        <thead>
                        <tr><th>Item Number</th><th>Name</th><th>Price</th></tr>
                        </thead>
                    @elseif($category->id<=6)
                        <thead>
                        <tr><th>Item Number</th><th>Name</th><th>Sandwich</th><th>Medium Sub</th><th>Large Sub</th><th>Wrap</th></tr>
                        </thead>
                    @elseif($category->id<=7)
                        <thead>
                        <tr><th>Item Number</th><th>Name</th><th>Medium</th><th>Large</th></tr>
                        </thead>
                    @endif
                    <tbody>

                    </tbody>
                </table>

        @endforeach
        </div>

    <div id="cart" class="modal">
        <div class="modal-header">
            <h5 class="modal-title">Current Orders</h5>
            <button type="button" class="close" onclick="dismiss()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div id='checkout_div_cart'>

                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button style="margin:1em;" class="btn" onclick="dismiss()"> Cancel</button>

            <button style="margin:1em;" class="btn"
                    onclick="proceed_to_checkout()">Checkout
            </button>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
<script type='text/javascript'>
//    order_now_temp();
    function order_now_temp(){
        alert("The Sandwich ordering module is currenly under maintainance, please place your order telephonically on 041 365 7146 ");
        window.location.href = '/home';
    }
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
    var db;
    var db_toppings;
    var db_cart;

    var toppings_request = window.indexedDB.open("toppings_cart", 1);
    var request = window.indexedDB.open("order_cart",2);
    //    var cart_request = window.indexedDB.open("complete_orders",1);
    request.onerror = function (event) {
        console.log("error: ");
    };

    request.onsuccess = function (event) {
        db = request.result;
//        var objectStore = db.createObjectStore("selected_drinks", {keyPath: "id", autoIncrement: true});
        clearIngredients(db);
        clearDrinks(db);
    };
    request.onupgradeneeded = function (event) {
        db = event.target.result;
        var objectStore = db.createObjectStore("selected_ingredients", {keyPath: "id", autoIncrement: true});
        var objectStore = db.createObjectStore("selected_drinks", {keyPath: "id", autoIncrement: true});
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
//        console.log("cutting");
        var objectStore = db_cart.createObjectStore("complete_orders", {keyPath: "id", autoIncrement: true});

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
    function dismiss(){
        $('.modal').hide();
    }
        function read_all_complete_orders() {
        try{
            var objectStore = db_cart.transaction(["complete_orders"], "readwrite").objectStore("complete_orders");
            var total_cost = 0;
            objectStore.openCursor().onsuccess = function (event) {
                var cursor = event.target.result;
                if (cursor) {
                    var with_order = "ord_" + cursor.value.id;
                    total_cost += Number(cursor.value.prize);
                    var cart_id = "cart_"+cursor.value.id
                    $("#checkout_div_cart").append('<div id=' + cart_id + ' class="card"><b>' + cursor.value.quantity + ' X ' + cursor.value.item_name + ' - ' + cursor.value.item_category + '<br>' + cursor.value.bread_type + ' - ' + cursor.value.toast_type + '</b><i id=' + with_order + ' onclick="remove_order(this)"  class="fa fa-trash" style="float:right" style="color:red"></i><br/><b>Cost: </b>R' + cursor.value.prize + '</div>');
//                        console.log("ingredients", cursor.value.ingredients);
                    var ingredients_string = "";
                    var toppings_string = "";
                    var drinks_string = "";
                    if (cursor.value.ingredients.length > 0) {
                        for (var i = 0; i < cursor.value.ingredients.length; i++) {
                            console.log(cursor.value.ingredients[i]);
                            ingredients_string = ingredients_string + "; " + cursor.value.ingredients[i].name;
                        }
                        $("#" + cart_id).append('<br/><b>Ingredients: </b>' + ingredients_string + '<br/>');

                    }
                    if (cursor.value.toppings.length > 0) {
                        for (var i = 0; i < cursor.value.toppings.length; i++) {
                            toppings_string = toppings_string + "; " + cursor.value.toppings[i].name;
                        }
                        $("#" + cart_id).append('<br/><b>Extra Toppings: </b>' + toppings_string + '<br/>');
                    }
                    if (cursor.value.drinks.length > 0) {
                        for (var i = 0; i < cursor.value.drinks.length; i++) {
                            drinks_string = drinks_string + "; " + cursor.value.drinks[i].name;
                        }
                        $("#" + cart_id).append('<br/><b>Drinks: </b>' + drinks_string + '<br/>');
                    }

                    cursor.continue();
                } else {
                    $("#all_total_due").empty();
                    sessionStorage.setItem('total_cost',total_cost.toFixed(2));
                    $("#all_total_due").append('Total Due: R' + total_cost.toFixed(2));
                }
            };
        }catch(err){

        }

        }
    function count_orders(db_cart) {
//        console.log("carting pano");
        var objectStore = db_cart.transaction(["complete_orders"], "readwrite").objectStore("complete_orders");
        var countRequest = objectStore.count();
        console.log("count req", countRequest);
        countRequest.onsuccess = function () {
            var count = countRequest.result;
            if(count==0){
                $("#cart_btn").hide();
            }else{
                sessionStorage.setItem("order_quantity",count);
                $("#order_count").append('<sup style="font-weight: bolder;">'+sessionStorage.getItem("order_quantity")+'*</sup>');
            }

        }
    }
        function proceed_to_checkout() {
            sessionStorage.setItem("more_order", "more_order");
//            sessionStorage.setItem("order_quantity", 1);
//            add_order_for_checkout();
            window.location.href = '/client_address_selection';
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
                            window.location.href = '/client_address_selection';
                        }
                    } else {
                        var link_to = sessionStorage.getItem('item_id');
                        window.location.href = '/client_address_selection';
                    }

                } else {

                    alert("Please select the ingredients you want");
                }
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
    function show_cart(){
        $("#cart").show();
    }
    function clearDrinks(db) {
        var objectStore = db.transaction(["selected_drinks"], "readwrite").objectStore("selected_drinks");
        var objectStoreRequest = objectStore.clear();
        objectStoreRequest.onsuccess = function (event) {
            // report the success of our request
            console.log("drinks cleared successfully");
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
        function toTitleCase(str) {
            return str.replace(
                /\w\S*/g,
                function(txt) {
                    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
                }
            );
        }
        function compare(a,b) {

            if(!isNaN(a.item_number)&&!isNaN(b.item_number)){
                if (Number(a.item_number) < Number(b.item_number))
                    return -1;
                if (Number(a.item_number) > Number(b.item_number))
                    return 1;
            }else if(!isNaN(a.item_number.substr(1,2))&&!isNaN(b.item_number.substr(1,2))){
                if (Number(a.item_number.substr(1,2)) < Number(b.item_number.substr(1,2)))
                    return -1;
                if (Number(a.item_number.substr(1,2)) > Number(b.item_number.substr(1,2)))
                    return 1;

            }else if(!isNaN(a.item_number.substr(1,1))&&!isNaN(b.item_number.substr(1,1))){
                if (Number(a.item_number.substr(1,1)) < Number(b.item_number.substr(1,1)))
                    return -1;
                if (Number(a.item_number.substr(1,1)) > Number(b.item_number.substr(1,1)))
                    return 1;
            }

        }

        var menu_items = {!!$menu_items!!};
        menu_items.sort(compare);
    var categories = {!! $categories !!};
    //    console.log("categories",categories.length);
    console.log(menu_items);
    $(document).ready(function(){
        $('.collapsible').collapsible();
        var more_order = sessionStorage.getItem("more_order");
            $(".dropdown-trigger").dropdown();
        read_all_complete_orders();
        for(var i=0;i<categories.length;i++){
//              console.log("category",categories[i]);
            $.each(menu_items, function(idx,obj){
                if(categories[i].id === obj.item_category){
                    try{
                        $("#"+categories[i].id).append('<tr id='+"tr_"+obj.item_number+' onclick="process_order(this)"><td>'+obj.item_number+'</td><td>'+toTitleCase(obj.item_name)+'</td><td> R '+(obj.sandwich).toFixed(2)+'</td><td> R '+(obj.mediumsub).toFixed(2)+'</td><td> R '+(obj.largesub).toFixed(2)+'</td><td>'+(obj.wrap).toFixed(2)+'</td></tr>');

                    }catch(err){
                        if(categories[i].id==18||categories[i].id==19||categories[i].id==20||categories[i].id==21||categories[i].id==22){
                            $("#"+categories[i].id).append('<tr id='+"tr_"+obj.item_number+' onclick="process_order(this)"><td>'+obj.item_number+'</td><td>'+toTitleCase(obj.item_name)+'</td><td> R '+(obj.sandwich).toFixed(2)+'</td></tr>');
                        }
                        else if(categories[i].id==7){
                            $("#"+categories[i].id).append('<tr id='+"tr_"+obj.item_number+' onclick="process_order(this)"><td>'+obj.item_number+'</td><td>'+toTitleCase(obj.item_name)+'</td><td> R '+(obj.mediumsub).toFixed(2)+'</td><td> R '+(obj.largesub).toFixed(2)+'</td></tr>');

                        }
                        if(obj.item_number==28||obj.item_number==27){
                            $("#"+categories[i].id).append('<tr id='+"tr_"+obj.item_number+' onclick="process_order(this)"><td>'+obj.item_number+'</td><td>'+toTitleCase(obj.item_name)+'</td><td></td><td> R '+(obj.mediumsub).toFixed(2)+'</td><td> R '+(obj.largesub).toFixed(2)+'</td><td>'+(obj.wrap).toFixed(2)+'</td></tr>');

                        }else if(obj.item_number==25||obj.item_number==33){
                            $("#"+categories[i].id).append('<tr id='+"tr_"+obj.item_number+' onclick="process_order(this)"><td>'+obj.item_number+'</td><td>'+toTitleCase(obj.item_name)+'</td><td></td><td></td><td></td><td> R '+(obj.wrap).toFixed(2)+'</td></tr>');

                        }else if(obj.item_number==32){
                            $("#"+categories[i].id).append('<tr id='+"tr_"+obj.item_number+' onclick="process_order(this)"><td>'+obj.item_number+'</td><td>'+obj.item_name+'</td><td></td><td>R '+(obj.sandwich).toFixed(2)+'</td><td></td><td> </td></tr>');

                        }

                    }
                }
            });
        }
        $('.step-container').stepMaker({
            steps: ['Choose Item', 'Bread Choice', 'Ingredients', 'Delivery','Receipt'],
            currentStep: 1
        });

    });
    function process_order(item_number){
        var id_string = item_number.id.split('_');
        var id = id_string[1];
        sessionStorage.setItem('item_number_1',id);
        var item_category = 0;
        var item_id = 0;
        var prize = 0;
        var menu_items_1 = {!!$menu_items_1!!};
        console.log("item number",item_number);
        $.each(menu_items, function (idx, obj) {
            if (id == obj.item_number) {
                var name_cur = obj.item_name;
                item_category = obj.item_category;
                item_id = obj.item_id;
                if(id==25||id==33){
                    prize = obj.wrap;
                    sessionStorage.setItem('item_category_price', prize);
                    sessionStorage.setItem('total_due',prize);
                    sessionStorage.setItem('item_id', item_id);
                }else if(id==32){
                    prize = obj.sandwich;
                    sessionStorage.setItem('item_id', item_id);

                }
                sessionStorage.setItem("route_item_category",item_category);
                sessionStorage.setItem('item_name', name_cur);
                sessionStorage.setItem('item_category_price', prize);
                sessionStorage.setItem('total_due',prize);
                sessionStorage.setItem('item_category', 'Tray');
                sessionStorage.setItem('item_id', obj.id);
                sessionStorage.setItem('bread_type',"Whole Wheat & White");
                sessionStorage.setItem('selected_toast',"No Toast");
                sessionStorage.setItem('quantity', 1);
                sessionStorage.setItem('item_category_price', obj.sandwich);
                sessionStorage.setItem('total_due', obj.sandwich);
                sessionStorage.setItem('item_description',obj.item_description);
                sessionStorage.setItem('item_image',obj.item_image);
            }
        });

        if(item_category>=18&&item_category<=22){
            console.log("Hitting");
            window.location.href = '/select_ingredients_toppings_client/'+item_id;
        }else if(id==32){
            sessionStorage.setItem('item_category',"Medium Sub");
            window.location.href = '/select_ingredients_toppings_client/'+item_id;
            sessionStorage.setItem('selected_toast',"No Toast");
            sessionStorage.setItem('item_category_price', prize);
            sessionStorage.setItem('total_due',prize);
        }else if(id==25||id==33){
            sessionStorage.setItem('item_category',"Wrap");
            window.location.href = '/select_ingredients_toppings_client/'+item_id;
            sessionStorage.setItem('item_category_price', prize);
            sessionStorage.setItem('selected_toast',"No Toast");
            sessionStorage.setItem('total_due',prize);
        }else{
            window.location.href='/client_bread_selection/'+item_id;
        }

        console.log(item_number);

    }
</script>

@endsection
