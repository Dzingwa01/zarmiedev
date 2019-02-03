<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderStatus;
use Illuminate\Http\Request;
use DB;

class OrdersApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getCurrentOrders(){
        $cur_date = date('Y-m-d H:i:s');
        $orders = Order::with('user','order_ingredients','toppings','drinks')
                    ->whereDate('created_at',$cur_date)->get();

        return response()->json(['orders'=>$orders,"current_date"=>$cur_date]);
    }

    public function getAllOrders(){
        $orders = Order::whereHas('user',function($query){
            $query->whereNotNull('id');
            return $query;
            })->doesntHave('status')
            ->with('order_ingredients','order_ingredients.ingredient','toppings','drinks','user')
            ->orderBy('created_at','desc')
            ->get();
        return response()->json(['orders'=>$orders]);
    }

    public function getAcceptedOrders(){
        $orders = Order::whereHas('user',function($query){
            $query->whereNotNull('id');
            return $query;
        })->whereHas('status',function($query){
            $query->where('status','accepted');
            return $query;
        })
            ->with('order_ingredients','order_ingredients.ingredient','toppings','drinks','user')
            ->orderBy('created_at','desc')
            ->get();
        return response()->json(['orders'=>$orders]);
    }

    public function declinedOrders(){
        $orders = Order::whereHas('user',function($query){
            $query->whereNotNull('id');
            return $query;
        })->whereHas('status',function($query){
            $query->where('status','declined');
            return $query;
        })
            ->with('order_ingredients','order_ingredients.ingredient','toppings','drinks','user')
            ->orderBy('created_at','desc')
            ->get();
        return response()->json(['orders'=>$orders]);
    }

    public  function acceptOrder(Order $order){

        DB::beginTransaction();
        try{
            $order_status = OrderStatus::create(['order_id'=>$order->id,'status'=>'accepted']);
            DB::commit();

            return response()->json(['message'=>'Order Accepted successfully','order'=>$order],200);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['message'=>'An error occured while accepting order, please contact your IT admin '.$e->getMessage(),'order'=>$order],200);
        }
    }

    public  function declineOrder(Order $order){

        DB::beginTransaction();
        try{
            $order_status = OrderStatus::create(['order_id'=>$order->id,'status'=>'declined']);
            DB::commit();

            return response()->json(['message'=>'Order declined successfully','order'=>$order],200);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['message'=>'An error occured while accepting order, please contact your IT admin '.$e->getMessage(),'order'=>$order],200);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
