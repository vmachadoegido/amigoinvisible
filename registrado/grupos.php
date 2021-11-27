<?php
    // Iniciar session
    session_start();

    // Traerme los datos de conexion.
    require("../assets/operaciones/operaciones.php");
    // Crear el objeto de operaciones.
    $objeto=new operaciones();

    require("../assets/operaciones/procesosapp.php");
    $objetoprocesosapp = new precososapp();


?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Victor Manuel Machado Egido">
        <title>Amigo Inivible - Inicio</title>

        <!-- Logo de la empresa en la pestaña -->
        <link rel="shortcut icon" href="../assets/imagenes/logo.png" />

        <!-- Boostrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

        <!-- Fontawesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.css" integrity="sha512-CB+XYxRC7cXZqO/8cP3V+ve2+6g6ynOnvJD6p4E4y3+wwkScH9qEOla+BTHzcwB4xKgvWn816Iv0io5l3rAOBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Estilos Generales -->
        <link href="../assets/css/estilo.css" rel="stylesheet">

        <!-- Libreria de Alertas -->
        <!-- Pagina https://sweetalert2.github.io -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <!-- Librerias para jquere, google, boostrap, etc. -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <!-- Librerias personales -->
        <script type="text/javascript" src="../assets/js/creargrupo.js"></script>
        <script type="text/javascript" src="../assets/js/funciones.js"></script>


    </head>
    <body>
        <!-- Comprobar que la sesion correo existe -->
        <?php

            // Si no hay sesion correo, mensaje de alerta.
            if(!isset($_SESSION["correo"]))
            {
                // Mensaje de alerta que no ha iniciado sesion
                echo '<script> nologeado(); </script>';
            }

            // Creo la variable de la fecha
            $fechahoy = date('Y-m-d');
        ?>

        <!-- Comprobar mensaje de error -->
        <?php

            if(isset($_SESSION["mensaje"]))
            {
                // Mensaje si se elimino el grupo
                if($_SESSION["mensaje"] == "CorrectoE")
                {
                    echo '<script> correctoeliminado(); </script>';
                    unset($_SESSION["mensaje"]);
                }
                // Mensaje de error.
                if($_SESSION["mensaje"] == "Error")
                {
                    echo '<script> error(); </script>';
                    unset($_SESSION["mensaje"]);
                }
            }
        ?>

         <!-- Revisa si esta invitado algun grupo y lo registra -->
        <?php
            // Guardo la variable de la sesion del correo.
            $correo = $_SESSION["correo"];

            // Consulta. Buscar si ese correo esta invitado algun grupo.
            $consulta = "
                SELECT *
                FROM invitado
                WHERE Correo = '".$correo."';
            ";
            //print_r($consulta);
            $objeto->realizarConsultas($consulta);

            // Si devuelve filas, significa que ese correo esta invitado algun grupo y entra en el if.
            if($objeto->comprobarFila()>0)
            {
                // Se extrae el resultado de la consulta y se guarda en bucle en $fila, y a continuacion se va guardando la IDGrupo en una array
                while($fila = $objeto->extraerFilas())
                {
                    // Guardo el dato recibido de la fila IDGrupo en una variable.
                    $array[] = $fila["IDGrupo"];

                }
                // Se recorre la array con los valores de la IDGrupos, que es invitado el usuario.
                foreach($array as $valor)
                {
                    //echo $valor.'-';
                    // Consulta. Comprueba si el correo y el grupo de la invitacion ya esta fue registrado o no.
                    $consulta ="
                        SELECT usuarios.IDUsuario, usuarios.Correo, grupos.IDGrupo, grupos.Propietario
                        FROM usuarios
                        INNER JOIN usuariogrupo ON usuariogrupo.IDUsuario = usuarios.IDUsuario
                        INNER JOIN grupos ON grupos.IDGrupo = usuariogrupo.IDGrupo
                        WHERE usuarios.Correo = 'vmachadoegido.guadalupe@alumnado.fundacionloyola.net' AND grupos.IDGrupo = '".$valor."';
                    ";
                    //print($consulta);
                    //echo '<br><br>';
                    $objeto->realizarConsultas($consulta);

                    // Si devuelve filas, significa que ese correo ya esta registrado en ese grupo.
                    if($objeto->comprobarFila()>0)
                    {
                        echo '<script> console.log("Ya esta registrado en el grupo"); </script>';
                    }
                    else // Si entra aqui significa, que no esta registrado en el grupo.
                    {
                        echo '<script> console.log("No esta registrado en el grupo"); </script>';

                        $consulta ="
                            SELECT IDUsuario, Correo
                            FROM usuarios
                            WHERE usuarios.Correo = '".$correo."';
                        ";
                        //print($consulta);

                        $objeto->realizarConsultas($consulta);
                        if($objeto->comprobarFila()>0)
                        {
                            // Extrar las filas de la consulta.
                            $fila = $objeto->extraerFilas();

                            //echo '<br>IDUsuario: '.$fila["IDUsuario"].'-'.$valor.'<br><br>';
                            // Se guarda la IDUsuario en una variable.
                            $idusuario = $fila["IDUsuario"];

                            // Se introduce la IDUsurio y la IDGrupo del invitado
                            $consulta = "INSERT INTO usuariogrupo (IDUsuario, IDGrupo) VALUES ('".$idusuario."', '".$valor."')";
                            $objeto->realizarConsultas($consulta);

                            // Si devuelve filas significa que se inserto correctamente.
                            if($objeto->comprobar()>0)
                            {
                                echo '<script> console.log("Se agrego el usuario al grupo"); </script>';
                            }
                            else // No se inserto los datos.
                            {
                                echo '<script> console.log("Hubo un problema al agregar el usuario al grupo"); </script>';
                            }
                        }
                    }
                }
            }
        ?>

        <!-- Se comprueba si hay una id en la url -->
        <?php

            // Comprueba si existe la variable $_GET["id"].
            // En caso que exista entra en el if por lo contrario no hace nada.
            if(isset($_GET["id"]))
            {
                // Comprueba si la variable $_GET["opcion"] es igual a 'ed' (editar), en caso que no sea asi se va al else.
                // Ejecuta la ventana modal de editar grupo. Lo hace visible.
                if($_GET["opcion"]=='ed')
                {
                    echo '<script>
                            $(document).ready(function(){
                              $("#ventanaeditargrupo").modal();
                            });
                        </script>';
                }
                else
                {
                    // Opcion para invitado
                    if($_GET["opcion"]=='in')
                    {
                        echo '<script>
                            $(document).ready(function(){
                              $("#ventanainvitargrupo").modal();
                            });
                        </script>';
                    }
                    else
                    {
                        // Opcion para expulsar
                        if($_GET["opcion"]=='ex' and isset($_GET["correo"]) and isset($_GET["id"]))
                        {
                            // Consulta. Comprueba si existe en la invitacion con ese grupo
                            $consulta ="
                                SELECT *
                                FROM invitado
                                WHERE Correo = '".$_GET["correo"]."' AND IDGrupo = '".$_GET["id"]."';
                            ";
                            //print($consulta);
                            $objeto->realizarConsultas($consulta);

                            // Si devuelve fila significa que esta en la tabla invitado.
                            if($objeto->comprobarFila()>0)
                            {

                                // Consulta. Eliminar la invitacion de esa persona.
                                $consulta = "DELETE FROM invitado WHERE invitado.Correo = '".$_GET["correo"]."';";
                                //print($consulta);
                                $objeto->realizarConsultas($consulta);

                                // Si devuelve fila significa que fue eliminado corectamente.
                                if($objeto->comprobar()>0)
                                {
                                    echo '<script> console.log("Fue eliminado la invitacion."); </script>';

                                    // Consulta. Comprueba que ese usuario pertenece a ese grupo.
                                    $consulta ="
                                        SELECT usuarios.IDUsuario, usuarios.Correo, usuariogrupo.IDUsuario, usuariogrupo.IDGrupo
                                        FROM usuarios
                                        INNER JOIN usuariogrupo ON usuariogrupo.IDUsuario = usuarios.IDUsuario
                                        WHERE usuarios.Correo = '".$_GET["correo"]."' AND usuariogrupo.IDGrupo = '".$_GET["id"]."';
                                    ";
                                    //print($consulta);
                                    $objeto->realizarConsultas($consulta);

                                    // Si devuelve fila significa que ese correo pertenecia a un grupo.
                                    if($objeto->comprobarFila()>0)
                                    {
                                        // Consulta. Elimina al usuario del grupo.
                                        $consulta = "DELETE FROM usuariogrupo WHERE usuariogrupo.IDGrupo = '".$_GET["id"]."'";
                                        $objeto->realizarConsultas($consulta);

                                        // Si devuelve filas significa que fue borraro corectamente.
                                        if($objeto->comprobar()>0)
                                        {
                                            echo '<script> console.log("Fue eliminado del grupo."); </script>';
                                            echo '<script> correctoexpulsado(); </script>';
                                            echo "<script>

                                                Swal.fire({
                                                  icon: 'success',
                                                  title: 'Correcto',
                                                  text: 'Expulsado Correctamente',
                                                  confirmButtonColor: '#3085d6',
                                                  cancelButtonColor: '#d33',
                                                  confirmButtonText: 'Actualizar'
                                                }).then((result) => {
                                                  if (result.isConfirmed)
                                                  {
                                                        window.location.href = 'https://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php';
                                                  }
                                                  else
                                                  {
                                                        window.location.href = 'https://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php';
                                                  }
                                                })

                                            </script>";
                                        }

                                    }
                                    else // Si no devuelve filas, significa que ese usuario no se registro en la web.
                                    {
                                        echo '<script> correctoexpulsado(); </script>';
                                    }

                                }
                            }
                        }
                        else
                        {
                            if($_GET["opcion"]=='ex')
                            {
                                echo '<script>
                                    $(document).ready(function(){
                                      $("#ventanaexpulsarinvitargrupo").modal();
                                    });
                                </script>';
                            }
                            else
                            {
                                if($_GET["opcion"]=='subir')
                                {
                                    echo '<script>
                                        $(document).ready(function(){
                                          $("#ventanasbuirregalo").modal();
                                        });
                                    </script>';
                                }
                                else
                                {
                                    if($_GET["opcion"]=='emp')
                                    {
                                        echo '<script>
                                            $(document).ready(function(){
                                              $("#ventanaemparejar").modal();
                                            });
                                        </script>';
                                    }
                                    else
                                    {
                                        
                                        if($_GET["opcion"]=='ver' and isset($_GET["id"]))
                                        {
                                            
                                            $idgrupo = $_GET["id"];
                                            $consulta="
                                                SELECT regalo.Ruta, regalo.Nombre
                                                FROM usuarios
                                                INNER JOIN regalo ON regalo.Usuario = usuarios.IDUsuario
                                                WHERE usuarios.Correo = '".$_SESSION["correo"]."' AND regalo.Grupo = $idgrupo;
                                            ";
                                            //echo $consulta2.'</br>';
                                            $objeto->realizarConsultas($consulta);


                                            if($objeto->comprobarFila()>0)
                                            {
                                                $fila = $objeto->extraerFilas();
                                                //echo '<a href="/amigoinvisible/regalos/'.$idgrupo.'/'.$_SESSION["correo"].'/'.$fila["Nombre"].'" target="_blank" type="button" class="btn btn-sm btn-outline-secondary">Ver Regalo</a>';
                                                header('Location: amigoinvisible/regalos/'.$idgrupo.'/'.$_SESSION["correo"].'/'.$fila["Nombre"].' ');
                                            }
                                            else
                                           {
                                                echo '<td>Sin Regalo</td>';
                                            }
                                        }
                                        

                                        
                                    }
                                }
                            }
                        }
                    }
                }
            }
        ?>

        <div id="info"></div>

        <!-- Cabezera - Navegador -->
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
            <!-- Imagen de la corpoativa -->
            <a href="" class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <img src="https://fundacionloyola.com/vguadalupe/wp-content/uploads/2019/12/logotipo.png" alt="Imagen Corporativa del Colegio" width="170" height="86" title="logotipo">
            </a>
            <!-- Opciones del navegador -->
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="http://22.2daw.esvirgua.com/amigoinvisible/registrado/" class="nav-link px-2 link-secondary">Inicio</a></li>
                <li><a href="http://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php" class="nav-link px-2 link-dark">Mis grupos</a></li>
            </ul>
        </header>

        <!-- Cabecera, titulo del sitio con foto -->
        <div id="cabezera">
            <div class="cabezera-titulo">Amigo Inivisle</div>
        </div>

        <!-- Contenedor -->
        <div class="py-5 text-center container">
            <div class="row py-lg-5 cancelarpaddingtop">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <!-- Titulo -->
                    <h1 class="fw-light">Mis Grupos</h1>
                    <!-- Separador -->
                    <hr class="rayas">
                </div>
            </div>
        </div>

        <!-- Contenedor de grupo -->
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <!-- Bucle Card -->
                    <?php
                        // Si la variable $_SESSION["rol"] contiene una "p" entra al if, en caso contrario al else
                        if($_SESSION["rol"] == "p")
                        {
                            // Consulta, donde saca la informacion donde el usuario que se obtiene de $_SESSION["correo"], sea propietario.
                            $consulta = "
                                SELECT usuarios.IDUsuario, usuarios.Correo, grupos.Nombre, grupos.IDGrupo, grupos.Fecha_Fin, grupos.Propietario
                                FROM usuarios
                                INNER JOIN grupos ON usuarios.IDUsuario=grupos.Propietario
                                WHERE usuarios.Correo = '".$_SESSION["correo"]."'
                                ORDER BY grupos.Fecha_Fin ASC";
                            //print_r($consulta);
                            $objeto->realizarConsultas($consulta);

                            // Comprueba si devuelve o no filas la consulta.
                            // En caso devolver significa que ese usuario es propietario de un grupo y ejecuta en bucle la info.
                            // En caso que no devuelva signicia que ese usuario no es propietario de ningun grupo.
                            if($objeto->comprobarFila()>0)
                            {
                                // Extraer filas - Bucle para todos los grupos que gestione.
                                // Extrae las filsa de la consulta, y lo va mostrando con sus diferenes opciones de gestion.
                                while($fila = $objeto->extraerFilas())
                                {
                                    echo '<div class="col cardtamano">';
                                        echo '<div class="card shadow-sm">';
                                            echo '<div class="card-body">';
                                                echo '<h5 class="card-title">'.$fila["Nombre"].'</h5>';
                                                echo '<p class="card-text">';
                                                echo 'Fecha Reparto: '.$fila["Fecha_Fin"].'';
                                                echo '</p>';
                                                echo '<div class="d-flex justify-content-between align-items-center cardbotones">';
                                                    echo '<div class="btn-group row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-4 g-3">';
                                                        echo '<a href="grupos.php?id='.$fila["IDGrupo"].'&opcion=ed" type="button" class="btn btn-sm btn-outline-secondary">Editar</a>';
                                                        //echo '<button type="button" class="btn btn-sm btn-outline-secondary">Invitar</button>';
                                                        echo '<a href="grupos.php?id='.$fila["IDGrupo"].'&opcion=in" type="button" class="btn btn-sm btn-outline-secondary">Invitar</a>';
                                                        echo '<a href="grupos.php?id='.$fila["IDGrupo"].'&opcion=ex" type="button" class="btn btn-sm btn-outline-secondary">Expulsar</a>';
                                                        echo '<a href="grupos.php?id='.$fila["IDGrupo"].'&opcion=emp" type="button" class="btn btn-sm btn-outline-secondary">Emparejar</a>';
                                                        echo '<a href="eliminargrupo.php?id='.$fila["IDGrupo"].'" type="button" class="btn btn-sm btn-outline-secondary">Eliminar</a>';
                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                }
                            }
                        }
                        else
                        {
                            // Si la variable $_SESSION["rol"], contiene una "a" entra en el if, en caso que no lo sea no hace nada.
                            if($_SESSION["rol"] == "a")
                            {
                                // Consulta. Donde busca que grupo pertenece el usuario.
                                $consulta = "
                                    SELECT usuarios.IDUsuario, usuarios.Correo, grupos.IDGrupo, grupos.Nombre, grupos.Fecha_Inicio, grupos.Fecha_Fin, grupos.Propietario
                                    FROM usuarios
                                    INNER JOIN usuariogrupo ON usuarios.IDUsuario=usuariogrupo.IDUsuario
                                    INNER JOIN grupos ON usuariogrupo.IDGrupo=grupos.IDGrupo
                                    WHERE usuarios.correo = '".$_SESSION["correo"]."'
                                    ORDER BY grupos.Fecha_Fin ASC";
                                //print_r($consulta);
                                $objeto->realizarConsultas($consulta);

                                // Comprueba que devuelva filas la consulta.
                                // Si devuelve filas mostrara los datos de los grupos que pertenece.
                                // Si no devuelve filas no hara nada.
                                if($objeto->comprobarFila()>0)
                                {

                                    // Extraer filas - Bucle para todos los grupos que participa.
                                    // Extrae las filas de la consulta y lo va mostrando en diferentes tarjetas.
                                    while($fila = $objeto->extraerFilas())
                                    {
                                        echo '<div class="col cardtamano">';
                                            echo '<div class="card shadow-sm">';
                                                echo '<div class="card-body">';
                                                    echo '<h5 class="card-title">'.$fila["Nombre"].'</h5>';
                                                    echo '<p class="card-text">';
                                                        echo 'Fecha Reparto: '.$fila["Fecha_Fin"].'';
                                                    echo '</p>';
                                                    echo '<div class="d-flex justify-content-between align-items-center cardbotones">';
                                                        echo '<div class="btn-group row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-4 g-3">';
                                                            echo '<a href="grupos.php?id='.$fila["IDGrupo"].'&opcion=subir" type="button" class="btn btn-sm btn-outline-secondary">Subir Regalo</a>';

                                                            $idgrupover = $fila["IDGrupo"];
                                                            $usuario = $_SESSION["correo"];
                                        

                                                            //$objetoprocesosapp->verregalo($idgrupover, $usuario);
                                        
                                        
//                                                            $consulta2="
//                                                                SELECT regalo.Ruta, regalo.Nombre
//                                                                FROM usuarios
//                                                                INNER JOIN regalo ON regalo.Usuario = usuarios.IDUsuario
//                                                                WHERE usuarios.Correo = '".$_SESSION["correo"]."' AND regalo.Grupo = $idgrupover;
//                                                            ";
//                                                            echo $consulta2.'</br>';
//                                                            $objeto->realizarConsultas($consulta2);
//
//
//                                                            if($objeto->comprobarFila()>0)
//                                                            {
//                                                                $fila2 = $objeto->extraerFilas();
//                                                                echo '<a href="/amigoinvisible/regalos/'.$idgrupover.'/'.$_SESSION["correo"].'/'.$fila2["Nombre"].'" target="_blank" type="button" class="btn btn-sm btn-outline-secondary">Ver Regalo</a>';
//
//                                                            }
//                                                            else
//                                                            {
//                                                                echo '<td>Sin Regalo</td>';
//                                                            }


                                                            echo '<a href="grupos.php?id='.$fila["IDGrupo"].'&opcion=ver" type="button" class="btn btn-sm btn-outline-secondary">Ver Regalo</a>';
                                                        echo '</div>';
                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                    }
                                    
                                    
                                    
                                    
                                    
                                }
                            }
                        }

                    ?>

                <!-- Card Plantilla -->
<!--
                <div class="col cardtamano">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Grupo 2</h5>
                            <p class="card-text">
                                Fecha Reparto: 23/10/2021
                            </p>
                            <div class="d-flex justify-content-between align-items-center cardbotones">
                                <div class="btn-group row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-4 g-3">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Editar</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Invitar</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Expulsar</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Emparejar</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
-->

                </div>
            </div>
        </div>

        <!-- Boton para agregar grupos. Solo perfil Profesor-->
        <?php
            if($_SESSION["rol"]=="p")
            {
                echo '<button class="botonagregar" data-toggle="modal" data-target="#ventanacreargrupo">';
                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">';
                        echo '<circle cx="12" cy="12" r="10"></circle>';
                        echo '<line x1="12" y1="8" x2="12" y2="16"></line>';
                        echo '<line x1="8" y1="12" x2="16" y2="12"></line>';
                    echo '</svg>';
                echo '</button>';
            }
        ?>

        <!-- Ventana Modal - Crear Grupo -->
        <div class="modal fade" id="ventanacreargrupo" tabindex="-1" role="dialog" aria-labelledby="titulocreargrupo" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="titulocreargrupo">Crear nuevo Grupo</h5>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <label for="nombregrupo" required>Nombre del Grupo </label>
                            <input type="text" id="nombregrupo" name="nombregrupo" placeholder="Nombre del Grupo" required/><br/><br/>
                            <label for="fechareparto" required>Fecha del Reparo</label>
                            <?php echo '<input type="date" id="fechareparto" name="trip-start" value="'.$fechahoy.'" required/>'; ?>
                            <input type="submit" id="crear" value="Crear" name="Crear">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" type="button" data-dismiss="modal">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ventana Modal - Editar Grupo -->
        <div class="modal fade" id="ventanaeditargrupo" tabindex="-1" role="dialog" aria-labelledby="tituloeditargrupo" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="tituloeditargrupo">Editar Grupo <?php echo ''.$_GET["id"].''?></h5>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <input type="hidden" id="idgrupo" value="<?php echo ''.$_GET["id"].''?>">
                            <label for="nombregrupo2" required>Nuevo nombre del Grupo</label>
                            <input type="text" id="nombregrupo2" name="nombregrupo" placeholder="Nombre del Grupo" required/><br/><br/>
                            <label for="fechareparto" required>Nueva Fecha del Reparo</label>
                            <?php echo '<input type="date" id="fechareparto2" name="trip-start" value="'.$fechahoy.'" required/>'; ?>
                            <input type="submit" id="editar" value="Editar" name="Editar">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" type="button" data-dismiss="modal">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ventana Modal - Agregar Invitado -->
        <div class="modal fade" id="ventanainvitargrupo" tabindex="-1" role="dialog" aria-labelledby="tituloinvitargrupo" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="tituloinvitargrupo">Invitar al Grupo <?php echo ''.$_GET["id"].''?></h5>
                    </div>
                    <div class="modal-body">
                        <form id="invitadoform" method="POST">
                            <input type="hidden" id="idgrupoinvitado" value="<?php echo ''.$_GET["id"].''?>">
                            <label for="invitado[]">Correo del invitado</label>
                            <input type="email" id="invitadocorreo" class="inputinvitar" name="invitado[]">
                        </form>
                        <button id="agregarfila">Agregar</button>
                    </div>
                    <div class="modal-footer">
                        <button id="invitar" class="btn btn-success" type="button" data-dismiss="modal">
                            Invitar
                        </button>
                        <button class="btn btn-warning" type="button" data-dismiss="modal">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ventana Modal - Expulsar Invitado -->
        <div class="modal fade" id="ventanaexpulsarinvitargrupo" tabindex="-1" role="dialog" aria-labelledby="tituloexpulsarinvitargrupo" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="tituloexpulsarinvitargrupo">Expulsar del Grupo <?php echo ''.$_GET["id"].''?></h5>
                    </div>
                    <div class="modal-body">
                        <?php

                            if($_GET["opcion"]=='ex')
                            {
                                // Consulta. Busca los correo que estan invitado al grupo selecionado.
                                $consulta = "SELECT * FROM invitado WHERE IDGrupo = '".$_GET["id"]."';";

                                $objeto->realizarConsultas($consulta);

                                if($objeto->comprobarFila()>0)
                                {
                                    while($fila = $objeto->extraerFilas())
                                    {
                                        echo '<table>';
                                            echo '<tr>';
                                                echo '<td>';
                                                    echo '<a href="grupos.php?id='.$fila["IDGrupo"].'&opcion=ex&correo='.$fila["Correo"].'">';
                                                        echo '<i class="fa fa-trash-o" aria-hidden="true"></i> ';
                                                    echo '</a>  ';
                                                    echo $fila["Correo"];
                                                echo '</td>';
                                            echo '</tr>';
                                        echo '</table>';
                                    }
                                }
                                else
                                {
                                    echo '<script> error(); </script>';
                                }
                            }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button id="expulsar" class="btn btn-success" type="button" data-dismiss="modal">
                            Expulsar
                        </button>
                        <button class="btn btn-warning" type="button" data-dismiss="modal">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ventana Modal - Subir Regalo -->
        <div class="modal fade" id="ventanasbuirregalo" tabindex="-1" role="dialog" aria-labelledby="titulosubirregalo" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="titulosubirregalo">Subir Regalo <?php echo 'grupo '.$_GET["id"].''?></h5>
                    </div>
                    <div class="modal-body">
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" id="usuarioregalo" value="<?php echo ''.$_SESSION["correo"].''; ?>"/>
                            <input type="hidden" id="gruporegalo" value="<?php echo ''.$_GET["id"].''; ?>"/>
                            <label for="regalo">Sube tu Regalo.</label>
                            <input type="file" name="archivo" id="regalo" maxlength="45" required/>
                            <input type="submit" id="subiregalo" value="Subir" name="Subir">
                        </form>
                        <?php
                            // Si existe la variable $_FILES['archivo'] entra en el if.
                            if(isset($_FILES['archivo']))
                            {
                                // Traer las operaciones de ftp
                                //require("../assets/operaciones/procesosapp.php");
                                //$objetoprocesosapp = new precososapp();

                                // Guardar en variables los datos que se enviaron.
                                $nombretemp = $_FILES['archivo']['tmp_name'];
                                $nombreregalo = $_FILES['archivo']['name'];
                                $formato = $_FILES['archivo']['type'];
                                $volumen = $_FILES['archivo']['size'];
                                $grupoid = $_GET["id"];
                                $correousuario = $_SESSION["correo"];
                                $fechahoy = date('Y-m-d');

                                // Si el formato es desconocido
                                if($formato == 'application/octet-stream' OR $formato == 'application/octet-stream')
                                {
                                    echo '<script> errortipoarchivo(); </script>';
                                }
                                else
                                {
                                    // Consulta la cual devuelve filas si ese usuario ya subio algun regalo.
                                    $consulta = "
                                        SELECT usuarios.Correo, usuarios.IDUsuario, regalo.IDRegalo, regalo.Grupo, regalo.Nombre
                                        FROM usuarios, regalo
                                        WHERE usuarios.Correo = '".$correousuario."' AND regalo.Grupo = $grupoid;
                                    ";

                                    //echo $consulta;
                                    $objeto->realizarConsultas($consulta);

                                    // Si devuelve filas, significa que ese usuario ya subio algun correo.
                                    if($objeto->comprobarFila()>0)
                                    {
                                        // Se extrae las filas.
                                        $fila = $objeto->extraerFilas();

                                        // Se guarda en una variable el nombre del regalo anterior.
                                        $nombreregaloanitguo = $fila["Nombre"];
                                        $idusaruio = $fila["IDUsuario"];

                                        // Funcion, se le envia los datos y si retorna un Si entra. Significa que se subio el archivo.
                                        if($objetoprocesosapp->subirarchivo($grupoid, $correousuario, $nombretemp, $nombreregalo) == "Si")
                                        {
                                            // Funcion que elimina el archivo antiguo. Si retorna Si entra. Signficia que se elimino.
                                            if($objetoprocesosapp->eliminararchivo($grupoid, $correousuario, $nombreregaloanitguo) == "Si")
                                            {
                                                // Consulta. Actualizar los datos de la BD con el nuevo regalo.
                                                $consulta = "
                                                    UPDATE regalo
                                                    SET
                                                    Nombre = '$nombreregalo',
                                                    Volumen = $volumen,
                                                    Formato = '$formato',
                                                    Ruta = 'amigoinvisible/regalos/$grupoid/$correousuario',
                                                    Fecha_Subida = '$fechahoy',
                                                    Grupo = $grupoid,
                                                    Usuario = $idusaruio
                                                    WHERE Grupo = $grupoid AND Usuario = $idusaruio;
                                                ";

                                                //cho $consulta;
                                                $objeto->realizarConsultas($consulta);

                                                // Si deuvelve filas significa que se actualizo los datos.
                                                if($objeto->comprobar()>0)
                                                {
                                                    echo '<script> correctosubido(); </script>';
                                                }
                                                else
                                                {
                                                    echo '<script> error(); </script>';
                                                }
                                            }
                                            else // Fallo al actualizar los datos.
                                            {
                                                echo '<script> error(); </script>';
                                            }
                                        }
                                        else // Si fallo la subida del archivo.
                                        {
                                            echo '<script> error(); </script>';
                                        }
                                    }
                                    else // Si entra aqui significa que es la primera subida de regalo.
                                    {
                                        // Consulta para sacar la ID del usuario.
                                        $consulta = "
                                            SELECT IDUsuario, Correo
                                            FROM usuarios
                                            WHERE Correo = '$correousuario';
                                        ";
                                        //echo $consulta;
                                        $objeto->realizarConsultas($consulta);

                                        // Si devuelve filas significa que existe ese usuario.
                                        if($objeto->comprobarFila()>0)
                                        {
                                            // Extraigo las filas de la consulta
                                            $fila = $objeto->extraerFilas();

                                            // Guardo en una variable la id del usuario.
                                            $idusuario = $fila["IDUsuario"];


                                            // Subimos el regalo en el servidor, en la carpeta del grupo y su correo.
                                            if($objetoprocesosapp->subirarchivo($grupoid, $correousuario, $nombretemp, $nombreregalo) == "Si")
                                            {
                                                //echo '<script> correctosubido(); </script>';

                                                // Consulta. Inserta los datos en la tabla regalo con los datos recibido del formulario de subida de regalo.
                                                $consulta = "
                                                    INSERT INTO regalo (Volumen, Nombre, Formato, Ruta, Fecha_Subida, Grupo, Usuario)
                                                    VALUES ($volumen, '$nombreregalo', '$formato', 'amigoinvisible/regalos/$grupoid/$correousuario', '$fechahoy', $grupoid, $idusuario);

                                                ";
                                                $objeto->realizarConsultas($consulta);
                                                //echo $consulta;

                                                // Si devuelve filas, significa que se agrego en la bd los datos.
                                                if($objeto->comprobar()>0)
                                                {
                                                    echo '<script> correctosubido(); </script>';
                                                }
                                                else
                                                {
                                                    echo '<script> error(); </script>';
                                                }
                                            }
                                            else
                                            {
                                                echo '<script> error(); </script>';
                                            }
                                        }
                                        else
                                        {
                                            echo '<script> error(); </script>';
                                        }
                                    }
                                }
                            }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" type="button" data-dismiss="modal">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Ventana Modal - Emparejar -->
        <div class="modal fade" id="ventanaemparejar" tabindex="-1" role="dialog" aria-labelledby="tituloemparejar" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="tituloemparejar">Emparejamiento <?php echo ''.$_GET["id"].''?></h5>
                    </div>
                    <div class="modal-body">
                        <?php

                            // Consulta. Sirve para mostrar los usuarios del grupo.
                            $consulta = "
                                SELECT grupos.IDGrupo, usuarios.IDUsuario, usuarios.Correo
                                FROM grupos
                                INNER JOIN usuariogrupo ON usuariogrupo.IDGrupo = grupos.IDGrupo
                                INNER JOIN usuarios ON usuarios.IDUsuario = usuariogrupo.IDUsuario
                                WHERE grupos.IDGrupo = ".$_GET["id"].";
                            ";

                            //echo $consulta;
                            $objeto->realizarConsultas($consulta);

                            // Si devuelve filas significa que ese grupo tiene usuarios.
                            if($objeto->comprobarFila()>0)
                            {
                                // Guarda todos los correo en una array.
                                while($fila = $objeto->extraerFilas())
                                {
                                    // Va guardando lo obtenido de la fila Correo en la array.
                                    $array[] = $fila["Correo"];
                                }

                                // Visualizar la array, con la lista de usuarios del grupo.
                                /*
                                foreach($array as $valores)
                                {
                                    echo $valores.'<br>';
                                }
                                */

                                // Contar el tamaño de la array y guardarlo.
                                $contador = count($array);
                                //echo $contador;

                                // Si contador es impar salta mensaje.
                                if($contador% 2 != 0 )
                                {
                                    echo '<script> errorimparpareja(); </script>';
                                }
                                else // Son numeros par la gente.
                                {
                                    //$contador2 = $contador-1;
                                    // Crear una array, la cual ire agregando numeros hasta llegar a $contador.
                                    for ($i = 1; $i <= $contador; $i++)
                                    {
                                        // Va guardando el contador en la array.
                                        $arraycontador[] = $i;
                                    }

                                    // Visualizar la array contador.
                                    /*
                                    foreach($arraycontador as $valor)
                                    {
                                        echo $valor.' ';
                                    }
                                    */

                                    // Variable contador.
                                    $i = 1;

                                    echo '<table class="table">';
                                        echo '<thead>';
                                            echo '<tr>';
                                                echo '<th>Parejas</th>';
                                                echo '<th>Quien Regala</th>';
                                                echo '<th>Destinatario</th>';
                                                echo '<th>Regalo</th>';
                                            echo '</tr>';
                                        echo '</thead>';
									// Recorro la array, $valor son los correos.
									foreach($array as $valor)
									{
										$random=array_rand($arraycontador,1);

										//echo $valor.'|'.$array[$random].'<br>';
									
										// Si el $valor(Quien Regala) es igual a $array[$random](Destinatario random) entra en el if
										if($valor == $array[$random])
										{
											// Se vuelve a barajar
											$random=array_rand($arraycontador,1);
											
											// Si vuelve a ser igual entra en el if, y reinicia la pagina.
											if($valor == $array[$random])
											{
												// Script para redirigir a la pagina de emparejar ese grupo.
												echo '<script> 
													window.location.href = "http://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php?id='?>
														<?php echo $_GET["id"] ?><?php echo '&opcion=emp";
												</script>';
											}
											
										}
										
										echo '<tbody>';
										echo '<tr>';
										  echo '<th>'.$i.'</th>';
										  echo '<td>'.$valor.'</td>';
										  echo '<td >'.$array[$random].'</td>';
										
											// Guardo la id del grupo en una variable.
											$idgrupo = $_GET["id"];
										
											// Consula. Para saber si tiene regalo la persona que regala.
											$consulta = "
												SELECT regalo.Ruta, regalo.Nombre
												FROM usuarios
												INNER JOIN regalo ON regalo.Usuario = usuarios.IDUsuario
												WHERE usuarios.Correo = '".$valor."' AND regalo.Grupo = $idgrupo;
											";

											//echo $consulta;
											$objeto->realizarConsultas($consulta);
										
											// Si devuelve filas significa que esa persona tiene regalo.
											if($objeto->comprobarFila()>0)
											{
												$fila = $objeto->extraerFilas();
												echo '<td><a href="/amigoinvisible/regalos/'.$_GET["id"].'/'.$valor.'/'.$fila["Nombre"].'" target="_blank">Regalo</a></td>';
											}
											else // SI entra aqui, significa que esa persona no subio regalo.
											{
												echo '<td>Vacio</td>';
											}
											
										
										echo '</tr>';

										// Borra los numeros del contador, y asi no se repiten los correos.
										unset($arraycontador[$random]);

										// Va aumentando la $i
										$i++;
										
										// Crear array destinatario.
										$array[] = $fila["Correo"];
										
										
									}

                                    

								}
                                
                                echo '</table>';

                                echo '<button class="btn btn-warning" type="button" data-dismiss="modal">Repartir</button>';

                            }


                        ?>
                    </div>
                    <div class="modal-footer">
                        <?php echo '<a href="grupos.php?id='.$_GET["id"].'&opcion=emp" class="btn btn-success" type="button">Volver a emparejar</a>'; ?>
                        <button class="btn btn-warning" type="button" data-dismiss="modal">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>




        <!-- Pie -->
        <footer class="p-3 mb-3 cancelarmarginbottom">
            <div class="container-footer">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <!-- Logo de la compañia -->
                    <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                        <img src="https://fundacionloyola.com/vguadalupe/wp-content/uploads/2019/12/logo-boletinW2.png" alt="Imagen Corporativa del Colegio" width="170" height="86" title="logotipo">
                    </a>

                    <!-- Menu -->
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="#" class="px-2">Avisos Legales</a></li>
                        <li><a href="#" class="px-2">Política de Privacidad</a></li>
                    </ul>

                    <!-- Seccion de Botones de Redes Soliales -->
                    <div class="dropdown text-end">
                        <div class="redessociales">
                            <a href="https://www.facebook.com/EscuelaVirgendeGuadalupe/" target="_blank" class="infinite-top-bar-social-icon" title="facebook">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a href="https://twitter.com/escuelaevg" target="_blank" class="infinite-top-bar-social-icon" title="twitter">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a href="https://www.youtube.com/user/VirgenDeGuadalupeTV?nohtml5=False" target="_blank" class="infinite-top-bar-social-icon" title="youtube">
                                <i class="fa fa-youtube"></i>
                            </a>
                            <a href="https://www.instagram.com/edvguadalupe/" target="_blank" class="infinite-top-bar-social-icon" title="instagram">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>


									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									