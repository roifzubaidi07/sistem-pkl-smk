<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    public static function cekKuota($id)
    {
        return count(Student::where('industry_id',$id)->get());
    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
