<?php

    // Traerme los datos de conexion.
    require("../assets/operaciones/operaciones.php");
    require("../assets/operaciones/crearsesion.php");

    // Crear el objeto de operaciones.
    $objeto=new operaciones();

    // Mostrar todos los datos que revice.
    //print_r($_POST);

    // Asignar a las variables los valores recividos.
    $UserEmail    = isset($_POST["UserEmail"]) ? $_POST["UserEmail"] : null;
    $UserName     = isset($_POST["UserName"]) ?  $_POST["UserName"] : null;
    $UserLastName = isset($_POST["UserLastName"]) ? $_POST["UserLastName"] : null;
    $UserAction   = isset($_POST["UserAction"]) ? $_POST["UserAction"] : null;

    // Inicia la session de las cookies
    session_start();

    // Si el usuario se ha logeado.
    if($UserAction == "login")
    {
        // Busca en $UserEmail (correo) donde hay un '@', y al estar en false devuelve el contenido detras suya.
        $domino = strstr($UserEmail, '@', false);

        // Mensaje para verlo desde consola y comprobar el dominio.
        //echo '<br>> El dominio es: '.$domino.'<br>';


        // Comprobar el dominio
        switch ($domino)
        {
            // ---------------------------------------------------------------------------------------------------------
            // Dominio del Alumno '@alumnado.fundacionloyola.net'
            case '@alumnado.fundacionloyola.net':
                // Comprobar que entra aqui.
                //echo '> Tu dominio es de Alumno';

                // Comprobar que existe en la BD ese correo.
                $consulta = "SELECT * FROM usuarios WHERE Correo='$UserEmail'";
                //echo '<br>La consulta '.$consulta.'<br>';

                $objeto->realizarConsultas($consulta);


                // Si devuelve fila, significa que existe ese alumno en la BD, por lo tanto ya esta registrado.
                if ($objeto->comprobarFila()>0)
                {
                    // Mensaje que indica que esa cuenta esta creada en la BD.
                    //echo '<br>> El Alumno esta guardado.<br>';

                    // Extraigo los datos sacado de la consulta (linea 40) y lo guardo en una variable.
                    $fila = $objeto->extraerFilas();
                    
                    // Creo una raid, donde guardare que esta logeado y los datos de la BD.
                    $respuesta["logged"] = true;
                    $respuesta["info"]   = $fila;

                    // Imprime los datos de la BD. signin.js lo lee.
                    print_r($respuesta);
                                      
                }
                else
                {
                    // Mensaje que el Alumno, no esta registrado.
                    //echo '<br>> El Alumno <b>NO</b> esta guardado.';
                    $consulta = "INSERT INTO usuarios (UserName, UserLastName, Correo, Tipo) VALUES ('$UserName', '$UserLastName', '$UserEmail', 'a')";
                    //echo $consulta;
                    $objeto->realizarConsultas($consulta);

                    // Si devuelve filas, significa que se inserto en la tabla correctamente.
                    if ($objeto->comprobar()>0)
                    {
                        // Comprobar que existe en la BD ese correo.
                        $consulta = "SELECT * FROM usuarios WHERE Correo='$UserEmail'";
                        //echo '<br>La consulta '.$consulta.'<br>';
                        //print_r($consulta);
                        $objeto->realizarConsultas($consulta);

                        // Comprueba que ese correo existe en la tabla usuarios.
                        if ($objeto->comprobarFila()>0)
                        {

                            // Mensaje que indica que esa cuenta esta creada en la BD.
                            //echo '<br>> El Alumno se guardado.<br>';

                            // Extraigo los datos sacado de la consulta (linea 40) y lo guardo en una variable.
                            $fila = $objeto->extraerFilas();

                            // Creo una raid, donde guardare que esta logeado y los datos de la BD.
                            $respuesta["logged"] = true;
                            $respuesta["info"]   = $fila;

                            // Imprime los datos de la BD. signin.js lo lee.
                            print_r($respuesta);
                            
                        }
                        else
                        {
                            // Mensaje que ocurrio un problema
                            //echo '<br>> El Alumno no esta guardado.<br>';
                        }
                    }

                }

                break;
            // ---------------------------------------------------------------------------------------------------------
            // Dominio del Profesor '@fundacionloyola.es'
            case '@fundacionloyola.es':
                // Comprobar que entra aqui.
                //echo '> Tu dominio es de Profesor';

                // Comprobar que existe en la BD ese correo.
                $consulta = "SELECT * FROM usuarios WHERE Correo='$UserEmail'";
                //echo '<br>La consulta '.$consulta.'<br>';
                //print_r($consulta);
                $objeto->realizarConsultas($consulta);


                // Si devuelve fila, significa que existe ese alumno en la BD, por lo tanto ya esta registrado.
                if ($objeto->comprobarFila()>0)
                {
                    // Mensaje que indica que esa cuenta esta creada en la BD.
                    //echo '<br>> El Alumno no esta guardado.<br>';

                    // Extraigo los datos sacado de la consulta (linea 40) y lo guardo en una variable.
                    $fila = $objeto->extraerFilas();

                    // Creo una raid, donde guardare que esta logeado y los datos de la BD.
                    $respuesta["logged"] = true;
                    $respuesta["info"]   = $fila;

                    // Imprime los datos de la BD. signin.js lo lee.
                    print_r($respuesta);
                    

                }
                else
                {
                    // Mensaje que el Alumno, no esta registrado.
                    //echo '<br>> El Alumno <b>NO</b> esta guardado.';
                    $consulta = "INSERT INTO usuarios (UserName, UserLastName, Correo, Tipo) VALUES ('$UserName', '$UserLastName', '$UserEmail', 'p')";
                    //echo $consulta;
                    $objeto->realizarConsultas($consulta);

                    // Si devuelve filas, significa que se inserto en la tabla correctamente.
                    if ($objeto->comprobar()>0)
                    {
                        // Comprobar que existe en la BD ese correo.
                        $consulta = "SELECT * FROM usuarios WHERE Correo='$UserEmail'";
                        //echo '<br>La consulta '.$consulta.'<br>';
                        //print_r($consulta);
                        $objeto->realizarConsultas($consulta);

                        // Comprueba que ese correo existe en la tabla usuarios.
                        if ($objeto->comprobarFila()>0)
                        {

                            // Mensaje que indica que esa cuenta esta creada en la BD.
                            //echo '<br>> El Alumno se guardado.<br>';

                            // Extraigo los datos sacado de la consulta (linea 40) y lo guardo en una variable.
                            $fila = $objeto->extraerFilas();

                            // Creo una raid, donde guardare que esta logeado y los datos de la BD.
                            $respuesta["logged"] = true;
                            $respuesta["info"]   = $fila;

                            // Imprime los datos de la BD. signin.js lo lee.
                            print_r($respuesta);
                            
                            // Crea la cookie
                            setcookie("correo", $UserEmail, false, "/");
                        }
                        else
                        {
                            // Mensaje que ocurrio un problema
                            //echo '<br>> El Alumno no esta guardado.<br>';
                        }
                    }

                }

                break;
            // ---------------------------------------------------------------------------------------------------------
            // El dominio no es valido.
            default:
                //echo '> Este dominio no tiene acceso.';
                $respuesta["logged"] = 0;
                print_r($respuesta);
                break;
        }
    }

?>
