<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
    protected $guard = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    protected $guarded = ['id'];

    public function mentor(){
        return $this->hasMany(Mentor::class);
    }
    public function student(){
        return $this->hasMany(Student::class);
    }
    public function chief(){
        return $this->hasMany(Chief::class);
    }
    public function pr(){
        return $this->hasMany(Pr::class);
    }
    public function level(){
        return $this->belongsTo(Level::class);
    }
}
