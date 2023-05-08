<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Farmacia</title>
</head>

<body>
    <!-- Modal para recuperar password -->

    <!-- Modal -->
    <div class="modal fade" id="enviarEmail" tabindex="-1" aria-labelledby="enviarEmail" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEnviar" class="g-3 needs-validation" method="POST"
                        action="{{ route('recuperarPass') }}">
                        @csrf
                        <h3>Recuperar contraseña</h3>
                        <br>
                        <div class="">
                            <input type="email" name="email" class="form-control" id="email"
                                value="{{ old('email') }}" placeholder="Introduzca un email">
                        </div>
                        <br>
                        <div class="col-12">
                            <button id="btnSubmitEnviar" style="width: 100%" class="btn btn-success"
                                type="submit">Enviar nueva
                                contraseña</button>
                        </div>
                    </form>

                    <script>
                        $(document).ready(function() {
                            $("#formEnviar").submit(function(event) {
                                // Prevenir la acción predeterminada del formulario
                                event.preventDefault();
                                // Validar el campo de laboratorio
                                if ($("#email").val() == "") {
                                    $("#email").addClass("is-invalid");
                                    $("#email").parent().find(".invalid-feedback")
                                        .remove(); // eliminar cualquier div existente
                                    $("#email").parent().append(
                                        "<div class='invalid-feedback'>Por favor, introduce un email.</div>");
                                } else {
                                    $("#email").removeClass("is-invalid");
                                    $("#email").addClass("is-valid");
                                }
                                // Enviar el formulario si todos los campos son válidos
                                if ($(".is-invalid").length == 0) {
                                    $("#formEnviar").unbind("submit").submit();
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <form action="" method="POST">
        @csrf
        <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
            <div class="card card0 border-0">
                <div class="row d-flex">
                    <div class="col-lg-6">
                        <div class="card1 pb-5">
                            <div class="row">
                                <img src="https://seeklogo.com/images/F/farmacia-logo-57EBC143C7-seeklogo.com.png"
                                    style="width: 100px" class="logo">
                            </div>
                            <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                                <img src="https://tecnyfarma.com/wp-content/uploads/2022/03/018_200122_30_0085-HDR-Editar-scaled-1-1.jpg"
                                    style="width: 800px; height:400px" class="image">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card2 card border-0 px-4 py-5">
                            <div class="row mb-4 px-3 justify-content-center">
                                <img src="{{ asset('img/bannerlogin.png') }}" style="width:500px" alt="">
                            </div>
                            <div class="row px-3 mb-4">
                                <div class="line"></div>
                                <div class="line"></div>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif
                            @if (session()->has('message'))
                                <div class="alert alert-success text-center">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <div class="row px-3">
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm">Correo electrónico</h6>
                                </label>
                                <input class="mb-4" type="text" name="email"
                                    placeholder="Enter a valid email address">
                            </div>
                            <div class="row px-3">
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm">Contraseña</h6>
                                </label>
                                <input type="password" name="password" placeholder="Enter password">
                            </div>
                            <div class="row px-3 pt-2 mb-4">
                                <a id="olvidoPass" data-toggle="modal" style="font-size:15px"
                                    data-target="#enviarEmail">
                                    ¿Has olvidado tu contraseña?
                                </a>
                            </div>
                            <script>
                                $("#olvidoPass").on("click", function() {
                                    $("#enviarEmail").modal("show");
                                });
                            </script>
                            <div class="row mb-3 px-3">
                                <button type="submit" class="btn btn-blue text-center">Iniciar Sesión</button>
                            </div>
                            <div class="row mb-4 px-3">
                                <small class="font-weight" style="font-size:15px">No tienes una cuenta? <a
                                        href="{{ route('register') }}" class="text-danger ">Registrate</a></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-blue py-4">
                    <div class="row px-3">
                        <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2023. Rafael Hinestrosa.</small>
                        <div class="social-contact ml-4 ml-sm-auto">
                            <span class="fa fa-facebook mr-4 text-sm"></span>
                            <span class="fa fa-google-plus mr-4 text-sm"></span>
                            <span class="fa fa-linkedin mr-4 text-sm"></span>
                            <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
