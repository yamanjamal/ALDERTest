<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Item;
use App\Models\Order;
use App\Models\Order_details;
use App\Models\Table;
use App\Services\CalculationService;

class OrderController extends BaseController
{

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

         // $request->items;
         // return $arr = JSON::parse();
         $toJSON = json_encode($request->items);
         return $toJSON->take('id');
        // 
        $order= \DB::transaction(function () use ($request) {
        
            $table=Table::where('id',$request->table_id)->first();
            $table->update(['status'=>'in_use']);
           return $a= $request->items->array_column('id');
            // return $items=Item::whereIn('id',$request->item_id[0]['id'])->get();
            // return $itemscount  = count($items);


            // $order = Order::create([
            //     'table_id'             => $request->table_id,
            //     'order_date'           => now(),
            //     'payment_method'       => $request->payment_method,
            //     'client_id'            => $request->client_id,
            //     'status'               => $request->status,
            //     'print_count'          => $itemscount,
            //     'customer'             => $request->customer,
            //     'user_id'              => 1,
            //     'discount_amount'      => $request->discount,
            //     'notes'                => $request->notes,
            //     'client_name'          => $request->client_name,
            // ]);


            // return $request->items[0]['id'];
            // foreach ($items as $item key $i) {
            //     for ($i=0; $i <$itemscount ; $i++) { 

            //         $order_details = Order_details::create([
            //             'order_id'      =>$order->id,
            //             'item_id'       =>$request->items[$i]['id'],
            //             'total_price'   =>$item->sell_price * $request->items[$i]['count'],
            //             'count'         =>$request->items[$i]['count'],
            //             'is_fired'      =>$request->is_fired,
            //             'status'        =>$order->status,
            //             'notes'         =>$order->notes,
            //             'cost'          =>$item->sell_price,
            //         ]);
            //     }

            // }


            // $ordertotal_price=Order_details::where('order_id',$order->id)->sum('total_price');
            // $itemscount  = $items->count();

            // $calcservice = new CalculationService($ordertotal_price);
            // $totalcost            = $calcservice->totalcost($request->discount);
            // $totalaftertaxes      = $calcservice->totalaftertaxes();
            // $taxesvalue           = $calcservice->taxesvalue();
            // $Consumption          = $calcservice->Consumption();
            // $Locat_administration = $calcservice->Locat_administration();
            // $Rebuild_tax          = $calcservice->Rebuild_tax();


            //  $order->update([
            //     'total_price'          => $ordertotal_price,
            //     'total_cost'           => $totalcost,
            //     'total_after_taxes'    => $totalaftertaxes,
            //     'taxes'                => $taxesvalue,
            //     'consumption_taxs'     => $Consumption,
            //     'local_adminstration'  => $Locat_administration,
            //     'rebuild_tax'          => $Rebuild_tax,
            // ]);




        }); 

        // return $this->sendResponse(new OrderResource($order),'Order created sussesfully');
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
