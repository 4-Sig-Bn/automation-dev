<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MTReport extends Model
{   
    protected $table = 'mt_reports';
    protected $fillable = [
        'content',
        'date'
    ];
}
