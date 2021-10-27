<?php


    if(isset($_POST["nombregrupo"]) && isset($_POST["fechareparto"]) && isset($_POST["correo"]))
    {
        
        // En caso que venga vacio el nombre del grupo.
        if(empty($_POST["nombregrupo"]))
        {
            $nombregrupo = "Amigo Invisble";
        }
        else
        {
            $nombregrupo = $_POST["nombregrupo"];
        }
        
        // Guardar variables
        $fechareparto = $_POST["fechareparto"];
        $correo = $_POST["correo"];
        
        // Fecha de hoy
        $fechahoy = date('Y-m-d');
        
        
        
        // Importo las operaciones
        require("../assets/operaciones/operaciones.php");

        // Crear el objeto de operaciones.
        $objeto=new operaciones();

        // Consulta para traer los datos del correo.
        $consulta = "SELECT * FROM usuarios WHERE correo='$correo';";
        //echo '<br>'.$consulta.'<br>';

        $objeto->realizarConsultas($consulta);

        // Comprueba que devolvio filas.
        if($objeto->comprobarFila()>0)
        {

            // Extrar las filas de la consulta.
            $fila = $objeto->extraerFilas();

            // Guardo el tipo
            $usuario = $fila["IDUsuario"];
            $tipo = $fila["Tipo"];
            //$tipo = "a";

            //echo $tipo;
            // Si es tipo p
            if($tipo == "p")
            {

                $consulta = "INSERT INTO grupos (Nombre, Fecha_Inicio, Fecha_Fin, Propietario) VALUES ('".$nombregrupo."', '".$fechahoy."', '".$fechareparto."', '".$usuario."');";
                //print_r($consulta);

                $objeto->realizarConsultas($consulta);
                if($objeto->comprobar()>0)
                {
                    echo 'Si'; 
                }
                else 
                {
                    echo 'No';
                }
            }
            else // Si es tipo a u otro
            {
                echo 'No';
            }
        }
        else // No exite ese correo por lo tanto le regresa a la pagina principal.
        {
            echo 'No';
        }
        
    }else
        echo 'No';


