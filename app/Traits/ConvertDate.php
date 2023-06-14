<?php

namespace App\Traits;

use Carbon\Carbon;

trait ConvertDate
{
    public function convertDate($date)
    {
        $result = Carbon::parse($date)
                        ->locale('id')
                        ->translatedFormat('j F Y');
        return $result;
    }
}