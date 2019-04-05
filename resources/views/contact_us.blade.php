@extends('order_processing')
@section('content')
    <div class="container">
  <div class="row card" style="margin-top:1em;">
      @if (session('success'))
          <div class="alert alert-success"><a href="#" class="close" data-dismiss="alert"
                                              aria-label="close">&times;</a>
              {{ session('success') }}
          </div>
      @elseif(session('error'))
          <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert"
                                             aria-label="close">&times;</a>
              {{ session('error') }}
          </div>
      @endif
      <form id="order_completion_form" col="col m10 " role="form" method="POST" action="{{url('contact_us')}}">
          <input id="_token" name="_token" value="{{ csrf_token() }}" hidden>
          <fieldset>
              <legend class="center">Send Us an Email</legend>
              <div class="row">

                  <div class="input-field col m6">
                      <label for="full_name" class="active">Full Name</label>
                      <input id='full_name' name="full_name" type='text' required>
                  </div>
                  <div class="input-field col m6">
                      <label for="email" >Email</label>
                      <input id='email' name="email" type='email' required>
                  </div>

              </div>
              <div class="row">
                  <div class="input-field  col m6" style="color:black">
                  <label for="phone_number" class="active">Phone Number</label>
                  <input id='phone_number' name="phone_number" type='tel' required>
              </div>
              </div>

              <div class="row">
                  <div id="address" class="input-field  col m12" style="color:black">
                      <label for="address_dialog">Message</label>
                      <textarea  id='message' name="message" class="materialize-textarea"></textarea>
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
