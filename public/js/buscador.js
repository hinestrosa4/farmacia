$(document).ready(function () {
    // verifica si el campo de búsqueda está vacío
    if ($('#buscar').val() == "") {
        buscarDatos(); // Llama a buscarDatos() sin pasar ningún parámetro
    }

    $(document).on('keyup', '#buscar', function () {
        let valor = $(this).val();
        buscarDatos(valor); // Llama a buscarDatos() con el valor del campo de búsqueda
    });

    function buscarDatos(consulta) {
        funcion = "buscar";
        if (!consulta) { // Si no hay consulta, selecciona todos los clientes
            consulta = "todos";
        }
        $.ajax({
            url: 'buscar-clientes.php',
            type: 'POST',
            dataType: 'json',
            data: { consulta: consulta, funcion: funcion },
        })
            .done(function (respuesta) {
                console.log(respuesta);
                if (respuesta.length > 0) {
                    // Borra los resultados anteriores
                    $('#usuarios').empty();
                    // Agrega los nuevos resultados al cuerpo del card
                    respuesta.forEach(function (usuario) {
                        let tipo = usuario.tipo;
                        let sexo = usuario.sexo;
                        let direccion = usuario.direccion == null ? "sin definir" : usuario.direccion;
                        let telefono = usuario.telefono == null ? "sin definir" : usuario.telefono;

                        let rol = tipo == 1 ? 'Administrador' :
                            tipo == 2 ? 'Farmacéutico' :
                                tipo == 3 ? 'Técnico' :
                                    tipo == 4 ? 'Auxiliar' : 'Desconocido';

                        let imagen = sexo == "hombre" ? '<img width=90px src="img/avatarUser.png" class="img-circle elevation-2" alt="User Image">' :
                            sexo == "mujer" ? '<img width=90px src="img/avatarUserMujer.png" class="img-circle elevation-2" alt="User Image">' : "No definido";

                        let html = `<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                          <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                              ${rol}
                            </div>
                            <div class="card-body pt-0">
                              <div class="row">
                                <div class="col-7">
                                  <h2 class="lead"><b>${usuario.nombre}</b></h2>
                                  <br>
                                  <ul class="ml-2 fa-ul">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> <strong>Dirección:</strong> ${direccion}</li>
                                    <li></li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> <strong>Teléfono:</strong> ${telefono}</li>
                                  </ul>
                                </div>
                                <div class="col-5 text-center">
                            ${imagen}
                                </div>
                              </div>
                            </div>
                            <div class="card-footer">
                              <div class="text-right">
                              <a href="" class="btn btn-sm btn-primary">
                                  <i class="fas fa-user"></i> Ver perfil
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>`;


                        $('#usuarios').append(html);
                    });
                } else {
                    // Si no se encontraron resultados, muestra un mensaje de error
                    $('#usuarios').html('<p class="text-danger">No se encontraron resultados</p>');
                }
            })
            .fail(function () {
                console.log("error");
            });
    }
});
