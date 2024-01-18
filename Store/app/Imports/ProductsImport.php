<?php

// app/Imports/ProductsImport.php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Product([
            'name' => $row['name'],
            'reference' => $row['reference'],
            'label' => $row['label'],
            'description' => $row['description'],
            'quantity' => $row['quantity'],
            'unit' => $row['unit'],
            'price' => $row['price'],
            'category_id' => $row['category_id'],
            'stock_id' => $row['stock_id'],
        ]);
    }
}
