<?php

namespace App\Traits;

/**
 * 
 * Diplay Tooltip on HTML 
 */
trait TooltipDisplayHTML 
{
    public function tooltipDisplayHTML($str)
    {
        $arrText = explode(' ', $str);
        $limitDisplayText = 3;
        $displayText = '';

        if (sizeof($arrText) > $limitDisplayText) {
            $displayText = $arrText[0] .' '. $arrText[1] .' '. $arrText[2] .' ...';
            return $html = '<a href="#" class="text-decoration-none" style="color: inherit;" data-toggle="tooltip" title="'.$str.'">'.$displayText.'</a>';
        } 
        
        return $str;
    }
}