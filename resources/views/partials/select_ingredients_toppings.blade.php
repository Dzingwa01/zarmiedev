@extends('order_processing')
@section('content')
    <div class="container" style="margin-top:8em">

        <div class="row">

            <div class="col-sm-8">
                <form id="ingredients_toppings_form" col="col-md-12">
                    <fieldset>
                        <legend>Ingredients</legend>
                        <p style="color:black;font-weight:bold;">Item ingredients - * Please select</p>
                        <div class="row" style="margin-top:2em;">
                            <div id='ingredients_list'>
                                @if(count($ingredients)>0)
                                    @foreach($ingredients as $ingredient)
                                        <button id='{{$ingredient->ingredient_id}}' class="glass"
                                                style="font-weight:bolder;margin-left:1em;color:white;"
                                                onclick="ingredient_select(this);">{{$ingredient->ingredient->name}}  </button>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <hr/>
                        <p style="color:black;font-weight:bold;">Swap ingredients with</p>
                        <div class="row" style="margin-top:2em;">
                            <div id='ingredients_list'>
                                @if(count($other_ingredients)>0)
                                    @foreach($other_ingredients as $ingredient)
                                        <button id='{{$ingredient->id}}' class="glass"
                                                style="font-weight:bolder;margin-left:1em;color:white;"
                                                onclick="ingredient_select_swap(this);">{{$ingredient->name}}  </button>
                                    @endforeach
                                @endif
                            </div>
                        </div>
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
                        <div id='item_ingredients'>
                            <h6><b>Ingredients</b></h6>
                        </div>

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
        request.onerror = function (event) {
            console.log("error: ", event);
        };

        request.onsuccess = function (event) {
            db = event.target.result;
//           var transaction = event.target.transaction;
//           var objectStore = db.transaction(["selected_ingredients"],"readwrite")
//               .objectStore("selected_ingredients");
            readAll(db);

        };
        request.onupgradeneeded = function (event) {
            db = event.target.result;
            var transaction = event.target.transaction;
            var objectStore = db.createObjectStore("selected_ingredients", {keyPath: "id", autoIncrement: true});
            transaction.oncomplete = function (event) {
                readAll(db);
            }
        }

        function addIngredient(ingredient_id, ingredient_name, ingredient_prize) {
            var request = db.transaction(["selected_ingredients"], "readwrite")
                .objectStore("selected_ingredients")
                .add({id: ingredient_id, name: ingredient_name, prize: ingredient_prize});

            request.onsuccess = function (event) {
                console.log("ingredient addedd");
            }
            request.onerror = function (event) {
                console.log("error", event);
            }
        }
        function readAll(db) {
//           console.log("rading all");
            var objectStore = db.transaction(["selected_ingredients"], "readwrite").objectStore("selected_ingredients");

            objectStore.openCursor().onsuccess = function (event) {
                var cursor = event.target.result;

                var ingredients = {!! $ingredients !!};

                if (cursor) {
                    for (var i = 0; i < ingredients.length; i++) {
                        if (ingredients[i].ingredient.id == cursor.value.id) {
                            $("#" + cursor.value.id).remove();
                            $('#item_ingredients').append('<button id=' + cursor.value.id + ' onclick="ingredient_select_reverse(this);"  class="glass" style="font-weight:bolder;margin-left:1em;color:white;">' + cursor.value.name + '</button>');
                        }
                    }

                    cursor.continue();
                } else {
//                      alert("No more entries!");
                }
            };
        }
        function removeIngredient(ingredient_id) {

            var request = db.transaction(["selected_ingredients"], "readwrite")
                .objectStore("selected_ingredients")
                .delete(ingredient_id);

            request.onsuccess = function (event) {
                console.log("ingredient removed", event);
            }
            request.onerror = function (event) {
                console.log("error", event);
            }
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

        var item_number = sessionStorage.getItem('item_name');
        $(document).ready(function () {
            var qty = sessionStorage.getItem('quantity');
            if (qty == 1) {
                $("#decrease_el").hide();
            }

            $('#choice').append('<h6><b>Choice - </b>' + sessionStorage.getItem('item_name') + '</h6>');
            $('#type').append('<h6> <b>Type - </b>' + sessionStorage.getItem('item_category') + '</h6>');
            $('#item_bread').append('<h6><b>Bread Choice - </b>' + sessionStorage.getItem('bread_type') + ' - ' + sessionStorage.getItem('selected_toast') + '</h6>');
            $('#item_prize').append('<h6> <b>Prize - </b> R ' + Number(sessionStorage.getItem('total_due')).toFixed(2) + '</h6>');
            $('#item_amount').append('<h6>' + sessionStorage.getItem('quantity') + '</h6>');

            $("#ingredients_toppings_form").on('submit', function (e) {
                e.preventDefault();
            });
            $('#ingredient_toppings_next').on('click', function (e) {
                var link_to = sessionStorage.getItem('item_id');
                window.location.href = '/address_selection/' + link_to;
                {{--window.location.href = "{{'/address_selection'}}"; --}}
            });
            $("#ingredient_toppings_back").on('click', function () {
                window.location.href = "{{'/process_order'}}";
            });

        });
        function ingredient_select_swap(obj) {
            alert("swap with");
            {{--var ingredients = {!! $ingredients !!};--}}
            {{--for(var i=0;i<ingredients.length;i++){--}}
            {{--if(ingredients[i].ingredient.id == obj.id){--}}
            {{--$('#'+obj.id).remove();--}}
            {{--addIngredient(obj.id,ingredients[i].ingredient.name,ingredients[i].ingredient.prize);--}}
            {{--$('#item_ingredients').append('<button id='+obj.id+' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" onclick="ingredient_select_reverse(this);" >'+ingredients[i].ingredient.name+'</button>');--}}
            {{--}--}}
            {{--}--}}
        }
        function ingredient_select(obj) {
            var ingredients = {!! $ingredients !!};
            for (var i = 0; i < ingredients.length; i++) {
                if (ingredients[i].ingredient.id == obj.id) {
                    $('#' + obj.id).remove();
                    addIngredient(obj.id, ingredients[i].ingredient.name, ingredients[i].ingredient.prize);
                    $('#item_ingredients').append('<button id=' + obj.id + ' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" onclick="ingredient_select_reverse(this);" >' + ingredients[i].ingredient.name + '</button>');
                }
            }
        }
        function ingredient_select_reverse(obj) {
            //   alert(obj.id);
            var ingredients = {!! $ingredients !!};
            for (var i = 0; i < ingredients.length; i++) {
                if (ingredients[i].ingredient.id == obj.id) {
                    $('#' + obj.id).remove();
                    removeIngredient(obj.id);
                    $('#ingredients_list').append('<button id=' + obj.id + ' class="glass" style="font-weight:bolder;margin-left:1em;color:white;" onclick="ingredient_select_reverse(this);" >' + ingredients[i].ingredient.name + '</button>');
                }
            }
//      console.log('Ingredients',ingredients);
        }
    </script>
@endsection