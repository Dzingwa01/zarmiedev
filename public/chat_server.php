<?php
/**
 * Created by PhpStorm.
 * User: Gandanga
 * Date: 2019-02-02
 * Time: 03:27 PM
 */
require  '/var/www/zarmiedev.co.za/html/zarmie/vendor/autoload.php';

$options = array(
    'cluster' => 'eu',
    'useTLS' => true
);
$pusher = new Pusher\Pusher(
    '8787890e09bb11d146f4',
    'e90b9d8e617ef78438f5',
    '705510',
    $options
);
$beamsClient = new \Pusher\PushNotifications\PushNotifications(array(
    "instanceId" => "adcaafab-3f97-4c96-9811-547f5c7ff032",
    "secretKey" => "2870A1B3FA363E6F79CC8D7644216B2A920FC2BAEB09760F0D45D30AA97755AC",
));

$event_type = $_POST['event_type'];
if($event_type =="New Order"){

    try{
        $order = new \stdClass();
        $order->id = $_POST['id'];
        $order->name = $_POST['name'];
        $order->surname = $_POST['surname'];
        $order->address = $_POST['address'];
        $order->item_name = $_POST['item_name'];
        $order->item_category = $_POST['item_category'];
        $order->bread_type = $_POST['bread_type'];
        $order->prize = $_POST['prize'];
        $order->toast_type = $_POST['toast_type'];
        $order->extra_instructions = $_POST['extra_instructions'];
        $order->delivery_time = $_POST['delivery_time'];
        $order->delivery_or_collect = $_POST['delivery_or_collect'];
        $order->ingredients = explode(",",$_POST['ingredients']);
        $order->toppings = explode(",",$_POST['toppings']);
        $order->drinks = explode(",",$_POST['drinks']);
        $order->quantity = $_POST['quantity'];
        $order->order_date = $_POST['order_date'];
        $order->phone_number = $_POST['phone_number'];

        $pusher->trigger('orders-channel', 'order-received-event', $order);



        $publishResponse = $beamsClient->publish(
            array("hello"),
            array("fcm" => array("notification" => array(
                "title" => "Order Received",
                "body" => $order->item_name . 'for '.$order->name .' '.$order->surname,
            )),
            ));
        echo("ndeip success".json_encode($order));
    }catch(Exception $e) {
        echo("error: ". $e->getMessage());

    }

}
