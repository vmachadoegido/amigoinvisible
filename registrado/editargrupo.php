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

    // Fecha de hoy
    $fechahoy = date('Y-m-d');

    // Importo las operaciones
    require("../assets/operaciones/operaciones.php");

    // Crear el objeto de operaciones.
    $objeto=new Operaciones();

    // Comprobar que recibe los la id del grupo.
    if(isset($_POST["idgrupo"])){
        // Guardar variables
        $idgrupo = $_POST["idgrupo"];

        // Consulta. para saber si el usuario es el propietario.
        $consulta = "
            SELECT usuarios.IDUsuario, usuarios.Correo, grupos.IDGrupo, grupos.Nombre, grupos.Fecha_Fin, grupos.Propietario
            FROM usuarios
            INNER JOIN grupos ON usuarios.IDUsuario=grupos.Propietario
            WHERE usuarios.Correo = '".$_SESSION["correo"]."' AND grupos.IDGrupo = '".$idgrupo."';
        ";
        //echo '<br>'.$consulta.'<br>';
        $objeto->realizarConsultas($consulta);

        // Comprueba que devolvio filas.
        if($objeto->comprobarFila()>0){
            // Extrar las filas de la consulta.
            $fila = $objeto->extraerFilas();

            // Guardo el tipo
            $propietario = $fila["Propietario"];
            $idusuario = $fila["IDUsuario"];

			// Si esta vacia el nombre del grupo.
			// Se guarda la variable de la consulta $fila Nombre.
			// En caso contrario se guarda del post nombregrupo
			if(empty($_POST["nombregrupo"]))
				$nombregrupo = $fila["Nombre"];
			else
				$nombregrupo = $_POST["nombregrupo"];

			// Si esta vacia el nombre del grupo.
			// Se guarda la variable de la consulta $fila Nombre.
			// En caso contrario se guarda del post nombregrupo
			if(empty($_POST["fechareparto"]))
				$fechareparto = $fila["Fecha_Fin"];
			else
				$fechareparto = $_POST["fechareparto"];
			
			// Si la IDPropietario es igual al idusuario, significa que es el propietario el que quiere hacer esta accion.
            if($propietario == $idusuario){
				// Si $nombregrupo es igual a $fila["IDUsuario"] o $fechareparto es igual a $fila["fechareparto"]
				// Significa que no edito alguno componente.
				if(($nombregrupo == $fila["IDUsuario"]) OR ($fechareparto == $fila["fechareparto"])){
					// Consulta. Actualiza el nombre y fecha_fin del grupo.
					$consulta= "
						UPDATE grupos
						SET Nombre= '".$nombregrupo."', Fecha_Fin = '".$fechareparto."'
						WHERE IDGrupo = '".$idgrupo."';
					";
					//echo $consulta;
					$objeto->realizarConsultas($consulta);
					
					echo 'Si';
				}else /* En caso que edite los dos componentes.*/ {
					// Consulta. Actualiza el nombre y fecha_fin del grupo.
					$consulta= "
						UPDATE grupos
						SET Nombre= '".$nombregrupo."', Fecha_Fin = '".$fechareparto."'
						WHERE IDGrupo = '".$idgrupo."';
					";
					$objeto->realizarConsultas($consulta);

					// Si devuelve filas, significa que se actualizo.
					if($objeto->comprobar()>0)
						echo 'Si';
					else // Si entra aqui significa que no se actualizo
						echo 'No';
			   	}
            }else // Si es tipo a u otro
            	echo 'No';
        }else /* No exite ese correo por lo tanto le regresa a la pagina principal.*/
        	echo 'No';
    }else
    	echo 'No';
