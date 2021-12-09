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
    // Importo las operaciones
    require("../assets/operaciones/operaciones.php");

    // Crear el objeto de operaciones.
    $objeto=new Operaciones();

	// Guardo las variables recibidas en variables.
	$regala = $_POST["regala"];
	$destinatario = $_POST["destinatario"];
	$grupo = $_POST["grupo"];


	// Contador de NoRegalo
	$contadorno = 0;

	// Recorre la array y comprueba que todos hayan subido regalo.
	// Si falta alguno da error.
	foreach($regala as $valor){
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
		if($objeto->comprobarFila()>0){
			//echo 'SiRegalo';
		}else /* SI entra aqui, significa que esa persona no subio regalo.*/{
			//echo 'NoRegalo';
			$contadorno++;
		}
	}
	

/**
	// Visualizar la array $regala
	foreach($regala as $valor){
		echo $valor.'<br>';
	}

	echo '                               ';

	// Visualizar la array $destinatario
	foreach($destinatario as $valor){
		echo $valor.'<br>';
	}
**/
	// Si el $contadorno es igual 0, significa que todos han subido su regalo.
 	// En caso que sea distinto (mayor), aun queda gente por subir regalo.
	if($contadorno == 0){
		// Contador de NoRegalo
		$contadorsi = 0;
		
		// Variable contador. Para $regala. La persona quien regala.
		$i = 0;

		// Recorrela array $destinatario.
		foreach($destinatario as $valor){
			// Consulta. Para sacar la id del usuario destinatario
			$consulta = "
				SELECT usuarios.IDUsuario, usuarios.Correo
				FROM usuarios
				WHERE correo = '$valor';
			";
			//echo $consulta;
			$objeto->realizarConsultas($consulta);

			// Si devuelve filas, sifnifica que ese usuario esta registrado.
			if($objeto->comprobarFila()>0){
				// Se saca las filas devueltas de la consulta y se guarda en $fila
				$fila = $objeto->extraerFilas();

				// Guardo las IDUsuario de las personas destinataria.
				$iddestinatario = $fila["IDUsuario"];

				// Visualizacion de quien regala con el destinatario.
				//echo 'Regala '.$regala[$i].'| Destinario '.$iddestinatario;
				//echo '                              ';

				// Consulta. Para saber la IDRegalo de la persona que regala, $regala.
				$consulta = "
					SELECT regalo.IDRegalo, regalo.Grupo, usuarios.correo, regalo.Destinatario, regalo.Nombre
					FROM regalo
					INNER JOIN usuarios ON usuarios.IDUsuario = regalo.Usuario
					WHERE usuarios.Correo = '$regala[$i]' AND regalo.grupo= $grupo;
				";
				//echo $consulta;
				$objeto->realizarConsultas($consulta);

				// Si devuelve filas significa que subio un regalo.
				if($objeto->comprobarFila()>0){
					// Se extrae las filas obtenidas de la consulta y se guarda en $fila.
					$fila = $objeto->extraerFilas();
					// Se guarda en $idregalo lo obtenido en $fila["IDRegalo"]
					$idregalo = $fila["IDRegalo"];
					$nombreregalo = $fila["Nombre"];
					$destinatarioconsulta = $fila["Destinatario"];
					
					// Renplanza los espacios en blanco, por %20, del nombre del regalo, y lo guarda en la variable $regalonombre.
					$regalonombre = str_replace(" ","%20",$nombreregalo);
					
					// Consulta. Actualiza en la BD el destinatario del regalo.
					$consulta = "UPDATE regalo SET Destinatario=$iddestinatario WHERE IDRegalo=$idregalo;";
					//echo $consulta;
					$objeto->realizarConsultas($consulta);

					// Si devuelve filas sinifica que se actualizo en la bd.
					if($objeto->comprobar()>0){
						// Se envia el correo al invitiado.
						$subject = "Amigo Invisible Regalo";
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

						$message = '
							<html lang="es">
								<head>
									<title>Amigo Invisible</title>
								</head>
								<body>
									<h1>Amigo Invisible</h1>
									<p>
										Hola, ya tienes tu regalo de tu amigo invisible<br/>
										Aqui tienes tu regalo <br/>

										http://22.2daw.esvirgua.com/amigoinvisible/regalos/'.$grupo.'/'.$valor.'/'.$regalonombre.'

									</p>
								</body>
							</html>
						';
						// Envia el correo.
						mail($valor, $subject, $message, $headers);
					}
					// Incrementa el contador.
					$contadorsi++;
				}else // No tiene subido ningun regalo.
					echo "No";
			}else // Ese usuario no existe.
				echo "No";
			// Aumenta el contador.
			$i++;
		}
		echo $contadorsi;
	}
	else // Si hace falta regalos entra en el else
		echo "FaltaRegalos";
		
