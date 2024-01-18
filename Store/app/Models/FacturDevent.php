<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturDevent extends Model
{
    use HasFactory;

    protected $table = 'facturedevent'; // Specify the correct table name

    protected $fillable = [
        'product_id',
        'client_id',
        'magasiner_id',
        'date',
        'quantity',
        'total_amount',
        'payment_method',
        'status_payment',
        'remiss_applique',
     ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');    }
        public function magasiner()
        {
            return $this->belongsTo(User::class, 'magasiner_id');
        }
        public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');  
    }
}
