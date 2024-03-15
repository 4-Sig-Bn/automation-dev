<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docu extends Model
{
    use HasFactory;

    protected $table = 'docu';
    protected $fillable = ['branch', 'file_name', 'upload_date', 'modified_date', 'uploaded_by'];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
