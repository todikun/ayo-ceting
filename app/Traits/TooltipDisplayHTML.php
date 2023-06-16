<?php

namespace App\Traits;

use Illuminate\Support\Str;

/**
 * 
 * Display Tooltip on HTML 
 */
trait TooltipDisplayHTML 
{
    public function tooltipDisplayHTML($str)
    {
        $limitText = Str::words($str, 4, ' ...');
        $html = '<a href="#" class="text-decoration-none" style="color: inherit;" data-toggle="tooltip" title="'.$str.'">'.$limitText.'</a>';
        
        return Str::endsWith($limitText, '...') ? $html : $limitText;
    }
}