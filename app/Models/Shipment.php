<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    // koristimo fabrike da bazu napunimo dummy podacima
    use HasFactory;

    protected $table = 'shipments';

    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_UNASSIGNED = 'unassigned';
    const STATUS_COMPLETED = 'completed';
    const STATUS_PROBLEM = 'problem';

    const ALLOWED_STATUS = [
        self::STATUS_IN_PROGRESS,
        self::STATUS_UNASSIGNED,
        self::STATUS_COMPLETED,
        self::STATUS_PROBLEM,
    ];

    protected $fillable = [
        'title',
        'from_city',
        'from_country',
        'to_city',
        'to_country',
        'price',
        'status',
        'user_id',
        'details'
    ];
    // mutator - proverava da li je vrednost dobra - u funkciji mora biti naziv setImePoljaAttribute
    // funkcija se ne poziva
    public function setStatusAttribute($status)
    {
        if (!in_array($status, self::ALLOWED_STATUS))
        {
            throw new \Exception('Invalid status');
        }
        // u slucaju da je status onaj koji je dozvoljen kazemo da se upise
        $this->attributes['status'] = strtolower($status);
    }

    public function documents()
    {
        return $this->hasMany(ShipmentDocument::class, 'shipment_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
