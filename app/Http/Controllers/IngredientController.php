<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;
use App\IngredientType;
use DB;
use Yajra\Datatables\Facades\Datatables;

class IngredientController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }
  public function getIndex()
  {
    $item_types=IngredientType::all();
    return view('admin.ingredients',compact('item_types'));
  }

  /**
  * Process datatables ajax request.
  *
  * @return \Illuminate\Http\JsonResponse
  */
  public function showIngredients()
  {
    $ingredient=Ingredient::all();
    return Datatables::of($ingredient) ->addColumn('action', function ($ingredient) {
      $re='ingredient/'.$ingredient->id;
      $sh='ingredient/show/'.$ingredient->id;
      $del='ingredient/delete/'.$ingredient->id;
      return '<a href='.$sh.'><i class="glyphicon glyphicon-eye-open"></i></a> <a href='.$re.'><i class="glyphicon glyphicon-edit"></i></a> <a href='.$del.'><i class="glyphicon glyphicon-trash"></i></a>';
    })
    ->make(true);
  }
  public function editIngredient($id){
    $ingredient = Ingredient::find($id);
    return view('admin.ingredient_item_edit',compact('ingredient'));
  }
  public function update(Request $request,$id)
  {
    $input = $request->all();
    $ingredient = Ingredient::find($id);
    $ingredient->update($input);

    return redirect()->route('manage_ingredients');
  }
  public function destroy($id)
  {
    Ingredient::find($id)->delete();
    return redirect()->route('manage_ingredients');
  }
  public function show($id)
  {
    $ingredient_item = Ingredient::find($id);
    $item_types=IngredientType::find($id);
  return view('admin.ingredient_item_show',compact('ingredient_item','item_types'));
  }

public function saveIngredientType(Request $request){

}
  public function store(Request $request)
  {
    $ingredient_item = new Ingredient;
    $ingredient_item->name=$request->item_name;
    $ingredient_item->description=$request->item_description;
    $ingredient_item->prize=$request->item_prize;
    $ingredient_item->ingredient_type_id=$request->item_type;
    $ingredient_item->save();
      return redirect()->route('manage_ingredients');
  }

}
