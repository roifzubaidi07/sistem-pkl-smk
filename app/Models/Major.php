<?php

namespace App\Models;

use App\Models\Mentor;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Major extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function grade(){
        return $this->hasMany(Grade::class);
    }
    public function mentor(){
        return $this->hasMany(Mentor::class);
    }
    public function chief(){
        return $this->hasMany(Chief::class);
    }
    public function student()
    {
        return $this->hasManyThrough(Student::class, Grade::class);
    }
}
