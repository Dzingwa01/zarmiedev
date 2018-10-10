<?php

namespace App\Http\Controllers;

use App\Drink;
use App\DrinkCategory;
use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Facades\Datatables;

class DrinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = DrinkCategory::all();
        return view('drinks.drinks', compact('categories'));
    }

    public function showDrinks()
    {
        $drinks = Drink::join('drink_categories', 'drinks.category_id', 'drink_categories.id')
            ->select('drinks.*', 'drink_categories.name as category')
            ->get();

        return Datatables::of($drinks)->addColumn('action', function ($drink) {

            $sh = 'drinks/' . $drink->id . '/edit';
            $del = 'drinks/delete/' . $drink->id;
            if($drink->in_stock=="yes"){
                $re = 'drinks/' . $drink->id;
                return '<a href=' . $re . ' title="Remove from stock"><i class="glyphicon glyphicon-remove" style="color:red"></i></a> <a href=' . $sh . '><i class="glyphicon glyphicon-edit"></i></a> <a href=' . $del . '><i class="glyphicon glyphicon-trash"></i></a>';

            }else{
                $re = 'drinks-add-stock/' . $drink->id;
                return '<a href=' . $re . ' title="Add to stock"><i class="glyphicon glyphicon-plus" style="color:green"></i></a> <a href=' . $sh . '><i class="glyphicon glyphicon-edit"></i></a> <a href=' . $del . '><i class="glyphicon glyphicon-trash"></i></a>';

            }
        })
            ->make(true);
    }

    public function reAddToStock($id){
        $drink = Drink::where('id',$id)->first();
        DB::beginTransaction();
        try {
            $drink->update(["in_stock" => "yes"]);
            DB::commit();
            return redirect()->route('drinks.index')->with("status", "Drink added to stock successfully ");

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('drinks.index')->with("error", "Error occured, please contact system admin " . $e->getMessage());
        }
    }

    public function reAddToStockCategory($id){
        $drink = DrinkCategory::where('id',$id)->first();
        DB::beginTransaction();
        try {
            $drink->update(["in_stock" => "yes"]);
            DB::commit();
            return redirect()->route('show_drink_type')->with("status", "Drink Category added to stock successfully ");

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('show_drink_type')->with("error", "Error occured, please contact system admin " . $e->getMessage());
        }
    }

    public function showCategories()
    {
        return view('drinks.drink_categories');
    }

    public function showDrinksCategories()
    {
        $drinks = DrinkCategory::all();

        return Datatables::of($drinks)->addColumn('action', function ($drink) {
            $del = 'drink_categories/delete/' . $drink->id;
            $sh = 'drink_categories_edit/' . $drink->id;
                if($drink->in_stock=="yes"){
                    $re = 'drink_categories/' . $drink->id;
                    return '<a href=' . $re . '><i class="glyphicon glyphicon-remove" title="Remove from stock" style="color:red"></i></a> <a href=' . $sh . '><i class="glyphicon glyphicon-edit" title="Edit"></i></a> <a href=' . $del . ' title="Delete"><i class="glyphicon glyphicon-trash" style="color:red"></i></a>';
                }else{
                    $re = 'drink_categories_readd/' . $drink->id;
                    return '<a href=' . $re . '><i class="glyphicon glyphicon-plus" title="Re-Add to stock" style="color:green"></i></a> <a href=' . $sh . '><i class="glyphicon glyphicon-edit" title="Edit"></i></a> <a href=' . $del . ' title="Delete"><i class="glyphicon glyphicon-trash" style="color:red"></i></a>';

                }
        })
            ->make(true);
    }

    public function displayDrinksCategories($id)
    {
        $drink = DrinkCategory::where('id',$id)->first();
        DB::beginTransaction();
        try {
            $drink->update(["in_stock" => "no"]);
            DB::commit();
            return redirect()->route('show_drink_type')->with("status", "Drink Category removed from stock successfully ");

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('show_drink_type')->with("error", "Error occured, please contact system admin " . $e->getMessage());
        }
    }

    public function editDrinksCategories($id)
    {
        $drink_category = DrinkCategory::find($id);
        return view('drinks.edit_categories', compact('drink_category'));
    }

    public function deleteDrinksCategories($id)
    {
        DB::beginTransaction();
        try {
            $drink = DrinkCategory::where('id', $id)->first();
            $drinkQnty = count(Drink::where('category_id', $drink->id)->get());
            if ($drinkQnty == 0) {
                $drink->delete();
                DB::commit();
                return redirect()->route('show_drink_type')->with("status", "Drink category deleted successfully");
            } else {
                return redirect()->route('show_drink_type')->with("error", "This drink category can not be deleted");
            }

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('show_drink_type')->with("error", "Error occured, please contact system admin " . $e->getMessage());
        }
    }

    public function updateDrinkCategory(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $drink = DrinkCategory::where('id', $id)->first();
            $drink->update($request->all());
//            dd($drink);
            DB::commit();
            return redirect()->route('show_drink_type')->with("status", "Drink updated successfully");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('show_drink_type')->with("error", "Error occured, please contact system admin " . $e->getMessage());
        }
    }

    public function storeDrinkCategory(Request $request)
    {

        DB::beginTransaction();
        try {
            $drink = DrinkCategory::create($request->all());
            DB::commit();
            return redirect()->route('show_drink_type')->with("status", "Drink added successfully");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('show_drink_type')->with("error", "Error occured, please contact system admin " . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
//        dd($request->all());
        $input = $request->all();


        DB::beginTransaction();
        try {
            if (array_key_exists("picture", $input)) {
                $file = $input['picture'];
                $ext = $file->getClientOriginalExtension();
                $filename = md5(str_random(5)) . '.' . $ext;
                $name = 'image_url';
                if ($file->move('menu_images/', $filename)) {
                    $this->arr[$name] = 'menu_images/' . $filename;
                }
                $input['image_url'] = $this->arr[$name];
                Drink::create($input);
            } else {
                Drink::create($input);
            }

            DB::commit();
            return redirect()->route('drinks.index')->with('status', "Drink saved successfully");
        } catch (\Exception $e) {
            // dd($e);
            DB::rollback();
            return redirect()->route('drinks.index')->with('error', "An error occurred " . $e->getMessage());

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $drink = Drink::where('id',$id)->first();
        DB::beginTransaction();
        try {
            $drink->update(["in_stock" => "no"]);
            DB::commit();
            return redirect()->route('drinks.index')->with("status", "Drink removed from stock successfully ");

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->route('drinks.index')->with("error", "Error occured, please contact system admin " . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories = DrinkCategory::all();
        $drink = Drink::find($id);
//        dd($drink);
        return view('drinks.edit', compact('drink', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
//        dd($request->all());
        $input = $request->all();
        $drink = Drink::find($id);
        DB::beginTransaction();
        try {
            if (array_key_exists("picture", $input)) {
                $file = $input['picture'];
                $ext = $file->getClientOriginalExtension();
                $filename = md5(str_random(5)) . '.' . $ext;
                $name = 'image_url';
                if ($file->move('menu_images/', $filename)) {
                    $this->arr[$name] = 'menu_images/' . $filename;
                }

                $input['image_url'] = $this->arr[$name];
                $drink->update($input);
            } else {
                $drink->update($input);
            }

            DB::commit();
            return redirect()->route('drinks.index')->with('status', "Drink saved successfully");
        } catch (\Exception $e) {
            // dd($e);
            DB::rollback();
            return redirect()->route('drinks.index')->with('error', "An error occurred " . $e->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::beginTransaction();
        $drink = Drink::find($id);
        try {
            $drink->delete();
            DB::commit();
            return redirect()->route('drinks.index')->with("status", "Drink deleted successfully");
        } catch (\Exception $e) {
            return redirect('drinks.index')->with("error", $e);
        }
    }
}
