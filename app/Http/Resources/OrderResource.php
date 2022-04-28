<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                  => $this->id,
            'table_id'            => $this->table_id,
            'order_date'          => $this->order_date,
            'total_price'         => number_format((double)($this->total_price), 2),
            'payment_state'       => $this->payment_state,
            'payment_method'      => $this->payment_method,
            'client_id'           => $this->client_id,
            'status'              => $this->status,
            'print_count'         => $this->print_count,
            'customer'            => $this->customer,
            'user_id'             => $this->user_id,
            'total_cost'          => number_format((double)($this->total_cost), 2),
            'total_after_taxes'   => number_format((double)($this->total_after_taxes), 2),
            'discount_amount'     => $this->discount_amount,
            'taxes'               => number_format((double)($this->taxes), 2),
            'consumption_taxs'    => number_format((double)($this->consumption_taxs), 2),
            'local_adminstration' => number_format((double)($this->local_adminstration), 2),
            'rebuild_tax'         => number_format((double)($this->rebuild_tax), 2),
            'notes'               => $this->notes,
            'client_name'         => $this->client_name,
            'order_details'       => Order_detailsResource::collection($this->whenloaded('Order_detailss')),
        ];
    }
}
