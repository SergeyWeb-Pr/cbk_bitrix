<?php
namespace Lst;

class Site
{
    public static function is_ajax()
    {
        $isAjax = false;
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $isAjax = true ;
        }
        return $isAjax;
    }

    public static function convert_to_select_params($array)
    {
        if (!is_array($array)) {
            return;
        }

        $select_params[]  = array('no' => 'Не выбрано');

        foreach ($array as $element) {
            $select_params[] = array($element['ID'] => $element['NAME'].' ['.$element['ID'].']');
        }


        return $select_params;
    }
}
