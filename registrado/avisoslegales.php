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
	* Descripcion del fichero: En este fichero estan los avisos legales.
	*
	*/

	// Iniciar sesion
	session_start();

	// Si no hay sesion correo, mensaje de alerta.
	if(!isset($_SESSION["correo"])){
		// Mensaje de alerta que no ha iniciado sesion
		echo '<script> nologeado(); </script>';
	}
?>


<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Victor Manuel Machado Egido">
        <title>Amigo Inivible - Inicio</title>

        <!-- Logo de la empresa en la pestaña -->
        <link rel="shortcut icon" href="assets/imagenes/logo.png" />

        <!-- Boostrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

        <!-- Fontawesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.css" integrity="sha512-CB+XYxRC7cXZqO/8cP3V+ve2+6g6ynOnvJD6p4E4y3+wwkScH9qEOla+BTHzcwB4xKgvWn816Iv0io5l3rAOBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Google -->
            <!-- Host -->
         <meta name="google-signin-client_id" content="919013948566-8m73s83e06hnrj6evsms7cm7uulurf2q.apps.googleusercontent.com">
            <!-- Local -->
<!--        <meta name="google-signin-client_id" content="919013948566-hl010ol0bg7pjvfktmdtgtgns9lv9qrk.apps.googleusercontent.com">-->

        <!-- Estilos Generales -->
        <link href="../assets/css/estilo.css" rel="stylesheet">

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>
    <body>
        <!-- Cabezera - Navegador -->
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
            <!-- Imagen de la corpoativa -->
            <a href="" class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <img src="../assets/imagenes/logo.png" alt="Imagen Corporativa del Colegio" width="170" height="86" title="logotipo">
            </a>
            <!-- Opciones del navegador -->
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
				<?php 
					if(isset($_SESSION["correo"])){
						echo '<li><a href="index.php" class="nav-link px-2 link-secondary">Inicio</a></li>';
					}else
						echo '<li><a href="../index.html" class="nav-link px-2 link-secondary">Inicio</a></li>';
				?>
            </ul>
        </header>

        <!-- Cabecera, titulo del sitio con foto -->
        <div id="cabezera">
            <div class="cabezera-titulo">AVISO LEGAL</div>
        </div>

        <!-- Contenedor -->
        <div class="py-5 text-center container">
            <div class="row py-lg-5 cancelarpaddingtop">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <!-- Titulo -->
					<h1 class="fw-light"><b>AVISO LEGAL</b></h1>
                    <!-- Separador -->
                    <hr class="rayas">
                    <!-- Contenido-->
					<h1 class="fw-light">COOKIES</h1>
					<p class="parrafoizquierda">
						La página web del Colegio Virgen de Guadalupe utiliza o puede utilizar cookies que se quedaran almacenadas en el ordenador. <br><br>
						Las cookies son archivos que nuestro ordenador envía al suyo, pero que no nos proporcionan información ni sobre su nombre, ni sobre cualquier dato de carácter personal suyo. <br><br>
						Las cookies que utilizamos no pueden leer datos de su ordenador ni leer las cookies que existan en su ordenador. <br><br>
						Si usted lo desea puede configurar su navegador de manera que le avise en la pantalla si va a recibir una cookie. <br><br>
						El usuario puede configurar su ordenador de manera que no reciba estas cookies, este hecho no impedirá que se pueda acceder a la información del sitio web.
					</p>

					<h1 class="fw-light">PROPIEDAD INTELECTUAL</h1>
					<p class="parrafoizquierda">
						Los contenidos que se recogen en el presente sitio web están protegidos por la legislación Española sobre los derechos de propiedad intelectual e industrial a favor de Escuela Virgen de Guadalupe y no se permite la reproducción y/o publicación, total o parcial, del sitio web, ni su tratamiento informático, su distribución, su difusión, ni su modificación o transformación, ni demás derechos reconocidos legalmente a su titular, sin el permiso previo y por escrito del mismo. <br><br>
						El usuario, única y exclusivamente, puede utilizar el material que aparezca en este sitio web para su uso personal y privado, quedando prohibido su uso con fines comerciales o para incurrir en actividades ilícitas. <br><br>
						Todos los derechos derivados de la propiedad intelectual están expresamente reservados por Escuela Virgen de Guadalupe. <br><br>
						La Escuela Virgen de Guadalupe velará por el cumplimiento de las anteriores condiciones como por la debida utilización de los contenidos presentados en sus páginas web, ejercitando todas las acciones civiles y penales que le correspondan en el caso de infracción o incumplimiento de estos derechos por parte del usuario.
					</p>
					
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
                        <li><a href="avisoslegales.php" class="px-2">Avisos Legales</a></li>
                        <li><a href="https://docs.google.com/document/d/1iepLUcJUnY6fm8Prx63hDC89X487iQmjMEDSQm5f3Pc/edit#" target="_blank" class="px-2">Política de Privacidad</a></li>
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
                                <i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>

<!-- Librerias necesarias para google y otros. -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="assets/js/signin.js"></script>

