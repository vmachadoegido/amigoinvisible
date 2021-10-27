<?php
    // Iniciar session
    session_start();
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

        <!-- Google -->
			<!-- Host -->
		<!-- <meta name="google-signin-client_id" content="919013948566-59sj3rmromelp2ojpvqd2ci8rv907idn.apps.googleusercontent.com"> -->
			<!-- Local -->
		<meta name="google-signin-client_id" content="919013948566-hl010ol0bg7pjvfktmdtgtgns9lv9qrk.apps.googleusercontent.com">

        <!-- Estilos Generales -->
        <link href="../assets/css/estilo.css" rel="stylesheet">
        
        <!-- Libreria de Alertas -->
        <!-- Pagina https://sweetalert2.github.io -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <script src="../assets/js/funciones.js"></script>

    </head>
    <body>
        
<!--
         Recoger el correo de la cookie 
        <script> 
            
            // Creo la cookie correo ( No tendria que estar aqui, es de pruebas) 
            document.cookie = "correo=vmachadoegido.guadalupe@alumnado.fundacionloyola.net";

        </script>
-->
        
        <!-- Comprobar que exite la session correo -->
        <?php 
            // Si no hay sesion correo, mensaje de alerta.
            if(!isset($_SESSION["correo"]))
            {
                // Mensaje de alerta que no ha iniciado sesion
                echo '<script> nologeado(); </script>';
            }
        ?>
        

        
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
                    <h1 class="fw-light">Amigo Inivisble</h1>
                    <!-- Separador -->
                    <hr class="rayas">
                    <!-- Contenido-->
                    <h4>¿Qué es el amigo invisible?</h4><br>
                    <p class="lead text-start">
                    <p>
                        El amigo secreto, santa secreto, amigo invisible o angelito es un juego muy popular en el que participan varias personas que se hacen regalos entre sí sin saber quién ha sido el que ha hecho cada regalo.
                        <br><br>
                        Para acceder a nuestro amigo invisible,<br> tienes que iniciar sersion con tu cuenta de google del colegio.
                    </p>
                    
                    <!-- Texto indicando el usuario que has iniciado sesion -->
                    <?php
                        // Muestre el correo guardado de la sesion.
                        echo '<br>Iniciado Sesion con <br><span style="font-size: 12px;">'.$_SESSION["correo"].'</span><br>';
                    ?>
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>