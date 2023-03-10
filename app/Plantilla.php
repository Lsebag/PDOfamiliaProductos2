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


    public static function muestra_productos($listaProductos){
        $msjProductos="<table>";
//        $msjProductos.="<tr><th>ÍndiceProducto</th><th>Nombre corto</th><th>Familia</th><th>Código</th>
//<th>Precio</th><th>Descripción</th></tr>\n";
        $msjProductos.="<tr><th>Nombre corto</th><th>Precio</th></tr>\n";
        foreach ($listaProductos as $indice=>$valor){
//            $msjProductos.="<tr><td>$indice</td><td>$valor[nombre_corto]</td><td>$valor[familia]</td><td>$valor[cod]
//            </td><td>$valor[PVP]</td><td>$valor[descripcion]</td>";
            $msjProductos.="<tr><td>$valor[nombre_corto]</td><td>$valor[PVP]</td>";
            $msjProductos.="<td>".self::boton_editar_producto($valor['cod'], $valor['familia'])."</td></tr>\n";
        }
        $msjProductos.="</table>";
        return $msjProductos;

    }

    private static function boton_editar_producto($cod, $familia){
        $boton_editar="\n\t<form action='editar.php' method='post'>\n";
        $boton_editar.="<input type='hidden' value='$cod' name='codigo'>\n";
        $boton_editar.="<input type='hidden' value='$familia' name='familia'>\n";
        $boton_editar.="<button type='submit' name='submit' value='editar'>Editar producto</button>\n";

        $boton_editar.="</form>";
        return $boton_editar;
    }

}