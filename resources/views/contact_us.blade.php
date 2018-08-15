@extends('order_processing')
@section('content')
    <div class="container">
  <div class="row card" style="margin-top:1em;">
      <form id="order_completion_form" col="col m10 " role="form" method="POST">
          <input id="_token" name="_token" value="{{ csrf_token() }}" hidden>
          <fieldset>
              <legend class="center">Send Us an Email</legend>
              <div class="row">

                  <div class="input-field col m6">
                      <label for="last_name_dialog" class="active">Full Name</label>
                      <input id='last_name_dialog' type='text' required>

                  </div>
                  <div class="input-field col m6">
                      <label for="email_address_dialog" >Email</label>
                      <input id='email_address_dialog' type='email' required>
                  </div>

              </div>
              <div class="row">
                  <div class="input-field  col m6" style="color:black">
                  <label for="phone_number" class="active">Phone Number</label>
                  <input id='phone_number_dialog' type='tel' required>
              </div>
              </div>

              <div class="row">
                  <div id="address" class="input-field  col m12" style="color:black">
                      <label for="address_dialog">Message</label>
                      <textarea  id='address_dialog' class="materialize-textarea"></textarea>
                  </div>
              </div>
              <div class="row" style="margin-top:2em;" >

                  <div class="col offset-s5 col s2" style="margin-bottom:1em;">
                      <button id='register_new_account' class="btn waves-effect waves-light">Submit</button>
                  </div>
              </div>
          </fieldset>

      </form>
  </div>
    </div>
  <style>

      .active:after {
          content: ""
      }
      .sidenav-overlay{z-index:99;}
  </style>
    <script>
        $(document).ready(function(){
            $(".dropdown-trigger_cus").dropdown();
            $(".dropdown-trigger_cus2").dropdown();
            $('.sidenav').sidenav();
        });
    </script>
@endsection
