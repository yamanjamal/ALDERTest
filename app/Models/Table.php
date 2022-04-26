<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
    ];
    
    public function User(){

        return $this->belongsTo(User::class);
        
    }

    public function Tests(){

        return $this->hasMany(Test::class);
        
    }
}
