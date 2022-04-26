<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id',
        'order_date',
        'total_price',
        'payment_state',
        'payment_method',
        'client_id',
        'status',
        'print_count',
        'customer',
        'user_id',
        'total_cost',
        'total_after_taxes',
        'discount_amount',
        'taxes',
        'consumption_taxs',
        'local_adminstration',
        'rebuild_tax',
        'notes',
        'client_name',
    ];
    
    public function Table(){

        return $this->belongsTo(Table::class);
        
    }    

    public function User(){

        return $this->belongsTo(User::class);
        
    }

    public function Order_detailss(){

        return $this->hasMany(Order_details::class);
        
    }
}
