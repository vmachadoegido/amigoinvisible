<?php
    // Traer los valores de la conexion.
    require("../assets/conexion/connection.php");


    class operaciones_ftp
    {

        public $conn_id;

        // Se crea el constructuro de conexion
        function __construct()
        {
            // Se conecta con el servidor.
            $this->conn_id = @ftp_connect(servidor);

            // Si se establece la conexion se iniciara session
            if($this->conn_id)
            {
                // Se inicia sesion con els ervidor.
                if(@ftp_login($this->conn_id,user_host,password))
                {
                    echo "<script>console.log('Inicio sesion correcto con el servidor');</script>";
                }
                else
                    echo "<script>console.log('Error: No se pudo iniciar sesion con el servidor.');</script>";

            }
            else // Si no se conecta con el servidor lo informara por console.log
            {
                echo "<script>console.log('Error: No se pudo conectar con el Servidor.');</script>";
            }
        }


        function conectar()
        {



        }


        /**
        * Crear una carpeta, en el grupo con esa persona.
        * @return Null
        * @param String $grupoid, String $usuarioregalo.
        */
        function crearcarpeta($grupoid, $usuarioregalo)
        {

            // Se introduce las variables obtenidas en la ruta.
            $ruta = '/amigoinvisible/regalos/'.$grupoid.'/'.$usuarioregalo.'';
            //echo $ruta.'<br>';

            // Se guarda en una variable, cada trozo de la ruta quitando el "/"
            $partes = explode("/",$ruta);
            $fullpath = "";
            // Se crea un bucle para ir creando las subcarpetas.
            foreach($partes as $parte)
            {
                // Si la parte esta vacia cantinua con la siguiente "partes"
                if(empty($parte))
                {
                    $fullpath .= "/";
                    continue;
                }
                // Se pone la siguiente parte en $fullpath, y asi va avanzando
                $fullpath .= $parte."/"; // '/amigoinvisible/regalos'

                // Se crea la carpeta con la ruta dada en $fullpath
                if(@ftp_chdir($this->conn_id, $fullpath)) // '/amigoinvisible/regalos'
                {
                   ftp_chdir($this->conn_id, $fullpath);
                }
                else // Si esta creada pasa a la siguiente parte
                {
                    // Se crea la carpeta con el nombre de la parte.
                    if(@ftp_mkdir($this->conn_id, $parte)) // En bucle las partes hasta completar la ruta entera '/amigoinvisible/regalos/'.$grupoid.'/'.$usuarioregalo.'';
                    {
                        ftp_chdir($this->conn_id, $parte);
                    }
                }
            }

            // Cierra la conexion con el ftp.
            ftp_close($this->conn_id);
        }

        /**
        * Elminar directorio.
        * @return Null
        * @param $dir String Directory Path
        */
        function eliminargrupoftp()
        {

            $logs_dir = "www";

            ftp_chdir($this->conn_id, $logs_dir);
            $files = ftp_nlist($this->conn_id, ".");


            foreach ($files as $file)
            {
                // Si la carpeta esta vacia, elimina la carpeta
                if(ftp_rmdir($this->conn_id, $file))
                {
                    echo "Eliminado ".$file."<br>";
                }
                else
                {
                    echo "No Eliminado ".$file."<br>";
                }

            }

            // Cierra la conexion con el ftp.
            ftp_close($this->conn_id);
        }

        /**
        * Subir Archivos al servidor.
        * @return Si, No.
        * @param Int $grupoid, String $correousuario, String $nombretemp, String $nombreregalo
        */
        function subirarchivos($grupoid, $correousuario, $nombretemp, $nombreregalo)
        {

            $destination_file = 'amigoinvisible/regalos/'.$grupoid.'/'.$correousuario.'/';

            ftp_pasv($this->conn_id, true);

            if(ftp_put($this->conn_id, $destination_file . $nombreregalo, $nombretemp, FTP_BINARY))
            {
                return "Si";
            }
            else
            {
                return "No";
            }

        }

        /**
        * Eliminar Archivos.
        * @return Si, No
        * @param INT $grupoid, String $correousuario, String $nombreregaloanitguo
        */
        function eliminararchivo($grupoid, $correousuario, $nombreregaloanitguo)
        {
            // Se crea una variable
            $file = 'amigoinvisible/regalos/'.$grupoid.'/'.$correousuario.'/'.$nombreregaloanitguo.'';

            if (ftp_delete($this->conn_id, $file))
            {
                return "Si";
            }
            else
            {
                echo "No";
            }
        }

        function vercontenido()
        {
            $file_list = ftp_nlist($this->conn_id, "amigoinvisible/");
            foreach ($file_list as $file)
            {
                echo "<br>$file";
            }
        }



        function descargararchivo()
        {


//            $file_path_my_pc = "C:\Users\Victor\Downloads";
//            $file_path_ftp_server = "www/hola/fondo.jpg";
//
//            ftp_pasv($this->conn_id, true);
//
//            if (ftp_get($this->conn_id, $file_path_ftp_server, FTP_ASCII))
//            {
//                echo "File has been downloaded!!";
//                ftp_close($this->conn_id);
//                return true;
//
//            }
//            else
//            {
//                ftp_close($this->conn_id);
//                echo "fail ... ";
//                echo "Connected has be stopped!!";
//                return false;
//
//            }

            $remote_file = "amigoinvisible/regalos/4/vmachadoegido.guadalupe@alumnado.fundacionloyola.net/PrtScr capture_3.jpg";
            echo $remote_file.'<br>';

            $local_file = "C:\Users\Victor\Documents";
            echo $local_file.'<br>';

            $handle = fopen($local_file, 'w'); // local_file es el directorio completo en donde se descarga el archivo remoto



            if (ftp_fget($this->conn_id, $handle, $remote_file, FTP_BINARY, 0))
            {
                // $conn_id - Es el id de conexion que obtienes con ftp_connect
                // $handle - Un apuntador del archivo abierto en el cual almacenar los datos.
                // $remote_file - La ruta del archivo remoto
                // FTP_ASCII - el modo de transferencia
                // 0 - resume_pos, la posición desde la cual se empieza a descargar el archivo remoto.
                echo "Se ha creado el archivo " . $local_file . " </br>";
                fwrite($log, $local_file . PHP_EOL);
            }
            else
            {
                echo "Ha habido un problema durante la descarga de $remote_file en $local_file";
            }







        }


    }



?>
