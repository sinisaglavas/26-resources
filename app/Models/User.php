<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    const ROLE_CLIENT = 'client';
    const ROLE_ADMINISTRATOR = 'administrator';
    const ROLE_TRUCKER = 'trucker';

    const ALLOWED_ROLES = [
        self::ROLE_CLIENT,
        self::ROLE_ADMINISTRATOR,
        self::ROLE_TRUCKER,
    ];

    // mutator - proverava da li je vrednost dobra - u funkciji mora biti naziv setImePoljaAttribute
    // ako neko pokusa da setuje rolu mora biti neka od ove tri
    // funkcija se ne poziva
    public function setRoleAttribute(string $role)
    {
        if (!in_array($role, self::ALLOWED_ROLES))
        {
            throw new \Exception('Invalid role');
        }
        // u slucaju da je role onaj koji je dozvoljen kazemo da se upise
        $this->attributes['role'] = strtolower($role);
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class, 'user_id', 'id');
    }
}
