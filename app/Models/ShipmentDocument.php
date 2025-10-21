<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentDocument extends Model
{
    protected $table = 'shipment_documents';

    protected $fillable = [
        'shipment_id',
        'document_name',
    ];
}
