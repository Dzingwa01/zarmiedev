<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Zarmie - The Sandwich Shop</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

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
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

  <script>
  $(document).ready(function(){
      $('select').material_select();
  });

  </script>
  <style>
  .drop-down{
    margin-left: 1em!important;
  }
  </style>
</head>
<body id="app-layout">
  <nav class="navbar-fixed-top white" role="navigation" style="height:7em;">
    <div class="nav-wrapper container-fluid">
      <a id="logo-container" href="{{route('admin_home')}}" class="brand-logo" ><img class="img-responsive img-rounded" src={{URL::asset('pictures/logo.png')}} /></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="{{route('admin_home')}}" class="btn"><i class="material-icons left">work</i> Dashboard</a></li>
        <li><a href="{{route('users')}}" class="btn"><i class="material-icons left">recent_actors</i> Users</a></li>
        <li><a href="{{route('manage_menus')}}"  class="btn"><i class="material-icons left">library_add</i> Menus</a></li>

        <li class="dropdown">
          <a  class="dropdown-toggle btn" data-toggle="dropdown" href="#">
            <i class="material-icons left">person_pin</i>
            Account
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <a style="width:160px!important;" class="btn" href="#" style="margin-left:1em;"><i class="material-icons left">mode_edit</i>Profile</a><br/>
            <a style="width:160px!important;" class="btn" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="margin-left:1em;"><i class="material-icons left">supervisor_account</i>logout</a>
          </ul>
        </li>
      </ul>
      <ul id="nav-mobile" class="side-nav">
        <li><a href="{{route('admin_home')}}" class="btn"><i class="material-icons left">work</i> Dashboard</a></li>
        <li><a href="{{route('users')}}" class="btn"><i class="material-icons left">recent_actors</i> Users</a></li>
        <li><a  href="{{route('manage_menus')}}" class="btn"><i class="material-icons left">library_add</i> Menus</a></li>
        <li class="dropdown">
          <a  class="dropdown-toggle btn" data-toggle="dropdown" href="#">
            <i class="material-icons left">person_pin</i>
            Account
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <a style="width:160px!important;" class="btn" href="#" style="margin-left:1em;"><i class="material-icons left">mode_edit</i>Edit Profile</a><br/>
            <a style="width:160px!important;" class="btn" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="margin-left:1em;"><i class="material-icons left">supervisor_account</i>logout</a>
          </ul>
        </li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>

    </div>
  </nav>
  <form id="logout-form" action="{{route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>

  <div class="container">

    @yield('content')
  </div>
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

  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
  <script type="text/javascript" async="async" defer="defer" data-cfasync="false" src="https://mylivechat.com/chatinline.aspx?hccid=10733251"></script>
</body>
</html>
