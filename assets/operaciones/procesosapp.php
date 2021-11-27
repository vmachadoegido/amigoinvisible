<?php

    class precososapp
    {
        /**
        * Crear una carpeta, en el grupo con esa persona.
        * @return Null
        * @param String $grupoid, String $usuarioregalo.
        */
        function subirarchivo($grupoid, $correousuario,  $nombretemp, $nombreregalo)
        {

            // Si no exite la carpeta
            if(!file_exists('../regalos/'.$grupoid.'/'))
            {
                // Crea la carpeta
                mkdir('../regalos/'.$grupoid.'/',0777,true);
                mkdir('../regalos/'.$grupoid.'/'.$correousuario.'/',0777,true);

                // Si existe esa ruta
                if(file_exists('../regalos/'.$grupoid.'/'.$correousuario.'/'))
                {
                    // Sube el archivo
                    if(move_uploaded_file($nombretemp, '../regalos/'.$grupoid.'/'.$correousuario.'/'.$nombreregalo))
                    {
                        return "Si";
                    }
                    else
                    {
                        return "No";
                    }
                }
            }
            else // Si existe la carpeta lo sube directamente.
            {
                // Sube al archivo
                if(move_uploaded_file($nombretemp, '../regalos/'.$grupoid.'/'.$correousuario.'/'.$nombreregalo))
                {
                    return "Si";
                }
                else
                {
                    return "No";
                }
            }
        }


        /**
        * Eliminar Archivos.
        * @return Si, No
        * @param INT $grupoid, String $correousuario, String $nombreregaloanitguo
        */
        function eliminararchivo($grupoid, $correousuario, $nombreregaloanitguo)
        {
            if(unlink('../regalos/'.$grupoid.'/'.$correousuario.'/'.$nombreregaloanitguo.''))
            {
              return "Si";
            }
            else
            {
              echo "No";
            }

        }




    }
?>
