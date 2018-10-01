<!DOCTYPE html>
<!--
Landing page based on Pratt: http://blacktie.co/demo/pratt/
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The Sandwich Shop">
    <meta name="author" content="MARSHTEQ">


    <title>Zarmie - The Sandwich Shop </title>

    <!-- Custom styles for this template -->
    {{--<link href="{{ asset('/css/all-landing.css') }}" rel="stylesheet">--}}

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
            color:black!important;
            width:300px;
            font-weight:900!important;
            text-align:center;
        }
        li{
            list-style: circle!important;
        }
        .card .card-image img {
            display: block;
            border-radius: 2px 2px 0 0;
        }

        div > h6 {
            font-size: 1rem;
        }
        .card{
            z-index: 5!important;

        }
        .card .card-image .card-title {
            color: #fff;
            position: absolute;
            bottom: 0;
            left: 0;
            padding: 20px;
        }
        .drink_button {
            display: block;
            width: 115px;
            height: 25px;
            background: #4E9CAF;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }
        input[type="checkbox"]{
            position:relative;
            left:1em;
            opacity: 1!important;
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
        .sidenav-overlay{
            z-index: 99!important;
        }
        a{
            text-decoration: none;
        }
        a.active{
            background-color: teal!important;
            color:white!important;
        }
        .tabs .indicator{
            background-color: teal!important;
        }
        .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
            background-color: #26a69a!important;;
        }
    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css"> --}}
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.css" rel="stylesheet"/>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>


</head>

<body >
<div id="app"></div>
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
                    <a style="color:black;font-weight: bolder;"  class="dropdown-trigger_cus2" data-toggle="dropdown" href="#dropdown1">
                        <i class="material-icons left">person_pin</i>
                        Account
                        <span class="caret"></span>
                    </a>
                </li>
            </ul>

        </div>

    </nav>
</div>
    <div class="slider">
        <ul id="slides" class="slides">
            <li class="parallax-container"><img src="{{URL::asset('pictures/sandwich_slider.jpg')}}" class="img-responsive parallax" />
                <div class="caption" >
                    <p class="z-depth-1 slide_p" style="margin-right:1em;font-weight:bolder;font-size:1.5em;">Sandwich of the week, only R16.99, order now! </p>
                    {{-- <button id="order_btn" class="btn" data-toggle="modal" style="margin-top:1em;margin-bottom:1em;" data-target="#order_popup_dialog">Order Now</button> --}}
                </div>
            </li>
            <li><img src="{{URL::asset('pictures/salad_slider.jpg')}}" class="img-responsive" />
                <div class="caption">
                    <p class="z-depth-1 slide_p" style="margin-right:1em;font-weight:bolder;font-size:1.5em;">Farm fresh salads up for grabs, hurry now! </p>
                    {{-- <button id="order_btn" class="btn" data-toggle="modal" style="margin-top:1em;margin-bottom:1em;" data-target="#order_popup_dialog">Order Now</button> --}}
                </div>
            </li>
            <li><img src="{{URL::asset('pictures/veg_slider.jpg')}}" class="img-responsive" />
                <div class="caption">
                    <p class="z-depth-1 slide_p" style="margin-right:1em;font-weight:bolder;font-size:1.5em;">We also cater for vegeteranians, order now to get awesome deals! </p>
                    {{-- <button id="order_btn" class="btn" data-toggle="modal" style="margin-top:1em;margin-bottom:1em;" data-target="#order_popup_dialog">Order Now</button> --}}
                </div>
            </li>
            <li><img src="{{URL::asset('pictures/platter_slider.jpg')}}" class="img-responsive" />
                <div class="caption">
                    <p class="z-depth-1 slide_p" style="margin-right:1em;font-weight:bolder;font-size:1.5em;">Catering for many people, we have got awesome tray specials starting from R55.00! </p>
                    {{-- <button id="order_btn" class="btn" data-toggle="modal" style="margin-top:1em;margin-bottom:1em;" data-target="#order_popup_dialog">Order Now</button> --}}
                </div>
            </li>
        </ul>
    </div>

    <div class="container">
        <div class="section">
            <!--   Icon Section   -->
            <div class="row">
                <div class=" col s12 col m4 card" >
                    <div class="card-image">
                        <img src="{{URL::asset('pictures/sandwich.jpg')}}" class="img-responsive" />

                    </div>
                    <div class="card-content">
                        <span class="card-title" style="color:black;font-weight:bold;font-size:1.5em">Sandwiches</span>
                        <p style="text-align:justify;color:black!important;">Choose one of our delicious fillings or design your own sandwich large or medium...
                        </p>
                    </div>
                   <div class="card-action">
                       <a id="sandwich_popup" title="More Information" class="pull-left " data-toggle="modal" data-target="#sandwich_popup_dialog" style="margin-bottom: 1em;color:teal"><i class=" material-icons left">info</i></a>
                       <a title="Order Now" href="order_display" class="pull-right "><i class="  material-icons left" style="margin-bottom: 1em; color:teal">add_shopping_cart</i> </a>
                   </div>

                </div>

                <div class="col s12 m4 card"  >
                    <div class="card-image">
                        <img src="{{URL::asset('pictures/greek_2.jpg')}}" class="img-responsive" />

                    </div>
                    <div class="card-content">
                        <span class="card-title" style="text-align:justify;color:black;font-weight:bold;font-size:1.5em">Salads</span>
                        <p style="text-align:justify;color:black!important;" >Party size salads are available on request. All dressings are served on the side..</p>

                    </div>
                    <div class="card-action">
                        <a id="salads_popup" title="More Information" data-toggle="modal" style="margin-top:1em;margin-bottom:1em;" data-target="#salads_popup_dialog" ><i class=" material-icons left" style="margin-bottom: 1em;color:teal">info</i></a>
                        <a title="Order Now" href="order_display" class="pull-right "><i class="  material-icons left" style="margin-bottom: 1em; color:teal">add_shopping_cart</i> </a>
                    </div>
                </div>
                <div class="col s12 m4 card" >
                    <div class="card-image">
                        <img src="{{URL::asset('pictures/wrap_tray_lg.jpg')}}" class="img-responsive" />

                       </div>
                    <div class="card-content">
                        <span class="card-title" style="color:black;font-weight:bold;font-size:1.5em">Trays & Platters</span>
                        <p style="text-align:justify;color:black!important;">We offer a variety of trays at unbelievable prices. Tray sizes range from small to extra large..</p>
                    </div>
                    <div class="card-action">
                        <a id="trays_popup" title="More Information" data-toggle="modal" style="margin-top:1em;margin-bottom:1em;" data-target="#trays_popup_dialog" style="margin-bottom: 1em;cursor:hand"><i style="margin-bottom: 1em;color:teal" class=" material-icons left">info</i></a>
                        <a title="Order Now" href="order_display" class="pull-right " ><i class="  material-icons left" style="margin-bottom: 1em; color:teal">add_shopping_cart</i> </a>

                    </div>
                </div>
            </div>
            <div class="row" style="margin-top:1em;">
                <h5 class="center">Where to Find Us</h5>
                <div class="center">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3309.719747024528!2d25.562721314723113!3d-33.94833553062155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e7ad17c338823d5%3A0xc3470fd4e6b82bb0!2s69+4th+Ave%2C+Newton+Park%2C+Port+Elizabeth%2C+6055!5e0!3m2!1sen!2sza!4v1495859382197" frameborder="0" style="border:0;height:300px;width:600px;"  allowfullscreen></iframe>
                </div>
            </div>

        </div>
    </div>
    <div id="trays_popup_dialog" class="modal" role="dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title center">Tray Details</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <p style="color:black!important;" >We offer a variety of trays at unbelievable prices. Tray sizes range from small to extra large. Large trays serve 8-12 people and small trays serve 4-6.</p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h6 style="font-weight:bold;">Sandwich Trays</h6>
                    <ul >
                        <li>Small Sandwich Trays</li>
                        <li>Large Sandwich Trays</li>
                        <li>Combination Vegeteranian Trays</li>
                        <li>Party Platter Subs</li>
                        <li>Sweet Tray</li>
                        <li>And many more..</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 style="font-weight:bold;">Snack and Sandwich Trays</h6>
                    <ul>
                        <li>Crisp chicken nuggets</li>
                        <li>Cocktail meatballs</li>
                        <li>Cocktail samoosas</li>
                        <li>Spring rolls</li>
                        <li>Fish bites</li>
                        <li>And many more..</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 style="font-weight:bold;">Deli Combination Trays</h6>
                    <ul>
                        <li>Chicken Kebab</li>
                        <li>Beef Kebab</li>
                        <li>Chicken Wings</li>
                        <li>Cheese Grillers Wrapped in Bacon</li>
                        <li>Marinated Spareribs</li>
                        <li>Crumbed Mushrooms</li>
                        <li>And many more..</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <div style="float:right;">
                   <a class="btn" href="order_display"><i class="material-icons left">payment</i> Order Now</a>
                </div>
            </div>
        </div>

    </div>
    <div id="salads_popup_dialog" class="modal" role="dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title center">Salads Details</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <p style="color:black!important;" >Party size salads are available on request. All dressings are served on the side.</p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h6 style="font-weight:bold;">Standard</h6>
                    <ul>
                        <li>Lettuce</li>
                        <li>Tomato</li>
                        <li>Cucumbers</li>
                        <li>Carrots</li>
                        <li>Dressing</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 style="font-weight:bold;">Optional</h6>
                    <ul>
                        <li>Onions</li>
                        <li>Green Peppers</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 style="font-weight:bold;">Dressings</h6>
                    <ul>
                        <li>Chef's Dressing</li>
                        <li>Creamy Yorghurt and Mustard dressing</li>
                        <li>Sea food dressing</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <div style="float:right;">
                    <a class="btn" href="order_display"><i class="material-icons left">payment</i> Order Now</a>
                </div>
            </div>
        </div>
    </div>
    <div id="sandwich_popup_dialog" class="modal" role="dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title center">Sandwich Details</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <p style="color:black!important;" >Choose one of our delicious fillings or design your own sandwich. Sizes vary from medium (15cm) to large(22cm). When designing your own sandwich you can choose the type of bread and any 3 additional toppings.
                </p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h6 class="center" style="font-weight:bold;">Standard Toppings</h6>
                    <ul>
                        <li>Lettuce</li>
                        <li>Tomato</li>
                        <li>Pickles</li>
                        <li>Secret Mayo Source</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="center" style="font-weight:bold;">Optional Toppings</h6>
                    <ul>
                        <li>Onions - plain/grilled</li>
                        <li>Cucumbers</li>
                        <li>Green Peppers</li>
                        <li>Secret Mustard Sauce</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <div style="float:right;">
                    <a class="btn"   href="order_display"><i class="material-icons left">payment</i> Order Now</a>
                </div>
            </div>
        </div>
    </div>

    <div id="order_popup_dialog" class="modal" role="dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h5 class="modal-title center">Order Details</h5>
        </div>
        <div class="modal-body">
            <div class="row">

                <div class="col-md-12 col-sm-12">

                    <div class="row" id='address_div'>
                        <form id="address_form" class="col s12">
                            <fieldset>
                                <legend>Enter Address for delivery</legend>
                                <div class="row">
                                    <input id='address' type='text'  placeholder="Enter your address" required>
                                </div>
                                <div class="row" style="margin-top:1em;">
                                    <div  id="map_canvas"></div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col s4 offset-s3">
                            <button class="btn waves-effect waves-light" type="button" id="address_action">Next<i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="fixed-action-btn">
    <a class="btn-floating btn-large teal">
        <i class="large material-icons">mode_edit</i>
    </a>
    <ul>
        <a class="btn-floating" href="contact_display" title="Contact Us"><i class="material-icons left">email</i> Contact Us</a>
        <a class="btn-floating" style="margin-top:1em;margin-bottom:1em;" href="order_display" title="Order Now"><i class="material-icons left">add_shopping_cart</i> Order Now</a>
        <a  class="btn-floating" href="{{ url('/login') }}" style="margin-left:1em;" title="Sign In"><i class="material-icons left">verified_user</i>Sign  In</a>
        {{--<li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>--}}
    </ul>
</div>
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


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

{{--<script src="{{ asset('/js/app.js') }}"></script>--}}
{{--<script src="{{ asset('/js/smoothscroll.js') }}"></script>--}}
{{--<script type="text/javascript" async="async" defer="defer" data-cfasync="false" src="https://mylivechat.com/chatinline.aspx?hccid=10733251"></script>--}}
{{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4VCOsDzZ-3fqwWrxmWWgoPNlXcpvpPvE&libraries=places&callback=getLocation" async defer></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>
<script>
    sessionStorage.clear();
    window.indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB ||
        window.msIndexedDB;

    window.IDBTransaction = window.IDBTransaction || window.webkitIDBTransaction ||
        window.msIDBTransaction;
    window.IDBKeyRange = window.IDBKeyRange ||
        window.webkitIDBKeyRange || window.msIDBKeyRange

    if (!window.indexedDB) {
        window.alert("Your browser doesn't support a stable version of IndexedDB.")
    }
    var request = indexedDB.deleteDatabase("order_cart");
    request.onsuccess = function (event) {
      console.log("deleted order cart");
    };
    var request2 = indexedDB.deleteDatabase("toppings_cart");
    request2.onsuccess = function (event) {
        console.log("deleted toppings_cart");
    };
    var request3 = indexedDB.deleteDatabase("complete_orders");
    request3.onsuccess = function (event) {
        console.log("deleted orders");
    };
    $(document).ready(function(){
        $("#details_form" ).hide();
        // $("#many_details_form").hide();
        //$("#sandwich_popup_dialog").modal("hide");
        $('.slider').slider({ full_width: true });
        $(".dropdown-trigger_cus").dropdown();
        $(".dropdown-trigger_cus2").dropdown();
        $('.sidenav').sidenav();
        $("#sandwich_popup").on('click',function(){
            $("#sandwich_popup_dialog").modal();
        });
        $('.fixed-action-btn').floatingActionButton();
        $("#salads_popup").on('click',function(){
            $("#salads_popup_dialog").modal();
        });
        $("#trays_popup").on('click',function(){
            $("#trays_popup_dialog").modal();
        });
        $('.carousel').carousel({
            interval: 3500
        });
        $('#address_form').on('submit',function(){
            return false;
        });
        $('#address_action').on('click',function(){
            var address=$('#address').val();
//            console.log(address.length);
            if(address.length>=15){
                sessionStorage.setItem('address',address);
                $('#address_div').hide();
                window.location.href = '/order_display';
                // $('#details_form').show();
                $(this).close();
            }
            else{
                // alert('Please enter your full address, in port elizabeth');
                $.notify('Please enter your full address, in port elizabeth',{
                    type:"danger",
                    align:"center",
                    verticalAlign:"middle",
                    animation:true,
                    animationType:"drop"
                });
            }
        });

    });

    var latitude=0;
    var longitude=0;
    var map;
    var infowindow;

    function getLocation(){
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(initAutocomplete);
        } else {
            $.notify('Geolocation is not supported by this browser',{
                type:"danger",
                align:"center",
                verticalAlign:"middle",
                animation:true,
                animationType:"drop"
            });
            // alert("Geolocation is not supported by this browser.");
        }
    }
    // $(document).ready(function(){
    //   getLocation();
    // });

    function initAutocomplete(position) {
        latitude=position.coords.latitude;
        longitude=position.coords.longitude;

        map = new google.maps.Map(document.getElementById('map_canvas'), {
            center: {lat: latitude, lng: longitude},
            zoom: 15,
            mapTypeId: 'roadmap'
        });

        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
            location:{lat:latitude,lng:longitude},
            radius:5
        },callback);
        // Create the search box and link it to the UI element.
        var input = document.getElementById('address');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
    }
    function callback(results, status) {
//        console.log("creating marker");
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            for (var i = 0; i < results.length; i++) {
                createMarker(results[i]);
                // var latLang=result[i].getPosition();
                // map.setCenter();
            }
        }
    }

    function createMarker(place) {
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
            map: map,
            position: place.geometry.location
        });

        google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(place.name);
            infowindow.open(map, this);
        });
    }
    $('#order_popup_dialog').on("shown.bs.modal",function(){
        google.maps.event.trigger(map, "resize");
    });

    function place_order(){
        alert("Coming soon");
    }

</script>
</body>
</html>
