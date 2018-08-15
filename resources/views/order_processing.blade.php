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

  .m-b-sm {
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
 
  .tile
  {
    background-image:url('/background_theme.jpg');
    color:#ffffff;
    margin-left:1em;
    text-align:center;
    /*vertical-align: center;*/
    height: 150px;
    width: 80%;
  }
  .tile:hover{
    box-shadow: 5px 5px 5px #888888;
    cursor: pointer;
    /*background-color: #90EE90;*/

  }
  .accordion:after {
    content: '\02795'; /* Unicode character for "plus" sign (+) */
    font-size: 13px;
    /*background-color: white!important;*/
    float: right;
    margin-left: 5px;
  }

  .active:after {
    content: "\2796"; /* Unicode character for "minus" sign (-) */
  }
  .accordion {
    background-color: #26a69a;
    color: white;
    cursor: pointer;
    font-weight: bold;
    padding: 18px;
    width: 70%;
    margin-left: 1em;
    text-align: left;
    border: none;
    outline: none;
    transition: 0.4s;
  }

  /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
  /*.active, .accordion:hover {*/
    /*background-color: #ccc;*/
  /*}*/

  /* Style the accordion panel. Note: hidden by default */
  .panel {
    /*padding: 0 18px;*/
    /*background-color: white;*/
    margin-left: 1em;
    display: none;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
  }
  .glass_unselected{
    /* background styles */
    position: relative;
    display: inline-block;

    background-color: grey; /*for compatibility with older browsers*/
    background-image: linear-gradient(grey,lightgrey);
    /*width:160px;*/
    border-radius: 25px;
    box-shadow: 0px 1px 4px -2px #333;


    /* text styles */

    color: #fff;
    font-size: 18px;
    font-family: sans-serif;
    font-weight: 100;
  }
  .drink_glass{
    /* background styles */
    position: relative;
    display: inline-block;

    background-color: #039be5; /*for compatibility with older browsers*/
    background-image: linear-gradient( #039be5,lightskyblue);
    /*width:160px;*/
    border-radius: 25px;
    box-shadow: 0px 1px 4px -2px #333;
    /* text styles */
    color: #fff;
    font-size: 18px;
    font-family: sans-serif;
    font-weight: 100;
  }
  .glass{
	/* background styles */
	position: relative;
	display: inline-block;
	
	background-color: green; /*for compatibility with older browsers*/
	background-image: linear-gradient(green,lightgreen);
	/*width:160px;*/
	border-radius: 25px;
    box-shadow: 0px 1px 4px -2px #333;
	/* text styles */
	color: #fff;
	font-size: 18px;
	font-family: sans-serif;
	font-weight: 100;
    }
    .glass:after{
    	background: linear-gradient(rgba(255,255,255,0.8), rgba(255,255,255,0.2));
    }

    .glass:hover{
	background: linear-gradient(#073,#0fa);
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
  <link href="/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="/css/jquery-step-maker.css">
  <script src="/js/materialize.js"></script>
  <script src="/js/init.js"></script>
  <script src="/js/jquery-step-maker.js"></script>
 
  <style>

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
  {{--<script>--}}
  {{--$(document).ready(function() {--}}
    {{--// $("#menu_popup_dialog").modal();--}}
    {{--$('select').material_select();--}}
  {{--});--}}
  {{--</script>--}}
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
        @yield('content')
        
  <footer class="page-footer teal container-fluid">
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

  </body>
  </html>
