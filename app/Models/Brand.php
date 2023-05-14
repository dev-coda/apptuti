<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'banner',
        'description',
        'slug',
        'delivery_days',
        'discount',
    ];

    public function vendors(){
        return $this->belongsToMany(Vendor::class);
    }
}
