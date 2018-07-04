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

//            DB::commit();
            $role = Role::where('name','client')->first();
            $user->attachRole($role);
            event($user);
            dispatch(new SendVerificationEmail($user));
            $input = $data;
            $ingr_amount = count($input['ingredients_array']);
            $ingredients_array = $input['ingredients_array'];
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

            return response()->json(["status" => "Account creation successfully, and your order was captured successfully. Please verify your account"]);
        }
        catch (\Exception $e){
            DB::rollback();
            return response()->json(["status" => "An error occured, please contact zarmie on 041 365 7146".$e->getMessage()]);
        }
//        return response()->view('status.status_message',$user,200);
    }
}