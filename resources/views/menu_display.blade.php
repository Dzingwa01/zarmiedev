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
      /*z-index: 5!important;*/

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
      <a id="logo-container" href="{{url('/home')}}" class="brand-logo"><img height="70px" width="100px" class="img-rounded" src={{URL::asset('pictures/logo.png')}} />  </a>
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
        <li><a class="" style="color:black;font-weight: bolder;" href="order_display"><i class="material-icons left">add_shopping_cart</i> Order Now</a></li>
        <li><a class="" style="color:black;font-weight: bolder;"  href="menu_display"><i class="material-icons left">reorder</i> Menu</a></li>
        {{-- <li><a class="btn"><i class="material-icons left">info</i> About Us</a></li> --}}
        <li><a class="" style="color:black;font-weight: bolder;" href="contact_display"><i class="material-icons left">email</i> Contact Us</a></li>
        <li>
          <a style="color:black;font-weight: bolder;"  class="dropdown-trigger_cus2" data-toggle="dropdown" href="#dropdown2">
            <i class="material-icons left">person_pin</i>
            Account
            <span class="caret"></span>
          </a>
        </li>
      </ul>

      <ul id="slide-out" class="sidenav">
        <li><a href="/home" class="sidenav-close" style="color:black;font-weight: bolder"><i class="tiny material-icons">home</i> Home</a></li>
        <li><a class="" style="color:black;font-weight:bolder;" href="/client_order_display"><i class="tiny material-icons left">add_shopping_cart</i> Order Now</a></li>
        <li><a href="/previous_orders" class="" style="color:black;font-weight: bolder"> <i class="tiny material-icons">shopping_cart</i>Previous Orders</a></li>
        <li><a class="" href="/client_menu_display" style="color:black;font-weight: bolder"><i class="tiny material-icons left">reorder</i> Menu</a></li> <hr>
        <li>
          <a  style="color:black;font-weight: bolder;" class="dropdown-trigger_cus" data-toggle="dropdown" href="#dropdown1">
            <i class="material-icons left">person_pin</i>
            Account
            <span class="caret"></span>
          </a>
        </li>
      </ul>

    </div>

  </nav>
</div>
  <div class="container-fluid" style="margin-top:1em">
    <div id='menu_items' class="row" >
      <header class="center"><h5>Our Menu</h5></header>
        @foreach ($categories as $category)
        <div class="col-md-4 col-sm-12" >
          <div class="tile" id='{{$category->id}}' onclick="showModal({{$category->id}},{{$menu_items}})" data-toggle="modal" data-target="#menu_popup_dialog">
            <img title='{{$category->category_name}}' src= '{{$category->picture_url}}' style = "margin-top:38px!important; width: 200px;height:62px"/>
          </div>
        </div>
        @endforeach
      </div>

    <div id="menu_popup_dialog" class="modal" role="dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title center">Available Choices</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <table id='menu_show' class="table table-hover table-sm table-striped">
            <th> Item Number </th>
            <th> Item Name </th>
            <th> Sandwich </th>
            <th> Medium Sub </th>
            <th> Large Sub </th>
            <th> Wrap </th>
          </table>
        </div>
      </div>
    </div>

    <style>
    .tile
    {
      background-image:url('background_theme.jpg');
      color:#ffffff;
      margin-top:6em!important;
      text-align:center;
      vertical-align: center;
      /*display: table-cell;*/
      /*width: 300px;*/
      height: 150px;
    }
    .tile:hover{
      box-shadow: 5px 5px 5px #888888;
      cursor: pointer;
      /*background-color: #90EE90;*/

    }
    .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
      background-color: #26a69a!important;;
    }
    </style>
    <script>
    $(document).ready(function(){
        $(".dropdown-trigger_cus").dropdown();
        $(".dropdown-trigger_cus2").dropdown();
        $('.sidenav').sidenav();
      sessionStorage.setItem('num_people',1);
      $("#for_one").on('click',function(){
        sessionStorage.setItem('num_people',1);
        sessionStorage.setItem('order_type','single');
        $('#num_people').hide();
      });
      $("#for_many").on('click',function(){
        $('#num_people').show();
        sessionStorage.setItem('order_type','many');
      });
      $("#num_people").on('blur',function(){
        sessionStorage.setItem('num_people',$('#num_people').val());
        console.log($('#num_people').val());
      });
    });
    </script>
    <script type='text/javascript'>
      function showModal(category_id,menu_items){
        console.log(menu_items);
        $(document).ready(function(){
          $("#menu_show").find("tr:gt(0)").remove();
          $.each(menu_items, function(idx,obj){
            if(obj.item_category == category_id){
                if(category_id==7){
                    $('#menu_show').append('<tr id='+"item_"+obj.item_number+' onclick="process_order(this)" ><td>'+ obj.item_number + '</td><td>'+obj.item_name + '</td><td></td><td>'+obj.MediumSub+'</td><td>'+obj.LargeSub+'</td><td></td>');

                }else if(category_id>=18&&category_id<=22){
                    $('#menu_show').append('<tr id='+"item_"+obj.item_number+' onclick="process_order(this)" ><td>'+ obj.item_number + '</td><td>'+obj.item_name + '</td><td>'+obj.Sandwich+'</td><td></td><td></td><td></td>');

                }
                else{
                if(obj.item_number==25||obj.item_number==33){
                        $('#menu_show').append('<tr id='+"tr_"+obj.item_number+' onclick="process_order(this)"><td>'+obj.item_number+'</td><td>'+obj.item_name+'</td><td></td><td></td><td></td><td> R '+(obj.Wrap).toFixed(2)+'</td></tr>');

                    }else if(obj.item_number==32){
                        $('#menu_show').append('<tr id='+"tr_"+obj.item_number+' onclick="process_order(this)"><td>'+obj.item_number+'</td><td>'+obj.item_name+'</td><td></td><td>R '+(obj.Sandwich).toFixed(2)+'</td><td></td><td> </td></tr>');

                    }else{
                        $('#menu_show').append('<tr id='+"item_"+obj.item_number+' onclick="process_order(this)" ><td>'+ obj.item_number + '</td><td>'+obj.item_name + '</td><td>'+obj.Sandwich+'</td><td>'+obj.MediumSub+'</td><td>'+obj.LargeSub+'</td><td>'+obj.Wrap+'</td>');
                    }
                }

            }
          });
          // $('#menu_popup_dialog').modal('show');
        });
      }
      function process_order(item_number){
          var id_string = item_number.id.split('_');
          var id = id_string[1];
          sessionStorage.setItem('item_number_1',id);
          var item_category = 0;
          var item_id = 0;
          var prize = 0;
          var menu_items = {!!$menu_items!!};
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
                  }else if(id==32){
                      prize = obj.sandwich;

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
              window.location.href = '/select_ingredients_toppings/'+item_id;
          }else if(id==32||id==25||id==33){
              sessionStorage.setItem('item_category',item_category);
              window.location.href = '/select_ingredients_toppings/'+item_id;
              sessionStorage.setItem('item_category_price', prize);
              sessionStorage.setItem('total_due',prize);
          }
          else{
              window.location.href='/bread_selection/'+item_id;
          }

          console.log(item_number);

      }
      $(document).ready(function(){

        $('#details_form').hide();
        $('#num_people').hide();
        $('#choice_selection').hide();
        $('#phone_number').keyup(function(){
          var phone=$('#phone_number').val();
          if(phone.length==3||phone.length==7){
            var new_phone_str=phone+'-';
            $('#phone_number').val(new_phone_str);
          }
        });
        $('#phone_number_many').keyup(function(){
          var phone=$('#phone_number_many').val();
          if(phone.length==3||phone.length==7){
            var new_phone_str=phone+'-';
            $('#phone_number_many').val(new_phone_str);
          }

        });
        $('#address_form').on('submit',function(){
          return false;
        });
        $('#address_action').on('click',function(){
          var address=$('#address').val();
          console.log(address.length);
          if(address.length>=15){
            sessionStorage.setItem('address',address);
            $('#address_div').hide();
            $('#details_form').show();
            $(this).hide();
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
        $('#details_form').on('submit',function(){
          var full_name=$('#full_name').val();
          var phone_number=$('#phone_number').val();

          sessionStorage.setItem('full_name',full_name);
          sessionStorage.setItem('phone_number',phone_number);
          var choices=[];

          $(':checkbox').each(function () {
            if(this.checked){
              choices.push($(this).val());
            }

          });
          if(choices.length==0){
            $.notify('Please select your choices',{
              type:"danger",
              align:"center",
              verticalAlign:"middle",
              animation:true,
              animationType:"drop"
            });
          }
          else{

            sessionStorage.setItem('selected_choices',JSON.stringify(choices));
            var stored=JSON.parse(sessionStorage.getItem('selected_choices'));
            // $("input, textarea,checkbox").val("");
            window.location.href='{{route('order_selection')}}';
          }

          return false;
        });

        $.get('get_choices.php',function(data,status){
          if(status=='success'){
            var results=JSON.parse(data);
            $.each(results,function(index,obj){
              $('#choice_stick_menu').append('<div class="col-md-6"><input type="checkbox" id="'+obj.id+'" value="'+obj.id+'" /><label for="'+obj.id+'">'+obj.category_name+'</label></div>');

            });
          }
        })
        .fail(function() {
          // alert( "An error occured loading choices, pelase try again" );
          $.notify('An error occured loading choices, pelase try again',{
            type:"danger",
            align:"center",
            verticalAlign:"middle",
            animation:true,
            animationType:"drop"
          });
        });

      });
      </script>
      <script src="js/materialize.js"></script>
      <script src="js/init.js"></script>

    </div>
    <div class="container-fluid">
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
    </div>

    <script type="text/javascript" async="async" defer="defer" data-cfasync="false" src="https://mylivechat.com/chatinline.aspx?hccid=10733251"></script>
    {{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4VCOsDzZ-3fqwWrxmWWgoPNlXcpvpPvE&libraries=places&callback=getLocation" async defer></script>--}}
  </body>
  </html>
