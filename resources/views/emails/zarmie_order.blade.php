@component('mail::message')
Hi Shane,

An order has been received:<br/>
<b>Customer Name: </b> {{$name . ' ' . $surname}}
<b>Contact Number:</b> {{$extra_info->phone_number}}<br/>
<b>Total Cost: R {{$extra_info->total_cost}}</b><br/>
<b>Delivery/Collect:</b> {{$extra_info->delivery_or_collection}}<br/>
@if($extra_info->delivery_or_collection=="Delivery")
<b>Delivery address:</b> {{$extra_info->address}}<br/>
@endif
<b>Time: {{$extra_info->delivery_time}}</b><br>
<b>Special Instructions:</b> {{$extra_info->instructions}}<br/><hr/>
<b>Order Details</b>
@foreach($order as $order_item)
<b>Item name:</b> {{$order_item->item_name}}<br/>
<b>Item size:</b> {{$order_item->item_category}}<br/>
<b>Bread type:</b> {{$order_item->bread_type}}<br/>
<b>Toast type:</b> {{$order_item->toast_type}}<br/>
<b>Quantity ordered:</b> {{$order_item->quantity}}<br/>
<b>Item Prize:</b> R{{$order_item->prize}}<br/>
<b>Ingredients: </b>
@foreach($order_item->ingredients as $ingredient)
<li>{{$ingredient->name}}</li>
@endforeach
@if(count($order_item->toppings)>0)
<b>Toppings:</b>
@foreach($order_item->toppings as $topping)
<li>{{$topping->name}}</li>
@endforeach
@endif
@if(count($order_item->drinks)>0)
<b>Drinks: </b>
@foreach($order_item->drinks as $drink)
<li>{{$drink->name}}</li>
@endforeach
@endif
<hr/>
@endforeach


Thanks,<br/>
{{ config('app.name') }}
@endcomponent
