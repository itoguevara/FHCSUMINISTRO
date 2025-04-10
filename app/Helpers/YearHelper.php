<?php

namespace App\Helpers;

use App\Models\RegistroControl;

class YearHelper
{
    public static function getAllYears()
    {
        // Lógica para obtener todos los años disponibles
        $anios = RegistroControl::where('sta_con', 'A')->pluck('ano_pro')->unique()->sort()->toArray();
        return $anios;
    }
}
