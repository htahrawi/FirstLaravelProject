<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = "offers"; 
    protected $fillable = [
        'photo',
        'name_ar',
        'name_en',
        'price',
        'detailes_ar',
        'detailes_en',
        'created_at',
        'updated_at'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    
    // public $timestamps = false;


}