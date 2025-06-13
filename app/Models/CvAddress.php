<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CvAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
