<?php
/**
 * Created by PhpStorm.
 * User: DEV
 * Date: 2018-07-25
 * Time: 07:54 AM
 */

namespace App\Http\Controllers;
use App\Drink;
use App\Ingredient;
use App\Jobs\OrderPlacedJob;
use App\Jobs\ZarmieOrder;
use App\Order;
use App\OrderHistory;
use App\OrderIngredient;
use App\User;
use Illuminate\Http\Request;
use App\Bread;
use App\Topping;
use DB;
use App\Menu;
use App\Category;
use App\Item_Size;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;
use App\OrderDrinks;

use App\OrderToppings;

class ClientOrderController
{

    public function getOrdersIndex()
    {
        $menu_items = DB::table('menu_item')
            ->join('item_sizes', 'item_sizes.id', 'menu_item.item_size_id')
            ->join('menu_categories', 'menu_categories.id', 'menu_item.category_id')
            ->where('prize', '>', 0)
            ->select('menu_item.id','category_id', 'name', 'prize', 'size_name', 'item_number', 'category_name', 'item_size_id','menu_item.description','menu_item.image_url')
           ->orderBy('menu_item.category_id','asc')->get();
        $menu_items_1 = $menu_items;
//         dd($menu_items);
        $categories = DB::table('menu_categories')
            ->where('id','!=',8)
            ->orderBy('id')
            ->get();
        $toppings = Topping::all();
        $toppings = json_encode($toppings);
        $bread = Bread::all();
        $bread = json_encode($bread);
        // dd($bread);
        $item_numbers = array();
        $counter = 0;
        foreach ($menu_items as $key => $item) {
            // dd($item);
            if (!in_array($item->item_number, $item_numbers)) {
                $temp = array();
                $id = $item->name;
                $item_numbers[$id] = $item->item_number;
            }
        }
        // dd($item_numbers);
        $item_sizes = DB::table('item_sizes')
            ->get();
        // dd($item_sizes);
        $resultant = array();
        $counter = 0;
        foreach ($item_numbers as $key => $number) {
            $formatted_result = array();
            $formatted_result['item_number'] = $number;
            foreach ($menu_items as $key => $item) {
                if ($item->item_number == $number) {
                    $new_var = $item->size_name;
                    $new_var = preg_replace('/\s+/', '', $new_var);
                    if ($new_var == 'Sandwich') {
                        $formatted_result['sandwich'] = $item->prize;
                    } else if ($new_var == 'MediumSub') {
                        $formatted_result['mediumsub'] = $item->prize;
                    } else if ($new_var == 'LargeSub') {
                        $formatted_result['largesub'] = $item->prize;
                    } else if ($new_var == 'Wrap') {
                        $formatted_result['wrap'] = $item->prize;
                    }
                    $formatted_result['item_name'] = $item->name;
                    $formatted_result['item_category'] = $item->category_id;
                    $formatted_result['item_id'] = $item->id;
                    $formatted_result['item_description'] = $item->description;
                    $formatted_result['item_image'] = $item->image_url;
                }
            }

            $resultant[$counter] = (object)$formatted_result;
            // dd($resultant[$counter]->sandwich);
            ++$counter;
        }
        $menu_items = $resultant;
        // dd($categories);
        return view('clients.order_display', compact('menu_items', 'item_numbers', 'item_sizes', 'categories', 'toppings', 'bread','menu_items_1'));
    }
    public function showHistory(){
        $previous_orders = OrderHistory::where('user_id',Auth::user()->id)->get();
//        dd($previous_orders);
        return view('clients.previous_orders',compact('previous_orders'));
    }

    public function repeatOrder($id){
        $previous_orders = OrderHistory::where('id',$id)->first();

        $user = Auth::user();
        $orders = $previous_orders;
//        dd($orders);
        $extra_info = new \stdClass();
        $extra_info->total_cost = $orders->total_cost;
        $extra_info->phone_number = $user->phone_number;
        $extra_info->address = $orders->address;
        $extra_info->delivery_or_collection = $orders->delivery_or_collect;

        $extra_info->delivery_time =  $orders->delivery_collect_time;
        $extra_info->instructions =  $orders->special_instructions;

        DB::beginTransaction();

        try {
//            $history = OrderHistory::create(["order_information"=>$orders,"user_id"=>$user->id]);
//            $history->save();
//            dd($orders->order_information);
            foreach ($orders->order_information as $order) {
                $item_name = $order['item_name'];
                $item_category = $order['item_category'];
                $bread_type = $order['bread_type'];
                $toast_type = $order['toast_type'];
                $quantity = $order['quantity'];
                $prize = $order['prize'];
                $order_input = ["address"=>$extra_info->address,"prize"=>$prize,"item_name" => $item_name, "phone_number" => $user->phone_number, "item_category" => $item_category, "bread_type" => $bread_type, "toast_type" => $toast_type, "quantity" => $quantity, "user_id" => $user->id];

                $order_cur = Order::create($order_input);
                foreach ($order['ingredients'] as $ingredient){
//                    dd($ingredient);
                    $item_ingredient = new OrderIngredient;
                    $item_ingredient->ingredient_id = $ingredient['id'];
                    $item_ingredient->order_id = $order_cur->id;
                    $item_ingredient->name = $ingredient['name'];
                    $item_ingredient->save();
                }
                foreach ($order['toppings'] as $topping){
                    $item_ingredient = new OrderToppings();
                    $item_ingredient->topping_id = $topping['id'];
                    $item_ingredient->order_id = $order_cur->id;
                    $item_ingredient->name = $topping['name'];
                    $item_ingredient->save();
                }
                foreach ($order['drinks'] as $drink){
                    $item_ingredient = new OrderDrinks();
                    $item_ingredient->drink_id = $drink['id'];
                    $item_ingredient->order_id = $order_cur->id;
                    $item_ingredient->name = $drink['name'];
                    $item_ingredient->save();
                }
                DB::commit();

            }
            event($user);
           $decoded = json_decode(json_encode($orders->order_information));

            dispatch(new OrderPlacedJob($user, $decoded,$extra_info));
            dispatch(new ZarmieOrder($user, $decoded,$extra_info));
            return redirect('/home')->with("status", "Order submitted successfully, Thank you");

        }
        catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return response()->json(["status" => "An error occured, please contact zarmie on 041 365 7146"]);
        }
    }
}