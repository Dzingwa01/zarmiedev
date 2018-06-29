@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection
<?php
$order = App\Order::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->get();?>

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-4 well-lg">
				<div class="box box-success">
					<div class="box-header with-border">
						{{--<h3>Users Report</h3>--}}
						<div class="info-box bg-green">
							<span class="info-box-icon"><i class="io ion-ios-people"></i> </span>
							<div class="info-box-content">
								<span class="info-box-text">Total Orders</span>
								<span class="info-box-number">{{count($order)}}</span>
								<div class="progress">
									<div class="progress-bar" style="width:100%"></div>
								</div>
								<span class="progress-description">Total Orders you have placed</span>
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
								<span class="info-box-text">Favourites</span>
								<span class="info-box-number"> 1</span>
								<div class="progress">
									<div class="progress-bar" style="width:100%"></div>
								</div>
								<span class="progress-description">Total Favourites</span>
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
								<span class="info-box-text">Specials for you</span>
								<span class="info-box-number">1</span>
								<div class="progress">
									<div class="progress-bar" style="width:100%"></div>
								</div>
								<span class="progress-description">Redeem your specials</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
