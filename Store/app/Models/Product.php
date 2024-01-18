<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'reference', 'label', 'description', 'quantity', 'unit', 'price', 'category_id', 'stock_id',

    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function facturDevent()
    {
        return $this->hasMany(FacturDevent::class);
    }
    // Product.php

// Product.php

// Product.php

public function bonSorties()
{
    return $this->belongsToMany(BonSortie::class)->withPivot('quantity');
}


}
