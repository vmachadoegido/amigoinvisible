
//Esta funcion sirve para retornar a la pagina principal si no has iniciado sesion
function nologeado()
{
    // Mensaje de alerta
    Swal.fire({
      icon: 'error',
      title: '¿Qué haces aqui?',
      text: 'No estas iniciado sesion!',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Iniciar Sesion'
    }).then((result) => {
      if (result.isConfirmed)
      {
            window.location.replace("http://22.2daw.esvirgua.com/amigoinvisible/");
      }
      else
      {
          window.location.replace("http://22.2daw.esvirgua.com/amigoinvisible/");
      }
    })

}

// Esta funcion sirve para mostrar un mensaje de error personalizado.

function error()
{
    Swal.fire({
      icon: 'error',
      text: 'Oops',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Actualizar'
    }).then((result) => {
      if (result.isConfirmed)
      {
            window.location.replace("http://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php");
      }
      else
      {
          window.location.replace("http://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php");
      }
    })

}

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
            window.location.replace("http://22.2daw.esvirgua.com/amigoinvisible/");
      }
      else
      {
          window.location.replace("http://22.2daw.esvirgua.com/amigoinvisible/");
      }
    })
}
