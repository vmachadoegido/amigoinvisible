<?php
    // Iniciar session
    session_start();

    // Traerme los datos de conexion.
    require("../assets/operaciones/operaciones.php");

    // Crear el objeto de operaciones.
    $objeto=new operaciones();

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

        <!-- Se comprueba si hay una id en la url -->
        <?php

            // Comprueba si existe la variable $_GET["id"].
            // En caso que exista entra en el if por lo contrario no hace nada.
            if(isset($_GET["id"]))
            {
                // Comprueba si la variable $_GET["opcion"] es igual a 'e' (editar), en caso que no sea asi se va al else.
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
                        if($_GET["opcion"]=='ex')
                        {
                            echo '<script>
                                $(document).ready(function(){
                                  $("#ventanaexpulsarinvitargrupo").modal();
                                });
                            </script>';
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
                                                        echo '<button type="button" class="btn btn-sm btn-outline-secondary">Emparejar</button>';
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
                                                        echo '<div class="btn-group row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 g-3">';
                                                            echo '<button type="button" class="btn btn-sm btn-outline-secondary">Subir Regalo</button>';
                                                            echo '<button type="button" class="btn btn-sm btn-outline-secondary">Ver Regalo</button>';
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
                            <!-- <input type="date" id="fechareparto" name="trip-start" value="2018-07-22"/> -->
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
                            <label for="nombregrupo" required>Nuevo nombre del Grupo</label>
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
            <div class="modal-dialog" role="document">
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
                                        echo $fila["Correo"];
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

<!-- Librerias necesarias. JQuery, Popper y Boostrap-->
<!--
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
-->



