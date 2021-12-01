<?php
    // Iniciar sesion
    session_start();
    // Importo las operaciones
    require("../assets/operaciones/operaciones.php");

    // Crear el objeto de operaciones.
    $objeto=new operaciones();

	$regala = $_POST["regala"];
	$destinatario = $_POST["destinatario"];
	$grupo = $_POST["grupo"];


/**
	// Recorre la array y comprueba que todos hayan subido regalo.
	// Si falta alguno da error.
	foreach($regala as $valor)
	{
		// Consula. Para saber si tiene regalo la persona que regala.
		$consulta = "
			SELECT regalo.Ruta, regalo.Nombre
			FROM usuarios
			INNER JOIN regalo ON regalo.Usuario = usuarios.IDUsuario
			WHERE usuarios.Correo = '".$valor."' AND regalo.Grupo = $grupo;
		";

		//echo $consulta;
		$objeto->realizarConsultas($consulta);

		//Si devuelve filas significa que esa persona tiene regalo.
		if($objeto->comprobarFila()>0)
		{
			//echo 'SiRegalo';
		}
		else // SI entra aqui, significa que esa persona no subio regalo.
		{
			echo 'NoRegalo';
		}

	}
**/

/**
	// Visualizar la array $regala
	foreach($regala as $valor)
	{
		echo $valor.'<br>';
	}

	echo '                              ';

	// Visualizar la array $destinatario
	foreach($destinatario as $valor)
	{
		echo $valor.'<br>';
	}
**/

	// Consulta. Saber la ID del destinatario
	// Consulta. Comprobar que la persona que regala existe.
	// Consulta. Insertar en la persona que regala el destinatario.



	// Variable contador. Para $regala. La persona quien regala.
	$i = 0;

	// Recorrela array $destinatario.
	foreach($destinatario as $valor)
	{
		// Consulta. Para sacar la id del usuario destinatario
		$consulta = "
			SELECT usuarios.IDUsuario, usuarios.Correo
			FROM usuarios
			WHERE correo = '$valor';
		";

		//echo $consulta;
		$objeto->realizarConsultas($consulta);

		// Si devuelve filas, sifnifica que ese usuario esta registrado.
		if($objeto->comprobarFila()>0)
		{
			// Se saca las filas devueltas de la consulta y se guarda en $fila
			$fila = $objeto->extraerFilas();

			// Guardo las IDUsuario de las personas destinataria.
			$iddestinatario = $fila["IDUsuario"];

			// Visualizacion de quien regala con el destinatario.
			//echo 'Regala '.$regala[$i].'| Destinario '.$iddestinatario;
			//echo '                              ';

			// Consulta. Para saber la IDRegalo de la persona que regala, $regala.
			$consulta = "
				SELECT regalo.IDRegalo, regalo.Grupo, usuarios.correo, regalo.Destinatario
				FROM regalo
				INNER JOIN usuarios ON usuarios.IDUsuario = regalo.Usuario
				WHERE usuarios.Correo = '$regala[$i]' AND regalo.grupo= $grupo;
			";

			//echo $consulta;
			$objeto->realizarConsultas($consulta);
			
			// Si devuelve filas significa que subio un regalo.
			if($objeto->comprobarFila()>0)
			{
				// Se extrae las filas obtenidas de la consulta y se guarda en $fila.
				$fila = $objeto->extraerFilas();
				// Se guarda en $idregalo lo obtenido en $fila["IDRegalo"]
				$idregalo = $fila["IDRegalo"];
				
				$destinatarioconsulta = $fila["Destinatario"];
				
				if($iddestinatario != $destinatarioconsulta)
				{
					// Consulta. Actualiza en la BD el destinatario del regalo.
					$consulta = "UPDATE regalo SET Destinatario=$iddestinatario WHERE IDRegalo=$idregalo;";
					//echo $consulta;
					$objeto->realizarConsultas($consulta);

					// Si devuelve filas sinifica que se actualizo en la bd.
					if($objeto->comprobar()>0)
					{
						//
						// Enviar correo del enlace del regalo
						//

					}
				}
				echo "Si";
				
			}
			else
			{
				echo "No";
			}
		}
		else
		{
			echo "No";
		}

		$i++;
	}
		
