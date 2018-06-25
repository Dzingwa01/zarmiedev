@extends('order_processing')
@section('content')
 <div class="container" style="margin-top:8em">
      
    <div class="row" >
       
          <div class="col-sm-8">
              <form id="ingredients_toppings_form" col="col-md-12">
                  <fieldset>
                      <legend>Ingredients & Toppings</legend>
                      <p style="color:black;font-weight:bold;">Select ingredients</p>
                      <div class="row" style="margin-top:2em;">
                           <div id='ingredients_list'>
                               @if(count($ingredients)>0)
                                               @foreach($ingredients as $ingredient)
                                                <button id='{{$ingredient->ingredient_id}}' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" onclick="ingredient_select(this);" >{{$ingredient->ingredient->name}}  </button>
                                               @endforeach
                                @endif
                            </div>
                    </div>
                    <hr/>
                    <p style="color:black;font-weight:bold;">Select Toppings (*free)</p>
                    <hr/>
                    <div class="row">
                <div class="col-sm-offset-2 col-sm-2" style="margin-top:1em;">
                   <button id='ingredient_toppings_back' class="btn waves-effect waves-light">Back</button>
                 </div>
                 
                  <div class="col-sm-offset-1 col-sm-2" style="margin-top:1em;">
                   <button id='ingredient_toppings_next' class="btn waves-effect waves-light">Next</button>
                  </div>
                </div>
                  </fieldset>
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
                
              </fieldset>
            </form>
          </div>
        </div>
  </div>
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
           readAll();
       };
       request.onupgradeneeded = function(event) {
           var db = event.target.result;
           var objectStore = db.createObjectStore("selected_ingredients", {keyPath: "id"});
           readAll();
       }

       function addIngredient(ingredient_id,ingredient_name,ingredient_prize){
           var request = db.transaction(["selected_ingredients"],"readwrite")
               .objectStore("selected_ingredients")
               .add({id:ingredient_id,name:ingredient_name,prize:ingredient_prize});

           request.onsuccess = function(event){
               console.log("ingredient addedd");
           }
           request.onerror = function(event){
               console.log("error",event);
           }
       }
       function readAll() {
//           console.log("rading all");
           var objectStore = db.transaction(["selected_ingredients"],"readwrite").objectStore("selected_ingredients");

           objectStore.openCursor().onsuccess = function(event) {
               var cursor = event.target.result;
               console.log("cursor",cursor);
               var ingredients = {!! $ingredients !!};

               if (cursor) {
                   for(var i=0;i<ingredients.length;i++){
                       if(ingredients[i].ingredient.id == cursor.value.id){
                           $("#"+cursor.value.id).remove();
                           $('#item_ingredients').append('<button id='+cursor.value.id+' onclick="ingredient_select_reverse(this);"  class="glass" style="font-weight:bolder;margin-left:1em;color:white;">'+cursor.value.name+'</button>');
                       }
                   }

                   cursor.continue();
               } else {
//                      alert("No more entries!");
               }
           };
       }
       function removeIngredient(ingredient_id){

           var request = db.transaction(["selected_ingredients"],"readwrite")
               .objectStore("selected_ingredients")
               .delete(ingredient_id);

           request.onsuccess = function(event){
               console.log("ingredient removed",event);
           }
           request.onerror = function(event){
               console.log("error",event);
           }
       }
  var item_number = sessionStorage.getItem('item_name');
  $(document).ready(function(){
       $('#choice').append('<h6><b>Choice - </b>'+sessionStorage.getItem('item_name')+'</h6>');
       $('#type').append('<h6> <b>Type - </b>'+sessionStorage.getItem('item_category')+'</h6>');
        $('#item_bread').append('<h6><b>Bread Choice - </b>'+sessionStorage.getItem('bread_type') + ' - ' +sessionStorage.getItem('selected_toast') + '</h6>');
        $('#item_prize').append('<h6> <b>Prize - </b> R '+Number(sessionStorage.getItem('total_due')).toFixed(2)+'</h6>');
        $('#item_amount').append('<h6> <b>Quantity - </b>'+sessionStorage.getItem('quantity')+'</h6>');
      
    $("#ingredients_toppings_form").on('submit',function(e){
        e.preventDefault();
    });
    $('#ingredient_toppings_next').on('click',function(e){
        window.location.href = "{{'/address_selection'}}"; 
    });
     $("#ingredient_toppings_back").on('click',function(){
        window.location.href = "{{'/process_order'}}";
    });
        
  });
  function ingredient_select(obj){
      var ingredients = {!! $ingredients !!};
      for(var i=0;i<ingredients.length;i++){
          if(ingredients[i].ingredient.id == obj.id){
              $('#'+obj.id).remove();
              addIngredient(obj.id,ingredients[i].ingredient.name,ingredients[i].ingredient.prize);
              $('#item_ingredients').append('<button id='+obj.id+' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" onclick="ingredient_select_reverse(this);" >'+ingredients[i].ingredient.name+'</button>');
          }
      }
  }
  function ingredient_select_reverse(obj){
      //   alert(obj.id);
      var ingredients = {!! $ingredients !!};
      for(var i=0;i<ingredients.length;i++){
          if(ingredients[i].ingredient.id == obj.id){
              $('#'+obj.id).remove();
              removeIngredient(obj.id);
              $('#ingredients_list').append('<button id='+obj.id+' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" onclick="ingredient_select_reverse(this);" >'+ingredients[i].ingredient.name+'</button>');
          }
      }
//      console.log('Ingredients',ingredients);
  }
   </script>
  @endsection