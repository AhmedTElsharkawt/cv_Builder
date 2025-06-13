<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CvPersonalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_title',
        'bio',
        'profile_image',
        'gender',
        'marital_status',
        'birth_date',
        'website',
        'country',
        'nationality',
        'health_status',
        'military_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
