<?php

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
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;


class OrderController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function getIndex()
    {
        return view('order_selection');
    }

    public function placeOrder(Request $request)
    {
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
            throw $e;
            return response()->json(["status" => "An error occured " . $e]);
        }

    }

    public function showAddressSelection($id)
    {
        $menu_item = Menu::find($id);
        $item_categories = Category::all();
        $item_sizes = Item_Size::all();
        $ingredients = $menu_item->item_ingredients;
        return view('partials.address_input', compact('ingredients'));
    }

    public function showIngredientsToppings($id)
    {
        $menu_item = Menu::find($id);
        $item_categories = Category::all();
        $item_type = Category::where('id', $menu_item->category_id)->first();
        $item_sizes = Item_Size::all();
        $ingredients = $menu_item->item_ingredients;

        $all_ingredients = Ingredient::join('ingredient_type','ingredient.ingredient_type_id','ingredient_type.id')->select('ingredient.*','ingredient_type.type_name')->get();

        $ingredients_with_id = [];
        foreach ($ingredients as $ingredient){
            foreach ($all_ingredients as $ingr) {
                if($ingredient->ingredient_id==$ingr->id){
                    array_push($ingredients_with_id,$ingr);
                }
            }
        }

        $other_ingredients = Ingredient::join('ingredient_type','ingredient.ingredient_type_id','ingredient_type.id')->select('ingredient.*','ingredient_type.type_name')->get();
        $dup_other = [];
        foreach ($ingredients_with_id as $with_id){
        foreach ($other_ingredients as $ingr) {
                if($with_id->ingredient_type_id == $ingr->ingredient_type_id && $with_id->id!=$ingr->id){
                    array_push($dup_other,$ingr);
                }
            }
        }
        $other_ingredients = $dup_other;
        $dup_other = [];
        $dup_other_ids = [];
        foreach ($other_ingredients as $ingr){
                $available = false;
                if(!in_array($ingr->id,$dup_other_ids)){
                    array_push($dup_other_ids,$ingr->id);
                    array_push($dup_other,$ingr);
                }
                else{
                    array_push($dup_other,$ingr);
                }
        }
        $other_ingredients = $dup_other;
//        dd($other_ingredients);
        return view('partials.select_ingredients_toppings', compact('ingredients','other_ingredients'));
    }

    public function showContactUsPage()
    {
        return view('contact_us');
    }

    public function getOrdersIndex()
    {
        $menu_items = DB::table('menu_item')
            ->join('item_sizes', 'item_sizes.id', 'menu_item.item_size_id')
            ->join('menu_categories', 'menu_categories.id', 'menu_item.category_id')
            ->where('prize', '>', 0)
            ->select('category_id', 'name', 'prize', 'size_name', 'item_number', 'category_name', 'item_size_id')
            ->orderBy('item_number')
            ->get();

        // dd($menu_items);
        $categories = DB::table('menu_categories')
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
                }
            }

            $resultant[$counter] = (object)$formatted_result;
            // dd($resultant[$counter]->sandwich);
            ++$counter;
        }
        $menu_items = $resultant;
        // dd($categories);
        return view('order_display', compact('menu_items', 'item_numbers', 'item_sizes', 'categories', 'toppings', 'bread'));
    }

    function gotToCompletion($id)
    {
        $menu_item = Menu::find($id);
        $item_categories = Category::all();
        $item_sizes = Item_Size::all();
        $ingredients = $menu_item->item_ingredients;
        return view('partials.order_completion', compact('ingredients'));
    }

    public function getUserByPhone($phone_number)
    {
        $user = User::where('phone_number', $phone_number)->first();
        return response()->json(["user" => $user]);
    }

    public function goToProcessOrder()
    {
        $bread = Bread::all();
        $bread = json_encode($bread);
        $menu_items = DB::table('menu_item')
            ->join('item_sizes', 'item_sizes.id', 'menu_item.item_size_id')
            ->join('menu_categories', 'menu_categories.id', 'menu_item.category_id')
            ->where('prize', '>', 0)
            ->select('category_id', 'name', 'prize', 'size_name', 'item_number', 'category_name', 'item_size_id')
            ->orderBy('item_number')
            ->get();

        // dd($menu_items);
        $categories = DB::table('menu_categories')
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
                }
            }

            $resultant[$counter] = (object)$formatted_result;
            // dd($resultant[$counter]->sandwich);
            ++$counter;
        }
        $menu_items = $resultant;
        return view('partials.order_processing', compact('bread', 'menu_items', 'item_numbers', 'item_sizes', 'categories', 'toppings', 'bread'));
    }

    public function showBread()
    {
        $bread = Bread::all();
        $bread = json_encode($bread);
        $menu_items = DB::table('menu_item')
            ->join('item_sizes', 'item_sizes.id', 'menu_item.item_size_id')
            ->join('menu_categories', 'menu_categories.id', 'menu_item.category_id')
            ->where('prize', '>', 0)
            ->select('category_id', 'name', 'prize', 'size_name', 'item_number', 'category_name', 'item_size_id', 'menu_item.id')
            ->orderBy('item_number')
            ->get();
        $menu_items_1 = $menu_items;
        // dd($menu_items);
        $categories = DB::table('menu_categories')
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
                }
            }

            $resultant[$counter] = (object)$formatted_result;
            // dd($resultant[$counter]->sandwich);
            ++$counter;
        }
        $menu_items = $resultant;
        return view('partials.bread_selection', compact('bread', 'menu_items', 'menu_items_1', 'item_numbers', 'item_sizes', 'categories', 'toppings', 'bread'));
    }

}
