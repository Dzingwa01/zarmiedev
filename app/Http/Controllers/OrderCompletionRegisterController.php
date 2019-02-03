<?php
/**
 * Created by PhpStorm.
 * User: DEV
 * Date: 2018-07-04
 * Time: 04:20 PM
 */

namespace App\Http\Controllers;
use App\Package;
use App\Role;
use App\User;
use Validator;
use DB;
use App\Jobs\SendVerificationEmail;
use App\Ingredient;
use App\Jobs\OrderPlacedJob;
use App\Jobs\ZarmieOrder;
use App\Order;
use App\OrderIngredient;
use Illuminate\Http\Request;

class OrderCompletionRegisterController
{
//    public function placeOrderRegister(Request $request)
//    {
////        $this->validator($request->all())->validate();
//
//        event(new Registered($user = $this->create($request->all())));
//
////        $this->guard()->login($user);
//        return response()->json(["status" => "Account creation successfully, and your order was captured successfully. Please verify your account"]);
//
//    }

    public function placeOrderRegister(Request $request)
    {
        $data = $request->all();
//        $data['email_token'] = base64_encode($data['email']);
        DB::beginTransaction();
        try {
            $user =User::create([
                'name' => $data['first_name'],
                'surname' => $data['last_name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'physical_address' => $data['address'],
                'password' => bcrypt($data['password']),
                'verification_token'=>base64_encode($data['email']),
                'verified'=>0
            ]);
            $input = $request->all();
            $orders = json_decode($input['orders']);
            $extra_info = new \stdClass();
            $extra_info->total_cost = $input['total_cost'];
            $extra_info->phone_number = $user->phone_number;
            $extra_info->address = $input['address'];
            $extra_info->delivery_or_collection = $input['delivery_or_collect'];
            $extra_info->delivery_time = $input['delivery_time'];
            $extra_info->instructions = $input['special_instructions'];
            $created_orders = [];

            foreach ($orders as $order) {
                $item_name = $order->item_name;
                $item_category = $order->item_category;
                $bread_type = $order->bread_type;
                $toast_type = $order->toast_type;
                $quantity = $order->quantity;
                $prize = $order->prize;
                $order_input = ["address"=>$input['address'],"prize"=>$prize,"item_name" => $item_name, "phone_number" => $user->phone_number, "item_category" => $item_category, "bread_type" => $bread_type, "toast_type" => $toast_type, "quantity" => $quantity, "user_id" => $user->id,"delivery_time"=>$input['delivery_collect_time'],"delivery_or_collect"=> $input['delivery_or_collect'],"extra_instructions"=>$input['special_instructions']];

                $order_cur = Order::create($order_input);
                foreach ($order->ingredients as $ingredient){
                    $item_ingredient = new OrderIngredient;
                    $item_ingredient->ingredient_id = $ingredient->id;
                    $item_ingredient->order_id = $order_cur->id;
                    $item_ingredient->name = $ingredient->name;
                    $item_ingredient->save();
                }
                foreach ($order->toppings as $topping){
                    $item_ingredient = new OrderToppings();
                    $item_ingredient->topping_id = $topping->id;
                    $item_ingredient->order_id = $order_cur->id;
                    $item_ingredient->name = $topping->name;
                    $item_ingredient->save();
                }
                foreach ($order->drinks as $drink){
                    $item_ingredient = new OrderDrinks();
                    $item_ingredient->drink_id = $drink->id;
                    $item_ingredient->order_id = $order_cur->id;
                    $item_ingredient->name = $drink->name;
                    $item_ingredient->save();
                }
                DB::commit();
                array_push($created_orders,$order_cur->load('order_ingredients','toppings','drinks','user'));
            }
            event($user);
            dispatch(new SendVerificationEmail($user));
            dispatch(new OrderPlacedJob($user, $orders,$extra_info));
            dispatch(new ZarmieOrder($user, $orders,$extra_info));

            return response()->json(["status" => "Account creation successfully, and your order was captured successfully. Please verify your account","orders"=>$created_orders]);
        }
        catch (\Exception $e){
            DB::rollback();
            return response()->json(["status" => "An error occured, please contact zarmie on 041 365 7146".$e->getMessage()]);
        }
//        return response()->view('status.status_message',$user,200);
    }
}