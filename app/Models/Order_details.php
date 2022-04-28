<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'item_id',
        'total_price',
        'count',
        'is_fired',
        'status',
        'notes',
        'note_price',
        'delay',
        'cost',
    ];
    
    public function Order(){

        return $this->belongsTo(Order::class);
        
    }    

    public function Item(){

        return $this->belongsTo(Item::class);
        
    }

}
