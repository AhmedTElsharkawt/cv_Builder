<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CvEducation extends Model
{
    use HasFactory;

    protected $table = 'cv_educations';

    protected $fillable = [
        'user_id',
        'institution',
        'major',
        'degree',
        'graduation_date',
        'description',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}
}
