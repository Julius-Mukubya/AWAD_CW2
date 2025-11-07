<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number',
        'first_name',
        'last_name',
        'national_id',
        'date_of_birth',
        'phone_number',
        'email',
        'address',
        'photo',
        'license_number',
        'license_issue_date',
        'license_expiry_date',
        'license_class',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relationship',
        'stage_id',
        'status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'license_issue_date' => 'date',
        'license_expiry_date' => 'date',
    ];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function motorcycle()
    {
        return $this->hasOne(Motorcycle::class);
    }
}
