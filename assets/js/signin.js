/**
* Alumno: Victor Manuel Machado Egido.
*
* Centro Educativo: Escuela Virgen de Guadalupe.
*
* Ciclo Formativo: Desarrollo de Aplicaciones Web.
*
* Curso: 2020-2021.
*
* Descripcion del fichero: En este fichero estas las funciones necesarias para conseguir el inicio de sesion de google.
*/

/**
* Funcion para obtener la informacion de la cuenta de google
* @param {String} googleUser 
*
*/
function onSignIn(googleUser){
	//Informacion basica del perfil, logeado
    var profile = googleUser.getBasicProfile();
    
	//Tipo de identificado
	auth("login", profile);
}


/**
* Funcion para desconectar de la cuenta de google. (No funciona).
*/

function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
	// Mensaje de consolta para decir que se desconecto
	console.log('El usuario se desconecto');
	// Lo redirige a la pagina principal.
	// window.location.href = "http://22.2daw.esvirgua.com/amigoinvisible/";
  });
}

/**
* Funcion de carga. (No funciona)
*/
function onLoad() {
  gapi.load('auth2', function() {
    gapi.auth2.init();
  });
}

/**
* Funcion para logearse a traves de google.
* @param {String} action 	Lo recibe de la funcion onSignIn.
* @param {String} profile 	Lo recibe de la funcion onSignIn.
* 
*/
function auth(action, profile = null){
	// Variable local, para guardar el estado de la accion de UserAction.
    let data = { UserAction : action };
    
    //console.log(action);

    if(profile){
		// Los datos que trae el profile.
         data ={
				UserID : profile.getId(),
                UserName : profile.getGivenName(),
                UserLastName : profile.getFamilyName(),
                UserEmail : profile.getEmail(),
                UserAction : action,
            };
		// Sitio donde explica las variables. https://developers.google.com/identity/sign-in/web/sign-in
    }
    
    // Busca los datos que se imprime en la web user.php
    $.ajax({
            type: "POST",
            url: "https://22.2daw.esvirgua.com/amigoinvisible/users/user.php",
            data: data,
            success: function(data){
                // Muestra por consola los datos recividos
                console.log(data);
                
                // Convierte el objeto data en JSON
                let user = JSON.stringify(data);
            
                // Muestro por consola la conversion.
                 console.log(user);
                // Muestro donde esta el valor de logged.
                console.log(user[27]);
                
                // Si user[27] | logged es 1, significa que esta logeado la cuanta, e caso que no cierra la cuanta.
                if(user[27] == 1){
                    // Alerta Personalizada - La cual aparece cuando es correcta la sesion y le lleva a la pagina logeada.
                    let timerInterval
                    Swal.fire({
                      icon: 'success',
                      title: 'Correcto',
                      text: 'Bienvenido :D',
                      showConfirmButton: false,
					  allowOutsideClick: false,
                      timer: 2000
                    }).then((result) => {
                      if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = "https://22.2daw.esvirgua.com/amigoinvisible/registrado/";
                      }
                    })

                }else{
                    // Esta cuanta NO es del dominio.

                    // Alerta Personalizada - La cual aparece cuando el correo no es del dominio.
                    let timerInterval
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops..',
                      text: 'Parece que ese correo no pertenece a este dominio',
					  allowOutsideClick: false,
                      showConfirmButton: false,
                      timer: 2000
                    })
                }
            }
        }
    )
}