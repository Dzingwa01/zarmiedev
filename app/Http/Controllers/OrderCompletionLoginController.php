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
use App\OrderIngredient;
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
    public function placeOrder(Request $request)
    {
//        dd($request->all());
//        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
//            return $this->sendLoginResponse($request);
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