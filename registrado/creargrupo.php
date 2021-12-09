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
	* Descripcion del fichero: En este fichero esta definada las variables para acceder al host & Base de Datos.
	*/

    // Iniciar sesion
    session_start();

    // COmprobar que recibe los datos.
    if(isset($_POST["nombregrupo"]) && isset($_POST["fechareparto"])){

        // En caso que venga vacio $_POST["nombregrupo"] le establezco yo.
		// En caso contrario guardo el de $_POST["nombregrupo"]
        if(empty($_POST["nombregrupo"])){
            $nombregrupo = "Amigo Invisble";
        }else
        	$nombregrupo = $_POST["nombregrupo"];

        // Guardar variables
        $fechareparto = $_POST["fechareparto"];
        $correo = $_SESSION["usuario"];

        // Fecha de hoy
        $fechahoy = date('Y-m-d');

        // Importo las operaciones
        require("../assets/operaciones/operaciones.php");

        // Crear el objeto de operaciones.
        $objeto=new Operaciones();

        // Consulta para traer los datos del correo.
        $consulta = "SELECT * FROM usuarios WHERE correo='".$_SESSION["correo"]."';";
        //echo '<br>'.$consulta.'<br>';
        $objeto->realizarConsultas($consulta);

        // Comprueba que devolvio filas .
        if($objeto->comprobarFila()>0){

            // Extrar las filas de la consulta.
            $fila = $objeto->extraerFilas();

            // Guardo el tipo
            $usuario = $fila["IDUsuario"];
            $tipo = $fila["Tipo"];

            // Si es $tipo pm entra en el if, en caso contrario en else.
            if($tipo == "p"){
                // Consulta. Crea el grupo.
                $consulta = "INSERT INTO grupos (Nombre, Fecha_Inicio, Fecha_Fin, Propietario) VALUES ('".$nombregrupo."', '".$fechahoy."', '".$fechareparto."', '".$usuario."');";
                //print_r($consulta);
                $objeto->realizarConsultas($consulta);
				
				// Si devuelve filas, significa que se inserto.
                if($objeto->comprobar()>0){
					// Obtiene la ultima id de de $consulta.
					$grupoid = $objeto->ultimoid();
					// Crea la carpeta del grupo
					mkdir('../regalos/'.$grupoid.'/',0777,true);

                    echo 'Si';
                }else // En caso que no haya sido insertado.{
                    echo 'No';
            }else // Si es tipo a u otro
            	echo 'No';
        }else // No exite ese correo por lo tanto le regresa a la pagina principal.
        	echo 'No';
    }else // En caso que esten vacias ambas variables.
        echo 'No';


