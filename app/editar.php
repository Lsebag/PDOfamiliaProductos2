<?php
ini_set('display_errors',true);
error_reporting(E_ALL);

//require_once "conexion.php";
$carga=fn($clase)=>require("$clase.php");
spl_autoload_register($carga);

session_start();

if (!isset($_SESSION['user'])){
    header("location:index.php?msj=Debes iniciar sesión para acceder");
    exit();
}

if (isset($_POST['submit'])){
    $db=new DB();
//    $nombreFamilia=$_POST['familia'];
    $codProducto=$_POST['codigo'];
    $mostrarParaEditarProducto=$db->obtener_producto_para_editar($codProducto);
    foreach ($mostrarParaEditarProducto as $valor){
        $nombre_corto="$valor[nombre_corto]";
        $descripcion="$valor[descripcion]";
        $PVP="$valor[PVP]";
        
    }
}







?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar.php</title>
</head>
<body>
Nombre corto<input type="text" name="nombre_corto" style="width : 20rem; height : 5rem" value="<?= "$nombre_corto" ?>"><br>
Descripción<input type="text" name="descripcion" style="width : 20rem; height : 5rem"  value="<?= "$descripcion" ?>"><br>
Precio<input type="text" name="PVP" style="width : 20rem; height : 5rem"  value="<?= "$PVP" ?>">

</body>
</html>
