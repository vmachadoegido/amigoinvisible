<?php

    // Iniciar sesion
    session_start();

    // Fecha de hoy
    $fechahoy = date('Y-m-d');

    // Importo las operaciones
    require("../assets/operaciones/operaciones.php");

    // Crear el objeto de operaciones.
    $objeto=new operaciones();

    // Comprobar que recibe los la id del grupo..
    if(isset($_POST["idgrupo"]))
    {
        // Guardar variables
        $nombregrupo = $_POST["nombregrupo"];
        $fechareparto = $_POST["fechareparto"];
        $correo = $_SESSION["usuario"];
        $idgrupo = $_POST["idgrupo"];

        // Consulto
        $consulta = "
            SELECT usuarios.IDUsuario, usuarios.Correo, grupos.Nombre, grupos.IDGrupo, grupos.Fecha_Fin, grupos.Propietario
            FROM usuarios
            INNER JOIN grupos ON usuarios.IDUsuario=grupos.Propietario
            WHERE usuarios.Correo = '".$_SESSION["correo"]."'
            AND grupos.IDGrupo = '".$idgrupo."';
        ";

        // Consulta para traer los datos del correo.
        //echo '<br>'.$consulta.'<br>';
        $objeto->realizarConsultas($consulta);

        // Comprueba que devolvio filas.
        if($objeto->comprobarFila()>0)
        {

            // Extrar las filas de la consulta.
            $fila = $objeto->extraerFilas();

            // Guardo el tipo
            $propietario = $fila["Propietario"];
            $idusuario = $fila["IDUsuario"];

            if($propietario == $idusuario)
            {
                // Si esta vacio el nombre del grupo.
                if(empty($nombregrupo))
                {
                    $consulta = "
                        UPDATE grupos
                        SET Fecha_Fin = '".$fechareparto."'
                        WHERE IDGrupo = '".$idgrupo."';
                    ";
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
                else
                {

                    // SI esta vacio la fecha
                    if(empty($fechareparto))
                    {
                        $consulta = "
                        UPDATE grupos
                        SET Nombre = '".$nombregrupo."'
                        WHERE IDGrupo = '".$idgrupo."';
                        ";
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
                    else
                    {
                        if(!empty($nombregrupo) and !empty($nombregrupo))
                        {
                            $consulta= "
                                UPDATE grupos
                                SET Nombre= '".$nombregrupo."', Fecha_Fin = '".$fechareparto."'
                                WHERE IDGrupo = '".$idgrupo."';
                            ";
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
                            else
                                echo 'No';
                    }
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
