<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

//require_once "conexion.php";
$carga = fn($clase) => require("$clase.php");
spl_autoload_register($carga);

session_start();

if (!isset($_SESSION['user'])) {
    header("location:index.php?msj=Debes iniciar sesión para acceder");
    exit();
}

$familia="";
$opcion_submit = $_POST['submit'] ?? "";
if (isset($_POST['submit'])) {
    switch ($opcion_submit) {
        case "Actualizar":
            $db = new DB();
            $producto = $_POST['producto'];
            $actualizado = $db->actualizar_producto($producto);
            $familia = $producto['familia'];
            header("location:listado.php?familia=$familia&actualizado=$actualizado");
            break;
        case "Cancelar":
            header("location:listado.php?msj=No has editado el producto");
            exit();
        default:
            $db = new DB();
//    $nombreFamilia=$_POST['familia'];
            $codProducto = $_POST['codigo'];
            $mostrarParaEditarProducto = $db->obtener_producto_para_editar($codProducto);
            foreach ($mostrarParaEditarProducto as $valor) {
                $producto['nombre_corto'] = $valor['nombre_corto'];
                $producto['cod'] = $valor['cod'];
                $producto['nombre'] = $valor['nombre'];
                $producto['descripcion'] = $valor['descripcion'];
                $producto['PVP'] = $valor['PVP'];
                $producto['familia'] = $valor['familia'];

            }

    }
}

//if (isset($_POST['Actualizar'])){
//    $db=new DB();
//    $nuevonombre_corto=$_POST['nombre_corto'];
//    $nuevadescripcion=$_POST['descripcion'];
//    $nuevopvp=$_POST['PVP'];
//    $codProducto=$_POST['codigo'];
//
//    $actualizaProducto=$db->actualizar_producto($nuevonombre_corto,$nuevadescripcion,$nuevopvp,$codProducto);
//}


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
        textarea {
            color: black;
        }
    </style>
    <title>Editar.php</title>
</head>
<body>
<div class="content">
    <h1>Aquí está la página para editar</h1>
    <fieldset>
        <form method="post" action="editar.php">
            Cod
            <textarea id="cod" name="producto[cod]" rows="4" cols="50" disabled><?= $producto['cod'] ?></textarea>

            Nombre corto
            <textarea id="nombre_corto" name="producto[nombre_corto]" rows="4" cols="50"><?= $producto['nombre_corto'] ?></textarea>

            Nombre
            <textarea id="nombre" name="producto[nombre]" rows="4" cols="50"><?= $producto['nombre'] ?></textarea>

            Descripción
            <textarea id="descripcion" name="producto[descripcion]" rows="10" cols="100"><?= $producto['descripcion'] ?></textarea>

            Precio
            <textarea id="PVP" name="producto[PVP]" rows="4" cols="50"><?= $producto['PVP'] ?></textarea>

            <input type="hidden" name="producto[familia]" value="<?= $producto['familia'] ?>">
            <input type="hidden" name="producto[cod]" value="<?= $producto['cod'] ?>">


            <button type="submit" name="submit" value="Actualizar">Actualizar</button>
            <button type="submit" name="submit" value="Cancelar">Cancelar</button>
        </form>
    </fieldset>
</div>
</body>
</html>
