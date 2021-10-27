<?php
    // Traer las operaciones.
    require("../assets/operaciones/operaciones.php");

    // Crear el objeto de la clase operaciones.
    $objoperaciones = new operaciones();

    echo $_POST["tipoforumario"];
    echo $_POST["Crear"];

    echo 'hola';

    header("Location: http://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php");

//    switch($_POST["tipoforumario"])
//    {
//        case "creargrupo":
//            // Guardo lo que trae del formulario crear grupo a una variable
//            $nombregrupo = $_POST["nombregrupo"];
//            $fechareparto = $_POST["fechareparto"];
//            echo 'hola';
//            break;
//        default:
//            error 
//    }
    













