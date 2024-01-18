<?php

// app\Models\StockIssue.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'issue_description',
        'quantity', // Add 'quantity' to the $fillable array
        'employee_id',
        // Add any other attributes that you want to allow mass assignment for
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
