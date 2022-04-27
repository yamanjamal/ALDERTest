<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Item;
use App\Models\Order;
use App\Models\Table;
use App\Services\CalculationService;

class OrderController extends BaseController
{
    // private $calcservice;

    // public function __construct()
    // {
    //     $this->calcservice = new CalculationService;
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::paginate($this->paginate);
        return $this->sendResponse(OrderResource::collection($orders)->response()->getData(true),'Orders sent sussesfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
            $table=Table::where('id',$request->table_id)->first();
            $table->update(['status'=>'in_use']);

            $total_price = Item::whereIn('id',$request->item_id)->sum('sell_price');
            // return $total_price;
            $itemscount  = Item::whereIn('id',$request->item_id)->count();

            $calcservice = new CalculationService($total_price);
            $totalaftertaxes = $calcservice->totalaftertaxes();
            // return $totalaftertaxes;
            $taxesvalue = $calcservice->taxesvalue();
            // return $taxesvalue;
            $totalcost = $calcservice->totalcost($request->discount);

            $Consumption = $calcservice->Consumption();
            $Rebuild_tax = $calcservice->Rebuild_tax();
            $Locat_administration = $calcservice->Locat_administration();
            // return $totalcost;

            $order = Order::create([
                'table_id'             => $request->table_id,
                'order_date'           => now(),
                'total_price'          => $total_price,
                'payment_state'        => $request->payment_state,
                'payment_method'       => $request->payment_method,
                'client_id'            => $request->client_id,
                'status'               => $request->status,
                'print_count'          => $itemscount,
                'customer'             => $request->customer,
                'user_id'              => 1,
                'total_cost'           => $totalcost,
                'total_after_taxes'    => $totalaftertaxes,
                'discount_amount'      => $request->discount,
                'taxes'                => $taxesvalue,
                'consumption_taxs'     => $Consumption,
                'local_adminstration'  => $Locat_administration,
                'rebuild_tax'          => $Rebuild_tax,
                'notes'                => $request->notes,
                'client_name'          => $request->client_name,
            ]);

            

            $items=Item::whereIn('id',$request->item_id)->get();
            $items->Order_details->create([
                'order_id'=>,
                'item_id',
                'total_price',
                'count',
                'is_fired',
                'status',
                'notes',
                'note_price',
                'delay',
                'cost',
            ]);



        // $order= \DB::transaction(function () use ($request) {


        // }); 

        // return $this->sendResponse(new OrderResource($order ),'Order created sussesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return $this->sendResponse(new OrderResource($order),'Order shown sussesfully');
    }

}
