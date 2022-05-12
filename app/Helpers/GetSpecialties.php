<?php
namespace App\Helpers;
use App\Models\ProfessorSpecialty;
  
use Illuminate\Support\Facades\DB;
  
class GetSpecialties {
 
    public static function getSpecialties($specialty) {
        $specialty = ProfessorSpecialty::where('specialty', $specialty)->first();

        return $specialty;
    }
}