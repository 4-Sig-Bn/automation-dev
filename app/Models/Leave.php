<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = ['start_date', 'end_date', 'status', 'approved_by','applicant_name','type','reason','ordered_by'];
    use HasFactory;


    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
