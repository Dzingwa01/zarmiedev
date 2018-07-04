@component('mail::message')
Hi Shane,

An order has been received:<br/>
<b>Customer Name: </b> {{$name . ' ' . $surname}}
<b>Contact Number:</b> {{$order->phone_number}}<br/>
<b>Item name:</b> {{$order->item_name}}<br/>
<b>Item size:</b> {{$order->item_category}}<br/>
<b>Bread type:</b> {{$order->bread_type}}<br/>
<b>Order Total Prize:</b> {{$order->prize}}<br/>
<b>Quantity ordered:</b> {{$order->quantity}}<br/>
<b>Delivery address:</b> {{$order->address}}<br/>

<b>Ingredients: </b>
@foreach($ingredients as $ingredient)
<li>{{$ingredient}}</li>
@endforeach

Thanks,<br/>
{{ config('app.name') }}
@endcomponent
