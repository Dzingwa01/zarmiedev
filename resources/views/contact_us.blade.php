@extends('order_processing')
@section('content')
  <div class="row">
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
@endsection
