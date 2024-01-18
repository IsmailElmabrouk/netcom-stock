<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'name',
        'location',
        'capacity',
    ];
    
    public function magasiniers()
    {
        return $this->hasMany(Magasinier::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function boneSorties()
    {
        return $this->hasMany(BoneSortie::class);
    }
    public function getTotalQuantityAttribute()
{
    return $this->products->sum('quantity');
}
}
