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

  <style>
  .drop-down{
    margin-left: 1em!important;
  }
  /*.btn{
  background-image:url('background_theme.jpg')!important;
  }*/
  </style>
</head>
<body>
  <nav class="navbar-fixed-top white" role="navigation" style="height:7em;">
    <div class="nav-wrapper container-fluid">
      <a id="logo-container" href="/" class="brand-logo" ><img class="img-responsive img-rounded" src={{URL::asset('pictures/logo.png')}} /></a>
      {{--@if (Auth::user()->verified!=0)--}}
      {{--<li><a href="{{ url('/home') }}">Home</a></li>--}}
      {{--@else--}}
      <ul class="right hide-on-med-and-down">
        <li><a class="btn" href="order_display" style="margin-top:1em;margin-bottom:1em;"><i class="material-icons left">payment</i> Order Now</a></li>
        <li><a class="btn"  href="menu_display"><i class="material-icons left">reorder</i> Menu</a></li>
        {{-- <li><a class="btn"><i class="material-icons left">info</i> About Us</a></li> --}}
        <li><a class="btn" href="contact_display"><i class="material-icons left">email</i> Contact Us</a></li>
        <li class="dropdown">
          <a  class="dropdown-toggle btn" data-toggle="dropdown" href="#">
            <i class="material-icons left">person_pin</i>
            Account
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <a style="width:160px!important;" class="btn" href="{{ url('/login') }}" style="margin-left:1em;"><i class="material-icons left">verified_user</i>Sign  In</a><br/>
            {{-- <a style="width:160px!important;" class="btn" href="{{ url('/register') }}" style="margin-left:1em;"><i class="material-icons left">person_pin</i>Register</a> --}}
          </ul>
        </li>
      </ul>
      <ul id="nav-mobile" class="side-nav">
        <li><a class="btn" href="order_display" style="margin-top:1em;margin-bottom:1em;"><i class="material-icons left">payment</i> Order Now</a></li>
        <li><a class="btn"><i class="material-icons left">reorder</i> Menu</a></li>
        {{-- <li><a class="btn"><i class="material-icons left">info</i> About Us</a></li> --}}
        <li><a class="btn" href="contact_display"><i class="material-icons left">email</i> Contact Us</a></li>
        <li class="dropdown">
          <a  class="dropdown-toggle btn" data-toggle="dropdown" href="#">
            <i class="material-icons left">person_pin</i>
            Account
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <a style="width:160px!important;" class="btn" href="{{ url('/login') }}" style="margin-left:1em;" ><i class="material-icons left">verified_user</i>Sign  In</a><br/>
            {{-- <a style="width:160px!important;" class="btn" href="{{ url('/register') }}" style="margin-left:1em;"><i class="material-icons left">person_pin</i>Register</a> --}}
          </ul>
        </li>

      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
      {{--@endif--}}
    </div>
  </nav>
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
  </style>
  <script>
  $(document).ready(function() {
    // $("#menu_popup_dialog").modal();
    $('select').material_select();
  });
  </script>
  <div class="container" style="margin-top:8em">
    <div class="row" >
      <header class="center"><h4>Our Menu</h4></header>
      <div id='menu_items' class="row" >
        @foreach ($categories as $category)
        <div class="col-md-4 col-sm-12" >
          <div class="tile" id='{{$category->id}}' onclick="showModal({{$category->id}},{{$menu_items}})" data-toggle="modal" data-target="#menu_popup_dialog">
            <img title='{{$category->category_name}}' src= '{{$category->picture_url}}' style = "margin-top:38px!important; width: 200px;height:62px"/>
          </div>
        </div>
        @endforeach
      </div>

    </div>

    <div id="menu_popup_dialog" class="modal" role="dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title center">Available Choices</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <table id='menu_show'>
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

    </style>
    <script>
    $(document).ready(function(){
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
    <div id="order_popup_dialog" class="modal" role="dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title center">Order Details</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-3">
            <p style="margin-left:1em;">
              <input name="order_for" type="radio" id="for_one" checked="checked" />
              <label for="for_one">Myself</label>
            </p>
            <p style="margin-left:1em;">
              <input name="order_for" type="radio" id="for_many" />
              <label for="for_many">For many people</label>
            </p>
            <p style="margin-left:1em;">
              <input name="num_people" type="number" id="num_people" placeholder="Number of People"/>
            </p>
          </div>
          <div class="col-md-9">
            <div class="row">
              <form id="details_form" class="col s12">
                <fieldset>
                  <legend>Enter your details and menu choice/s</legend>
                  <div class="row">
                    <div class="input-field col s6">
                      <input id="full_name" type="text" class="validate" required>
                      <label for="full_name">Full Name</label>
                    </div>
                    <div class="input-field col s6">
                      <input id="phone_number" type="tel" pattern="^\d{3}-\d{3}-\d{4}$" class="validate" required>
                      <label for="phone_number">Phone Number(xxx-xxx-xxxx)</label>
                    </div>
                  </div>
                  <div id='choice_stick_menu' class='row'>

                  </div>
                  <div>
                    {{-- <p>
                      <input type="checkbox" id="test5" />
                      <label for="test5">Red</label>
                    </p>
                  </div> --}}
                  <div class="row">
                    <div class="col s4 offset-s3">
                      <button id="go_next" class="btn waves-effect waves-light" type="submit" name="action">Next
                        <i class="material-icons right">send</i>
                      </button>
                    </div>
                  </div>
                </fieldset>
              </form>
            </div>
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
    <style>
    #map_canvas {
      height: 250px;
      /*width: 300px;*/
      margin: 0px;
      padding: 0px
    }
    .controls {
      border: 1px solid!important;
      border-radius: 2px 0 0 2px!important;
      box-sizing: border-box!important;
      -moz-box-sizing: border-box!important;
      height: 32px;
      outline: none;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }
    .pac-container {
      background-color: #fff;
      z-index: 20;
      position: fixed;
      display: inline-block;
      float: left;
    }
    .modal{
      z-index: 20;
    }
    .modal-backdrop{
      z-index: 10;
      }​
      #address {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #address:focus {
        border-color: #4d90fe;
      }

      /*.pac-container {
      font-family: Roboto;
      }*/

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        /*font-family: Roboto;*/
        font-size: 13px;
        font-weight: 300;
      }

      </style>
      <script type='text/javascript'>
      function showModal(category_id,menu_items){
        console.log(menu_items);
        $(document).ready(function(){
          $("#menu_show").find("tr:gt(0)").remove();
          $.each(menu_items, function(idx,obj){
            if(obj.item_category == category_id){
              $('#menu_show').append('<tr><td>'+ obj.item_number + '</td><td>'+obj.item_name + '</td><td>'+obj.Sandwich+'</td><td>'+obj.MediumSub+'</td><td>'+obj.LargeSub+'</td><td>'+obj.Wrap+'</td>');
            }
          });
          // $('#menu_popup_dialog').modal('show');
        });
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
      {{-- <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false">
      </script> --}}
      {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4VCOsDzZ-3fqwWrxmWWgoPNlXcpvpPvE&libraries=places&callback=getLocation" async defer></script> --}}
      <script>
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
        // console.log("creating marker");
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
      </script>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4VCOsDzZ-3fqwWrxmWWgoPNlXcpvpPvE&libraries=places&callback=getLocation" async defer></script>
  </body>
  </html>
