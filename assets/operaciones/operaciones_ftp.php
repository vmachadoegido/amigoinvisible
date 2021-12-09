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

    // Traer los valores de la conexion.
    require("../assets/conexion/connection.php");

	/**
	*	Clase de operaciones sobre el Host.
	*
	*	Recoge la librería de funciones utilizadas sobre el host.
	*/
    class Operaciones_ftp
    {

		/**
        *	Funcion crear una carpeta, en el grupo con esa persona.
		*
        *	@param String $grupoid 			Contiene la id del grupo.
		*	@param String $correousuario 	Contiene el correo del usuario.
		*	@param String $nombretemp 		Contiene el nombre del archivo temporal.
		*	@param String $nombreregalo 	Contiene el nombre del regalo.
		*
		*	@return String Si|No
        */
        function subirarchivo($grupoid, $correousuario,  $nombretemp, $nombreregalo){
            // Si no exite la carpeta
            if(!file_exists('../regalos/'.$grupoid.'/'.$correousuario.'/')){
                // Crea la carpeta
                mkdir('../regalos/'.$grupoid.'/'.$correousuario.'/',0777,true);

                // Si existe esa ruta
                if(file_exists('../regalos/'.$grupoid.'/'.$correousuario.'/')){
                    // Sube el archivo
                    if(move_uploaded_file($nombretemp, '../regalos/'.$grupoid.'/'.$correousuario.'/'.$nombreregalo)){
                        return "Si";
                    }else{
                        return "No";
                    }
                }
            }else // Si existe la carpeta lo sube directamente.{
                // Sube al archivo
                if(move_uploaded_file($nombretemp, '../regalos/'.$grupoid.'/'.$correousuario.'/'.$nombreregalo)){
                    return "Si";
                }else{
                    return "No";
                }
        }

		/**
        *	Funcion eliminar carpetas con sus archivos. (No funciona con SubCarpetas).
		*
        *	@param String $dir 			Contiene la ruta a eliminar.
		*
		*	@return String Si|No
        */
		
		function eliminarcarpeta($dir){
			$files = scandir($dir);
			array_shift($files);    // Elimina '.' de la array
			array_shift($files);    // Elimina '..' de la array

			foreach ($files as $file){
				$file = $dir . '/' . $file;
				if (is_dir($file)){
					rmdir_recursive($file);
					rmdir($file);
				}else{
					unlink($file);
				}
			}
			rmdir($dir);
		}

		/**
        *	Funcion eliminar carpetas con sus archivos. (Sirve para SubCarpetas).
		*
        *	@param String $dir 			Contiene la ruta a eliminar.
		*
        */
		
		function eliminarsubcarpetas($dir){
			$structure = glob(rtrim($dir, "/").'/*');
			if (is_array($structure)){
				foreach($structure as $file){
					if (is_dir($file)) recursiveRemove($file);
					elseif (is_file($file)) unlink($file);
				}
			}
			rmdir($dir);
		}
		
		/**
        *	Funcion eliminar archivos.
		*
        *	@param String $grupoid 				Contiene la id del grupo
		*	@param String $correousuario 		Contiene el correo del usuario.
		*	@param String $nombreregaloanitguo 	Contiene el nombre del regalo antiguo.
		*
		*	@return String Si|No
        */
        function eliminararchivo($grupoid, $correousuario, $nombreregaloanitguo){
            if(unlink('../regalos/'.$grupoid.'/'.$correousuario.'/'.$nombreregaloanitguo.'')){
              return "Si";
            }else{
              echo "No";
            }
        }

		/**
        *	Funcion para renombrar un archivo.
		*
        *	@param String $grupoid 				Contiene la id del grupo
		*	@param String $correousuario 		Contiene el correo del usuario.
		*	@param String $nombreregaloanitguo 	Contiene el nombre del regalo antiguo.
		*
        */
		function renombrarmismo($grupoid, $correousuario, $nombreregaloantiguo){
			rename("../regalos/'.$grupoid.'/'.$correousuario.'/'.$nombreregaloantiguo.'", "../regalos/'.$grupoid.'/'.$correousuario.'/archivotemp");
		}

    }



?>
