<?php
// ClientsImport.php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Client;

class ClientsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Check if 'name' is not empty before creating a new Client
        if (!empty($row['name'])) {
            return new Client([
                'name'    => $row['name'],
                'email'   => $row['email'],
                'phone'   => $row['phone'],
                'address' => $row['address'],
            ]);
        }

        // If 'name' is empty, return null to skip this row
        return null;
    }
}

