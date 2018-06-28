@component('mail::message')
Hi {{$name . ' ' . $surname}},

Your order has been received. Your order details are as follows:
Item name:{{$order->item_name}}<br/>
Item category:{{$order->item_category}}<br/>
Bread type:{{$order->bread_type}}<br/>
Quantity ordered:{{$order->quantity}}<br/>
Delivery address:{{$order->address}}<br/>
Contact Number:{{$order->phone_number}}<br/>

Thanks,<br/>
{{ config('app.name') }}
@endcomponent
