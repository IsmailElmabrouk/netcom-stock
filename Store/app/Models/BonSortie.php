<?php
 namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\BonSortieVerificationNotification;


class BonSortie extends Model
{
    protected $table = 'bonsorties';

    protected $fillable = [
        'date',
        'stock_id',
        'reason',
        'user_id',
        'status',   
        'reject_justification',
        'magasiner_comments', 
        'client_id',
        'quantities_updated',
        'verifier_by',

 
        // Add this line

    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
 // Modèle BonSortie
 public function products()
 {
     return $this->belongsToMany(Product::class)->withPivot('quantity');
 }

 public function sendVerificationNotification()
 {
     $this->user->notify(new BonSortieVerificationNotification($this));
 }
 
 
 

public function client()
{
    return $this->belongsTo(Client::class);
}

public function acceptedBy()
{
    return $this->belongsTo(User::class, 'accepted_by');
}

}
