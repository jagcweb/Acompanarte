<?php
namespace App\Helpers;
use App\Models\ProfessorAccompaniment;
  
use Illuminate\Support\Facades\DB;
  
class GetAccompaniments {
 
    public static function getAccompaniments($accompaniment) {
        $specialty = ProfessorAccompaniment::where('accompaniment', $accompaniment)->first();

        return $specialty;
    }
}