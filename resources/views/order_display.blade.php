<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Zarmie - The Sandwich Shop</title>
  <meta name="description" content="The Sandwich Shop">
  <meta name="keywords" content="Sandwiches PE, Salads, Food Trays, Port Elizabeth, Breakfast, Lunch">
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Styles -->
  <style>
  .full-height {
    height: 100vh;
  }

  .flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
  }

  .position-ref {
    position: relative;
  }

  .top-right {
    position: absolute;
    right: 10px;
    top: 18px;
  }

  .content {
    text-align: center;
  }

  .title {
    font-size: 84px;
  }

  .links > a {
    color: #636b6f;
    padding: 0 25px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: .1rem;
    text-decoration: none;
    text-transform: uppercase;
  }

  .m-b-md {
    margin-bottom: 30px;
  }
  .caption{
    left:40%!important;
  }
  .btn{
    margin-left:4em!important;
  }
  .slide_p{
    color:white!important;
    width:300px;
    text-align:center;
  }
  ul{
    list-style:none!important;
  }
  p{
    color:#fff;
  }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  {{-- <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script> --}}

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.css" rel="stylesheet"/>
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script>
//  sessionStorage.clear();
  </script>
  <style>
  .drop-down{
    margin-left: 1em!important;
  }
  .card .card-image img {
    display: block;
    border-radius: 2px 2px 0 0;
    height: 60px !important;
  }

  div > h6 {
    font-size: 1rem;
  }
  .card{
    height:400!important;
    z-index: 5!important;
    overflow: visible!important;
  }
  .card .card-image .card-title {
    color: #fff;
    position: absolute;
    bottom: 0;
    left: 0;
    padding: 20px;
  }
  .card .card-content {
    padding: 10px;
    border-radius: 0 0 2px 2px;
    height: 200px !important;
    /*overflow:visible!important;*/
  }
  .card .card-content p {
    margin: 0;
    color: inherit;

  }
  .card .card-content .card-title {
    line-height: 38px;
  }
  .card-action {
    position: relative;
    background-color: inherit;
    border-top: 1px solid rgba(160, 160, 160, 0.2);
    z-index: 2;
    height:40px!important;
  }
  select{
    z-index: 20!important;
  }

  .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
    background-color: #26a69a!important;;
  }
    .with_cart{
      margin-top: 5em;
    }
  .sidenav-overlay{z-index:99!important;}
  </style>
  <script>
  $(document).ready(function() {
    // $("#menu_popup_dialog").modal();
//    $('select').material_select();
      $(".dropdown-trigger").dropdown();
      $(".dropdown-trigger_cus").dropdown();
      $(".dropdown-trigger_cus2").dropdown();
      $('.sidenav').sidenav();
  });
  </script>
</head>
<body>

<div class="navbar-fixed">
  <nav class="white" role="navigation" style="height: 5em;">
    <div class="nav-wrapper ">
      <a id="logo-container" href="{{url('/')}}" class="brand-logo"><img height="70px" width="100px" class="img-rounded" src={{URL::asset('pictures/logo.png')}} />  </a>
      <a href="#" data-target="slide-out" class="sidenav-trigger" style="color:teal"><i class="material-icons">menu</i></a>
      <ul id="dropdown1" class="dropdown-content">
        <a  class="" href="{{ url('/login') }}">Sign  In</a><br/>
        <a  class="" href="{{ url('/register') }}">Register</a>

      </ul>
      <ul id="dropdown2" class="dropdown-content">
        <a  class="" href="{{ url('/login') }}">Sign  In</a><br/>
        <a  class="" href="{{ url('/register') }}">Register</a>
      </ul>
      <ul class="right hide-on-med-and-down">
        <li><a class="" style="color:black;font-weight: bolder;" href="/order_display"><i class="material-icons left">add_shopping_cart</i> Order Now</a></li>
        <li><a class="" style="color:black;font-weight: bolder;"  href="/menu_display"><i class="material-icons left">reorder</i> Menu</a></li>
        {{-- <li><a class="btn"><i class="material-icons left">info</i> About Us</a></li> --}}
        {{--<li><a class="" style="color:black;font-weight: bolder;" href="/contact_display"><i class="material-icons left">email</i> Contact Us</a></li>--}}
        <li>
          <a style="color:black;font-weight: bolder;"  class="dropdown-trigger_cus2" data-toggle="dropdown" href="#dropdown2">
            <i class="material-icons left">person_pin</i>
            Account
            <span class="caret"></span>
          </a>
        </li>
      </ul>

      <ul id="slide-out" class="sidenav">
        <li><a class="" style="color:black;font-weight: bolder;" href="/"><i class="material-icons left">home</i>Home</a></li>
        <li><a class="" style="color:black;font-weight: bolder;" href="/order_display"><i class="material-icons left">add_shopping_cart</i> Order Now</a></li>
        <li><a class="" style="color:black;font-weight: bolder;"  href="/menu_display"><i class="material-icons left">reorder</i> Menu</a></li>
        {{-- <li><a class="btn"><i class="material-icons left">info</i> About Us</a></li> --}}
        {{--<li><a class="" style="color:black;font-weight: bolder;" href="/contact_display"><i class="material-icons left">email</i> Contact Us</a></li>--}}
        <li>
          <a style="color:black;font-weight: bolder;"  class="dropdown-trigger_cus2" data-toggle="dropdown" href="#dropdown2">
            <i class="material-icons left">person_pin</i>
            Account
            <span class="caret"></span>
          </a>
        </li>
      </ul>

    </div>

  </nav>
</div>

  <div class="container-fluid">
    {{--<div class="step-container" style="width: 700px; margin: 0 auto"></div>--}}
    <a id="cart_btn" hidden  class=" btn pull-right" onclick="show_cart()" style="margin-top:1em; margin-right:1em;">CHECKOUT<i class="fa fa-shopping-cart" ></i><span style="color:red" id="order_count"></span> </a>

    <div>
      <div id='menu_items' class="row">
        @foreach ($categories as $category)
          <center>
            <h5>{{$category->category_name}}</h5>
          </center>
              <table id="{{$category->id}}" class="table table-hover table-sm table-striped card" >
                @if($category->id==18||$category->id==19||$category->id==22||$category->id==21||$category->id==20)
                  <thead>
                  <tr><th>Item Number</th><th>Name</th><th>Price</th></tr>
                  </thead>
                @elseif($category->id<=6)
                  <thead>
                  <tr><th>Item Number</th><th>Name</th><th>Sandwich</th><th>Medium Sub</th><th>Large Sub</th><th>Wrap</th></tr>
                  </thead>
                @elseif($category->id<=7)
                  </thead>
                  <tr><th>Item Number</th><th>Name</th><th>Medium</th><th>Large</th></tr>
                  </thead>
                @endif
                <tbody>
                </tbody>
              </table>

        @endforeach
      </div>
      {{--<ul class="collapsible">--}}
        {{--@foreach ($categories as $category)--}}
        {{--<li style="margin-bottom: 1em;">--}}
          {{--<div class="collapsible-header">--}}
            {{--<div style="margin:auto;width:50%;">--}}
              {{--<center>--}}
                {{--<img title='{{$category->category_name}}' src='{{$category->picture_url}}' style = "margin-top:1em; width: 300px;height:62px"/>--}}
              {{--</center>--}}
            {{--</div>--}}
          {{--</div>--}}

          {{--<div class="collapsible-body">--}}
              {{--<table id="{{$category->id}}" class="table table-hover table-sm table-striped">--}}
                {{--@if($category->id==18||$category->id==19||$category->id==22||$category->id==21||$category->id==20)--}}
                  {{--<thead>--}}
                  {{--<tr><th>Item Number</th><th>Name</th><th>Price</th></tr>--}}
                  {{--</thead>--}}
                {{--@elseif($category->id<=6)--}}
                  {{--<tr><th>Item Number</th><th>Name</th><th>Sandwich</th><th>Medium Sub</th><th>Large Sub</th><th>Wrap</th></tr>--}}
                {{--@elseif($category->id<=7)--}}
                  {{--<tr><th>Item Number</th><th>Name</th><th>Medium</th><th>Large</th></tr>--}}
                {{--@endif--}}
                {{--<tbody>--}}
                {{--</tbody>--}}
              {{--</table>--}}
          {{--</div>--}}

        {{--</li>--}}
        {{--@endforeach--}}
      {{--</ul>--}}
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

  </div>

  {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
  <link rel="stylesheet" href="/css/jquery-step-maker.css">
  <script src="/js/jquery-step-maker.js"></script>
    <script type='text/javascript'>
  
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
    function toTitleCase(str) {
        return str.replace(
            /\w\S*/g,
            function(txt) {
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            }
        );
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
    function clearIngredients(db) {
        var objectStore = db.transaction(["selected_ingredients"], "readwrite").objectStore("selected_ingredients");
        var objectStoreRequest = objectStore.clear();
        objectStoreRequest.onsuccess = function (event) {
            // report the success of our request
            console.log("cleared successfully");
        };
    }
    function proceed_to_checkout() {
        sessionStorage.setItem("more_order", "more_order");
//            sessionStorage.setItem("order_quantity", 1);
//            add_order_for_checkout();
        window.location.href = '/address_selection';
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
    var menu_items = {!!$menu_items!!};
    var categories = {!! $categories !!};
//    console.log("categories",categories.length);
      console.log(menu_items);
      $(document).ready(function(){
          $('.collapsible').collapsible();
          var more_order = sessionStorage.getItem("more_order");
          read_all_complete_orders();
//          if(more_order!=null&&more_order!=undefined&&more_order!="null"){
//              $("#cart_btn").show();
//              $("#order_count").empty();
//
//              $("#menu_items").addClass("with_cart");
//          }else{
//              $("#cart_btn").hide();
//          }
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
    function dismiss(){
        $('.modal').hide();
    }
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
            window.location.href = '/select_ingredients_toppings/'+item_id;
        }else if(id==32){
            sessionStorage.setItem('item_category',"Medium Sub");
            window.location.href = '/select_ingredients_toppings/'+item_id;
            sessionStorage.setItem('selected_toast',"No Toast");
            sessionStorage.setItem('item_category_price', prize);
            sessionStorage.setItem('total_due',prize);
        }else if(id==25||id==33){
            sessionStorage.setItem('item_category',"Wrap");
            window.location.href = '/select_ingredients_toppings/'+item_id;
            sessionStorage.setItem('item_category_price', prize);
            sessionStorage.setItem('selected_toast',"No Toast");
            sessionStorage.setItem('total_due',prize);
        }else{
            window.location.href='/bread_selection/'+item_id;
        }

        console.log(item_number);

    }
    </script>

    <footer class="page-footer teal">
      <div class="container">
        <div class="row">
          <div style="margin-top:1.5em;" class="col-md-6">
            <ul>
              <h5 style="color:white;">Branches</h5>
              <li><a style="color:white;" href="#">Bloemfontein - Westdene</a></li>
              <li><a style="color:white;" href="#">Bloemfontein - UOVS</a></li>
              <li><a style="color:white;">Kimberly</a></li>
              <li><a style="color:white;">George</a></li>
              <li><a style="color:white;">Port Elizabeth - <i class="material-icons prefix">contact_phone</i> 041 365 7146 or WhatsApp 071 704 9449</a></li>
            </ul>
          </div>
          <div class="col-md-offset-1 col-md-4">
            <h5 style="color:white;"> Follow us on: </h5>
            <ul class="icons">
              <li>
                <a class="icon rounded fa-facebook" href="https://www.facebook.com/The-Sandwich-Shop-174784602609962/"><span class="label">Facebook</span></a>
              </li>
              <li>
                <a class="icon rounded fa-twitter"><span class="label">Twitter</span></a>
              </li>
            </ul>
          </div>


        </div>
        <div class="footer-copyright">
          <div class="container">
            <a id="footer_p" style="color:white;" href="#">Copyright &copy; Zarmie </a>
          </div>
        </div>
      </div>
      <script>
      var year = new Date().getFullYear();
      $(document).ready(function () {
        $('#footer_p').append(year);
      });
      </script>
    </footer>

    {{--<script type="text/javascript" async="async" defer="defer" data-cfasync="false" src="https://mylivechat.com/chatinline.aspx?hccid=10733251"></script>--}}
    {{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4VCOsDzZ-3fqwWrxmWWgoPNlXcpvpPvE&libraries=places&callback=getLocation" async defer></script>--}}
  </body>
  </html>
