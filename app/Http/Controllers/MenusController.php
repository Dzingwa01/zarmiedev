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

    public function editMenu($id)
    {
        $menu_item = Menu::find($id);
        $item_categories = Category::all();
        $item_sizes = Item_Size::all();
        $ingredients = $menu_item->item_ingredients;
        $other_items = Menu::where('item_number', $menu_item->item_number)->get();
        return view('admin.menu_item_edit', compact('menu_item', 'item_categories', 'item_sizes', 'other_items', 'ingredients'));
    }

    public function update(Request $request, $id)
    {

        $input = $request->all();
//        dd($input);
        $menu_item = Menu::find($id);
        $menu_item->name = $input['name'];
        $menu_item->description = $input['description'];
        $menu_item->category_id = $input['item_category'];
        $menu_item->item_size_id = $input['item_size'];
        $menu_item->prize = $input['prize'];
        $menu_item->item_number = $input['item_number'];

        $menu_item->save();

        return redirect()->route('manage_menus');
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
            return redirect()->route('manage_menus')->with("status", "Menu item deleted successfully");
        } catch (\Exception $e) {
            return redirect('/menus')->with("error", "could not delete menu item, please contact system admin");
        }
    }

    public function show($id)
    {

        $menu_item = Menu::find($id);
        $categories = Category::all();
        $item_sizes = Item_Size::all();
        return view('menu_item_show', compact('menu_item', 'categories', 'item_sizes'));

    }

    public function store(Request $request)
    {
//    $input=$request->all();
        $categories = Category::all();
        $item_sizes = Item_Size::all();
        DB::beginTransaction();
        try {

            foreach ($item_sizes as $item_size) {
                if ($item_size->size_name == "Medium Sub") {
//                dd("check");
                    $input = ["name" => $request->item_name, "description" => $request->description, "category_id" => $request->category_id, "item_size_id" => $item_size->id, "prize" => $request->medium_sub, "item_number" => $request->item_number];
                    Menu::create($input);
                } else if ($item_size->size_name == "Sandwich") {
                    $input = ["name" => $request->item_name, "description" => $request->description, "category_id" => $request->category_id, "item_size_id" => $item_size->id, "prize" => $request->sandwich_prize, "item_number" => $request->item_number];
                    Menu::create($input);
                } else if ($item_size->size_name == "Large Sub") {
                    $input = ["name" => $request->item_name, "description" => $request->description, "category_id" => $request->category_id, "item_size_id" => $item_size->id, "prize" => $request->large_sub_prize, "item_number" => $request->item_number];
                    Menu::create($input);

                } else if ($item_size->size_name == "Wrap") {
                    $input = ["name" => $request->item_name, "description" => $request->description, "category_id" => $request->category_id, "item_size_id" => $item_size->id, "prize" => $request->wrap_prize, "item_number" => $request->item_number];
                    Menu::create($input);
                }
            }
            DB::commit();
            return response()->json(['menu_categories' => $categories, 'item_sizes' => $item_sizes, 'status' => "Menu Items with item number".$request->item_number."save successfully"]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['menu_categories' => $categories, 'item_sizes' => $item_sizes, 'error' => "An error occured, please contact system admin"]);
        }

    }

}
