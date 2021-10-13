<?php
    // Traer los valores de la conexion.
    require("../assets/conexion/connection.php");

/**
    Clase de operaciones.
    Recoge la librería de funciones reutilizadas en otros ficheros.
*/
    class operaciones
    {
        public $mysqli;
        public $resultado;

        // COntructor que siempre ejecuta la coenxion con la Base de Datos.
        function __construct()
        {
            $this->mysqli = new mysqli(servidor, usuario, password, basedatos);

            if(!$this->mysqli)
            {
                echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
            }

        }

        /**
            Devuelve la conexion
            @return MySQLi El objeto de conexión a la BBDD.
         */
        function conexion()
        {
            return $this->mysqli = new mysqli(servidor, usuario, password, basedatos);
        }

        /**
            Funcion para realizar la consulta.
            Guarda el ResultSet en $this->resultado
            @param sql {String} Sentencia SQL para la consulta.
        */
        function realizarConsultas($sql)
        {
            $this->resultado = $this->mysqli->query($sql);
        }

        // Funcion para comprar una consulta SELECT.
        function comprobarFila()
        {
            return $this->resultado->num_rows;
        }

        // Funcion para comprar una consulta INSERT, UPDATE, REPLACE or DELETE.
        function comprobar()
        {
            return $this->mysqli->affected_rows;
        }

        // Funcion para extraer filas de la consulta.
        function extraerFilas()
        {
            return $this->resultado->fetch_array();
        }

        // Funcion que retorna la ultima id de la ultima consulta
        function ultimoid()
        {
            return $this->mysqli->insert_id;
        }

        // Devuelve el numero de error
        function error()
        {
            return $this->mysqli->errno;
        }

    }
?>
