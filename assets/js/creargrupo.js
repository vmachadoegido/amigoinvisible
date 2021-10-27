$(document).ready(function () {
    
    $("#crear").click(function(event){
        
        event.preventDefault(); // Mostrar un mensaje del servidor.
        
        var nombregrupo = $("#nombregrupo").val();
        var fechareparto = $("#fechareparto").val();
        var correo = $("#correo").val();
        
        $.post("../registrado/creargrupo.php", {
            nombregrupo: nombregrupo,
            fechareparto: fechareparto,
            correo: correo
        }, function(respuesta){
//            $("#info").text(respuesta)
            console.log(respuesta)
            
            if(respuesta == "Si")
            {
                Swal.fire({
                  icon: 'success',
                  text: 'Creado correctamente',
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Iniciar Sesion',
                  showConfirmButton: false,  
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
            else // En caso que sea No o cualquier otro valor de error.
            {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Ocurrio algo inesperado y no se pudo crear el grupo.',
                  showConfirmButton: false,  
                })
            }
            
            
        });
        
    });
    
});
