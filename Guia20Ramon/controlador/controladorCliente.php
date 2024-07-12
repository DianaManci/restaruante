<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/Clientes.php");

$opcion             = $_POST["fEnviar"];
$id         = isset($_POST["fId"]) ? $_POST["fId"] : 0;
$nombre     = isset($_POST["fNombre"]) ? $_POST["fNombre"] : "";
$apellido   = isset($_POST["fApellido"]) ? $_POST["fApellido"] : "";
$telefono   = isset($_POST["fTelefono"]) ? $_POST["fTelefono"] : "";
$ciudad     = isset($_POST["fCiudad"]) ? $_POST["fCiudad"] : "";
$correo     = isset($_POST["fCorreo"]) ? $_POST["fCorreo"] : "";


$nombre      = htmlspecialchars($nombre);
$apellido   = htmlspecialchars($apellido);
$telefono      = htmlspecialchars($telefono);
$ciudad  = htmlspecialchars($ciudad);
$correo    = htmlspecialchars($correo);


$objetoCliente = new Clientes ($conexion, $id,  $nombre, $apellido, $telefono, $ciudad, $correo );

switch ($opcion) {
    case 'Ingresar':
        $objetoCliente->insertar();
        $mensaje = "Ingresado";
        break;
    case 'Modificar':
        $objetoCliente->modificar();
        $mensaje = "Modificado";
        break;
    case 'Eliminar':
        $objetoCliente->eliminar();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/FormularioClientes.php?msj=$mensaje");