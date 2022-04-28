<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order_detailsResource extends JsonResource
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
            'id'            => $this->id,
            'order_id'      => $this->order_id,
            'item_id'       => $this->item_id,
            'total_price'   => number_format((double)($this->total_price), 2),
            'count'         => $this->count,
            'is_fired'      => $this->is_fired,
            'status'        => $this->status,
            'notes'         => $this->notes,
            'note_price'    => $this->note_price,
            'delay'         => $this->delay,
            'cost'          => number_format((double)($this->cost), 2),
        ];
    }
}
