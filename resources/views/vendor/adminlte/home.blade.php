@extends('client_processing')
@section('content')
<?php
$order = App\Order::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->get();?>

	<div class="container-fluid" style="">
		<center>
			<h5>Welcome {{Auth::user()->name}}</h5>
		</center>
		@if (session('status'))
			<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				{{ session('status') }}
			</div>
		@elseif(session('error'))
			<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				{{ session('error') }}
			</div>
		@endif
		<div class="row">
			{{--<div class="col s12 m2 card" >--}}
				{{--<ul id="slide-out" class="sidenav">--}}
					{{--<li><div class="user-view">--}}
							{{--<a href="#user"> <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" /></a>--}}
							{{--<p style="color:black;font-weight: bolder">{{Auth::user()->name . ' '. Auth::user()->surname}}</p>--}}
							{{--<p style="color:black;font-weight: bolder">{{Auth::user()->email}}</p>--}}
						{{--</div></li>--}}
					{{--<li><div class="divider" style="margin-top: 2em;color:black"> </div></li><br>--}}
					{{--<li><a href="/previous_orders" class="" style="color:black;font-weight: bolder"> <i class="tiny material-icons">shopping_cart</i>Previous Orders</a></li><br>--}}
					{{--<li><a href="#!" class="" style="margin-top: 2em;color:black;font-weight: bolder"><i class="tiny material-icons">favorite</i> Favourites</a></li>--}}
					{{--<li><div class="divider" style="margin-top: 2em;color:black"> </div></li><br>--}}

					{{--<li><a style="margin-top: 2em;color:black;font-weight: bolder" class="" href="#!"><i class="tiny material-icons">person</i>Manage Profile</a></li>--}}
				{{--</ul>--}}


				<div class=" col s12 col m4 card"  >
					<div class="card-image">
						<img src="{{URL::asset('/pictures/sandwich.jpg')}}" class="img-responsive" />

					</div>
					<div class="card-content">
						<span class="card-title" style="color:black;font-weight:bold;font-size:1.5em">Sandwiches</span>
						<p style="text-align:justify;color:black!important;">Choose one of our delicious fillings or design your own sandwich large or medium...
						</p>
					</div>
					<div class="card-action">
						<a id="sandwich_popup" title="More Information" class="pull-left " data-toggle="modal" data-target="#sandwich_popup_dialog" style="margin-bottom: 1em;color:teal"><i class=" material-icons left">info</i></a>
						<a title="Order Now" href="client_order_display" class="pull-right "><i class="  material-icons left" style="margin-bottom: 1em; color:teal">add_shopping_cart</i> </a>
					</div>
				</div>

				<div class="col s12 m4 card"  >
					<div class="card-image">
						<img src="{{URL::asset('pictures/greek_2.jpg')}}" class="img-responsive" />

					</div>
					<div class="card-content">
						<span class="card-title" style="text-align:justify;color:black;font-weight:bold;font-size:1.5em">Salads</span>
						<p style="text-align:justify;color:black!important;" >Party size salads are available on request. All dressings are served on the side..</p>

					</div>
					<div class="card-action">
						<a id="salads_popup" title="More Information" data-toggle="modal" style="margin-top:1em;margin-bottom:1em;" data-target="#salads_popup_dialog" ><i class=" material-icons left" style="margin-bottom: 1em;color:teal">info</i></a>
						<a title="Order Now" href="client_order_display" class="pull-right "><i class="  material-icons left" style="margin-bottom: 1em; color:teal">add_shopping_cart</i> </a>
					</div>
				</div>
				<div class="col s12 m4 card" >
					<div class="card-image">
						<img src="{{URL::asset('pictures/wrap_tray_lg.jpg')}}" class="img-responsive" />

					</div>
					<div class="card-content">
						<span class="card-title" style="color:black;font-weight:bold;font-size:1.5em">Trays & Platters</span>
						<p style="text-align:justify;color:black!important;">We offer a variety of trays at unbelievable prices. Tray sizes range from small to extra large..</p>
					</div>
					<div class="card-action">
						<a id="trays_popup" title="More Information" data-toggle="modal" style="margin-top:1em;margin-bottom:1em;" data-target="#trays_popup_dialog" style="margin-bottom: 1em;cursor:hand"><i style="margin-bottom: 1em;color:teal" class=" material-icons left">info</i></a>
						<a title="Order Now" href="client_order_display" class="pull-right " ><i class="  material-icons left" style="margin-bottom: 1em; color:teal">add_shopping_cart</i> </a>
					</div>
				</div>

		</div>
		<div id="trays_popup_dialog" class="modal" role="dialog">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title center">Tray Details</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<p style="color:black!important;" >We offer a variety of trays at unbelievable prices. Tray sizes range from small to extra large. Large trays serve 8-12 people and small trays serve 4-6.</p>
				</div>
				<div class="row">
					<div class="col-md-4">
						<h6 style="font-weight:bold;">Sandwich Trays</h6>
						<ul >
							<li>Small Sandwich Trays</li>
							<li>Large Sandwich Trays</li>
							<li>Combination Vegeteranian Trays</li>
							<li>Party Platter Subs</li>
							<li>Sweet Tray</li>
							<li>And many more..</li>
						</ul>
					</div>
					<div class="col-md-4">
						<h6 style="font-weight:bold;">Snack and Sandwich Trays</h6>
						<ul>
							<li>Crisp chicken nuggets</li>
							<li>Cocktail meatballs</li>
							<li>Cocktail samoosas</li>
							<li>Spring rolls</li>
							<li>Fish bites</li>
							<li>And many more..</li>
						</ul>
					</div>
					<div class="col-md-4">
						<h6 style="font-weight:bold;">Deli Combination Trays</h6>
						<ul>
							<li>Chicken Kebab</li>
							<li>Beef Kebab</li>
							<li>Chicken Wings</li>
							<li>Cheese Grillers Wrapped in Bacon</li>
							<li>Marinated Spareribs</li>
							<li>Crumbed Mushrooms</li>
							<li>And many more..</li>
						</ul>
					</div>
				</div>
				<div class="modal-footer">
					<div style="float:right;">
						<a class="btn" href="client_order_display"><i class="material-icons left">payment</i> Order Now</a>
					</div>
				</div>
			</div>

		</div>
		<div id="salads_popup_dialog" class="modal" role="dialog">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title center">Salads Details</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<p style="color:black!important;" >Party size salads are available on request. All dressings are served on the side.</p>
				</div>
				<div class="row">
					<div class="col-md-4">
						<h6 style="font-weight:bold;">Standard</h6>
						<ul>
							<li>Lettuce</li>
							<li>Tomato</li>
							<li>Cucumbers</li>
							<li>Carrots</li>
							<li>Dressing</li>
						</ul>
					</div>
					<div class="col-md-4">
						<h6 style="font-weight:bold;">Optional</h6>
						<ul>
							<li>Onions</li>
							<li>Green Peppers</li>
						</ul>
					</div>
					<div class="col-md-4">
						<h6 style="font-weight:bold;">Dressings</h6>
						<ul>
							<li>Chef's Dressing</li>
							<li>Creamy Yorghurt and Mustard dressing</li>
							<li>Sea food dressing</li>
						</ul>
					</div>
				</div>
				<div class="modal-footer">
					<div style="float:right;">
						<a class="btn" href="client_order_display"><i class="material-icons left">payment</i> Order Now</a>
					</div>
				</div>
			</div>
		</div>
		<div id="sandwich_popup_dialog" class="modal" role="dialog" style="">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title center">Sandwich Details</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<p style="color:black!important;" >Choose one of our delicious fillings or design your own sandwich. Sizes vary from medium (15cm) to large(22cm). When designing your own sandwich you can choose the type of bread and any 3 additional toppings.
					</p>
				</div>
				<div class="row">
					<div class="col-md-4">
						<h6 class="center" style="font-weight:bold;">Standard Toppings</h6>
						<ul>
							<li>Lettuce</li>
							<li>Tomato</li>
							<li>Pickles</li>
							<li>Secret Mayo Source</li>
						</ul>
					</div>
					<div class="col-md-4">
						<h6 class="center" style="font-weight:bold;">Optional Toppings</h6>
						<ul>
							<li>Onions - plain/grilled</li>
							<li>Cucumbers</li>
							<li>Green Peppers</li>
							<li>Secret Mustard Sauce</li>
						</ul>
					</div>
				</div>
				<div class="modal-footer">
					<div style="float:right;">
						<a class="btn"   href="client_order_display"><i class="material-icons left">payment</i> Order Now</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<style>
	.modal{
		height: 420px;
	}
</style>

@endsection
