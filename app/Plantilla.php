<?php

class Plantilla
{
    public static function html_select_familias($familias,$codigo){
        $html_select="<select name='familia'>";
        foreach ($familias as $familia){
            if ($codigo==$familia['cod']){
                $html_select.="<option value=$familia[cod] selected>{$familia['nombre']}</option>\n";
            }else{
                $html_select.="<option value='".$familia['cod']."'>{$familia['nombre']}</option>\n";
            }

        }
        $html_select .="</select>";
        return $html_select;
    }

}