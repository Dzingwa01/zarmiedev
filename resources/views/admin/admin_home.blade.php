@extends('adminlte::layouts.app')

@section('htmlheader_title')
  {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
    <?php $users = App\User::all();
    $menus = App\Menu::all();$ingredients = App\Ingredient::all();
    $orders = \App\Order::all();?>
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-4 well-lg">
        <div class="box box-success">
          <div class="box-header with-border">
            {{--<h3>Users Report</h3>--}}
            <div class="info-box bg-green">
              <span class="info-box-icon"><i class="io ion-ios-people"></i> </span>
              <div class="info-box-content">
                <span class="info-box-text">Users</span>
                <span class="info-box-number">{{count($users)}}</span>
                <div class="progress">
                  <div class="progress-bar" style="width:100%"></div>
                </div>
                <span class="progress-description">Total Users registered on the system</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 well-lg">
        <div class="box box-primary">
          <div class="box-header with-border">
            {{--<h3>Articles</h3>--}}
            <div class="info-box bg-aqua">
              <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i> </span>
              <div class="info-box-content">
                <span class="info-box-text">Menu Items</span>
                <span class="info-box-number"> {{count($menus)}}</span>
                <div class="progress">
                  <div class="progress-bar" style="width:100%"></div>
                </div>
                <span class="progress-description">Total Menu Items</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 well-lg">
        <div class="box box-warning">
          <div class="box-header with-border">
            {{--<h3>Users Report</h3>--}}
            <div class="info-box bg-yellow">
              <span class="info-box-icon"><i class="io ion-ios-contacts"></i> </span>
              <div class="info-box-content">
                <span class="info-box-text">Ingredients</span>
                <span class="info-box-number">{{count($ingredients)}}</span>
                <div class="progress">
                  <div class="progress-bar" style="width:100%"></div>
                </div>
                <span class="progress-description">Total Number of Ingredients</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 well-lg">
        <div class="box box-primary">
          <div class="box-header with-border">
            {{--<h3>Articles</h3>--}}
            <div class="info-box bg-gray-light">
              <span class="info-box-icon"><i class="ion ion-ios-beer"></i> </span>
              <div class="info-box-content">
                <span class="info-box-text">Orders</span>
                <span class="info-box-number">{{count($orders)}}</span>
                <div class="progress">
                  <div class="progress-bar" style="width:100%"></div>
                </div>
                <span class="progress-description">Total number of orders received</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 well-lg">
        <div class="box box-primary">
          <div class="box-header with-border">
            {{--<h3>Users Report</h3>--}}
            <div class="info-box bg-blue-active">
              <span class="info-box-icon"><i class="io ion-ios-happy"></i> </span>
              <div class="info-box-content">
                <span class="info-box-text">Promotions</span>
                <span class="info-box-number"></span>
                <div class="progress">
                  <div class="progress-bar" style="width:100%"></div>
                </div>
                <span class="progress-description">Total number of promotions</span>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>

  </div>

@endsection

