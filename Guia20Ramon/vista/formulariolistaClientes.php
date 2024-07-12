<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Clientes</title>
    <link rel="stylesheet" href="../estilos2/listarClientes.css">
</head>

<body>
    <menu class="menu" type="context">
        <div>
                 <a href="/guia20Ramon/index.php">Inicio</a>
                <a href="/guia20Ramon/vista/FormularioClientes.php">Registrarse</a>
                <a href="/guia20Ramon/vista/FormulariosListaClientes.php">Clientes</a>
                <a href="/guia20Ramon/vista/Menu.php">Menú</a>
        </div>
    </menu>
    <header>
        <h1>Clientes</h1>
    </header>
    <table border="2">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Ciudad</th>
                <th>Correo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once("../modelo/Conexion.php");
            $objetoConexion = new conexion();
            $conexion = $objetoConexion->conectar();

            include_once("../modelo/Clientes.php");
            $objetoCliente = new Clientes($conexion, 0, 'nombre', 'apellido', 'telefono', 'ciudad', 'correo');
            $listarClientes = $objetoCliente->listar(0);
            while ($unRegistro = mysqli_fetch_array($listarClientes)) {
                echo '<tr>';
                echo '<td>' . $unRegistro['nombre'] . '</td>';
                echo '<td>' . $unRegistro['apellido'] . '</td>';
                echo '<td>' . $unRegistro['telefono'] . '</td>';
                echo '<td>' . $unRegistro['ciudad'] . '</td>';
                echo '<td>' . $unRegistro['correo'] . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <?php
    mysqli_free_result($listarClientes);
    $objetoConexion->desconectar($conexion);
    ?>
</body>

</html>
