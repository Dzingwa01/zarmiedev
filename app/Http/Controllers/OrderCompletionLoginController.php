<?php
/**
 * Created by PhpStorm.
 * User: DEV
 * Date: 2018-07-04
 * Time: 03:03 PM
 */

namespace App\Http\Controllers;

use App\Ingredient;
use App\Jobs\OrderPlacedJob;
use App\Jobs\ZarmieOrder;
use App\Order;
use App\OrderDrinks;
use App\OrderIngredient;
use App\OrderToppings;
use App\User;
use Illuminate\Http\Request;
use App\Bread;
use App\Topping;
use DB;
use App\Menu;
use App\Category;
use App\Item_Size;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Validation\ValidationException;

class OrderCompletionLoginController
{
    public function placeOrderClient(Request $request){
        $user = Auth::user();
        $input = $request->all();
        $orders = json_decode($input['orders']);
        $extra_info = new \stdClass();
        $extra_info->total_cost = $input['total_cost'];
        $extra_info->phone_number = $user->phone_number;
        $extra_info->address = $input['address'];
        $extra_info->delivery_or_collection = $input['delivery_or_collect'];
        $extra_info->delivery_time = $input['delivery_collect_time'];
        $extra_info->instructions = $input['special_instructions'];

        DB::beginTransaction();

        try {
            foreach ($orders as $order) {
                $item_name = $order->item_name;
                $item_category = $order->item_category;
                $bread_type = $order->bread_type;
                $toast_type = $order->toast_type;
                $quantity = $order->quantity;
                $prize = $order->prize;
                $order_input = ["address"=>$input['address'],"prize"=>$prize,"item_name" => $item_name, "phone_number" => $user->phone_number, "item_category" => $item_category, "bread_type" => $bread_type, "toast_type" => $toast_type, "quantity" => $quantity, "user_id" => $user->id];

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

            }
            event($user);
            dispatch(new OrderPlacedJob($user, $orders,$extra_info));
            dispatch(new ZarmieOrder($user, $orders,$extra_info));
            return response()->json(["status" => "Order submitted successfully, Thank you"]);

        }
        catch (\Exception $e) {
            dd($e);
                DB::rollback();
                return response()->json(["status" => "An error occured, please contact zarmie on 041 365 7146"]);
            }
    }

    public function placeOrder(Request $request)
    {
        if ($this->attemptLogin($request)) {
            $input = $request->all();
            $ingr_amount = count($input['ingredients_array']);
            $ingredients_array = $input['ingredients_array'];
            $user = User::where('phone_number', $input['phone_number'])->first();
            DB::beginTransaction();
            try {
                $input['user_id'] = $user->id;
                $order = Order::create($input);
                for ($x = 0; $x < $ingr_amount; $x++) {
                    $item_ingredient = new OrderIngredient;
                    $item_ingredient->ingredient_id = $ingredients_array[$x];
                    $item_ingredient->order_id = $order->id;
                    $item_ingredient->save();
                }
                DB::commit();
                $ingredients = OrderIngredient::join('ingredient', 'ingredient.id', 'order_ingredients.ingredient_id')->where('order_id', $order->id)->pluck('ingredient.name');
                event($user);
                dispatch(new OrderPlacedJob($user, $order, $ingredients));
                dispatch(new ZarmieOrder($user, $order, $ingredients));

                return response()->json(["status" => "Order captured successfully"]);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(["status" => "An error occured, please contact zarmie on 041 365 7146"]);
            }
        }
        else{
            return response()->json(["status" => "Order not completed, wrong credentials"]);
        }
    }
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), true
        );
    }

    protected function guard()
    {
        return Auth::guard();
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function username()
    {
        return 'email';
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }
//    public function placeOrder(Request $request)
//    {
//        $input = $request->all();
//        $ingr_amount = count($input['ingredients_array']);
//        $ingredients_array = $input['ingredients_array'];
//        $user = User::where('phone_number', $input['phone_number'])->first();
//        DB::beginTransaction();
//        try {
//            $input['user_id'] = $user->id;
//            $order = Order::create($input);
//            for ($x = 0; $x < $ingr_amount; $x++) {
//                $item_ingredient = new OrderIngredient;
//                $item_ingredient->ingredient_id = $ingredients_array[$x];
//                $item_ingredient->order_id = $order->id;
//                $item_ingredient->save();
//            }
//            DB::commit();
//            $ingredients = OrderIngredient::join('ingredient', 'ingredient.id', 'order_ingredients.ingredient_id')->where('order_id', $order->id)->pluck('ingredient.name');
//            event($user);
//            dispatch(new OrderPlacedJob($user, $order, $ingredients));
//            dispatch(new ZarmieOrder($user, $order, $ingredients));
//
//            return response()->json(["status" => "Order captured successfully"]);
//        } catch (\Exception $e) {
//            DB::rollback();
////            throw $e;
//            return response()->json(["status" => "An error occured " . $e]);
//        }
//
//    }
}