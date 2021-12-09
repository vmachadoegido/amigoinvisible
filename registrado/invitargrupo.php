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

    // Se guarda lo recivido en variables.
    $arrayinvitado = $_POST["correoinvitadoarray"];
    $grupoid = $_POST["grupoid"];
    $usuario = $_SESSION["correo"];
	// Variable contador.
	$contadorsi = 0;

	// Se recorre la $arrayinvitado, para ir haciendo las acciones.
    foreach ($arrayinvitado as $valor){
        // Si son distintos las variables entra al if en caso cotnrario al else.
        if($usuario != $valor){
            // Consulta. Muestra los datos de la tabla invitado, si existe con la id del grupo y el correo introducido.
            $consulta = "SELECT * FROM invitado WHERE IDGrupo = '".$grupoid."' AND Correo = '".$valor."';";
            $objeto->realizarConsultas($consulta);

            // Si devuelve filas, significa que ese correo ya fue invitado a ese grupo.
            // Por lo tanto no lo guarda y lo ignora.
            if($objeto->comprobar()>0){
				
			}else /* Si no devuelve filas, significa que ese correo no fue invitado a ese grupo y lo introduce. */ {
				// Si valor contiene algo.
				if(!empty($valor)){
					// Consulta. Inserta el correo invitado al grupo que se le invitado.
					$consulta = "INSERT INTO invitado (IDGrupo, Correo) VALUES ('".$grupoid."', '".$valor."');";
					$objeto->realizarConsultas($consulta);

					// Comprueba si devuelve filas. Si lo hace significa que fue agregado a la tabla y se le envia un correo.
					if($objeto->comprobar()>0){
						// Se envia el correo al invitiado.
						$subject = "Amigo Invisible";
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
										Hola, has sido invitado a un grupo de amigo invisible.<br/>
										Inicia sesion en https://22.2daw.esvirgua.com/amigoinvisible.
									</p>
								</body>
							</html>
						';
						// Envia el correo.
						mail($valor, $subject, $message, $headers);
					}

					// Aumenta el contador, al ser agregado a la BD.
					$contadorsi++;
				}
            }
        }else /* Si se invita a si mismo, le salta este error, aun asi invita a los demas correos.*/
        	echo 'Mismo';
    }
// Variable que muestra las veces que se agrego un correo.
echo $contadorsi;




