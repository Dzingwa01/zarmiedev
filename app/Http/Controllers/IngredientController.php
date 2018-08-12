<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;
use App\IngredientType;
use DB;
use Yajra\Datatables\Facades\Datatables;

class IngredientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $item_types = IngredientType::all();
        return view('admin.ingredients', compact('item_types'));
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showIngredients()
    {
        $ingredient = Ingredient::join("ingredient_type", "ingredient_type.id", "ingredient_type_id")
            ->select("ingredient.*", "ingredient_type.type_name")->get();

        return Datatables::of($ingredient)->addColumn('action', function ($ingredient) {
            $re = 'ingredient/' . $ingredient->id;
            $sh = 'ingredient/show/' . $ingredient->id;
            $del = 'ingredient/delete/' . $ingredient->id;
            return '<a href=' . $sh . '><i class="glyphicon glyphicon-eye-open"></i></a> <a href=' . $re . '><i class="glyphicon glyphicon-edit"></i></a>';
        })
            ->make(true);
    }

    public function getIngredients()
    {
        $ingredients = Ingredient::orderBy('name', 'asc')->get();
        return response()->json(["ingredients" => $ingredients]);
    }

    public function editIngredient($id)
    {
        $ingredient = Ingredient::find($id);
        $item_types = IngredientType::all();

        return view('admin.ingredient_item_edit', compact('ingredient', 'item_types'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $ingredient = Ingredient::find($id);
        $ingredient->update($input);
        $ingredient->save();

        return redirect()->route('manage_ingredients');
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Ingredient::find($id)->delete();
            DB::commit();
            return redirect()->route('manage_ingredients')->with("status", "Ingredient deleted successfully");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('manage_ingredients')->with("error", "Error occured, please contact system admin " . $e->getMessage());
        }
    }

    public function show($id)
    {
        $ingredient_item = Ingredient::find($id);
//      dd($ingredient_item);
        $item_types = IngredientType::where('id', $ingredient_item->ingredient_type_id)->first();
//      dd($item_types);
        return view('admin.ingredient_item_show', compact('ingredient_item', 'item_types'));
    }

    public function saveIngredientType(Request $request)
    {

    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $ingredient_item = new Ingredient;
            $ingredient_item->name = $request->item_name;
            $ingredient_item->description = $request->item_description;
            $ingredient_item->prize = $request->item_prize;
            $ingredient_item->medium_prize = $request->item_prize;
            $ingredient_item->large_prize = $request->item_prize;
            $ingredient_item->wrap_prize = $request->item_prize;
            $ingredient_item->ingredient_type_id = $request->item_type;
            $ingredient_item->save();
            DB::commit();
            return redirect()->route('manage_ingredients')->with("status", "Ingredient addedd successfully");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('manage_ingredients')->with("error", "Error occured, please contact system admin " . $e->getMessage());
        }
    }

}
