@extends('client_processing')
@section('content')
<div class="container-fluid">
    <center>
        <h5>Order History</h5>
    </center>
    <div class="row">
        <div id="previous_orders" class="col s12 m12">

        </div>
    </div>

</div>
<style>
    .card .card-content {
        padding: 10px;
        border-radius: 0 0 2px 2px;
        overflow-y:scroll!important;
    }

</style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
    <script>
        read_all_complete_orders();
        function read_all_complete_orders(){
            var previous_orders = {!! $previous_orders !!};
            $("#previous_orders").empty();
            if(previous_orders.length == 0){
                $("#previous_orders").append('<h6 class="center"> No have not placed an order yet</h6>');
            }
            for(var i=0;i<previous_orders.length;i++){

                var prev_id = previous_orders[i].id;
                var div_id = "div_"+prev_id;
                var footer_id = "footer_"+prev_id;
                var prev_orders = previous_orders[i].order_information;
                console.log("Order Info",prev_orders);

                $("#previous_orders").append('<div  class=" col m4 col s12 card "><div id='+div_id+' class="card-content"  ></div><div id='+footer_id+' class="card-action"></div></div>');
                for(var x=0;x<prev_orders.length;x++){
                    var cursor = prev_orders[x];
                    $("#"+div_id).append('<div  class=""><b>'+cursor.quantity+' X '+cursor.item_name+' - ' +cursor.item_category+ '<br>'+cursor.bread_type+' - '+cursor.toast_type+'</b><br/><b>Cost: </b>R'+cursor.prize+'</div>');

                    var ingredients_string ="";
                    var toppings_string ="";
                    var drinks_string ="";
                    if(cursor.ingredients.length>0){
                        for(var ii=0;ii<cursor.ingredients.length;ii++){
                            ingredients_string = ingredients_string+"; "+cursor.ingredients[ii].name;
                        }
                        $("#"+div_id).append('<b>Ingredients: </b>'+ingredients_string+'<br/>');
                    }
                    if(cursor.length>0){
                        for(var ii=0;i<cursor.toppings.length;ii++){
                            toppings_string = toppings_string+"; "+cursor.toppings[ii].name;
                        }
                        $("#"+div_id).append('<b>Extra Toppings: </b>'+toppings_string+'<br/>');
                    }
                    if(cursor.drinks.length>0){
                        for(var ii=0;i<cursor.drinks.length;ii++){
                            drinks_string = drinks_string+"; "+cursor.drinks[ii].name;
                        }
                        $("#"+div_id).append('<b>Drinks: </b>'+drinks_string+'<br/>');
                    }
                    $("#"+div_id).append('<div class="divider" style="margin-top: 1em;color:black"> <div/>');
                }

                var new_id = "prev_"+prev_id;
                $("#"+footer_id).append('<a id="'+new_id+'" onclick="repeat_order(this)" class="" style="margin-bottom: 1em;"><i class="material-icons left">add_shopping_cart</i>Repeat</a>');

            }
        }

        function repeat_order(obj){
            var split_obj = obj.id.split('_');
            var previous_order = split_obj[1];
            window.location.href = "/repeat_order/"+previous_order;
        }
    </script>
@endsection