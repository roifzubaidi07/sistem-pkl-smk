<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function grade(){
        return $this->belongsTo(Grade::class);
    }
    public function mentor(){
        return $this->belongsTo(Mentor::class);
    }
    public function industry(){
        return $this->belongsTo(Industry::class);
    }
    public function attendence(){
        return $this->hasMany(Attendence::class);
    }
    public function jurnal(){
        return $this->hasMany(Jurnal::class);
    }
    public function industrysubmission(){
        return $this->hasOne(IndustrySubmission::class);
    }
}
