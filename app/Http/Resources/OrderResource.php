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
            'total_price'         => $this->total_price,
            'payment_state'       => $this->payment_state,
            'payment_method'      => $this->payment_method,
            'client_id'           => $this->client_id,
            'status'              => $this->status,
            'print_count'         => $this->print_count,
            'customer'            => $this->customer,
            'user_id'             => new UserResource($this->whenloaded('User')),
            'total_cost'          => $this->total_cost,
            'total_after_taxes'   => $this->total_after_taxes,
            'discount_amount'     => $this->discount_amount,
            'taxes'               => $this->taxes,
            'consumption_taxs'    => $this->consumption_taxs,
            'local_adminstration' => $this->local_adminstration,
            'rebuild_tax'         => $this->rebuild_tax,
            'notes'               => $this->notes,
            'client_name'         => $this->client_name,
            'order_details'       => Order_detailsResource::collection($this->whenloaded('Order_detailss')),
        ];
    }
}
