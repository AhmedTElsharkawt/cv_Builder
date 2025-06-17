<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // CV_Builder Relationships
    public function cvPersonalInfo()
    {
        return $this->hasOne(CvPersonalInfo::class);
    }

    public function cvEducations()
    {
        return $this->hasMany(CvEducation::class);
    }

    public function cvExperiences()
    {
        return $this->hasMany(CvExperience::class);
    }

    public function cvTrainings()
    {
        return $this->hasMany(CvTraining::class);
    }

    public function cvSkills()
    {
        return $this->hasMany(CvSkill::class);
    }

    public function cvProjects()
    {
        return $this->hasMany(CvProject::class);
    }

    public function cvLanguages()
    {
        return $this->hasMany(CvLanguage::class);
    }

    public function cvLinks()
    {
        return $this->hasMany(CvLink::class);
    }

    public function cvAddress()
    {
        return $this->hasOne(CvAddress::class);
    }

    public function cv_purchasedTemplates()
    {
        return $this->belongsToMany(CvTemplate::class, 'template_purchases');
    }

    public function cv_hasPurchasedTemplate($templateId)
    {
        return $this->cv_purchasedTemplates()->where('cv_template_id', $templateId)->exists();
    }
}
