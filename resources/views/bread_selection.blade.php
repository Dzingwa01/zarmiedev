@extends('order_processing')
@section('content')
 <div class="container">
        @foreach ($categories as $category)
          <div class="col-md-12 col-sm-12 col-xs-12" >
            <div style="margin:auto;width:50%;">
              <center>
                <img title='{{$category->category_name}}' src='{{$category->picture_url}}' style = "align:center; margin-top:2em; important; width: 300px;height:62px"/>
              </center>
            </div>
            <table id="{{$category->id}}" class="table table-hover table-sm table-striped">
              <thead>
                <tr><th>Item Number</th><th>Name</th><th>Sandwich</th><th>Medium Sub</th><th>Large Sub</th><th>Wrap</th></tr>
              </thead>
              <tbody>
              </tbody>
            </table>

          </div>
        @endforeach
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
    var db_toppings;
    var toppings_request = window.indexedDB.open("toppings_cart", 1);
     var request = window.indexedDB.open("order_cart",2);
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
    toppings_request.onerror = function (event) {
        console.log("error: ", event);
    };

    toppings_request.onsuccess = function (event) {
        db_toppings = event.target.result;
//        addDefaultToppings();
    };
    toppings_request.onupgradeneeded = function (event) {
        db_toppings = event.target.result;

        var transaction = event.target.transaction;
        var objectStore_toppings = db_toppings.createObjectStore("selected_toppings", {keyPath: "id", autoIncrement: true});
        transaction.oncomplete = function (event) {
//            addDefaultToppings();
        }
    }
    function clearToppings() {
        var objectStore = db_toppings.transaction(["selected_toppings"], "readwrite").objectStore("selected_toppings");
        var objectStoreRequest = objectStore.clear();
        objectStoreRequest.onsuccess = function (event) {
            // report the success of our request
            console.log("toppings cleared successfully");
        };
    }
    function clearIngredients() {
        var objectStore = db.transaction(["selected_ingredients"], "readwrite").objectStore("selected_ingredients");
        var objectStoreRequest = objectStore.clear();
        objectStoreRequest.onsuccess = function (event) {
            // report the success of our request
            console.log("ingredients cleared successfully");
        };
    }
    clearIngredients();
    clearToppings();
</script>
@endsection