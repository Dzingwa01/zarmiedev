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
  li{
    list-style: circle!important;
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
  <script>
  $(document).ready(function(){
    $("#details_form" ).hide();
    // $("#many_details_form").hide();
    //$("#sandwich_popup_dialog").modal("hide");
    $('.slider').slider({ full_width: true });
    $('.parallax').parallax();
    $("#sandwich_popup").on('click',function(){
      $("#sandwich_popup_dialog").modal('show');
    });
    $("#salads_popup").on('click',function(){
      $("#salads_popup_dialog").modal('show');
    });
    $("#trays_popup").on('click',function(){
      $("#trays_popup_dialog").modal('show');
    });

  });

  </script>
  <style>
  .drop-down{
    margin-left: 1em!important;
  }
  </style>
</head>
<body>
  <nav class="navbar-fixed-top white" role="navigation" style="height:7em;">
    <div class="nav-wrapper container-fluid">
      <a id="logo-container" href="#" class="brand-logo" ><img class="img-responsive img-rounded" src={{URL::asset('pictures/logo.png')}} /></a>
      @if (Auth::check())
        <li><a href="{{ url('/home') }}">Home</a></li>
      @else
        <ul class="right hide-on-med-and-down">
          <li><a class="btn" style="margin-top:1em;margin-bottom:1em;" href="order_display"><i class="material-icons left">payment</i> Order Now</a></li>
          <li><a class="btn" href="menu_display"><i class="material-icons left">reorder</i> Menu</a></li>
          {{-- <li><a class="btn"><i class="material-icons left">info</i> About Us</a></li> --}}
          <li><a class="btn"><i class="material-icons left">email</i> Contact Us</a></li>
          <li class="dropdown">
            <a  class="dropdown-toggle btn" data-toggle="dropdown" href="#">
              <i class="material-icons left">person_pin</i>
              Account
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <a style="width:160px!important;" class="btn" href="{{ url('/login') }}" style="margin-left:1em;"><i class="material-icons left">verified_user</i>Sign  In</a><br/>
               <a style="width:160px!important;" class="btn" href="{{ url('/register') }}" style="margin-left:1em;"><i class="material-icons left">person_pin</i>Register</a>
            </ul>
          </li>
        </ul>
        <ul id="nav-mobile" class="side-nav">
          <li><a class="btn" href="order_display" style="margin-top:1em;margin-bottom:1em;"><i class="material-icons left">payment</i> Order Now</a></li>
          <li><a class="btn" href="/menu_display"><i class="material-icons left">reorder</i> Menu</a></li>
          <li><a class="btn"><i class="material-icons left">email</i> Contact Us</a></li>
          <li class="dropdown">
            <a  class="dropdown-toggle btn" data-toggle="dropdown" href="#">
              <i class="material-icons left">person_pin</i>
              Account
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <a style="width:160px!important;" class="btn" href="{{ url('/login') }}" style="margin-left:1em;" ><i class="material-icons left">verified_user</i>Sign  In</a><br/>
               <a style="width:160px!important;" class="btn" href="{{ url('/register') }}" style="margin-left:1em;"><i class="material-icons left">person_pin</i>Register</a>
            </ul>
          </li>

        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
      @endif
    </div>
  </nav>
  <div class="row" style="margin-top:8em;">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading"><header class="center"><h4>Contact Us</h4></header></div>
              <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="">
                      {{ csrf_field() }}
                      <div class="form-group">
                          <label for="item_number" class="col-md-4 control-label">Full Name</label>
                          <div class="col-md-6">
                              <input id="full_name" type="text" class="form-control" name="full_name" value="" placeholder="Enter full name" required autofocus>

                          </div>
                      </div>
                      <div class="form-group">
                          <label for="name" class="col-md-4 control-label">Cellphone Number</label>
                          <div class="col-md-6">
                              <input id="cell_number" type="tel" class="form-control" name="cell_number" value="" placeholder="Cellphone Number" required>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="item_description" class="col-md-4 control-label">Message</label>
                          <div class="col-md-6">
                            <textarea id="message" name="message" class="form-control materialize-textarea" value="" required rows="4" col="5" placeholder="Enter your message here"></textarea>
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-lg">
                                  Send
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>

  </div>

    <script type="text/javascript" async="async" defer="defer" data-cfasync="false" src="https://mylivechat.com/chatinline.aspx?hccid=10733251"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4VCOsDzZ-3fqwWrxmWWgoPNlXcpvpPvE&libraries=places&callback=getLocation" async defer></script>
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
  </body>
  </html>
