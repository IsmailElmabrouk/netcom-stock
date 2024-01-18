<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

  // Client.php

public function bonSorties()
{
    return $this->hasMany(BonSortie::class);
}

    // Autres méthodes ou attributs liés au modèle Client
}