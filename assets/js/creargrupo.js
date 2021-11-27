$(document).ready(function () {
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Cuando se pulsa el elemento con la id crear.
    $("#crear").click(function(event){

        event.preventDefault(); // Mostrar un mensaje del servidor.

        // Recoger los datos de los elementos con la id y guardarlo en una variable.
        var nombregrupo = $("#nombregrupo").val();
        var fechareparto = $("#fechareparto").val();
        var correo = $("#correo").val();

        // Enviar los datos a creargrupo.php, donde creara el grupo y devolvera un si o no, dependiendo de si
        // funciono o no al crearlo.
        $.post("../registrado/creargrupo.php", {
            nombregrupo: nombregrupo,
            fechareparto: fechareparto
        }, function(respuesta){
//            $("#info").text(respuesta)
            console.log(respuesta)

            // Si la respuesta es Si, muestra un mensaje que se creo el grupo y le devuelve a la pagina grupos.php.
            if(respuesta == "Si")
            {
                Swal.fire({
                  icon: 'success',
                  text: 'Creado correctamente',
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
            else // En caso que sea No o cualquier otro valor da error.
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


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Cuando se pulsa el elemento con la id editar..
    $("#editar").click(function(event){

        event.preventDefault(); // Mostrar un mensaje del servidor.

        // Recoge los datos de los elmentos de la id y lo guarda en una variable.
        var nombregrupo = $("#nombregrupo2").val();
        var fechareparto = $("#fechareparto2").val();
        var idgrupo = $("#idgrupo").val();

        // Envia los datos a editargrupo.php, y ejecuta esas funciones.
        $.post("../registrado/editargrupo.php", {
            nombregrupo: nombregrupo,
            fechareparto: fechareparto,
            idgrupo: idgrupo
        }, function(respuesta){
//            $("#info").text(respuesta)
            console.log(respuesta)

            // Si devuelve un Si, muestra un mensaje personalizado que se edito y lo redirige a grupos.php
            if(respuesta == "Si")
            {
                Swal.fire({
                  icon: 'success',
                  text: 'Modificado correctamente',
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
            else // En caso que sea No o cualquier otro valor de error.
            {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Ocurrio algo inesperado y no se pudo editar el grupo.',
                  showConfirmButton: false,
                })
            }


        });

    });
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    var i=0;

    // Cuando se pulsa el boton agregar, de la ventana modal invitar crea una nueva fila.
    $("#agregarfila").click(function(event){
        console.log("Creando linea de invitado");
        i++;

            $('#invitadoform').append('' +
                '<div id="row'+i+'">'+
                '<label for="invitado[]" class="labelinvitar" >Correo del invitado</label>'+
                '<input type="email" id="invitadocorreo" class="inputinvitar" name="invitado[]">'+
                '<input type="button" class="eliminarfila" value="Eliminar"/>'+i+
                '</div>'
            );
    });

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Cuando se pulsa el boton eliminar, de la ventana modal invitar borra esa fila.
    $(document).on('click', '.eliminarfila', function (event) {
        event.preventDefault(); // Pueda volver a llamarse
        $(this).closest('div').remove(); // Elimina el elemento div
    });

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Cuando se oulsa el boton invitar, de la ventana modal invitar.
    $("#invitar").click(function(event){

        event.preventDefault(); // Mostrar un mensaje del servidor.

        // Crear la array
        var correoinvitadoarray = new Array();

        // Recoger los datos que reciba la clase inputinvitar se guarda en correoinput.
        // Y se crea una array con los datos recividos.
        var correoinput = document.getElementsByClassName('inputinvitar'),
            namesValues = [].map.call(correoinput,function(invitadocorreo){
                correoinvitadoarray.push(invitadocorreo.value);
            });

        // Recorrer la array correoinvitadoarray. Esta parte es para verlo en consola
//        correoinvitadoarray.forEach(function(inputsValuesData){
//            console.log("Correos: " + correoinvitadoarray);
//        });

        // Guardar la id del grupo del invitado.
        var grupoid = $('#idgrupoinvitado').val();
        //console.log(grupoid);


        $.ajax({
            url:"invitargrupo.php",
            method:"POST",
            data: { correoinvitadoarray: correoinvitadoarray, grupoid: grupoid },
            success:function(respuesta)
            {
                console.log(respuesta);
                // Si devuelve un Si, muestra un mensaje personalizado que se edito y lo redirige a grupos.php
//                if(respuesta == "Si")
//                {
//                    Swal.fire({
//                      icon: 'success',
//                      text: 'Modificado correctamente',
//                      confirmButtonColor: '#3085d6',
//                      cancelButtonColor: '#d33',
//                      confirmButtonText: 'Actualizar'
//                    }).then((result) => {
//                      if (result.isConfirmed)
//                      {
//                            window.location.replace("http://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php");
//                      }
//                      else
//                      {
//                          window.location.replace("http://22.2daw.esvirgua.com/amigoinvisible/registrado/grupos.php");
//                      }
//                    })
//                }
//                else // En caso que sea No o cualquier otro valor de error.
//                {
//                    Swal.fire({
//                      icon: 'error',
//                      title: 'Oops...',
//                      text: 'Ocurrio algo inesperado y no se pudo editar el grupo.',
//                      showConfirmButton: false,
//                    })
//                }
            }
        });
    });

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Cuando se oulsa el boton invitar, de la ventana modal invitar.
    $("#repartir").click(function(event){

		
		
		
			for(var i=0;i<jArray.length;i++)
			{
				//document.getElementById("contenedor").innerHTML += "Nombre " + jArray[i] + " ";
				alert(jArray[i]); 
			}
		
			for(var i=0;i<jArray2.length;i++)
			{
				//document.getElementById("contenedor").innerHTML += "Nombre " + jArray[i] + " ";
				alert(jArray2[i]); 
			}

		

    });

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
});
