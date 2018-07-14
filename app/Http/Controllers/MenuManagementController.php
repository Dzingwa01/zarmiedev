<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;
use App\IngredientType;
use DB;
use Yajra\Datatables\Facades\Datatables;
use App\Menu;

class MenuManagementController extends Controller
{
  public function __construct(){
    // $this->middleware('auth');
  }
  public function getIndex()
  {

    $menu_items = DB::table('menu_item')
                  ->join('item_sizes','item_sizes.id','menu_item.item_size_id')
                  ->join('menu_categories','menu_categories.id','menu_item.category_id')
                  ->where('prize','>',0)
                  ->select('menu_item.id','category_id','name','prize','size_name','item_number','category_name','item_size_id','menu_item.description','menu_item.image_url')
                  ->orderBy('item_number')
                  ->get();

    // dd($menu_items);
    $categories = DB::table('menu_categories')
                  ->orderBy('id')
                  ->get();
    $item_numbers = array();
    $counter = 0;
    foreach ($menu_items as $key => $item) {
      // dd($item);
      if(!in_array($item->item_number, $item_numbers)){
        $temp = array();
        $id = $item->name;
        $item_numbers[$id] = $item->item_number;
      }
    }
    // dd($item_numbers);
    $item_sizes = DB::table('item_sizes')
                  ->get();
    $resultant =array();
    $counter = 0;
    foreach ($item_numbers as $key => $number) {
      $formatted_result = array();
      $formatted_result['item_number'] = $number;
      foreach ($menu_items as $key => $item) {
        if($item->item_number == $number){
          $new_var = $item->size_name;
          $new_var = preg_replace('/\s+/', '', $new_var);
          $formatted_result[$new_var] = $item->prize;
          $formatted_result['item_name'] = $item->name;
          $formatted_result['item_category'] = $item->category_id;
          $formatted_result['item_id'] = $item->id;
            $formatted_result['item_description'] = $item->description;
            $formatted_result['item_image'] = $item->image_url;
        }
      }
      $resultant[$counter] =(object)$formatted_result;
      ++$counter;
    }
    $menu_items = json_encode($resultant);
    return view('menu_display',compact('menu_items','item_numbers','item_sizes','categories'));
  }



}
