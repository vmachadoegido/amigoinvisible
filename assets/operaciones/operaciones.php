<?php
	/**
	* Alumno: Victor Manuel Machado Egido.
	*
	* Centro Educativo: Escuela Virgen de Guadalupe.
	*
	* Ciclo Formativo: Desarrollo de Aplicaciones Web.
	*
	* Curso: 2020-2021.
	*
	* Descripcion del fichero: En este fichero estan las funciones basicas para acceder a la Base de Datos y hacer operaciones con esta.
	*/

    // Traer los valores de la conexion.
	require("../assets/conexion/connection.php");


	/**
	*	Clase de operaciones sobre la Base de Datos.
	*
	*	Recoge la librería de funciones reutilizadas en otros ficheros.
	*
	*/
    class Operaciones{
		/** public $mysqli :  string*/
        public $mysqli;
		/** public $mysqli :  string*/
        public $resultado;

        // COntructor que siempre ejecuta la coenxion con la Base de Datos.
		/**
		* Funcion para establecer la conexion con la Base De datos.
		*
		* @param String servidor
		* @param String usuario
		* @param String password
		* @param String basedatos
		*/
        function __construct(){
            $this->mysqli = new mysqli(servidor, usuario, password, basedatos);

            if(!$this->mysqli){
                echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
                echo "<script>console.log('Error: No se pudo conectar a la BD.');</script>";
            }

        }

        /**
        *    Funcion que devuelve la conexion
		*
        *    @return String $this->mysqli El objeto de conexión a la BBDD.
        */
        function conexion(){
            return $this->mysqli = new mysqli(servidor, usuario, password, basedatos);
        }

        /**
        *    Funcion para realizar consultas.
		*
        *    Guarda el ResultSet en $this->resultado
		*
        *    @param String $sql Sentencia SQL para la consulta.
        */
        function realizarConsultas($sql){
            $this->resultado = $this->mysqli->query($sql);
        }

		/**
        *    Funcion para comprar una consulta SELECT.
		*
        *    Guarda el ResultSet en $this->resultado
		*
		* 	 @return String $this->resultado 	El numero de filas devueltas.
        */
        function comprobarFila(){
            return $this->resultado->num_rows;
        }

		
		/**
        *    Funcion para comprar una consulta INSERT, UPDATE, REPLACE or DELETE.
		*
        *    Guarda el ResultSet en $this->mysqli
		*
        *    @return String $this->mysqli  El numero de filas afectadas.
        */
        function comprobar(){
            return $this->mysqli->affected_rows;
        }

		
		/**
        *    Funcion para extraer filas de la consulta.
		*
        *    Guarda el ResultSet en $this->resultado
		*
        *    @return String $this->resultado Las filas obtenidas de la consulta..
        */
        function extraerFilas(){
            return $this->resultado->fetch_array();
        }

		
		
		/**
        *    Funcion que retorna la ultima id de la ultima consulta INSERT, UPDATE, REPLACE or DELETE.
		*
        *    Guarda el ResultSet en $$this->mysqli
		*
        *    @return String $this->mysqli  La ultima ID afectada.
        */
        function ultimoid(){
            return $this->mysqli->insert_id;
        }

		/**
        *    Funcion que retorna el numero de error
		*
        *    Guarda el ResultSet en $this->mysqli
		*
        *    @return String $this->mysqli  El numero de error.
        */
        function error(){
            return $this->mysqli->errno;
        }
    }
?>
