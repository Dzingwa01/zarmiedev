<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AdminController extends Controller
{
  public function __construct(){
   $this->middleware('auth');
}

public function index(){
  return view('admin.admin_home');
}

public function menus(){
  $categories=DB::table('menu_categories')->get();
  $item_sizes=DB::table('item_sizes')->get();
  return view('admin.menus')->with('menu_categories',$categories)->with('item_sizes',$item_sizes);
}
}
