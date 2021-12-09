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

    //Importo las operaciones
    require("../assets/operaciones/operaciones.php");
	require("../assets/operaciones/operaciones_ftp.php");

    // Crear el objeto de operaciones.
    $objeto = new Operaciones();
	$objetoftp=new Operaciones_ftp();

	// Guardo en variables lo recibido desde ajax.
	$correexpulsado = $_POST["correexpulsado"];
	$laidgrupo = $_POST["laidgrupo"];
	
	// Visualizar las variables 
	//echo $correexpulsado.'/'.$laidgrupo;

	// Consulta. Comprueba si existe en la invitacion con ese grupo
	$consulta ="
		SELECT *
		FROM invitado
		WHERE Correo = '$correexpulsado' AND IDGrupo = '$laidgrupo';
	";
	//echo $consulta; 
	$objeto->realizarConsultas($consulta);

	// Si devuelve fila significa que esta en la tabla invitado.
	if($objeto->comprobarFila()>0){

		// Consulta. Eliminar la invitacion de esa persona.  ||| Borrar la Invitacion .
		$consulta = "DELETE FROM invitado WHERE Correo = '$correexpulsado' AND IDGrupo = $laidgrupo;";
		//echo $consulta;
		$objeto->realizarConsultas($consulta);

		// Si devuelve fila significa que fue eliminado corectamente.
		if($objeto->comprobar()>0){

			// Consulta. Comprueba que ese usuario pertenece a ese grupo.
			$consulta ="
				SELECT usuarios.IDUsuario AS Usuario, usuarios.Correo, usuariogrupo.IDUsuario, usuariogrupo.IDGrupo
				FROM usuarios
				INNER JOIN usuariogrupo ON usuariogrupo.IDUsuario = usuarios.IDUsuario
				WHERE usuarios.Correo = '$correexpulsado' AND usuariogrupo.IDGrupo = '$laidgrupo';
			";
			//echo $consulta;
			$objeto->realizarConsultas($consulta);

			// Si devuelve fila significa que ese correo pertenecia a un grupo.
			if($objeto->comprobarFila()>0){
				// Extraigo las filas de la consulta.
				$fila = $objeto->extraerFilas();
				
				// Guardo la IDUsuario en una variable
				$idusuarioborrar = $fila["Usuario"];
				
				// Ruta donde tiene que eliminar la carpeta y contenido de esa persona.
				$dir = '../regalos/'.$laidgrupo.'/'.$correexpulsado.'/';
				//echo $dir;
			
				// Elimino la carpeta del usuario en ese grupo.  ||| Borrar Carpeta & Regalo.
				$objetoftp->eliminarcarpeta($dir);
				
				// Consulta. Elimina al usuario del grupo.  ||| Borrar pertenencia al grupo.
				$consulta = "DELETE FROM usuariogrupo WHERE IDGrupo = '$laidgrupo' AND IDUsuario = $idusuarioborrar";
				//echo $consulta;
				$objeto->realizarConsultas($consulta);

				// Si devuelve filas significa que fue borrado corectamente.
				if($objeto->comprobar()>0){
					// Consulta. Busca a la persona a eliminar su regalo.
					$consulta = "SELECT * FROM regalo WHERE Grupo = $laidgrupo AND Usuario = $idusuarioborrar;";
					$objeto->realizarConsultas($consulta);
					
					// Si devuelve filas significa que tenia un regalo subido.
					if($objeto->comprobarFila()>0){
						// Extraer las filas de la consulta a la variable $fila.
						$fila = $objeto->extraerFilas();
						
						// Guardo la IDRegalo en la variable $regalo.
						$regaloid = $fila["IDRegalo"];
						
						// Consulta. Saber quien pertenece a ese grupo.
						$consulta = "SELECT * FROM regalo WHERE Grupo = $laidgrupo; ";
						$objeto->realizarConsultas($consulta);

						// Si devuelve filas, significa que hay gente en ese grupo.
						if($objeto->comprobarFila()>0){
							// Bucle para guardar las IDUsuarios en una array
							while($fila = $objeto->extraerFilas()){
								// Se guarda lo extraido de la fila Usuario en la array.
								$array[] = $fila["Usuario"];
							}

							// Se recorre la arra y se actualiza la bd, el Destinatario en NULL
							foreach($array as $valor){
								// Consulta. Poner NULL en los cambios Destinatarios.
								$consulta = "UPDATE regalo SET Destinatario= NULL WHERE Grupo = 1 AND Usuario = $valor;";
								$objeto->realizarConsultas($consulta);
							}
						}
						
						// Consulta. Elimino el regalo en la bd, de la persona expulsada.  ||| Borrar Regalo BD
						$consulta = "DELETE FROM regalo WHERE IDRegalo = $regaloid;";
						$objeto->realizarConsultas($consulta);
						
						echo 'Si';
					}else // Si entra aqui significa que esa persona, no esta registrada en la web/no subio ningun regalo.
						echo 'Si';
				}
			}else /* Si no devuelve filas, significa que ese usuario no se registro en la web. */{
				// Se pone si, ya que fue eliminado de tabla invitado.
				echo 'Si';
			}
		}
	}

?>