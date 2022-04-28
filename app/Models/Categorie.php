<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    
    public function Department(){

        return $this->belongsTo(Department::class);
        
    }

    public function Items(){

        return $this->hasMany(Item::class);
        
    }
}
