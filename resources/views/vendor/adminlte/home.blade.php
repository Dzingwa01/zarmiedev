@extends('client_processing')
@section('content')
<?php
$order = App\Order::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->get();?>

	<div class="container" style="margin-top: 6em;">
		<center>
			<h5>Welcome {{Auth::user()->name}}</h5>
		</center>
		<div class="row">
			<div class=" col s12 col m4 card" >
				<div class="card-image">
					<img src="{{URL::asset('/pictures/sandwich.jpg')}}" class="img-responsive" />

				</div>
				<div class="card-content">
					<span class="card-title" style="color:black;font-weight:bold;font-size:1.5em">Sandwiches</span>
					<p style="text-align:justify;color:black!important;">Order our delicious sandwich or make your own...
					</p>
				</div>
				<div class="card-action">
					<a id="sandwich_popup" title="More Information" class="pull-left " data-toggle="modal" data-target="#sandwich_popup_dialog" style="margin-bottom: 1em;color:teal"><i class=" material-icons left">info</i></a>
					<a title="Order Now" href="order_display" class="pull-right "><i class="  material-icons left" style="margin-bottom: 1em; color:teal">payment</i> </a>
				</div>
			</div>

			<div class="col s12 m4 card"  >
				<div class="card-image">
					<img src="{{URL::asset('pictures/greek_2.jpg')}}" class="img-responsive" />

				</div>
				<div class="card-content">
					<span class="card-title" style="text-align:justify;color:black;font-weight:bold;font-size:1.5em">Salads</span>
					<p style="text-align:justify;color:black!important;" >A variety of salads. All dressings are served on the side...</p>

				</div>
				<div class="card-action">
					<a id="salads_popup" title="More Information" data-toggle="modal" style="margin-top:1em;margin-bottom:1em;" data-target="#salads_popup_dialog" ><i class=" material-icons left" style="margin-bottom: 1em;color:teal">info</i></a>
					<a title="Order Now" href="order_display" class="pull-right "><i class="  material-icons left" style="margin-bottom: 1em; color:teal">payment</i> </a>
				</div>
			</div>
			<div class="col s12 m4 card" >
				<div class="card-image">
					<img src="{{URL::asset('pictures/wrap_tray_lg.jpg')}}" class="img-responsive" />

				</div>
				<div class="card-content">
					<span class="card-title" style="color:black;font-weight:bold;font-size:1.5em">Trays & Platters</span>
					<p style="text-align:justify;color:black!important;">Trays & Platters at unbelievable prices. Small & Large...</p>
				</div>
				<div class="card-action">
					<a id="trays_popup" title="More Information" data-toggle="modal" style="margin-top:1em;margin-bottom:1em;" data-target="#trays_popup_dialog" style="margin-bottom: 1em;cursor:hand"><i style="margin-bottom: 1em;color:teal" class=" material-icons left">info</i></a>
					<a title="Order Now" href="order_display" class="pull-right " ><i class="  material-icons left" style="margin-bottom: 1em; color:teal">payment</i> </a>

				</div>
			</div>
		</div>
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@endsection
