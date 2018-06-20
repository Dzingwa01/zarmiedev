<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Facades\Datatables;

class UploadsController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }
  public function getIndex()
  {
      return view('admin.upload_file');
  }

}
