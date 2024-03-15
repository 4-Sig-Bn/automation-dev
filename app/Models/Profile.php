<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'number_type',
        'number',
        'rank',
        'trade',
        'name',
        'coy',
        'marital_status',
        'blood_gp',
        'height_feet',
        'height_inch',
        'weight',
        'present_address',
        'vil',
        'union',
        'upazila',
        'po',   
        'district',
        'distance_from_border',
        'birth_date',
        'enrolment_date',
        'unit_join_date',
        'retirement_date',
        'punishment',

    ];

    public function carrierPlan()
    {
        return $this->hasMany(CarrierPlan::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
}

