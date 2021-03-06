<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'is_available',
        'in_orderes',
        'order',
        'menu_order',
        'menu_cat_id',
        'monthly_avg',
        'rate_star',
        'sell_price',
        'parent_id',
    ];
    
    public function User(){

        return $this->belongsTo(User::class);
        
    }

    public function Categorie(){

        return $this->belongsTo(Categorie::class,'category_id');
        
    }

    public function Order_details(){

        return $this->hasMany(Order_details::class);
        
    }
}
