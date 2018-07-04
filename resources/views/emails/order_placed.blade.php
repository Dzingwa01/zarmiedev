@component('mail::message')
Hi {{$name . ' ' . $surname}},

Your order has been received. Your order details are as follows:<br/>
<b>Item name:</b> {{$order->item_name}}<br/>
<b>Item size:</b> {{$order->item_category}}<br/>
<b>Bread type:</b> {{$order->bread_type}}<br/>
<b>Quantity ordered:</b> {{$order->quantity}}<br/>
<b>Order Total Prize:</b> {{$order->prize}}<br/>
<b>Delivery address:</b> {{$order->address}}<br/>
<b>Contact Number:</b> {{$order->phone_number}}<br/>
<b>Ingredients: </b>
@foreach($ingredients as $ingredient)
<li>{{$ingredient}}</li>
@endforeach

Your order will be delivered in the next 20 minutes<br/>
Thanks,<br/>
{{ config('app.name') }}
@endcomponent
