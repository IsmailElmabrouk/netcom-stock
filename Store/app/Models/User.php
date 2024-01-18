<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles; // Import the HasRoles trait
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\HasDatabaseNotifications;




class User extends Authenticatable
{ 
    use HasApiTokens, HasFactory;
    use HasRoles;
    use Notifiable;
    use HasDatabaseNotifications;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'name',

        'email',

        'password',

        'type'

    ];

  
    
    public function facturedevents()
    {
        return $this->hasMany(FacturDevent::class, 'magasiner_id');
    }

    
    public function bonsorties()
    {
        return $this->hasMany(BonSortie::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
   // Modifiez la fonction type pour inclure "Commercial"
protected function type(): Attribute
{
    return new \Illuminate\Database\Eloquent\Casts\Attribute(
        get: fn ($value) =>  ["user", "admin", "Magasiner", "Commercial"][$value]
    );
}

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function bonSortieNotifications()
    {
        return $this->notifications()->where('type', 'App\Notifications\BoneSortieStatusNotification');
    }
    
    
    
}
