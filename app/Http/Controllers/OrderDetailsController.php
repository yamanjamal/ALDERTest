<?php

namespace App\Http\Controllers;

use App\Models\Order_details;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_detailss = Order_details::all();
        return view('Order_details.index',compact('order_detailss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Order_details.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order_details = Order_details::create($request->validated());
        return redirect()->route('Order_details.index')->with('success','Order_details created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order_details  $order_details
     * @return \Illuminate\Http\Response
     */
    public function show(Order_details $order_details)
    {
        return view('Order_details.show',compact('order_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order_details  $order_details
     * @return \Illuminate\Http\Response
     */
    public function edit(Order_details $order_details)
    {
        return view('Order_details.edit',compact('order_details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order_details  $order_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order_details $order_details)
    {
        $snack->update($request->validated());
        return redirect()->back()->with('success','Order_details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order_details  $order_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order_details $order_details)
    {
        $order_details->delete();
        return redirect()->route('Order_details.index')->with('success','Order_details deleted successfully'); 
    }
}
