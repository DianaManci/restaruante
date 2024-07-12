<?php

include_once("../modelo/Conexion.php");
include_once("../modelo/Clientes.php");


$objetoConexion = new Conexion();
$conexion = $objetoConexion->conectar();

$objetoCliente = new Clientes($conexion, 0, 'nombre', 'apellido', 'telefono', 'ciudad', 'correo');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['fEnviar']) && $_POST['fEnviar'] === 'Ingresar') {
        
        $nombre = $_POST['fNombre'];
        $apellido = $_POST['fApellido'];
        $telefono = $_POST['fTelefono'];
        $ciudad = $_POST['fCiudad'];
        $correo = $_POST['fCorreo'];

        
        $objetoCliente->insertar();

        
        header("../vista/formularioClientes.php" );
        exit;
    }
}


$listarClientes = $objetoCliente->listar(0);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario Clientes</title>
    <link rel="stylesheet" href="../estilos2/guardarCliente.css">
</head>

<body>

    <menu  class="menu" >
                <a href="/guia20Ramon/index.php">Inicio</a>
                <a href="/guia20Ramon/vista/FormularioClientes.php">Registrarse</a>
                <a href="/guia20Ramon/vista/FormularioListaClientes.php">Clientes</a>
                <a href="/guia20Ramon/vista/Menu.php">Menú</a>
    </menu>

   
     
<div class="container2">
    <h2>Ingresar Nuevo Cliente</h2>
    <form id="fIngresarEstudiante" action="../controlador/ControladorCliente.php" method="post">
        <input type="hidden" name="fId" value="0">
        <div class="form-group">
            <label for="fNombre">Nombre:</label>
            <input type="text" name="fNombre" id="fNombre">
        </div>
        <div class="form-group">
            <label for="fApellido">Apellidos:</label>
            <input type="text" name="fApellido" id="fApellido">
        </div>
        <div class="form-group">
            <label for="fTelefono">Teléfono:</label>
            <input type="text" name="fTelefono" id="fTelefono">
        </div>
        <div class="form-group">
            <label for="fCiudad">Ciudad:</label>
            <input type="text" name="fCiudad" id="fCiudad">
        </div>
        <div class="form-group">
            <label for="fCorreo">Correo:</label>
            <input type="text" name="fCorreo" id="fCorreo">
        </div>
        <div class="button-group">
            <button type="submit" name="fEnviar" value="Ingresar">Ingresar</button>
            <button type="reset" name="fEnviar" value="Limpiar">Limpiar</button>
        </div>
    </form>
</div>

<br>
<br>
    <div class="container">
        <table border="1">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Ciudad</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($unRegistro = mysqli_fetch_array($listarClientes)) {
                    echo '<tr>';
                    echo '<form id="fModificarCliente" action="../controlador/ControladorCliente.php" method="post">';
                    echo '<td><input type="hidden" name="fId" value="' . $unRegistro['id'] . '">';
                    echo '<input type="text" name="fNombre" value="' . $unRegistro['nombre'] . '"></td>';
                    echo '<td><input type="text" name="fApellido" value="' . $unRegistro['apellido'] . '"></td>';
                    echo '<td><input type="text" name="fTelefono" value="' . $unRegistro['telefono'] . '"></td>';
                    echo '<td><input type="text" name="fCiudad" value="' . $unRegistro['ciudad'] . '"></td>';
                    echo '<td><input type="text" name="fCorreo" value="' . $unRegistro['correo'] . '"></td>';
                    echo '<td>';
                    echo '<button type="submit" name="fEnviar" value="Modificar">Modificar</button>';
                    echo '<br>';
                    echo '<button type="submit" name="fEnviar" value="Eliminar">Eliminar</button>';
                    echo '</td>';
                    echo '</form>';
                    echo '</tr>';
                }

                mysqli_free_result($listarClientes);
                $objetoConexion->desconectar($conexion);
                ?>
            </tbody>
        </table>
    </div>

   
</body>

</html>