<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chief extends Model
{
    protected $guarded = ['id'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function major(){
        return $this->belongsTo(Major::class);
    }
    use HasFactory;
}
