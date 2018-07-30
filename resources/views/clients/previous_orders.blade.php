@extends('client_processing')
@section('content')
<div class="container-fluid" style="margin-top: 6em;">
    <center>
        <h5>Order History</h5>
    </center>
    <div class="row">
        <div class="col s12 m2 card" >
            <ul id="slide-out" class="sidenav">
                <li><div class="user-view">
                        <a href="#user"> <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" /></a>
                        <p style="color:black;font-weight: bolder">{{Auth::user()->name . ' '. Auth::user()->surname}}</p>
                        <p style="color:black;font-weight: bolder">{{Auth::user()->email}}</p>
                    </div></li>
                <li><div class="divider" style="margin-top: 2em;color:black"> </div></li><br>
                <li><a href="/previous_orders" class="" style="color:black;font-weight: bolder"> <i class="tiny material-icons">shopping_cart</i>Previous Orders</a></li><br>
                <li><a href="#!" class="" style="margin-top: 2em;color:black;font-weight: bolder"><i class="tiny material-icons">favorite</i> Favourites</a></li>
                <li><div class="divider" style="margin-top: 2em;color:black"> </div></li><br>

                <li><a style="margin-top: 2em;color:black;font-weight: bolder" class="" href="#!"><i class="tiny material-icons">person</i>Manage Profile</a></li>
            </ul>
        </div>

        <div id="previous_orders" class="col s12 m10">

        </div>
    </div>

</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        read_all_complete_orders();
        function read_all_complete_orders(){
            var previous_orders = {!! $previous_orders !!}
            console.log("previosu",previous_orders);
            for(var i=0;i<previous_orders.length;i++){
                var cursor = previous_orders[i].order_information[0];
                console.log("ingredients",cursor);
                $("#previous_orders").append('<div id='+cursor.id+' class="card col s3"><b>'+cursor.quantity+' X '+cursor.item_name+' - ' +cursor.item_category+ '<br>'+cursor.bread_type+' - '+cursor.toast_type+'</b><br/><b>Cost: </b>R'+cursor.prize+'</div>');
                console.log("ingredients",cursor.ingredients);
                var ingredients_string ="";
                var toppings_string ="";
                var drinks_string ="";
                if(cursor.ingredients.length>0){
                    for(var i=0;i<cursor.ingredients.length;i++){
                        console.log(cursor.ingredients[i]);
                        ingredients_string = ingredients_string+"; "+cursor.ingredients[i].name;
                    }
                    $("#"+cursor.id).append('<br/><b>Ingredients: </b>'+ingredients_string+'<br/>');

                }
                if(cursor.length>0){
                    for(var i=0;i<cursor.toppings.length;i++){
                        toppings_string = toppings_string+"; "+cursor.toppings[i].name;
                    }
                    $("#"+cursor.id).append('<br/><b>Extra Toppings: </b>'+toppings_string+'<br/>');
                }
                if(cursor.drinks.length>0){
                    for(var i=0;i<cursor.drinks.length;i++){
                        drinks_string = drinks_string+"; "+cursor.drinks[i].name;
                    }
                    $("#"+cursor.id).append('<br/><b>Drinks: </b>'+drinks_string+'<br/>');
                }
                $("#"+cursor.id).append('<br/><a class="btn" style="margin-bottom: 2em;"><i class="material-icons left">add_shopping_cart</i>Repeat Order</a>');
            }

        }
    </script>
@endsection