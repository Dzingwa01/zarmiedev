@component('mail::message')
Hi {{$name . ' ' . $surname}},

Your order has been received. Your order details are as follows:<br/>
<b>Total Cost: R{{$extra_info->total_cost}}</b><br/>

@foreach($order as $order_item)
<b>Item name:</b> {{$order_item->item_name}}<br/>
<b>Item size:</b> {{$order_item->item_category}}<br/>
<b>Bread type:</b> {{$order_item->bread_type}}<br/>
<b>Toast type:</b> {{$order_item->toast_type}}<br/>
<b>Quantity ordered:</b> {{$order_item->quantity}}<br/>
<b>Item Prize: R</b> {{$order_item->prize}}<br/>
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
<b>Delivery/Collect:</b> {{$extra_info->delivery_or_collection}}<br/>
@if($extra_info->delivery_or_collection=="Delivery")
<b>Delivery address:</b> {{$extra_info->address}}<br/>
@endif
<b>Contact Number:</b> {{$extra_info->phone_number}}<br/>
<b>Special Instructions:</b> {{$extra_info->instructions}}<br/>

Your order will be processed accordingly. For any queries regarding your order, please contact us on 041 365 7146<br/>
Thanks,<br/>
{{ config('app.name') }}
@endcomponent
