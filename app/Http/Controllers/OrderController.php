<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::all();
        if (sizeof($orders)==0) return response()->json(['message'=>'Not found'],404);
        return $orders;
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

        $order = Order::create(['id'=>$request->input('id'),'status'=>$request->input('status'), 'name'=>$request->input('name'), 'phone'=>$request->input('phone')]);
        $orderProductIDs = explode(',',$request->input('products'));
        foreach ($orderProductIDs as $orderProductID) {
            $order->products()->attach($orderProductID);
        }
        return response()->json(['order'=>$order, 'Ordered Products'=>$order->products()->get()],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $order = Order::findOrFail($id);
        return  response()->json($order,201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //
        $order = Order::findOrFail($id);
        $order->products()->detach();
        $order->name = $request->input('name');
        $order->phone = $request->input('phone');
        $orderProductIDs = explode(',',$request->input('products'));
        foreach ($orderProductIDs as $orderProductID) {
            $order->products()->attach($orderProductID);
        }
        $order->save();
        return response()->json(['order'=>$order, 'Ordered Products'=>$order->products()->get()],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $order = Order::findOrFail($id);
        $order->products()->detach();
        $order->delete();
        return  response()->json(null, 201);
    }
}
