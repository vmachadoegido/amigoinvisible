function onSignIn(googleUser) 
{
	//Informacion basica del perfil, logeado
    var profile = googleUser.getBasicProfile();
    
	//Tipo de identificado
	auth("login", profile);
}


// Funcion para desconectar
function signOut() 
{
  var auth2 = gapi.auth2.getAuthInstance();
  auth2.signOut().then(function () {
        // Mensaje de consolta para decir que se desconecto
        console.log('El usuario se desconecto');
        // Lo redirige a la pagina principal.
        window.location.href = "http://amigoinvisible.com";
  });
}
// Funcion de carga
function onLoad() 
{
  gapi.load('auth2', function() {
    gapi.auth2.init();
  });
}
    



function auth(action, profile = null)
{
    let data = { UserAction : action };
    
    console.log(action);

    if(profile)
    {
		// Los datos que trae el profile.
         data =
            {
				UserID : profile.getId(),
                UserName : profile.getGivenName(),
                UserLastName : profile.getFamilyName(),
                UserEmail : profile.getEmail(),
                UserAction : action,
            };
		// Sitio donde explica las variables. https://developers.google.com/identity/sign-in/web/sign-in	
    }
    
    // Busca los datos que se imprime en la web user.php
    $.ajax(
        {
            type: "POST",
            url: "../users/user.php",
            data: data,
            success: function(data)
            {
                // Muestra por consola los datos recividos
                //console.log(data);
                
                // Convierte el objeto data en JSON
                let user = JSON.stringify(data);
                
                // Muestro por consola la conversion.
                //console.log(user);
                // Muestro donde esta el valor de logged.
                //console.log(user[136]);
                
                // Si user[27] | logged es 1, significa que esta logeado la cuanta, e caso que no cierra la cuanta.
                if(user[136] == 1)
                {
                    // Esa cuanta esta logeada y es del dominio.
                    //alert("hola");
                    
                    //Si esta logeado, y esta en la pagina principal le lleva a la sesscion registrado.
                    if(document.URL === "http://amigoinvisible.com/")
                    {
                        window.location.href = "http://amigoinvisible.com/registrado/";
                    }
                    
                }
                else
                {
                    // Esta cuanta NO es del dominio.
                    alert("Ese dominio no es valido.");
                    
                    // Cerrar Sesion
                    //singOut();
                }
                
            }
        }
    )
    
}
