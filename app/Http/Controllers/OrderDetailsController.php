<?php

namespace App\Http\Controllers;

use App\Http\Resources\Order_detailsResource;
use App\Models\Order_details;
use Illuminate\Http\Request;

class OrderDetailsController extends BaseController
{

    public $paginate=10;

    public function __construct()
    {
        $this->authorizeResource(Order_details::class,'order_details');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_detailss = Order_details::paginate($this->paginate);
        return $this->sendResponse(Order_detailsResource::collection($order_detailss)->response()->getData(true),'Order_detailss sent sussesfully');
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
        return $this->sendResponse(new Order_detailsResource($order_details ),'Order_details created sussesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order_details  $order_details
     * @return \Illuminate\Http\Response
     */
    public function show(Order_details $order_details)
    {
        return $this->sendResponse(new Order_detailsResource($order_details),'Order_details shown sussesfully');
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
        $order_details->update($request->validated());
        return $this->sendResponse(new Order_detailsResource($order_details),'Order_details updated sussesfully');
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
        return $this->sendResponse(new Order_detailsResource($order_details),'Order_details deleted sussesfully');
    }
}
