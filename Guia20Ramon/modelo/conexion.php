<?php
    class Conexion {
        function conectar (){
            $Conexion = mysqli_connect("localhost","root","","restaurante");
            mysqli_query($Conexion, "SET NAMES 'utf8' ");
            return $Conexion;
        }
            function desconectar($Conexion){
                mysqli_close($Conexion);
            }
    }
?>