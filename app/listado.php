<?php

ini_set('display_errors',true);
error_reporting(E_ALL);


require_once "conexion.php";
$carga=fn($clase)=>require("$clase.php");
spl_autoload_register($carga);

session_start();

if (!isset($_SESSION['user'])){
    header("location:index.php?msj=Debes de loguearte para acceder");
    exit();
}

$usuario = $_SESSION['user'];


$opcion = $_POST['submit'] ?? "";
switch ($opcion){
    case "logout":
        session_destroy();
        header("location:index.php?msj=Espero que vuelvas pronto");
        exit();
    default://(Si intento acceder directamente)
}

$db = new DB();



$listaFamilias=$db->obtener_familias();
/*$familiasDesplegable='<select>';
foreach ($listaFamilias as $familia){
$familiasDesplegable.="<option value=$familia[cod]>$familia[nombre]</option>";
    }
$familiasDesplegable.="</select>";*/



//mostrarProductos
if (isset($_POST['submit'])){
    $cod=$_POST['familia'];
    $listaProductos=$db->obtener_productos($cod);
    $msjProductos="<table>";
foreach ($listaProductos as $indice=>$valor){
    $msjProductos.="<tr><td>$indice</td><td>$valor[nombre_corto]</td><td>$valor[familia]</td>
<td>$valor[cod]</td><td>$valor[PVP]</td><td>$valor[descripcion]</td></tr>";
}
$msjProductos.="</table>";
}




?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <style>

    </style>
    <title>Ejercicio familia productos PDO</title>
</head>
<body>
<div class="content">
<h1>Bienvenido a este sitio web <?= $usuario ?></h1><br>


<form action="listado.php" method="post">
    <button type="submit" name="submit" value="logout">Cerrar sesión</button>
</form>


<form action="listado.php" method="post">
<fieldset>
    <legend>Listado de familias</legend>
    <?= Plantilla::html_select_familias($listaFamilias) ?>
</fieldset>
    <button type="submit" name="submit" value="mostrarProductos">Mostrar productos</button>
    <?= $msjProductos??"" ?>
</form>
</div>





</body>
</html>