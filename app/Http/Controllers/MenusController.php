<?php

namespace App\Http\Controllers;

use App\Ingredient;
use Illuminate\Http\Request;
use App\Menu;
use App\Category;
use App\Item_Size;
use App\ItemIngredient;
use DB;
use Yajra\Datatables\Facades\Datatables;

class MenusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
//         dd(Item_Size::all());
        $categories = Category::all();
        $item_sizes = Item_Size::all();
        return view('admin.menus')->with('menu_categories', $categories)->with('item_sizes', $item_sizes);
    }
    public function getCategoriesIndex(){
        return view('admin.menu_category');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showMenus()
    {

        $menu = Menu::join('menu_categories', 'menu_categories.id', 'menu_item.category_id')
            ->join('item_sizes', 'item_sizes.id', 'menu_item.item_size_id')
            ->select('menu_item.id', 'category_name', 'name', 'menu_item.description', 'menu_item.created_at', 'size_name', 'prize', 'item_number')
            ->get();

        return Datatables::of($menu)->addColumn('action', function ($menu) {
            $re = 'menu/' . $menu->id;
            $sh = 'menu/show/' . $menu->id;
            $del = 'menu/delete/' . $menu->id;
            return '<a href=' . $sh . '><i class="glyphicon glyphicon-eye-open"></i></a> <a href=' . $re . '><i class="glyphicon glyphicon-edit"></i></a> <a href=' . $del . '><i class="glyphicon glyphicon-trash"></i></a>';
        })
            ->make(true);
    }

    public function saveCategory(Request $request){

        $input = $request->all();
        $file = $input['category_image'];
        $ext  = $file->getClientOriginalExtension();
        $filename = md5(str_random(5)).'.'.$ext;
        $name = 'picture_url';
        if($file->move('menu_images/',$filename)){
            $this->arr[$name] = 'menu_images/'.$filename;
        }

        DB::beginTransaction();
        try{
            $category=new Category;
            $category->category_name = $input['category_name'];
            $category->description = $input['category_description'];
            $category->picture_url = $this->arr[$name];
            $category->save();
            DB::commit();
            return redirect()->route('manage_category_menus')->with('status', "Menu Category saved successfully" );
        }
        catch(\Exception $e){
            // dd($e);
            DB::rollback();
            return  redirect()->route('manage_category_menus')->with('error', "Menu Category could not be saved ");

        }


    }

public function showMenuCategories(){
    $menu = Category::all();
    return Datatables::of($menu)->addColumn('action', function ($menu) {
        $re = 'menu_category/' . $menu->id;
        $sh = 'menu_category/show/' . $menu->id;
        $del = 'menu_category/delete/' . $menu->id;
        return '<a href=' . $sh . '><i class="glyphicon glyphicon-eye-open"></i></a> <a href=' . $re . '><i class="glyphicon glyphicon-edit"></i></a> <a href=' . $del . '><i class="glyphicon glyphicon-trash"></i></a>';
    })
        ->make(true);
}
    public function editMenu($id)
    {
        $menu_item = Menu::find($id);
//        dd($menu_item);
        $item_categories = Category::all();
        $item_sizes = Item_Size::all();
        $ingredients = $menu_item->item_ingredients;
        $other_items = Menu::where('item_number', $menu_item->item_number)->get();
        return view('admin.menu_item_edit', compact('menu_item', 'item_categories', 'item_sizes', 'other_items', 'ingredients'));
    }

    public function update(Request $request, $id)
    {

        $input = $request->all();
        $ingr_amount = count($input['ingredients_array']);
        $ingredients_array = $input['ingredients_array'];

        $categories = Category::all();
        $item_sizes = Item_Size::all();
        DB::beginTransaction();
        try {
            $menu_item = Menu::find($id);
            $menu_item_1 = Menu::where('item_size_id', 1)
            ->where('item_number', $menu_item->item_number)
                ->first();

            $menu_item_2 = Menu::where('item_size_id', 2)
                ->where('item_number', $menu_item->item_number)
                ->first();
            $menu_item_3 = Menu::where('item_size_id', 3)
                ->where('item_number', $menu_item->item_number)
                ->first();
            $menu_item_4 = Menu::where('item_size_id', 4)
                ->where('item_number', $menu_item->item_number)
                ->first();

            foreach ($item_sizes as $item_size) {
                if ($item_size->size_name == "Medium Sub") {
//                dd("check");
                    $input = ["name" => $request->item_name, "description" => $request->description, "category_id" => $request->category_id, "item_size_id" => $item_size->id, "prize" => $request->medium_sub_prize, "item_number" => $request->item_number];
                    $menu_item_2->update($input);
                } else if ($item_size->size_name == "Sandwich") {
                    $input = ["name" => $request->item_name, "description" => $request->description, "category_id" => $request->category_id, "item_size_id" => $item_size->id, "prize" => $request->sandwich_prize, "item_number" => $request->item_number];
                    $menu_item_1->update($input);
                } else if ($item_size->size_name == "Large Sub") {
                    $input = ["name" => $request->item_name, "description" => $request->description, "category_id" => $request->category_id, "item_size_id" => $item_size->id, "prize" => $request->large_sub_prize, "item_number" => $request->item_number];
                    $menu_item_3->update($input);

                } else if ($item_size->size_name == "Wrap") {
                    $input = ["name" => $request->item_name, "description" => $request->description, "category_id" => $request->category_id, "item_size_id" => $item_size->id, "prize" => $request->wrap_prize, "item_number" => $request->item_number];
                    $menu_item_4->update($input);
                }

            }



            $item_ingredient = ItemIngredient::where('item_id', $menu_item_1->id)->get();
            if (count($item_ingredient) == 0) {
                for ($x = 0; $x < $ingr_amount; $x++) {
                    $item_ingredient = new ItemIngredient;
                    $item_ingredient->ingredient_id = $ingredients_array[$x];
                    $item_ingredient->item_id = $id;
                    $item_ingredient->save();
                }
                DB::commit();
                return response()->json(['menu_categories' => $categories, 'item_sizes' => $item_sizes, 'status' => "Menu Items with item number " . $request->item_number . " save successfully"]);

            } else {
                $deleted_rows_1 = ItemIngredient::where('item_id', $menu_item_1->id)->delete();
//                dd($deleted_rows_1);
                for ($x = 0; $x < $ingr_amount; $x++) {
                    $item_ingredient = new ItemIngredient;
                    $item_ingredient->ingredient_id = $ingredients_array[$x];
                    $item_ingredient->item_id = $menu_item_1->id;
                    $item_ingredient->save();
                }
                $deleted_rows_2 = ItemIngredient::where('item_id', $menu_item_2->id)->delete();
                for ($x = 0; $x < $ingr_amount; $x++) {

                    $item_ingredient = new ItemIngredient;
                    $item_ingredient->ingredient_id = $ingredients_array[$x];
                    $item_ingredient->item_id = $menu_item_2->id;
                    $item_ingredient->save();
                }
                $deleted_rows_3 = ItemIngredient::where('item_id', $menu_item_3->id)->delete();
                for ($x = 0; $x < $ingr_amount; $x++) {
                    $item_ingredient = new ItemIngredient;
                    $item_ingredient->ingredient_id = $ingredients_array[$x];
                    $item_ingredient->item_id = $menu_item_3->id;
                    $item_ingredient->save();
                }
                $deleted_rows_4 = ItemIngredient::where('item_id', $menu_item_4->id)->delete();
                for ($x = 0; $x < $ingr_amount; $x++) {

                    $item_ingredient = new ItemIngredient;
                    $item_ingredient->ingredient_id = $ingredients_array[$x];
                    $item_ingredient->item_id = $menu_item_4->id;
                    $item_ingredient->save();
                }
                DB::commit();
                return response()->json(['menu_categories' => $categories, 'item_sizes' => $item_sizes, 'status' => "Menu Items with item number " . $request->item_number . " saved successfully"]);
            }
        }
        catch
            (\Exception $e) {
                DB::rollback();
                return response()->json(['menu_categories' => $categories, 'item_sizes' => $item_sizes, 'error' => $e->getMessage()]);
            }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        $menu = Menu::find($id);
        $menus = Menu::where('item_number', $menu->item_number)->get();
        try {
            foreach ($menus as $mn) {
                $mn->delete();
            }
            DB::commit();
            return redirect()->route('manage_menus')->with("status", "Menu category deleted successfully");
        } catch (\Exception $e) {
            return redirect('/manage_menus')->with("error", "could not delete menu category, please contact system admin");
        }
    }

    public function destroyMenuCategory($id){
        DB::beginTransaction();
        $menu = Category::find($id);
        try {
            $menu->delete();
            DB::commit();
            return redirect()->route('/menu_categories')->with("status", "Menu item deleted successfully");
        } catch (\Exception $e) {
            return redirect('/menu_categories')->with("error", $e);
        }
    }

    public function show($id)
    {
        $menu_item = Menu::find($id);

        $categories = Category::all();
        $item_sizes = Item_Size::all();
        $item_ingredients = $menu_item->item_ingredients;
        $ingredients = Ingredient::all();
//        $item_ingredients = ItemIngredient::join('ingredient','item_ingredient.ingredient_id','ingredient.ingredient_type_id')->where('item_ingredient.item_id',$menu_item->id)->select('item_ingredient.*','ingredient.name')->get();
        $other_items = Menu::where('item_number', $menu_item->item_number)->get();
//        dd($item_ingredients);
        return view('admin.menu_item_show', compact('menu_item', 'categories', 'item_sizes','item_ingredients','other_items','ingredients'));

    }

    public function showMenuCategory($id){
        $categories = Category::find($id);
        return view('admin.menu_item_category_show', compact('categories'));
    }

    public function editMenuCategory($id){
        $categories = Category::find($id);
        return view('admin.menu_item_category_edit', compact('categories'));
    }

    public function store(Request $request)
    {
    $input_temp=$request->all();
        $ingr_amount = count($input_temp['ingredients_array']);
        $ingredients_array = $input_temp['ingredients_array'];
        $categories = Category::all();
        $item_sizes = Item_Size::all();
        $menu_item_1 = null;
        $menu_item_2 = null;
        $menu_item_3 = null;
        $menu_item_4 = null;
        DB::beginTransaction();
        try {

            foreach ($item_sizes as $item_size) {
                if ($item_size->size_name == "Medium Sub") {
//                dd("check");
                    $input = ["name" => $request->item_name, "description" => $request->description, "category_id" => $request->category_id, "item_size_id" => $item_size->id, "prize" => $request->medium_sub, "item_number" => $request->item_number];
                    $menu_item_2 = Menu::create($input);
                } else if ($item_size->size_name == "Sandwich") {
                    $input = ["name" => $request->item_name, "description" => $request->description, "category_id" => $request->category_id, "item_size_id" => $item_size->id, "prize" => $request->sandwich_prize, "item_number" => $request->item_number];
                    $menu_item_1 =  Menu::create($input);
                } else if ($item_size->size_name == "Large Sub") {
                    $input = ["name" => $request->item_name, "description" => $request->description, "category_id" => $request->category_id, "item_size_id" => $item_size->id, "prize" => $request->large_sub_prize, "item_number" => $request->item_number];
                    $menu_item_3 =  Menu::create($input);

                } else if ($item_size->size_name == "Wrap") {
                    $input = ["name" => $request->item_name, "description" => $request->description, "category_id" => $request->category_id, "item_size_id" => $item_size->id, "prize" => $request->wrap_prize, "item_number" => $request->item_number];
                    $menu_item_4 = Menu::create($input);
                }
            }
            for ($x = 0; $x < $ingr_amount; $x++) {
                $item_ingredient = new ItemIngredient;
                $item_ingredient->ingredient_id = $ingredients_array[$x];
                $item_ingredient->item_id = $menu_item_1->id;
                $item_ingredient->save();
            }

            for ($x = 0; $x < $ingr_amount; $x++) {

                $item_ingredient = new ItemIngredient;
                $item_ingredient->ingredient_id = $ingredients_array[$x];
                $item_ingredient->item_id = $menu_item_2->id;
                $item_ingredient->save();
            }

            for ($x = 0; $x < $ingr_amount; $x++) {
                $item_ingredient = new ItemIngredient;
                $item_ingredient->ingredient_id = $ingredients_array[$x];
                $item_ingredient->item_id = $menu_item_3->id;
                $item_ingredient->save();
            }

            for ($x = 0; $x < $ingr_amount; $x++) {
                $item_ingredient = new ItemIngredient;
                $item_ingredient->ingredient_id = $ingredients_array[$x];
                $item_ingredient->item_id = $menu_item_4->id;
                $item_ingredient->save();
            }

            DB::commit();
            return response()->json(['menu_categories' => $categories, 'item_sizes' => $item_sizes, 'status' => "Menu Items with item number " . $request->item_number . " saved successfully"]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['menu_categories' => $categories, 'item_sizes' => $item_sizes, 'error' => "An error occured, please contact system admin"]);
        }

    }

}
