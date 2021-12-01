<?php
    //Importo las operaciones
    require("../assets/operaciones/operaciones.php");
	require("../assets/operaciones/operaciones_ftp.php");

    // Crear el objeto de operaciones.
    $objeto = new operaciones();
	$objetoftp=new operaciones_ftp();


	$laidgrupo = 56;


	// Ruta donde tiene que eliminar la carpeta y contenido de esa persona.
	$dir = '../regalos/'.$laidgrupo.'/';
	echo $dir;

	recursiveRemove($dir);


	function recursiveRemove($dir) 
		{
			$structure = glob(rtrim($dir, "/").'/*');
			if (is_array($structure)) 
			{
				foreach($structure as $file) 
				{
					if (is_dir($file)) recursiveRemove($file);
					elseif (is_file($file)) unlink($file);
				}
			}
			rmdir($dir);
		}

	
	// Elimino la carpeta del usuario en ese grupo.  ||| Borrar Carpeta & Regalo.
	//$objetoftp->recursiveRemove($dir);


?>