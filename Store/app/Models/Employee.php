<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StockIssue;
class Employee extends Model
{
    protected $fillable = [
        'name',
        // Add any other attributes that you want to allow mass assignment for
        'role',
        'stock_id',
    ];
    
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
    // Inside the Employee model

public function stockIssues()
{
    return $this->hasMany(StockIssue::class);
}

}
