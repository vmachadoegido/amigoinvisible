// Funcion de alerta personalizada. Cuando no este iniciada la session.
function nologeado()
{
    // Mensaje de alerta
    Swal.fire({
      icon: 'error',
      title: '¿Qué haces aqui?',
      text: 'No estas iniciado sesion!',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Iniciar Sesion',
	  allowOutsideClick: false
    }).then((result) => {
      if (result.isConfirmed)
      {
            window.location.href = "http://22.2daw.esvirgua.com/amigoinvisible/";
      }
      else
      {
            window.location.href = "http://22.2daw.esvirgua.com/amigoinvisible/";
      }
    })

}

// Funcion de alerta personalizada. Con cualquier mensaje de error comun.
function error()
{
    Swal.fire({
      icon: 'error',
      title: 'Oops',
      text: 'Algo ocurrio X.X',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Actualizar'
    }).then((result) => {
      if (result.isConfirmed)
      {
            window.location.href = "http://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php";
      }
      else
      {
            window.location.href = "http://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php";
      }
    })

}

// Funcion de alerta personalizada. Cuando se elimina un grupo correctamente.
function correctoeliminado()
{
    // Mensaje de alerta
    Swal.fire({
      icon: 'success',
      title: 'Correcto',
      text: 'Eliminado Correctamente',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Actualizar'
    }).then((result) => {
      if (result.isConfirmed)
      {
            window.location.href = "https://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php";
      }
      else
      {
            window.location.href = "https://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php";
      }
    })
}

// Funcion de alerta personalizada. CUando se expulsa correctamente alguien del grupo.
function correctoexpulsado()
{
    // Mensaje de alerta
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
            window.location.href = "https://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php";
      }
      else
      {
            window.location.href = "https://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php";
      }
    })
}

// Funcion de alerta personalizada. Cuando se sube correctamente el archivo.
function correctosubido()
{
    // Mensaje de alerta
    Swal.fire({
      icon: 'success',
      text: 'Subido regalo Correctamente',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Actualizar'
    }).then((result) => {
      if (result.isConfirmed)
      {
            window.location.href = "https://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php";
      }
      else
      {
            window.location.href = "https://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php";
      }
    })
}

// Funcion de alerta personalizada. Cuando la lista de personas de un grupo es impar.
function errorimparpareja()
{
    Swal.fire({
      icon: 'warning',
      title: 'Falta gente',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Actualizar'
    }).then((result) => {
      if (result.isConfirmed)
      {
            window.location.href = "http://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php";
      }
      else
      {
            window.location.href = "http://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php";
      }
    })
}

// Funcion de alerta personalizada. Cuando se sube un archivo de un formato no correcto.
function errortipoarchivo()
{
    Swal.fire({
      icon: 'warning',
      title: 'Oops',
      title: 'Extension no Soportada',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Actualizar'
    }).then((result) => {
      if (result.isConfirmed)
      {
            window.location.href = "http://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php";
      }
      else
      {
            window.location.href = "http://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php";
      }
    })
}


