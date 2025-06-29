<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CvSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
