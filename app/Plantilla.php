<?php

class Plantilla
{
    public static function html_select_familias($familias){
        $html_select="<select name='familia'>";
        foreach ($familias as $familia){
            $html_select.="<option value='".$familia['cod']."'>{$familia['nombre']}
            </option>\n";
        }
        $html_select .="</select>";
        return $html_select;
    }

}