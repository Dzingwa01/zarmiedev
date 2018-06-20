<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;
use App\IngredientType;
use DB;
use Yajra\Datatables\Facades\Datatables;

class IngredientTypeController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }
  public function getIndex()
  {
      return view('admin.ingredient_types');
  }

  /**
  * Process datatables ajax request.
  *
  * @return \Illuminate\Http\JsonResponse
  */
  public function showIngredientTypes()
  {
    $ingredient=IngredientType::all();
    return Datatables::of($ingredient) ->addColumn('action', function ($ingredient) {
      $re='ingredient_type/'.$ingredient->id;
      $sh='ingredient_type/show/'.$ingredient->id;
      $del='ingredient_type/delete/'.$ingredient->id;
      return '<a href='.$sh.'><i class="glyphicon glyphicon-eye-open"></i></a> <a href='.$re.'><i class="glyphicon glyphicon-edit"></i></a> <a href='.$del.'><i class="glyphicon glyphicon-trash"></i></a>';
    })
    ->make(true);
  }
  public function editIngredientType($id){
    $ingredient = IngredientType::find($id);
    // dd($ingredient);
    return view('admin.ingredient_item_type_edit',compact('ingredient'));
  }
  public function update(Request $request,$id)
  {
    $input = $request->all();
    $ingredient = IngredientType::find($id);
    $ingredient->update($input);

    return redirect()->route('ingredient_type_home');
  }
  public function destroy($id)
  {
    IngredientType::find($id)->delete();
    return redirect()->route('ingredient_type_home');
  }
  public function show($id)
  {
    $ingredient_item = IngredientType::find($id);

  return view('admin.ingredient_item_type_show',compact('ingredient_item'));
  }

  public function store(Request $request)
  {
    $ingredient_item = new IngredientType;
    $ingredient_item->type_name=$request->item_name;
    $ingredient_item->description=$request->item_description;
    $ingredient_item->save();
      return redirect()->route('ingredient_type_home');
  }

}
