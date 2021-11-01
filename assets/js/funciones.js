
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
    let timerInterval
    Swal.fire({
      icon: 'error',
      title: 'Oops',
      text: 'Hubo un error',
      showConfirmButton: false,  
      timer: 2000
    }).then((result) => {
      if (result.dismiss === Swal.DismissReason.timer) {
        window.location.href = "hhttp://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php";
      }
    })
}

function correctoeliminado()
{
    let timerInterval
    Swal.fire({
      icon: 'success',
      title: 'Correcto',
      text: 'Eliminado Correctamente',
      showConfirmButton: false,  
      timer: 2000
    }).then((result) => {
      if (result.dismiss === Swal.DismissReason.timer) {
        window.location.href = "hhttp://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php";
      }
    })
}