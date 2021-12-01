<?php
    //Importo las operaciones
    require("../assets/operaciones/operaciones.php");
	require("../assets/operaciones/operaciones_ftp.php");

    // Crear el objeto de operaciones.
    $objeto = new operaciones();
	$objetoftp=new operaciones_ftp();

	// Guardo en variables lo recibido desde ajax.
	$correepropietario= $_POST["correepropietario"];
	$laidgrupo = $_POST["laidgrupo"];
	
	// Visualizar las variables
	//echo $correepropietario.'/'.$laidgrupo;

	// Consulta. Saca la informacion de si esa persona es propietaria de ese grupo
	$consulta ="
		SELECT usuarios.IDUsuario, usuarios.Correo, grupos.IDGrupo, grupos.Propietario
		FROM usuarios
		INNER JOIN usuariogrupo ON usuariogrupo.IDUsuario = usuarios.IDUsuario
		INNER JOIN grupos ON grupos.IDGrupo = usuariogrupo.IDGrupo
		WHERE usuarios.Correo = '$correepropietario' AND grupos.IDGrupo = $laidgrupo;
	";
	//echo $consulta; 
	$objeto->realizarConsultas($consulta);

	// Si devuelve filas, signfica que esta en ese grupo
	if($objeto->comprobarFila()>0)
	{
		// Extraigo las filas de la consulta.
		$fila = $objeto->extraerFilas();
		
		$usuarioid = $fila["IDUsuario"];
		$usuariopropietario = $fila["Propietario"];
		
		
		//echo $usuarioid.'/'.$usuariopropietario;

		// Si el usuario que intenta borrar el grupo es el propietario entra al if.
		if($usuarioid == $usuariopropietario)
		{
			
			// Consulta. Elimina ese grupo.
			$consulta = "DELETE FROM grupos WHERE IDGrupo = $laidgrupo;";
			//echo $consulta; 
			$objeto->realizarConsultas($consulta);
			
			// Si devuelve filas, sigfnicia que se elimino ese grupo.
			if($objeto->comprobar()>0)
			{
				// Ruta donde tiene que eliminar la carpeta y contenido de esa persona.
				$dir = '../regalos/'.$laidgrupo.'';
				//echo $dir;

				// Elimino la carpeta del usuario en ese grupo.  ||| Borrar Carpeta & Regalo.
				$objetoftp->recursiveRemove($dir);
				
				echo 'Si';
			}
			else
			{
				echo 'No';
			}
			
		}
		else // Si usuario que intenta borrar el grupo no es el propietario entra al else.
		{
			echo 'No';
		}
	}
	else
	{
		echo 'No';
	}




?>