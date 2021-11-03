<?php

    // Iniciar session
    session_start();

    // Traerme los datos de conexion.
    require("../assets/operaciones/operaciones.php");

    // Crear el objeto de operaciones.
    $objeto=new operaciones();

    // COmprobar que existe la id
    if(isset($_GET["id"]))
    {
        // Guardo la id obtenida en una variable.
        $idgrupo = $_GET["id"];

        // Consulta
        $consulta = "
            SELECT usuarios.IDUsuario, usuarios.Correo, grupos.Nombre, grupos.IDGrupo, grupos.Propietario
            FROM usuarios
            INNER JOIN grupos ON usuarios.IDUsuario=grupos.Propietario
            WHERE usuarios.Correo = '".$_SESSION["correo"]."'";
        //print_r($consulta);
        $objeto->realizarConsultas($consulta);

        // Comprueba que devuelva filas.
        if($objeto->comprobarFila()>0)
        {

            $consulta = "DELETE FROM grupos WHERE IDGrupo='$idgrupo';";
            $objeto->realizarConsultas($consulta);

            if($objeto->comprobar()>0) // Existe ese grupo y lo elimina
            {
                $_SESSION["mensaje"] = "CorrectoE";
                header("Location: http://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php");
            }
            else // Ese grupo no existe. Fue eliminado antes.
            {
                $_SESSION["mensaje"] = "Error";
                header("Location: http://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php");
            }

        }
        else // Esa id no pertenece a esa persona
        {
            $_SESSION["mensaje"] = "Error";
            header("Location: http://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php");
        }
    }
    else // No obtuvo la id del grupo.
    {
        $_SESSION["mensaje"] = "Error";
        header("Location: http://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php");
    }


