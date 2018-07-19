@extends('order_processing')
@section('content')
 <div class="container-fluid" style="margin-top:5em">
     <div class="row">
         <div class="step-container" style="width: 100%; margin: 0 auto"></div>
     </div>

     <div class="row" >

          <div class=" col-md-6 col-sm-12 card" style="margin-left: 1em;">
              <h6 style="font-weight: bolder;font-size:1.5em;" id="choice_normals"></h6>
            <form id="bread_selection" style="margin-top:2em;">
              {{--<fieldset>--}}
                {{--<h6 style="color:black;font-weight:bold;font-size: 1.5em;">Bread & Toast Choice</h6>--}}
                {{--<h6>Please select your bread and toast option</h6>--}}
                <div  id='bread_choice_form'>
                  <div class="row">
                    <div class="col-sm-6" >
                      <div id="bread_choices" >
                          <label style="font-size: 16px; color:black; font-weight: bold;">Bread Type</label>
                        <p >
                          <input name="group01" class="bread" type="radio" id="white_bread" value="White Bread"/>
                          <label for="white_bread">White Bread</label>
                        </p>
                        <p id="brown_bread_p">
                          <input name="group01" class="bread" type="radio" value="Brown Bread" id="brown_bread" />
                          <label for="brown_bread" >Brown Bread</label>
                        </p>
                        <p>
                          <input name="group01" class="bread" value="Whole Wheat" type="radio" id="whole_wheat" />
                          <label for="whole_wheat">Whole Wheat Bread</label>
                        </p>

                      </div>
                    </div>
                      <div class="col-sm6">
                          <div style="margin-left:2em;">
                              <input name="num_people" type="number" id="num_people"  value="1" hidden required/>
                          </div>
                          <label style="font-size: 16px; font-weight: bold; color:black;">Toast Choice</label>
                          <p>
                              <input name="group1" type="radio" value="Toast" id="toast" required/>
                              <label for="toast">Toast</label>
                          </p>
                          <p>
                              <input name="group1" type="radio" value="No Toast" id="no_toast" />
                              <label for="no_toast">No Toast</label>
                          </p>
                      </div>
                    
                  </div>
                </div>
                   <div class="row">
                <div class="col-sm-offset-2 col-sm-2" style="margin-top:1em;">
                   <button id='bread_back' class="btn waves-effect waves-light">Back</button>
                 </div>
                 
                  <div class="col-sm-offset-1 col-sm-2" style="margin-top:1em;">
                    <button id='bread_next' class="btn waves-effect waves-light">Next</button>
                  </div>
                </div>
                 
              {{--</fieldset>--}}
            </form>
          </div>
         <div class="col-sm-5 card" style="margin-left:2em; ">
             <div class="row">
                 <div class="col s12">
                     <ul class="tabs z-depth-1">
                         <li class="tab col s6 "><a id="current_order_tab" href="#current_order" class="active"
                                                    style="color:black;text-decoration: none;">Current Order
                                 Details</a></li>
                         <li id="checkout_list" class="tab col s6"><a id="checkout_tab" class=""
                                                                      style="color:black;text-decoration: none;"
                                                                      href="#checkout_div">Review Or Update<i
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

                 </div>
                 <div id="checkout_div" class="col s12">Test 2</div>
             </div>
         </div>
        </div>
     <div hidden>
     @if(count($ingredients)>0)
     @foreach($ingredients as $ingredient)
     <button
     style="font-weight:bolder;margin-left:1em;color:white;"
     >{{$ingredient->ingredient->name}}  </button>
     @endforeach
     @endif
     </div>
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
  <script>
  <?php $menu_items = json_encode($menu_items);?>
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
  var cart_request = window.indexedDB.open("complete_orders",1);
  cart_request.onerror = function (event) {
      console.log("error: ");
  };

  cart_request.onsuccess = function (event) {
      db_cart = cart_request.result;
//      count_orders(db_cart);
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
  function addDefault() {
      var ingredients = {!! json_encode($ingredients) !!};
      console.log("ingredients", ingredients);
      for (var i = 0; i < ingredients.length; i++) {
          addIngredient(ingredients[i].id, ingredients[i].ingredient.name, ingredients[i].ingredient.prize, ingredients[i].ingredient.ingredient_type_id);
//                    $('#item_ingredients').append('<button id=' + ingredients[i].id + ' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" onclick="ingredient_select_reverse(this);" >' + ingredients[i].ingredient.name + '</button>');
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
  var item_number = sessionStorage.getItem('item_number_1');
  sessionStorage.setItem("prev_swap_choice","no");
  sessionStorage.setItem("prev_swap_choice_2","no");
  function decrease_quantity(){
      $('#item_amount').empty();
      var quantity = sessionStorage.getItem('quantity');
      var new_qty = Number(quantity)-1;
      if(new_qty>1){
          $("#decrease_el").show();
      }
      else{
          $("#decrease_el").hide();
      }
      var more_order = sessionStorage.getItem("more_order");

      if(more_order!=null&&more_order!=undefined&&more_order!="null"){
          $("#cart_btn").show();
          $("#order_count").empty();
          $("#order_count").append('<sup style="font-size: 1.2em;font-weight: bolder;">'+sessionStorage.getItem("order_quantity")+'*</sup>');
          $("#menu_items").addClass("with_cart");
      }else{
          $("#cart_btn").hide();
      }
      $('#item_amount').append('<h6> <b>'+ new_qty+'</h6>');
      sessionStorage.setItem('quantity',new_qty);
      var item_prize = Number(sessionStorage.getItem("item_category_price")).toFixed(2);
      var total_due = Number(item_prize*new_qty).toFixed(2);
      sessionStorage.setItem('total_due',total_due);
      $('#item_prize').empty();
      $('#item_prize').append('<h6> <b>Prize - </b>R'+total_due+'</h6>');
  }
  function initializeQuantities(){
      var quantity = $('#num_people').val();
      $("#decrease_el").hide();
      sessionStorage.setItem('quantity',quantity);
      $('#item_amount').append('<h6> <b>'+ quantity+'</h6>');
      var item_prize = Number(sessionStorage.getItem("item_category_price")).toFixed(2);
      var total_due = Number(item_prize*$('#num_people').val()).toFixed(2);
      sessionStorage.setItem('total_due',total_due);
      $('#item_prize').append('<h6> <b>Prize - </b>R'+total_due+'</h6>');
  }
  function increase_quantity(){
      $('#item_amount').empty();
      var quantity = sessionStorage.getItem('quantity');
      var new_qty = Number(quantity)+1;
      if(new_qty>1){
          $("#decrease_el").show();
      }
      else{
          $("#decrease_el").hide();
      }

      $('#item_amount').append('<h6> <b>'+ new_qty+'</h6>');
      sessionStorage.setItem('quantity',new_qty);
      var item_prize = Number(sessionStorage.getItem("item_category_price")).toFixed(2);
      var total_due = Number(item_prize*new_qty).toFixed(2);
      sessionStorage.setItem('total_due',total_due);
      $('#item_prize').empty();
      $('#item_prize').append('<h6> <b>Prize - </b>R'+total_due+'</h6>');
  }
  $(document).ready(function(){
      $('.tabs').tabs();
      var more_order = sessionStorage.getItem("more_order");
      if(more_order!=null&&more_order!=undefined&&more_order!="null"){
          $("#cart_btn").show();
          $("#order_count").empty();
          $("#order_count").append('<sup style="font-weight: bolder;">'+sessionStorage.getItem("order_quantity")+'*</sup>');
          $("#menu_items").addClass("with_cart");
      }else{
          $("#checkout_list").hide();
      }
      $("#choice_normals").append(sessionStorage.getItem('item_name') +" - "+sessionStorage.getItem('item_category'));
      $('.step-container').stepMaker({
          steps: ['Item Size','Bread Choice', 'Ingredients', 'Delivery','Receipt'],
          currentStep: 2
      });
    if(sessionStorage.getItem('item_category')=="Medium Sub" || sessionStorage.getItem('item_category')=="Large Sub"){
        $("#no_toast").attr("checked",true);
        sessionStorage.setItem('selected_toast','No Toast');
        $("#brown_bread_p").hide();
    }
      var menu_items = {!!$menu_items!!};
      initializeQuantities();

        $.each(menu_items, function(idx,obj){
          if(item_number == obj.item_number){
            var name_cur = obj.item_name;
            sessionStorage.setItem('item_name',name_cur);
             $('#choice').append('<h6><b>Choice - </b>'+sessionStorage.getItem('item_name')+'</h6>');
            $('#type').append('<h6> <b>Type - </b>'+sessionStorage.getItem('item_category')+'</h6>');
             
          }
        }); 
        $('input:radio').click(function(){
      var bread_choice = $(this).val();
      var selected_bread = '';
      var selected_toast = '';
        if(bread_choice!=="Toast" && bread_choice !=="No Toast"){
             $('#item_bread').empty();
             selected_bread = $(this).val();
             sessionStorage.setItem('bread_type',selected_bread);
             if(sessionStorage.getItem('selected_toast')!==null){
                  $('#item_bread').append('<h6><b>Bread Choice - </b>'+bread_choice + ' - ' +sessionStorage.getItem('selected_toast') + '</h6>');
             }
             else{
                  $('#item_bread').append('<h6><b>Bread Choice - </b>'+bread_choice + '</h6>');
             }
        }
        else{
            $('#item_bread').empty();
            selected_toast = $(this).val();
            sessionStorage.setItem('selected_toast',selected_toast);
         $('#item_bread').append('<h6><b>Bread Choice - </b>'+sessionStorage.getItem('bread_type') + ' - ' + bread_choice+'</h6>');
        }
      
  });
  
    $('#num_people').change(function(){
         $('#item_amount').empty();
         $('#item_prize').empty();
         var quantity = $('#num_people').val();
         sessionStorage.setItem('quantity',quantity);
         $('#item_amount').append('<h6> <b>Quantity - </b>'+ quantity+'</h6>');
          var item_prize = Number(sessionStorage.getItem("item_category_price")).toFixed(2);
          var total_due = item_prize*$('#num_people').val();
          sessionStorage.setItem('total_due',total_due);
          $('#item_prize').append('<h6> <b>Prize - </b>R'+total_due+'</h6>');
    });
    $("#bread_selection").on('submit',function(e){
        e.preventDefault();
        
    });
     $("#bread_next").on('click',function(e){
        e.preventDefault();
        if(sessionStorage.getItem("bread_type")==null||sessionStorage.getItem("bread_type")==""){
            alert("Please select bread type");
        }
        else if(sessionStorage.getItem("selected_toast")==null){
            alert("Please select toast type");
        }else{
            var link_to = sessionStorage.getItem('item_id');
            window.location.href = '/select_ingredients_toppings/'+link_to;
        }

        
    });
    
     $("#bread_back").on('click',function(e){
        e.preventDefault();
             window.history.back();
    });
        
  });
 
  </script>

@endsection