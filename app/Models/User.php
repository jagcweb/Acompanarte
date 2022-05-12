<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
        'password',
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
    ];
    
    public function config_professor(){
    	return $this->hasOne(ConfigurationProfessor::class);
    }

    public function suscription(){
    	return $this->hasOne(ProfessorSuscription::class);
    }

    public function professor_specialties(){
    	return $this->hasMany(ProfessorSpecialty::class);
    }

    public function professor_languages(){
    	return $this->hasMany(ProfessorLanguage::class);
    }

    public function ratings(){
    	return $this->hasMany(Rating::class);
    }

    public function getFullNameAttribute(){
    	return $this->name.' '.$this->surname;
    }
}
