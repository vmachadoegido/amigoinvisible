
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
            window.location.href = "http://22.2daw.esvirgua.com/amigoinvisible/";
      }
      else
      {
            window.location.href = "http://22.2daw.esvirgua.com/amigoinvisible/";
      }
    })

}

// Esta funcion sirve para mostrar un mensaje de error personalizado.

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


