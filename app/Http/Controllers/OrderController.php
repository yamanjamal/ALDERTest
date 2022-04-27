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

            \DB::beginTransaction();

            try {
                $table=Table::where('id',$request->table_id)->first();
                $table->update(['status'=>'in_use']);
                
                
                $items=Item::whereIn('id',array_column($request->items,'id'))->get();
                $itemscount  = count(array_column($request->items,'id'));

                
                $order = Order::create([
                    'table_id'             => $request->table_id,
                    'order_date'           => now(),
                    'payment_method'       => $request->payment_method,
                    'client_id'            => $request->client_id,
                    'status'               => 'pending',
                    'print_count'          => $itemscount,
                    'customer'             => $request->customer,
                    'user_id'              => 18,
                    'discount_amount'      => $request->discount,
                    'notes'                => $request->notes,
                    'client_name'          => $request->client_name,
                ]);

                $i=0;

                foreach ($items as $item) {
                    $order_details = Order_details::create([
                        'order_id'      => $order->id,
                        'item_id'       => $request->items[$i]['id'],
                        'total_price'   => $item->sell_price * $request->items[$i]['count'],
                        'count'         => $request->items[$i]['count'],
                        'is_fired'      => $request->is_fired,
                        'status'        => 'pending',
                        'notes'         => $order->notes,
                        'cost'          => $item->sell_price,
                    ]);
                    $i++;
                }
                $i=0;



                $ordertotal_price=Order_details::where('order_id',$order->id)->sum('total_price');
                $itemscount  = $items->count();

                $calcservice = new CalculationService($ordertotal_price);
                $totalcost            = $calcservice->totalcost($request->discount);
                $totalaftertaxes      = $calcservice->totalaftertaxes();
                $taxesvalue           = $calcservice->taxesvalue();
                $Consumption          = $calcservice->Consumption();
                $Locat_administration = $calcservice->Locat_administration();
                $Rebuild_tax          = $calcservice->Rebuild_tax();


                 $order->update([
                    'total_price'          => $ordertotal_price,
                    'total_cost'           => $totalcost,
                    'total_after_taxes'    => $totalaftertaxes,
                    'taxes'                => $taxesvalue,
                    'consumption_taxs'     => $Consumption,
                    'local_adminstration'  => $Locat_administration,
                    'rebuild_tax'          => $Rebuild_tax,
                ]);

                \DB::commit();
                // all good
            } catch (\Exception $e) {
                \DB::rollback();
                // something went wrong
            }
            

        return $this->sendResponse(new OrderResource($order),'Order created sussesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return $this->sendResponse(new OrderResource($order->load('Order_detailss')),'Order created sussesfully');
    }

}
