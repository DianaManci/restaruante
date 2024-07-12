<?php
    class clientes{
      
        private $_conexion;
        private $_id;
        private $_nombre;
        private $_apellido;
        private $_telefono;
        private $_ciudad;
        private $_correo;
        private $_paginacion =10;

        public function obtenerNombre($id) {
            $consulta = mysqli_query($this->_conexion, "SELECT nombre FROM clientes WHERE id = $id");
            $resultado = mysqli_fetch_assoc($consulta);
            return $resultado['nombre'];
        }
        function __construct($conexion, $id, $nombre, $apellido, $telefono, $ciudad, $correo){
            $this->_conexion     = $conexion;
            $this->_id           = $id;
            $this->_nombre       = $nombre;
            $this->_apellido     = $apellido;
            $this->_telefono     = $telefono;
            $this->_ciudad       = $ciudad;
            $this->_correo       = $correo;
        }
   
        function  __get($k){
            return $this->$k;
        }
        function  __set($k,$v){
            $this->$k = $v;
        }

        function insertar(){
            
            $insercion = mysqli_query($this->_conexion,"INSERT INTO cliente (id, nombre, apellido, telefono, ciudad, correo) VALUES(NULL,'$this->_nombre','$this->_apellido','$this->_telefono','$this->_ciudad','$this->_correo')");
            return $insercion;
        }
        function modificar(){
            $modificacion = mysqli_query($this->_conexion,"UPDATE cliente SET 
            nombre      = '$this->_nombre',
            apellido    = '$this->_apellido', 
            telefono    = '$this->_telefono', 
            ciudad      = '$this->_ciudad', 
            correo      = '$this->_correo'
            WHERE id    = $this->_id");
            return $modificacion;
        }
        function eliminar(){
            print_r("hola");
            $eliminacion = mysqli_query($this->_conexion,"DELETE FROM cliente WHERE id= $this->_id"); 
            //$auditoria   = mysqli_query($this->_conexion,"INSERT INTO Auditoria(idAuditoria, detalleAuditoria, idUsuarioAuditoria, fechaAuditoria)VALUES(NULL, 'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
            return $eliminacion;
        }
        
        function cantidadPaginas(){
            $cantidadBloques = mysqli_query($this->_conexion,"SELECT CEIL (COUNT (id)/$this->_paginacion)AS cantidad FROM cliente") or die(mysqli_error($this->_conexion));
            $unRegistro      = mysqli_fetch_array($cantidadBloques);
            return $unRegistro['cantidad'];
        }

        function listar($pagina){
            if ($pagina<=0){
                $listado = mysqli_query($this->_conexion,"SELECT * FROM cliente ORDER BY id") or  die (mysqli_error($this->_conexion));
                return  $listado;
                
            }else{
                $paginacionMax = $pagina * $this->_paginacion;
                $paginacionMin = $paginacionMax - $this->_paginacion;
                $listado       = mysqli_query($this->_conexion,"SELECT * FROM cliente ORDER BY id LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
                return  $listado;
            }
        }

    }
?>