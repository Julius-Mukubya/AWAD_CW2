<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorcycle extends Model
{
    use HasFactory;

    protected $fillable = [
        'rider_id',
        'registration_number',
        'make',
        'model',
        'year',
        'engine_number',
        'chassis_number',
        'color',
        'insurance_company',
        'insurance_policy_number',
        'insurance_expiry_date',
    ];

    protected $casts = [
        'insurance_expiry_date' => 'date',
    ];

    public function rider()
    {
        return $this->belongsTo(Rider::class);
    }
}
