<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarrierPlan extends Model
{   
    protected $fillable = ['profile_id','year', 'cycle_1', 'cycle_2', 'cycle_3', 'cycle_4'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
